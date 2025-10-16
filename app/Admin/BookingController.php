<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Booking, PackageSchedule};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $r)
    {
        $q = Booking::with(['user','package','schedule'])
            ->when($r->status, fn($x)=>$x->where('status',$r->status))
            ->when($r->keyword, function($x) use ($r){
                $kw = '%'.$r->keyword.'%';
                $x->whereHas('user', fn($u)=>$u->where('name','like',$kw)->orWhere('email','like',$kw))
                  ->orWhereHas('package', fn($p)=>$p->where('title','like',$kw));
            })
            ->orderByDesc('id');

        $bookings = $q->paginate(15)->withQueryString();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user','package','schedule']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $booking->load(['user','package','schedule']);
        $schedules = PackageSchedule::where('tour_package_id',$booking->tour_package_id)
                        ->orderBy('depart_date')->get();
        return view('admin.bookings.edit', compact('booking','schedules'));
    }

    public function update(Request $r, Booking $booking)
    {
        $data = $r->validate([
            'status'      => 'required|in:pending,paid,cancelled',
            'pax'         => 'required|integer|min:1|max:50',
            'schedule_id' => 'nullable|exists:package_schedules,id',
        ]);

        return DB::transaction(function() use ($booking,$data){
            if(isset($data['schedule_id']) && $data['schedule_id'] != $booking->schedule_id){
                if($booking->schedule_id){
                    PackageSchedule::where('id',$booking->schedule_id)->increment('seats_quota', $booking->pax);
                }
                $new = PackageSchedule::lockForUpdate()->findOrFail($data['schedule_id']);
                if($new->seats_quota < $data['pax']){
                    return back()->withErrors(['pax'=>'Kuota tidak cukup pada jadwal baru'])->withInput();
                }
                $new->decrement('seats_quota', $data['pax']);
                $booking->schedule_id = $new->id;
            }elseif($data['pax'] != $booking->pax && $booking->schedule_id){
                $diff = $data['pax'] - $booking->pax;
                if($diff > 0){
                    $sched = PackageSchedule::lockForUpdate()->find($booking->schedule_id);
                    if($sched->seats_quota < $diff){
                        return back()->withErrors(['pax'=>'Kuota tambahan tidak cukup'])->withInput();
                    }
                    $sched->decrement('seats_quota', $diff);
                }elseif($diff < 0){
                    PackageSchedule::where('id',$booking->schedule_id)->increment('seats_quota', abs($diff));
                }
            }

            $booking->pax    = $data['pax'];
            $booking->status = $data['status'];
            $booking->paid_at = $data['status']==='paid' ? now() : null;

            $booking->total_price = $booking->package->base_price * $booking->pax;
            $booking->save();

            return redirect()->route('admin.bookings.index')->with('success','Booking diperbarui');
        });
    }

    public function destroy(Booking $booking)
    {
        return DB::transaction(function() use ($booking){
            if($booking->schedule_id){
                PackageSchedule::where('id',$booking->schedule_id)->increment('seats_quota', $booking->pax);
            }
            $booking->delete();
            return back()->with('success','Booking dihapus');
        });
    }
}

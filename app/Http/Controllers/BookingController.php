<?php

namespace App\Http\Controllers;

use App\Models\{Booking, TourPackage, PackageSchedule};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // LIST booking milik user
    public function index()
    {
        $bookings = Booking::with('package','schedule')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    // FORM booking
    public function create(TourPackage $package)
    {
        $package->load('schedules');
        return view('bookings.create', compact('package'));
    }

    // SIMPAN booking
    public function store(Request $r, TourPackage $package)
    {
        $data = $r->validate([
            'schedule_id' => 'required|exists:package_schedules,id',
            'pax'         => 'required|integer|min:1|max:50',
        ]);

        return DB::transaction(function () use ($package, $data) {
            $schedule = PackageSchedule::lockForUpdate()->findOrFail($data['schedule_id']);
            abort_if($schedule->tour_package_id !== $package->id, 422, 'Jadwal tidak sesuai paket');

            if ($schedule->seats_quota < $data['pax']) {
                return back()->withErrors(['pax'=>'Kuota tidak mencukupi']);
            }

            $schedule->decrement('seats_quota', $data['pax']);

            $booking = Booking::create([
                'user_id'         => Auth::id(),
                'tour_package_id' => $package->id,
                'schedule_id'     => $schedule->id,
                'pax'             => $data['pax'],
                'total_price'     => $package->base_price * $data['pax'],
                'status'          => 'pending',
            ]);

            return redirect()->route('bookings.index')
                ->with('success', 'Booking dibuat (#'.$booking->id.')');
        });
    }

    // UPLOAD bukti pembayaran -> auto set paid
    public function uploadProof(Request $r, Booking $booking)
    {
        abort_if($booking->user_id !== Auth::id(), 403);

        $r->validate([
            'proof' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $path = $r->file('proof')->store('payment_proofs', 'public');

        $booking->update([
            'payment_proof_path' => $path,
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with('success','Bukti pembayaran diunggah. Status menjadi paid.');
    }
}

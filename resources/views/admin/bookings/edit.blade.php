@extends('layouts.admin')
@section('content')
<h3 class="mb-3">Edit Booking #{{ $booking->id }}</h3>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="card">
      <div class="card-body">
        <form method="post" action="{{ route('admin.bookings.update',$booking->id) }}">
          @csrf @method('PUT')

          <div class="mb-2">
            <label class="form-label">User</label>
            <input class="form-control" value="{{ $booking->user->name }} ({{ $booking->user->email }})" disabled>
          </div>

          <div class="mb-2">
            <label class="form-label">Paket</label>
            <input class="form-control" value="{{ $booking->package->title }}" disabled>
          </div>

          <div class="mb-2">
            <label class="form-label">Jadwal</label>
            <select name="schedule_id" class="form-select">
              <option value="">— Tanpa Jadwal —</option>
              @foreach($schedules as $s)
                <option value="{{ $s->id }}" @selected(optional($booking->schedule)->id==$s->id)>
                  {{ \Carbon\Carbon::parse($s->depart_date)->isoFormat('D MMM YYYY') }} (kuota {{ $s->seats_quota }})
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-2">
            <label class="form-label">Pax</label>
            <input type="number" min="1" max="50" name="pax" value="{{ old('pax',$booking->pax) }}" class="form-control" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              @foreach(['pending','paid','cancelled'] as $st)
                <option value="{{ $st }}" @selected($booking->status==$st)>{{ $st }}</option>
              @endforeach
            </select>
          </div>

          <button class="btn btn-primary">Simpan Perubahan</button>
          <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="card">
      <div class="card-body">
        <h6 class="mb-2">Bukti Pembayaran</h6>
        @if($booking->payment_proof_path)
          <a target="_blank" href="{{ asset('storage/'.$booking->payment_proof_path) }}">
            <img src="{{ asset('storage/'.$booking->payment_proof_path) }}" class="img-fluid rounded">
          </a>
        @else
          <p class="text-muted">Belum ada bukti.</p>
        @endif
        <hr>
        <div>Total sekarang:</div>
        <div class="display-6">Rp {{ number_format($booking->total_price,0,',','.') }}</div>
      </div>
    </div>
  </div>
</div>
@endsection

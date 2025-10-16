@extends('layouts.app')
@section('content')
<div class="row g-4">
  <div class="col-md-7">
    <h1>{{ $package->title }}</h1>
    <p class="text-muted">{{ $package->destination->name }} • {{ $package->duration_days }} hari</p>
    <div class="mb-3">@foreach($package->images as $img)<img src="{{ $img->path }}" class="img-fluid rounded mb-2">@endforeach</div>
    <p>{{ $package->description }}</p>
    <h5>Itinerary</h5>
    <ol>
      @foreach($package->itinerary as $it)
        <li><strong>Hari {{ $it->day_number }}:</strong> {{ $it->title }} — <span class="text-muted">{{ $it->description }}</span></li>
      @endforeach
    </ol>
  </div>
  <div class="col-md-5">
    <div class="card">
      <div class="card-body">
        <h5>Mulai dari</h5>
        <div class="display-6">Rp {{ number_format($package->base_price,0,',','.') }}</div>
        <hr>
        <form method="post" action="{{ route('bookings.store',$package->slug) }}">
          @csrf
          <div class="mb-2">
            <label class="form-label">Jadwal Keberangkatan</label>
            <select name="schedule_id" class="form-select" required>
              @foreach($package->schedules as $s)
                <option value="{{ $s->id }}">{{ \Carbon\Carbon::parse($s->depart_date)->isoFormat('D MMMM Y') }} — Kuota: {{ $s->seats_quota }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-2">
            <label class="form-label">Jumlah Orang</label>
            <input type="number" min="1" name="pax" class="form-control" value="1" required>
          </div>
          @auth
            <button class="btn btn-primary w-100">Pesan Sekarang</button>
          @else
            <a href="/login" class="btn btn-outline-primary w-100">Login untuk Booking</a>
          @endauth
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
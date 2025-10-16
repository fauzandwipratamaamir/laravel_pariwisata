@extends('layouts.admin')
@section('content')
<h3>Detail Booking #{{ $booking->id }}</h3>
<ul class="list-group mb-3">
  <li class="list-group-item"><strong>User:</strong> {{ $booking->user->name }} ({{ $booking->user->email }})</li>
  <li class="list-group-item"><strong>Paket:</strong> {{ $booking->package->title }}</li>
  <li class="list-group-item"><strong>Jadwal:</strong> {{ optional($booking->schedule)->depart_date ?? '—' }}</li>
  <li class="list-group-item"><strong>Pax:</strong> {{ $booking->pax }}</li>
  <li class="list-group-item"><strong>Total:</strong> Rp {{ number_format($booking->total_price,0,',','.') }}</li>
  <li class="list-group-item"><strong>Status:</strong> {{ $booking->status }}</li>
  <li class="list-group-item"><strong>Dibayar:</strong> {{ optional($booking->paid_at) }}</li>
</ul>
@if($booking->payment_proof_path)
  <a target="_blank" href="{{ asset('storage/'.$booking->payment_proof_path) }}">
    <img src="{{ asset('storage/'.$booking->payment_proof_path) }}" class="img-fluid rounded">
  </a>
@endif
<a href="{{ route('admin.bookings.edit',$booking->id) }}" class="btn btn-primary mt-3">Edit</a>
@endsection

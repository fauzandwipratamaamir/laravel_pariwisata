@extends('layouts.admin')
@section('content')
<h2 class="mb-3">Dashboard Admin</h2>
<div class="row g-3">
  <div class="col-md-3"><a class="btn btn-dark w-100" href="/admin/bookings">Kelola Booking</a></div>
  <div class="col-md-3"><a class="btn btn-dark w-100" href="/admin/packages">Kelola Paket</a></div>
  <div class="col-md-3"><a class="btn btn-dark w-100" href="/admin/categories">Kelola Kategori</a></div>
  <div class="col-md-3"><a class="btn btn-dark w-100" href="/admin/destinations">Kelola Destinasi</a></div>
</div>
@endsection

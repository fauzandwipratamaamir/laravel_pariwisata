@extends('layouts.app')
@section('content')
<h2>Register</h2>
<form method="post" action="/register">@csrf
  <div class="mb-2"><label class="form-label">Nama</label><input class="form-control" name="name" required></div>
  <div class="mb-2"><label class="form-label">Email</label><input class="form-control" name="email" type="email" required></div>
  <div class="mb-2"><label class="form-label">Password</label><input class="form-control" name="password" type="password" required></div>
  <div class="mb-2"><label class="form-label">Konfirmasi Password</label><input class="form-control" name="password_confirmation" type="password" required></div>
  <button class="btn btn-primary">Daftar</button>
</form>
@endsection
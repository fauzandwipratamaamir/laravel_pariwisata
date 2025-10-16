@extends('layouts.app')
@section('content')
<h2>Login</h2>
<form method="post" action="/login">@csrf
  <div class="mb-2"><label class="form-label">Email</label><input class="form-control" name="email" type="email" required></div>
  <div class="mb-2"><label class="form-label">Password</label><input class="form-control" name="password" type="password" required></div>
  <div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="remember" id="remember"><label class="form-check-label" for="remember">Ingat saya</label></div>
  <button class="btn btn-primary">Masuk</button>
</form>
@endsection
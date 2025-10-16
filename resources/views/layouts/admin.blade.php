<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | {{ $title ?? 'TripGo' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark navbar-expand-lg mb-4">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="/admin">TripGo Admin</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#admnav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="admnav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/admin/bookings">Booking</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/packages">Paket</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/categories">Kategori</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/destinations">Destinasi</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/">← Ke Situs</a></li>
        <li class="nav-item">
          <form action="/logout" method="post" class="d-inline">@csrf
            <button class="btn btn-sm btn-outline-light">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  @include('partials.flash')
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="/">TripGo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/packages">Paket</a></li>
        @auth
          @can('admin')<li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>@endcan
          <li class="nav-item"><a class="nav-link" href="/my/bookings">Booking Saya</a></li>
        @endauth
      </ul>
      <ul class="navbar-nav">
        @guest
          <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
        @else
          <li class="nav-item"><span class="navbar-text me-2">Hi, {{ auth()->user()->name }}</span></li>
          <li class="nav-item">
            <form action="/logout" method="post">@csrf<button class="btn btn-sm btn-outline-danger">Logout</button></form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
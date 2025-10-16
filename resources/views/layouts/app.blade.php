<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'TripGo' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Hero */
    .hero {
      background: linear-gradient(120deg, #f8fbff 0%, #eef5ff 50%, #ffffff 100%);
      border-bottom: 1px solid #eef1f6;
    }
    .hero .title {
      font-size: clamp(28px, 4vw, 48px);
      font-weight: 800;
      letter-spacing: -0.02em;
    }
    .hero .subtitle { color:#6b7280; }

    /* Card destinasi */
    .pkg-card { transition: transform .2s ease, box-shadow .2s ease; border-radius: 18px; overflow: hidden; }
    .pkg-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(16,24,40,.08); }
    .pkg-img { aspect-ratio: 16/11; object-fit: cover; width: 100%; }
    .price { font-size: 1.1rem; font-weight: 700; }

    /* Filter pill */
    .filter-pill { border-radius: 999px; }

    /* Footer */
    .site-footer { color:#6b7280; border-top:1px solid #eef1f6; }
  </style>
</head>
<body>
  @include('partials.nav')

  <main class="container my-4">
    @include('partials.flash')
    {{ $slot ?? '' }}
    @yield('content')
  </main>

  <footer class="site-footer py-4">
    <div class="container d-flex flex-wrap gap-2 justify-content-between align-items-center">
      <small>© {{ date('Y') }} TripGo</small>
      <div class="d-flex gap-3">
        <a href="/packages" class="link-secondary text-decoration-none">Semua Paket</a>
        @auth @can('admin')<a href="/admin" class="link-secondary text-decoration-none">Admin</a>@endcan @endauth
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

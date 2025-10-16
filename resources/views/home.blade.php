@extends('layouts.app')
@section('content')

<section class="hero rounded-4 p-4 p-md-5 mb-5">
  <div class="row align-items-center g-4">
    <div class="col-lg-7">
      <h1 class="title mb-2">Jelajahi Paket Wisata Populer</h1>
      <p class="subtitle mb-0">Destinasi terkurasi, harga transparan, jadwal fleksibel. Pilih paket favoritmu!</p>
    </div>
    <div class="col-lg-5">
      <form action="/packages" class="d-flex gap-2">
        <input name="keyword" class="form-control filter-pill" placeholder="Cari Bali, Labuan Bajo, dll…">
        <button class="btn btn-primary filter-pill px-4">Cari</button>
      </form>
    </div>
  </div>
</section>

@if($featured->count())
<div class="row g-4">
  @foreach($featured as $p)
    <div class="col-md-6 col-lg-4">
      <div class="card pkg-card h-100">
        @php $img = $p->images->first()->path ?? 'https://picsum.photos/800/550?blur=1'; @endphp
        <img src="{{ $img }}" class="pkg-img" alt="{{ $p->title }}">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start mb-1">
            <h5 class="card-title mb-0">{{ $p->title }}</h5>
            <span class="badge bg-success-subtle border border-success-subtle text-success"> {{ $p->duration_days }} hari </span>
          </div>
          <div class="small text-muted mb-2">{{ $p->destination->name }} • {{ $p->category->name }}</div>
          <div class="price mb-3">Rp {{ number_format($p->base_price,0,',','.') }} <span class="fw-normal text-muted">/ pax</span></div>
          <a href="{{ route('packages.show',$p->slug) }}" class="btn btn-primary w-100">Lihat Paket</a>
        </div>
      </div>
    </div>
  @endforeach
</div>
@else
  <p>Belum ada paket aktif.</p>
@endif
@endsection

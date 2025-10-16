@extends('layouts.app')
@section('content')
<h1 class="mb-3 fw-bold">Semua Paket Wisata</h1>

<form class="row g-2 gy-2 align-items-center mb-3">
  <div class="col-md-3"><input name="keyword" value="{{ request('keyword') }}" class="form-control filter-pill" placeholder="Cari paket..."></div>
  <div class="col-md-3">
    <select name="category" class="form-select filter-pill">
      <option value="">Semua Kategori</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}" @selected(request('category')==$c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <select name="destination" class="form-select filter-pill">
      <option value="">Semua Destinasi</option>
      @foreach($destinations as $d)
        <option value="{{ $d->id }}" @selected(request('destination')==$d->id)>{{ $d->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2 d-flex gap-2">
    <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control filter-pill" placeholder="Min">
    <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control filter-pill" placeholder="Max">
  </div>
  <div class="col-md-1"><button class="btn btn-primary w-100 filter-pill">Filter</button></div>
</form>

<div class="row g-4">
  @forelse($packages as $p)
  <div class="col-sm-6 col-lg-4 col-xl-3">
    <div class="card pkg-card h-100">
      @php $img = $p->images->first()->path ?? 'https://picsum.photos/800/550?random=1'; @endphp
      <img src="{{ $img }}" class="pkg-img" alt="{{ $p->title }}">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <h6 class="card-title mb-1">{{ $p->title }}</h6>
          <span class="badge text-bg-light border">{{ $p->duration_days }}h</span>
        </div>
        <div class="small text-muted">{{ $p->destination->name }}</div>
        <div class="price mt-2 mb-3">Rp {{ number_format($p->base_price,0,',','.') }}</div>
        <a href="{{ route('packages.show',$p->slug) }}" class="btn btn-sm btn-outline-primary w-100">Detail</a>
      </div>
    </div>
  </div>
  @empty
    <p>Tidak ada paket.</p>
  @endforelse
</div>

<div class="mt-3">{{ $packages->links() }}</div>
@endsection

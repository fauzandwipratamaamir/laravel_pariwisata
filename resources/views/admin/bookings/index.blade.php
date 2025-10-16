@extends('layouts.admin')
@section('content')
<h3 class="mb-3">Semua Booking</h3>

<form class="row g-2 mb-3">
  <div class="col-md-4">
    <input name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Cari user/paket...">
  </div>
  <div class="col-md-3">
    <select name="status" class="form-select">
      <option value="">Semua Status</option>
      @foreach(['pending','paid','cancelled'] as $st)
        <option value="{{ $st }}" @selected(request('status')==$st)>{{ $st }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2">
    <button class="btn btn-light w-100">Filter</button>
  </div>
</form>

<table class="table align-middle">
  <thead>
    <tr>
      <th>#</th><th>User</th><th>Paket</th><th>Tanggal</th><th>Pax</th><th>Total</th><th>Status</th><th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  @foreach($bookings as $b)
    <tr>
      <td>{{ $b->id }}</td>
      <td>
        <div class="fw-semibold">{{ $b->user->name }}</div>
        <div class="small text-muted">{{ $b->user->email }}</div>
      </td>
      <td>{{ $b->package->title }}</td>
      <td>{{ optional($b->schedule)->depart_date ?? '—' }}</td>
      <td>{{ $b->pax }}</td>
      <td>Rp {{ number_format($b->total_price,0,',','.') }}</td>
      <td>
        @if($b->status=='paid')<span class="badge text-bg-success">paid</span>
        @elseif($b->status=='cancelled')<span class="badge text-bg-danger">cancelled</span>
        @else <span class="badge text-bg-secondary">pending</span>@endif
      </td>
      <td class="d-flex gap-2">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.bookings.edit',$b->id) }}">Edit</a>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.bookings.show',$b->id) }}">Detail</a>
        <form action="{{ route('admin.bookings.destroy',$b->id) }}" method="post" onsubmit="return confirm('Hapus booking?')">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-outline-danger">Hapus</button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

{{ $bookings->links() }}
@endsection

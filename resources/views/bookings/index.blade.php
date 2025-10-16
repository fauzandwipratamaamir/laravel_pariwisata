@extends('layouts.app')
@section('content')
<h2>Booking Saya</h2>
<table class="table align-middle">
  <thead>
    <tr>
      <th>#</th><th>Paket</th><th>Tanggal</th><th>Pax</th><th>Total</th><th>Status</th><th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  @foreach($bookings as $b)
    <tr>
      <td>{{ $b->id }}</td>
      <td>{{ $b->package->title }}</td>
      <td>{{ optional($b->schedule)->depart_date }}</td>
      <td>{{ $b->pax }}</td>
      <td>Rp {{ number_format($b->total_price,0,',','.') }}</td>
      <td>
        @if($b->status === 'paid')
          <span class="badge text-bg-success">paid</span>
        @elseif($b->status === 'cancelled')
          <span class="badge text-bg-danger">cancelled</span>
        @else
          <span class="badge text-bg-secondary">pending</span>
        @endif
      </td>
      <td style="min-width: 260px">
        @if($b->status !== 'paid')
          <form action="{{ route('bookings.upload_proof', $b->id) }}" method="post" enctype="multipart/form-data" class="d-flex gap-2">
            @csrf
            <input type="file" name="proof" accept="image/*" class="form-control form-control-sm" required>
            <button class="btn btn-sm btn-primary">Upload</button>
          </form>
          <small class="text-muted">jpg/jpeg/png/webp, maks 2MB</small>
        @else
          @if($b->payment_proof_path)
            <a class="btn btn-sm btn-outline-success" target="_blank" href="{{ asset('storage/'.$b->payment_proof_path) }}">
              Lihat Bukti
            </a>
          @else
            <span class="text-muted">—</span>
          @endif
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
{{ $bookings->links() }}
@endsection

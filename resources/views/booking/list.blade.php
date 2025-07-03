{{-- resources/views/booking/list.blade.php --}}
@extends('layouts.app')
@section('title','Booking Saya')

@push('css')
<style>
  /* kartu ringkas ketika layar < 768 px */
  @media (max-width: 767.98px){
    .booking-card {border-left:4px solid #0d6efd}
    .booking-card .badge   {font-size:.75rem}
    .booking-card h5       {font-size:1rem;margin-bottom:.25rem}
    .booking-card small    {font-size:.7rem}
  }
</style>
@endpush

@section('content')
<div class="container my-4">
  <h3 class="mb-4 fw-semibold">Booking Saya</h3>

  {{-- JIKA TIDAK ADA BOOKING --}}
  @if($bookings->isEmpty())
      <div class="alert alert-info d-flex align-items-center gap-2">
        <i class="bi bi-info-circle-fill"></i>
        <span>Anda belum memiliki booking apa pun.</span>
      </div>
  @else

    {{-- ======================== TABLE (DESKTOP) ======================== --}}
    <div class="d-none d-md-block">
      <table class="table align-middle table-hover shadow-sm">
        <thead class="table-light">
          <tr class="align-middle text-nowrap">
            <th style="width:60px">#</th>
            <th>Konsultan</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th style="width:110px">Detail Riwayat Booking Saya</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bookings as $b)
            <tr>
              <td>{{ $loop->iteration + ($bookings->currentPage()-1)*$bookings->perPage() }}</td>
              <td>{{ $b->consultant->user->name }}</td>
              <td>{{ \Carbon\Carbon::parse($b->date)->isoFormat('D MMMM Y') }}</td>
              <td>{{ substr($b->time,0,5) }} WIB</td>
              <td>
                <a href="{{ route('booking.show',$b->id) }}"
                   class="btn btn-sm btn-outline-primary">
                  <i class="bi bi-eye-fill me-1"></i> Detail
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- ======================== KARTU (MOBILE) ======================== --}}
    <div class="d-md-none">
      @foreach($bookings as $b)
      <div class="booking-card bg-white rounded shadow-sm p-3 mb-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
          <h5 class="mb-0">{{ $b->consultant->user->name }}</h5>
          <span class="badge
            @class([
              'bg-warning text-dark' => $b->status=='pending',
              'bg-success'           => $b->status=='approved',
              'bg-danger'            => $b->status=='rejected',
              'bg-secondary'         => $b->status=='done',
            ])">
            {{ ucfirst($b->status) }}
          </span>
        </div>
        <small class="text-muted d-block">
          {{ \Carbon\Carbon::parse($b->date)->isoFormat('ddd, D MMM Y') }}
          &bull; {{ substr($b->time,0,5) }} WIB
        </small>
        <a href="{{ route('booking.show',$b->id) }}"
           class="btn btn-sm btn-outline-primary mt-2 w-100">
          <i class="bi bi-eye-fill me-1"></i> Detail
        </a>
      </div>
      @endforeach
    </div>

    {{-- ======================== PAGINATION ======================== --}}
    <div class="mt-3">
      {{ $bookings->links('vendor.pagination.bootstrap-5') }}
    </div>

  @endif
</div>
@endsection

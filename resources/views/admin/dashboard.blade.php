@extends('admin.layout')
@section('content')
<h3 class="mb-4">Ringkasan</h3>

{{-- Style khusus dash-card --}}
<style>
  .dash-card {
    position: relative;
    border: none;
    border-radius: 1rem;
    min-height: 130px;
    color: #fff;
    overflow: hidden;
  }

  .dash-card .icon {
    position: absolute;
    right: -25px;
    bottom: -25px;
    font-size: 6rem;
    opacity: 0.15;
  }
</style>

<div class="row g-4">

  {{-- TOTAL USER --}}
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card dash-card bg-primary shadow-sm">
      <div class="card-body">
        <h6 class="text-uppercase fw-semibold small">Total User</h6>
        <h2 class="fw-bold mb-0">{{ $totalUsers }}</h2>
        <i class="bi bi-people-fill icon"></i>
      </div>
    </div>
  </div>

  {{-- TOTAL KONSULTAN --}}
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card dash-card bg-secondary shadow-sm">
      <div class="card-body">
        <h6 class="text-uppercase fw-semibold small">Total Konsultan</h6>
        <h2 class="fw-bold mb-0">{{ $totalConsultant }}</h2>
        <i class="bi bi-person-badge icon"></i>
      </div>
    </div>
  </div>

  {{-- KONSULTAN AKTIF --}}
  <div class="col-12 col-md-6 col-xl-3">
    <div class="card dash-card bg-success shadow-sm">
      <div class="card-body">
        <h6 class="text-uppercase fw-semibold small">Konsultan Aktif</h6>
        <h2 class="fw-bold mb-0">{{ $totalConsultantActive }}</h2>
        <i class="bi bi-check-circle-fill icon"></i>
      </div>
    </div>
  </div>

</div>
@endsection

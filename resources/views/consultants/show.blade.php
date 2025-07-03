@extends('layouts.app')
@section('title', 'Profil Konsultan '.$consultant->user->name)

@section('content')
<style>
  .profile-section{
    background:#f0f6ff;
    padding:3rem 1.5rem;
    border-radius:1rem;
  }
  .tag{
    background:#e0f2ff;
    color:#0c4a6e;
    font-weight:500;
    padding:.3rem .7rem;
    border-radius:1rem;
    font-size:.85rem;
    display:inline-block;
    margin:.25rem;
  }
</style>

<div class="container my-5">
  <div class="profile-section">
    <div class="row align-items-start g-4">

      {{-- Foto --}}
      <div class="col-md-3 text-center">
        <img src="{{ $consultant->photo
                    ? asset('storage/'.$consultant->photo)
                    : asset('images/default-avatar.png') }}"
             alt="Foto Konsultan"
             class="img-fluid rounded shadow-sm mb-3"
             style="width:100%;max-width:180px">
      </div>

      {{-- Detail --}}
      <div class="col-md-6">
        <h3 class="fw-bold mb-2">Profil Konsultan {{ $consultant->user->name }}</h3>
        <p class="mb-2 text-muted">{{ $consultant->user->email }}</p>

        <div class="mb-3">
          @foreach(explode(',', $consultant->specialization) as $spec)
            <span class="tag">{{ trim($spec) }}</span>
          @endforeach
        </div>

        <h5 class="fw-semibold mt-4 mb-2">Tentang Konsultan</h5>
        <p class="text-muted">
          {{ $consultant->bio ?? 'Konsultan belum menambahkan deskripsi.' }}
        </p>

        {{-- Jam Operasi --}}
        @if($consultant->working_hours)
          <p class="mt-3 text-muted">
            <i class="bi bi-clock me-1"></i>
            <strong>Jam Operasi:</strong>
            {{ str_replace('-', ' – ', $consultant->working_hours) }}
          </p>
        @endif
      </div>

      {{-- Panel Aksi --}}
      <div class="col-md-3 d-flex flex-column align-items-start gap-3">
        <h5 class="fw-semibold">Tarif Konsultasi</h5>
        <p class="fs-5 text-primary fw-bold">
          Rp {{ number_format($consultant->rate,0,',','.') }} / sesi
        </p>
        {{-- <a href="#" class="btn btn-success w-100">Booking Sekarang</a> --}}
        {{-- <a href="{{ route('konseling_online') }}" class="btn btn-outline-secondary w-100">Kembali</a> --}}
      </div>

    </div>
  </div>
</div>
@endsection

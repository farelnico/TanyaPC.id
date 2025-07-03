@php
/** @var \Illuminate\Pagination\LengthAwarePaginator $consultants */
@endphp

@extends('layouts.app') {{-- pakai layout utama supaya <html>… otomatis --}}

@section('title','Konsultan Online')

@section('content')


<!-- Section: Statistik -->
<section class="statistik-section">
  <div class="image-wrapper">
    <img src="{{ asset('assets/bg1.png') }}" alt="Konsultasi" class="main-image" />
  </div>
</section>

<section class="consultant-list">
  <h2>Konsultan Pilihan Untukmu</h2>
  <p>Rekomendasi Konsultan dari TanyaPC.id</p>

  {{-- LOOP konsultan --}}
  @forelse($consultants as $c)
    <div class="consultant-card">

      {{-- Foto + badge --}}
      <div class="consultant-photo">
        <img src="{{ $c->photo ? asset('storage/'.$c->photo) : asset('images/default-avatar.png') }}"
             alt="{{ $c->user->name }}">
        @if($loop->first)  {{-- contoh badge untuk 1–2 baris pertama --}}
          <span class="badge">Rekomendasi</span>
        @endif
      </div>

      {{-- Info --}}
      <div class="consultant-info">
        <p class="license">🟡 Konsultan Berlisensi</p>
        <h3>{{ $c->user->name }}</h3>

        @if($c->working_hours)
          <div class="schedule-options d-flex align-items-center gap-2">
            <span class="schedule-label mb-0">Jam Operasional Konsultan:</span>

            <button class="schedule" disabled>
              {{ str_replace('-', ' – ', $c->working_hours) }} WIB
            </button>
          </div>
        @endif
      </div>


      {{-- Aksi --}}
      <div class="consultant-actions">
        <a href="{{ route('consultant.show',$c->slug) }}" class="btn-outline">Lihat Profil</a>
        <a href="{{ route('booking.create',$c->slug) }}" class="btn-primary">Jadwalkan Sekarang</a>
      </div>
    </div>
  @empty
    <p>Belum ada konsultan tersedia.</p>
  @endforelse

</section>

@include('partials.footer') 

@endsection






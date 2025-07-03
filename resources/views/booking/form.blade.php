{{-- resources/views/booking/form.blade.php --}}
@extends('layouts.app')
@section('title', 'Pilih Jadwal • '.$consultant->user->name)

@push('css')
<style>
  /* --- Card wrapper --- */
  .booking-card      { max-width: 640px; margin: 3rem auto; }
  .booking-card img  { object-fit: cover; }
  .booking-card .card-header h5 { font-weight: 600; }
</style>
@endpush

@section('content')
<div class="card shadow-sm border-1 booking-card w-100">


  {{-- ---------- Header (foto + nama konsultan) ---------- --}}
  {{-- <div class="card-header bg-white border-0 d-flex align-items-center">
    <img  src="{{ $consultant->user->avatar_url
                 ?? 'https://ui-avatars.com/api/?name='.urlencode($consultant->user->name) }}"
          alt="{{ $consultant->user->name }}"
          class="rounded-circle me-3" width="56" height="56">
    <h5 class="mb-0">{{ $consultant->user->name }}</h5>
  </div> --}}

  {{-- ---------- Header (foto + nama konsultan) ---------- --}}
<div class="card-header bg-white border-0 d-flex align-items-center">
    <img src="{{ $consultant->photo
                 ? asset('storage/'.$consultant->photo)               {{-- foto upload admin --}}
                 : ($consultant->user->avatar_url                    {{-- avatar dari profil user (jika ada) --}}
                    ?? 'https://ui-avatars.com/api/?name='.urlencode($consultant->user->name)) }}"
         alt="{{ $consultant->user->name }}"
         class="rounded-circle me-3" width="56" height="56">
    <h5 class="mb-0">{{ $consultant->user->name }}</h5>
</div>


  {{-- ---------- Body (form) ---------- --}}
  <div class="card-body">

    {{-- Judul kecil dalam body --}}
    <h6 class="fw-bold mb-3">Booking Jadwal</h6>

    {{-- Flash & Error --}}
    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('booking.store', $consultant->slug) }}"
          method="POST" class="booking-form">
      @csrf

      {{-- ========== METODE KONSELING ========== --}}
      <div class="mb-3">
        <label class="form-label">Metode Konseling</label>

        @if($consultant->mode === 'both')
          <select name="mode" class="form-select" required>
            <option value="online">Online</option>
            <option value="offline">Offline</option>
          </select>
        @else
          <input type="hidden" name="mode" value="{{ $consultant->mode }}">
          <div class="form-control-plaintext ps-2">
            {{ ucfirst($consultant->mode) }}
          </div>
        @endif
      </div>

      {{-- ========== TANGGAL ========== --}}
      <div class="mb-3">
        <label for="date" class="form-label">Pilih Tanggal</label>
        <input type="date"
               id="date" name="date"
               class="form-control"
               min="{{ now()->toDateString() }}"
               required>
      </div>

      {{-- ========== JAM ========== --}}
      <div class="mb-3">
        <label for="time" class="form-label">Pilih Jam</label>
        <select id="time" name="time" class="form-select" required>
          @php
            $availSlots = $slots ?? [
              '08:00','08:30','09:00','09:30','10:00',
              '13:00','13:30','14:00','14:30','15:00',
              '16:00','19:00','20:00'
            ];
          @endphp

          @foreach($availSlots as $slot)
            <option value="{{ $slot }}">{{ $slot }}</option>
          @endforeach
        </select>
      </div>

      {{-- ========== SUBMIT ========== --}}
      <button class="btn btn-primary w-100">
        <i class="bi bi-check-circle me-1"></i> Kirim Booking
      </button>
    </form>

  </div> {{-- /card-body --}}
</div> {{-- /card --}}
@endsection

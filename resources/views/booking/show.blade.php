{{-- resources/views/booking/show.blade.php --}}
@extends('layouts.app')
@section('title','Booking #'.$booking->id)

@php
    /* ---------- Badge warna ---------- */
    $clr = [
        'pending'  => 'warning text-dark',
        'approved' => 'primary',
        'rejected' => 'danger',
        'done'     => 'success',
    ][$booking->status];

    /* ---------- Link WhatsApp ---------- */
    $waMsg = urlencode(
        "Halo, ini detail booking saya (#{$booking->id}) ".
        "pada ".\Carbon\Carbon::parse($booking->date)->translatedFormat('d F Y').
        " pukul {$booking->time} WIB."
    );
    $waLink = 'https://wa.me/'.ltrim($booking->consultant->user->phone,'0').'?text='.$waMsg;

    /* ---------- Mode layanan ---------- */
    $mode = $booking->consultant->mode;               // online | offline | both
@endphp


@section('content')
<div class="container my-5" style="max-width:750px">

    <h3 class="fw-bold mb-4">Rangkuman Sesi</h3>

    {{-- -------- Countdown dummy saat pending -------- --}}
    @if($booking->status==='pending')
        <div class="alert bg-light border-0 d-flex justify-content-between align-items-center mb-3 shadow-sm">
            <span class="fw-semibold">Selesaikan pembayaran dalam</span>
            <span class="d-flex gap-2 fs-6">
                <span class="badge bg-primary p-2">01</span> :
                <span class="badge bg-primary p-2">59</span> :
                <span class="badge bg-primary p-2">36</span>
            </span>
        </div>
    @endif

    <div class="card shadow-sm w-100">
        <div class="card-body">

            {{-- ---------- Header profil ---------- --}}
            <div class="d-flex align-items-center gap-3 mb-3">
                <img src="{{ $booking->consultant->photo
                            ? asset('storage/'.$booking->consultant->photo)
                            : asset('images/default-avatar.png') }}"
                    class="rounded-circle object-fit-cover" width="60" height="60">

                <div>
                    <h5 class="mb-0 fw-semibold">{{ $booking->consultant->user->name }}</h5>
                    <span class="badge bg-{{ $clr }} mt-1">{{ ucfirst($booking->status) }}</span>
                </div>
            </div>

            <hr>

            {{-- ---------- Jadwal & media ---------- --}}
            <div class="row text-sm">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="d-flex align-items-center text-primary fw-semibold mb-1">
                        <i class="bi bi-calendar-week me-1"></i> Jadwal Konseling
                    </div>
                    <div>
                        {{ \Carbon\Carbon::parse($booking->date)->translatedFormat('l, d F Y') }}<br>
                        {{ substr($booking->time,0,5) }}
                        – {{ \Carbon\Carbon::parse($booking->time)->addMinutes(30)->format('H:i') }} WIB
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex align-items-center text-primary fw-semibold mb-1">
                        <i class="bi bi-camera-video me-1"></i> Media Konseling
                    </div>
                    <div>
                        @switch($mode)
                            @case('online')  Video / Voice Call @break
                            @case('offline') Tatap Muka          @break
                            @default         Video / Voice Call &amp; Tatap Muka
                        @endswitch
                    </div>
                </div>
            </div>

            <hr>

            {{-- ---------- Rincian harga (contoh) ---------- --}}
            <div class="row mb-2 small">
                <div class="col">Biaya Konseling</div>
                <div class="col text-end fw-semibold">
                    Rp{{ number_format($booking->consultant->rate,0,',','.') }}
                </div>
            </div>
            <div class="row mb-2 small">
                <div class="col">Diskon</div>
                <div class="col text-end text-danger">-Rp100.000</div>
            </div>
            <div class="row mb-3 small">
                <div class="col">Biaya Administrasi</div>
                <div class="col text-end text-success">Gratis</div>
            </div>

            <div class="bg-light rounded p-3 d-flex justify-content-between align-items-center fw-bold">
                <span>Total Harga</span>
                <span class="fs-5 text-primary">
                    Rp{{ number_format($booking->consultant->rate-100000,0,',','.') }}
                </span>
            </div>

            {{-- ====================================================
                 LINK MEDIA SESI (muncul hanya jika APPROVED)
            ===================================================== --}}
            @if($booking->status === 'approved')
                {{-- ---------- ONLINE : Zoom ---------- --}}
                @if($mode === 'online' && $booking->zoom_link)
                    <div class="alert alert-info d-flex align-items-center gap-2 mt-4">
                        <i class="bi bi-camera-video-fill fs-5"></i>
                        <a href="{{ $booking->zoom_link }}" target="_blank" class="fw-semibold">
                            Link Zoom – Klik untuk bergabung
                        </a>
                    </div>

                {{-- ---------- OFFLINE / BOTH : Google Maps ---------- --}}
                @elseif(in_array($mode,['offline','both']) && $booking->map_link)
                    <div class="alert alert-info d-flex align-items-center gap-2 mt-4">
                        <i class="bi bi-geo-alt-fill fs-5"></i>
                        <a href="{{ $booking->map_link }}" target="_blank" class="fw-semibold">
                            Lihat lokasi di Google Maps
                        </a>
                    </div>
                @endif
            @endif

            {{-- ---------- Tombol WhatsApp ---------- --}}
            <a href="{{ $waLink }}" class="btn btn-success w-100 mt-3" target="_blank">
                <i class="bi bi-whatsapp me-1"></i> Kirim Detail ke WhatsApp
            </a>

        </div><!-- /.card-body -->
    </div><!-- /.card -->
</div>
@endsection

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Konsultasi PC')</title>

  {{-- Font + stylesheet utama --}}
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  {{-- Bootstrap 5 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  @stack('styles')

  {{-- Script lain (jika ada) --}}
    <script src="{{ asset('js/testimonial-marquee.js') }}" defer></script>
  </head>
    @stack('scripts')
<body>

{{-- ========== NAVBAR RESPONSIF ========== --}}
<header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 px-4">
  <div class="container-fluid">
    <a href="/layout" class="navbar-brand fw-bold text-primary">TanyaPC.id</a>

    {{-- tombol burger --}}
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- menu --}}
    <div class="collapse navbar-collapse" id="navbarContent">
      {{-- kiri --}}
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        {{-- dropdown layanan --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">Layanan</a>
          <ul class="dropdown-menu" aria-labelledby="layananDropdown">
            <li><a class="dropdown-item" href="/konseling_online">Konseling Online</a></li>
            <li><a class="dropdown-item" href="/konseling_offline">Konseling Offline</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link" href="/konseling_online">List Konsultan</a></li>
        <li class="nav-item"><a class="nav-link" href="/tentang_kami">Tentang Kami</a></li>
        <li class="nav-item"><a class="nav-link" href="https://youtu.be/AqDyPdoti2g/@TanyaPCid" target="_blank" rel="noopener">Konten Konseling</a></li>
      </ul>

      {{-- kanan --}}
      <ul class="navbar-nav flex-lg-row gap-lg-3 align-items-lg-center">
        {{-- CTA --}}
        <li class="nav-item">
          <a href="{{ url('/konseling_online') }}"
             class="btn btn-primary w-100 w-lg-auto mb-2 mb-lg-0">
             Konsultasi Sekarang
          </a>
        </li>

        {{-- auth --}}
        @auth
          {{-- dropdown avatar --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
               href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center"
                   style="width:32px;height:32px;font-weight:500">
                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
              </div>
              <span class="fw-medium">{{ strtok(Auth::user()->name,' ') }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item" href="{{ route('booking.list') }}">
                  <i class="bi bi-calendar-check me-1"></i>Riwayat Booking Saya
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST" class="px-3">@csrf
                  <button class="dropdown-item p-0">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>

          {{-- admin link --}}
          @if(Auth::user()->role==='admin')
            <li class="nav-item">
              <a href="{{ route('adm.dashboard') }}" class="btn btn-outline-primary">Admin</a>
            </li>
          @endif
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Masuk / Daftar</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</header>


{{-- ========== KONTEN UTAMA ========== --}}
<div class="container mt-4">
  @yield('content')
</div>

</body>
</html>

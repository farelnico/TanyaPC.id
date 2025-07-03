<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Konsultasi PC')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/testimonial-marquee.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap JS (dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

    <header>
      <div class="logo">
        <a href="/layout" class="brand-link">TanyaPC.id</a>
      </div>

        <nav class="nav-links">
        <div class="dropdown">
            <a href="#" class="dropbtn">Layanan &#9662;</a>
            <div class="dropdown-content">
            <a href="/konseling_online">Konseling Online</a>
            <a href="/konseling_offline">Konseling Offline</a>
            </div>
        </div>

        <a href="/konseling_online">List Konsultan</a>
        <a href="/tentang_kami">Tentang Kami</a>
        <a href="/konten_konseling">Konten Konseling</a>
        {{-- <a href="/login" class="login-link">Login</a> --}}
        </nav>

      <div class="nav-actions">
        
        <a href="{{ url('/konseling_online') }}" class="btn-primary">Konsultasi Sekarang</a>
      </div>

<ul class="navbar-nav d-flex align-items-center gap-3">

  <!-- Dropdown Login / Avatar -->
  @auth
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
      href="#" id="userDropdown" role="button"
      data-bs-toggle="dropdown" aria-expanded="false">
      <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
          style="width: 32px; height: 32px; font-weight: 500;">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
      </div>
      <span class="fw-medium">{{ strtok(Auth::user()->name, ' ') }}</span>

    </a>

<ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="userDropdown">
      @auth
      <li><a class="dropdown-item" href="{{ route('booking.list') }}">
            <i class="bi bi-calendar-check me-1"></i> Riwayat Booking Saya
          </a></li>
      @endauth
      <li><hr class="dropdown-divider"></li>
      <li>
        <form action="{{ route('logout') }}" method="POST" class="px-3">
          @csrf
          <button class="btn btn-link dropdown-item p-0">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
          </button>
        </form>
      </li>
    </ul>
  </li>
  @else
  <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">Masuk / Daftar</a>
  </li>
  @endauth
</ul>

@auth
  @if(Auth::user()->role==='admin')
     <a href="{{ route('adm.dashboard') }}" class="btn btn-outline-primary me-2">Admin</a>
  @endif
@endauth

</header>


  <!-- Konten Utama -->
  <div class="container mt-4">
    @yield('content')
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

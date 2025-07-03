<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Admin TanyaPC.id</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    /* sedikit sentuhan ‑warna menu aktif */
    .nav-link.active   { background:#0d6efd!important; }
    .nav-link.active i { opacity:.9; }
    .dash-sidebar      { width:240px;height:140vh; }
  </style>
</head>
<body class="d-flex">

  {{-- ----------  SIDEBAR  ---------- --}}
  <nav class="dash-sidebar flex-shrink-0 bg-dark text-white p-3">
    <a href="{{ route('adm.dashboard') }}" class="d-block mb-4 fw-bold text-white text-decoration-none">
      Admin TanyaPC.id
    </a>

    <ul class="nav nav-pills flex-column">

      {{-- DASHBOARD --}}
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('adm.dashboard') ? 'active fw-semibold' : '' }}"
           href="{{ route('adm.dashboard') }}">
          <i class="bi bi-speedometer2 me-1"></i> Dashboard
        </a>
      </li>

      {{-- KONSULTAN --}}
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('adm.consult.*') ? 'active fw-semibold' : '' }}"
           href="{{ route('adm.consult.index') }}">
          <i class="bi bi-person-badge me-1"></i> Konsultan
        </a>
      </li>

      {{-- BOOKING (menu baru) --}}
      <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('adm.book.*') ? 'active fw-semibold' : '' }}"
           href="{{ route('adm.book.index') }}">
          <i class="bi bi-calendar-check me-1"></i> Booking
        </a>
      </li>

      {{-- (opsional) USER --}}
      {{-- <li class="nav-item">
        <a class="nav-link text-white {{ request()->routeIs('adm.user.*') ? 'active fw-semibold' : '' }}"
           href="{{ route('adm.user.index') }}">
          <i class="bi bi-people me-1"></i> User
        </a>
      </li> --}}

      {{-- LOGOUT --}}
      <li class="nav-item mt-3">
        <form action="{{ route('logout') }}" method="POST">@csrf
          <button class="btn btn-outline-danger w-100">
            <i class="bi bi-box-arrow-right me-1"></i> Logout
          </button>
        </form>
      </li>
    </ul>
  </nav>

  {{-- ----------  AREA KONTEN  ---------- --}}
  <main class="flex-grow-1 p-4 bg-light">
    <div class="container-fluid">
      @yield('content')
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

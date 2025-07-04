{{-- resources/views/auth/login.blade.php --}}
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Masuk • TanyaPC.id</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
      html,body{
          height:100%;
          margin:0;
          /* ===== GRADIENT LATAR ===== */
          background:linear-gradient(135deg,
                         #e7f1ff 0%,
                         #c9e3ff 40%,
                         #ffffff 100%);
          background-color:#e7f1ff;          /* fallback */
          overflow:hidden;
      }
      body{
          display:flex;
          align-items:center;
          justify-content:center;
          font-family:Inter,sans-serif
      }
  </style>
</head>
<body>

  <div class="card shadow-lg rounded-4 p-4 my-2"
       style="max-width:420px;width:100%;max-height:calc(100vh - 2rem);overflow:auto;">

      {{-- Logo --}}
      <div class="text-center mb-4">
        <img src="{{ asset('assets/logo.png') }}" alt="logo" height="60">
      </div>

      <h3 class="fw-bold text-center mb-3">Welcome to TanyaPC.id</h3>

      @if($errors->any())
        <div class="alert alert-danger small py-2">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="form-floating mb-3">
          <input  type="email" name="email"
                  class="form-control @error('email') is-invalid @enderror"
                  id="emailInput" placeholder="name@example.com" required
                  value="{{ old('email') }}">
          <label for="emailInput"><i class="bi bi-envelope me-2"></i>Email</label>
        </div>

        <div class="form-floating mb-3">
          <input  type="password" name="password"
                  class="form-control @error('password') is-invalid @enderror"
                  id="passInput" placeholder="Password" required>
          <label for="passInput"><i class="bi bi-lock me-2"></i>Password</label>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 small">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Ingat saya</label>
          </div>
          <a href="#" class="text-decoration-none">Lupa password?</a>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Masuk</button>
      </form>

      <p class="small text-center mt-4">
        Belum punya akun?
        <a href="{{ url('/register') }}" class="fw-semibold text-decoration-none">Daftar</a>
      </p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

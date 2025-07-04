{{-- resources/views/auth/register.blade.php --}}
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Daftar • TanyaPC.id</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- ===== STYLE LATAR GRADIENT ===== -->
  <style>
      html,body{
          height:100%;
          margin:0;
          /* sama persis dg login: biru muda → putih */
          background:linear-gradient(135deg,
                      #e7f1ff 0%,
                      #c9e3ff 40%,
                      #ffffff 100%);
          background-color:#e7f1ff; /* fallback */
          overflow:hidden;
          font-family:Inter,sans-serif;
      }
      body{
          display:flex;
          align-items:center;
          justify-content:center;
      }
  </style>
</head>
<body>

  <!--  KARTU REGISTRASI  -->
  <div class="card shadow-lg rounded-4 p-4 my-2"
       style="max-width:420px;width:100%;max-height:calc(100vh - 2rem);overflow:auto;">

      <!-- Logo -->
      <div class="text-center mb-4">
          <img src="{{ asset('assets/logo.png') }}" alt="logo TanyaPC" height="60">
      </div>

      <h3 class="fw-bold text-center mb-3">Buat Akun TanyaPC.id</h3>

      {{-- Flash error --}}
      @if($errors->any())
          <div class="alert alert-danger small py-2">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ url('/register') }}">
          @csrf

          <!-- NAMA -->
          <div class="form-floating mb-3">
              <input type="text" name="name"
                     class="form-control @error('name') is-invalid @enderror"
                     id="nameInput" placeholder="Nama Lengkap" required
                     value="{{ old('name') }}">
              <label for="nameInput"><i class="bi bi-person me-2"></i>Nama Lengkap</label>
          </div>

          <!-- EMAIL -->
          <div class="form-floating mb-3">
              <input type="email" name="email"
                     class="form-control @error('email') is-invalid @enderror"
                     id="emailInput" placeholder="you@example.com" required
                     value="{{ old('email') }}">
              <label for="emailInput"><i class="bi bi-envelope me-2"></i>Email</label>
          </div>

          <!-- PASSWORD & KONFIRMASI -->
          <div class="row">
              <div class="col-md-6 form-floating mb-3">
                  <input type="password" name="password"
                         class="form-control @error('password') is-invalid @enderror"
                         id="passInput" placeholder="Password" required>
                  <label for="passInput"><i class="bi bi-lock me-2"></i>Password</label>
              </div>

              <div class="col-md-6 form-floating mb-3">
                  <input type="password" name="password_confirmation"
                         class="form-control" id="passConf"
                         placeholder="Ulangi Password" required>
                  <label for="passConf"><i class="bi bi-lock me-2"></i>Ulangi</label>
              </div>
          </div>

          <button class="btn btn-primary w-100 py-2" type="submit">Daftar</button>
      </form>

      <p class="small text-center mt-4">
          Sudah punya akun?
          <a href="{{ url('/login') }}" class="fw-semibold text-decoration-none">Masuk</a>
      </p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

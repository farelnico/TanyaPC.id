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
            <i class="bi bi-calendar-check me-1"></i> Booking Saya
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

    <main>
      <div class="hero-text">
        <p style="color:#0052cc; font-weight:600;">
          Konsultasi & Perakitan PC oleh Teknisi Profesional
        </p>
        <h1>
          Rakit PC Lebih Cerdas<br>Tanpa Risiko & Overbudget
        </h1>
        <p>
          Kami bantu kamu memilih komponen terbaik sesuai kebutuhan dan dana secara langsung maupun online.
        </p>

        <div class="service-cards">
          {{-- Konseling Online --}}
          <a href="{{ url('/konseling_online') }}" class="service-card">
              <div class="card-text">
                  <p class="card-label">Konseling untuk saya</p>
                  <h3>Konseling Online</h3>
                  <span class="card-cta">Pilih &nbsp;→</span>
              </div>
              <img src="{{ asset('assets/img_online_counseling.png') }}" alt="Online Icon">
          </a>

          {{-- Konseling Offline --}}
          <a href="{{ url('/konseling_offline') }}" class="service-card">
              <div class="card-text">
                  <p class="card-label">Konseling untuk saya</p>
                  <h3>Konseling Offline</h3>
                  <span class="card-cta">Pilih &nbsp;→</span>
              </div>
              <img src="{{ asset('assets/img_offline_counseling.png') }}" alt="Offline Icon">
          </a>
        </div>

      </div>
        <div class="hero-image">
            <img src="{{ asset('assets/logo.png') }}" alt="Konsultasi" class="main-image" />
        </div>
    </main>

    <section class="section-teknisi">
    <div class="section-header">
        <p class="subhead">Profil Konsultan <span style="color:#0052cc">TanyaPC.id</span></p>
        <p class="description">Lulusan terbaik dan teknisi berpengalaman dari berbagai bidang komputer & IT</p>
        <div class="badge-list">
          <img src="{{ asset('assets/ui.png') }}"  alt="badge">
          <img src="{{ asset('assets/ugm.png') }}"  alt="badge">
          <img src="{{ asset('assets/undip.png') }}"  alt="badge">  
          <img src="{{ asset('assets/its.png') }}"  alt="badge">  
          <img src="{{ asset('assets/unpad.png') }}"  alt="badge">  
        </div>
    </div>

    <div class="teknisi-list">
      <div class="teknisi-card">
          <img src="{{ asset('assets/teknisi1.png') }}" alt="Teknisi A">
          <h4>Rania R., S.Kom</h4>
          <p>Spesialis Perakitan & Upgrade PC</p><br><hr>
          {{-- <p class="rating">⭐ 5.0 (20+ review)</p> --}}
          <p class="price">Rp200.000</p>
          <p class="label">Jadwal Tersedia</p>
      </div>

      <div class="teknisi-card">
          <img src="{{ asset('assets/teknisi2.png') }}" alt="Teknisi B">
          <h4>Fariz F., S.Kom</h4>
          <p>Spesialis Hardware & Software</p><br><hr>
          {{-- <p class="rating">⭐ 4.8 (30+ review)</p> --}}
          <p class="price">Rp180.000</p>
          <p class="label">Jadwal Tersedia</p>
      </div>

      <div class="teknisi-card">
          <img src="{{ asset('assets/teknisi3.png') }}" alt="Teknisi C">
          <h4>Yulia A., S.Kom</h4>
          <p>Spesialis Gaming Setup & Optimasi FPS</p><br><hr>
          {{-- <p class="rating">⭐ 4.9 (25+ review)</p> --}}
          <p class="price">Rp190.000</p>
          <p class="label">Jadwal Tersedia</p>
      </div>

      <div class="teknisi-card">
          <img src="{{ asset('assets/teknisi4.png') }}" alt="Teknisi D">
          <h4>Rayzan C., S.Kom</h4>
          <p>Spesialis Maintenance & Upgrade Komponen</p><br><hr>
          {{-- <p class="rating">⭐ 4.8 (28+ review)</p> --}}
          <p class="price">Rp180.000</p>
          <p class="label">Jadwal Tersedia</p>
      </div>
    </div>
</section>

<section class="section-review">

    </div>
    <p class="media-title">Sudah diliput oleh:</p>
    <div class="media-logos">
        <img src="{{ asset('assets/sponsor.png') }}" alt="CNN">
    </div>
</section>


<section class="section-topic">
  <div class="topic-container">
    <div class="topic-image">
      <img src="{{ asset('assets/org2.jpg') }}" alt="Konsultan TanyaPC.id"/>
      <div class="topic-overlay">
        <h4>Konsultan TanyaPC.id</h4>
        {{-- <p>🟦 Rakit PC, Komponen, Budgeting, Upgrade, Troubleshooting…</p> --}}
      </div>
    </div>
    <div class="topic-text">
      <p class="sub-title">Topik Konsultasi</p>
      <h2>Berikut ini berbagai masalah yang dapat kami bantu:</h2>
      <ul class="topic-list">
        <li>Rakit PC sesuai kebutuhan & anggaran</li>
        <li>Pemilihan komponen yang kompatibel</li>
        <li>Rekomendasi spek untuk gaming/editing</li>
        <li>Upgrade PC lama agar tetap optimal</li>
        <li>Solusi bottleneck dan performa lemot</li>
        <li>Overbudget tanpa hasil maksimal</li>
        <li>Kesalahan beli komponen (PSU, GPU, dll)</li>
        <li>PC cepat panas atau noise berlebihan</li>
        <li>Konsultasi remote jarak jauh</li>
        <li>Build PC untuk content creator / kantor</li>
        <li>Simulasi part & estimasi harga</li>
        <li>Dan banyak lainnya</li>
      </ul>
      <a href="{{ url('/konseling_online') }}" class="btn-booking">Konsultasi Sekarang</a>
    </div>
  </div>
</section>

<section class="section-medium">
  <div class="text-center">
    <p class="section-subtitle">Layanan TanyaPC.id</p>
    <h2>Pilih medium konseling yang nyaman untukmu</h2>
  </div>

  <div class="medium-cards">
    <!-- Konseling Offline -->
    <div class="medium-card">
      <img src="{{ asset('assets/offline.jpg') }}" alt="Konseling Offline" class="card-image">
      <div class="card-body">
        <h3>Konseling Offline</h3>
        <p class="location">🏠 Rumah Bicara <br>📍Jakarta Barat & Jakarta Selatan</p>
        <ul class="benefits">
          <li class="icon1">Ruangan konseling yang nyaman</li>
          <li class="icon2">Efektivitas konseling maksimal</li>
          <li class="icon3">Langsung bertemu dengan konseling tatap muka</li>
        </ul>
        <p class="price-before">Rp549.000 <span class="discount">-28%</span></p>
        <p class="price-now">Rp399.000 <span class="per">/jam</span></p>
        <a href="/konseling_offline" class="btn-booking">Konsultasi Sekarang</a>
      </div>
    </div>

    <!-- Konseling Online -->
    <div class="medium-card">
      <img src="{{ asset('assets/online.jpg') }}" alt="Konseling Online" class="card-image">
      <div class="card-body">
        <h3>Konseling Online</h3>
        <p class="location">📱 via Whatsapp atau Google Meet</p><br>
        <ul class="benefits">
          <li class="icon4">Jadwal tercepat &lt;24 jam & tempat fleksibel</li>
          <li class="icon5">Pilih voice call atau video call</li>
          <li class="icon6">Privasimu dijamin 100% aman</li>
        </ul>
        <p class="price-before">Rp349.000 <span class="discount">-28%</span></p>
        <p class="price-now">Rp249.000 <span class="per">/jam</span></p>
        <a href="{{ url('/konseling_online') }}" class="btn-booking">Konsultasi Sekarang</a>
      </div>
    </div>
  </div>
</section>

<style>
.benefits {
    list-style: none;
    padding-left: 2rem;
}

.benefits li {
    position: relative;
    padding-left: 2.5rem;
    margin-bottom: 0.5rem;
}

.benefits li::before {
    content: '';
    position: absolute;
    top: 2px;
    left: 0;
    width: 20px;
    height: 20px;
    background-size: contain;
    background-repeat: no-repeat;
}

/* Konseling Offline Icons */
.benefits li.icon1::before {
    background-image: url('{{ asset('assets/icon1.png') }}');
}

.benefits li.icon2::before {
    background-image: url('{{ asset('assets/icon2.png') }}');
}

.benefits li.icon3::before {
    background-image: url('{{ asset('assets/icon3.png') }}');
}

/* Konseling Online Icons */
.benefits li.icon4::before {
    background-image: url('{{ asset('assets/icon4.png') }}');
}

.benefits li.icon5::before {
    background-image: url('{{ asset('assets/icon6.png') }}');
}

.benefits li.icon6::before {
    background-image: url('{{ asset('assets/icon7.png') }}');
}
</style>


{{-- Membandingkan layanan KonsultasiPC.id dengan layanan lain --}}

<section class="comparison-section">
  <h2 class="comparison-title">
    Kenapa <span>TanyaPC.id</span> Lebih Baik?
  </h2>

  <div class="table-wrapper">
    <table class="comparison-table">
      <thead>
        <tr>
          <th>Fitur</th>
          <th><span class="logo-small">TanyaPC.id</span></th>
          {{-- <th><img src="{{ asset('assets/logo.png') }}" alt="TanyaPC.id" class="logo-small"></th> --}}
          <th>Layanan Lain</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Rekomendasi Komponen Sesuai Budget</td>
          <td>✅</td>
          <td>❓</td>
        </tr>
        <tr>
          <td>Analisis Kelebihan & Kekurangan</td>
          <td>✅</td>
          <td>✖</td>
        </tr>
        <tr>
          <td>Konsultasi Online & Offline</td>
          <td>✅</td>
          <td>❓</td>
        </tr>
        <tr>
          <td>Teknisi Berpengalaman</td>
          <td>✅</td>
          <td>❓</td>
        </tr>
        <tr>
          <td>Tanpa Antri & Fast Response</td>
          <td>✅</td>
          <td>✖</td>
        </tr>
        <tr>
          <td>Garansi & Follow-up</td>
          <td>✅</td>
          <td>✖</td>
        </tr>
      </tbody>
    </table>
  </div>
</section>



<!-- ==========  FAQ SECTION  ========== -->
<style>
  .faq-wrapper{
    max-width:760px;
    margin:40px auto;
    padding:0 1rem;
    text-align:center;
  }
  .faq-wrapper h2{
    font-size:28px;
    margin-bottom:24px;
  }

  /* Card container */
  .faq-card{
    background:#fff;
    border-radius:12px;
    box-shadow:0 8px 24px rgba(0,0,0,.07);
    overflow:hidden;
    text-align:left;          /* override wrapper center */
  }

  /* Accordion item */
  .faq-item{border-top:1px solid #eee;}
  .faq-item:first-child{border-top:none;}

  .faq-question{
    width:100%;
    padding:18px 20px;
    font-size:16px;
    font-weight:500;
    background:none;
    border:none;
    cursor:pointer;
    display:flex;
    justify-content:space-between;
    align-items:center;
    text-align:left;
  }
  .faq-question::after{
    content:"\25be";          /* ▾ */
    font-size:14px;
    color:#666;
    transition:transform .25s;
  }
  .faq-item.open .faq-question::after{transform:rotate(180deg);} /* ▴ */

  .faq-answer{
    max-height:0;
    overflow:hidden;
    padding:0 20px;
    transition:max-height .3s ease, padding .3s ease;
    font-size:15px;
    line-height:1.6;
    color:#444;
    text-align:left;
  }
  .faq-item.open .faq-answer{
    padding:12px 20px 20px;
    max-height:260px;         /* adjust if answer longer */
  }

  .faq-footer{
    margin-top:28px;
    font-size:14px;
    color:#666;
  }
  .faq-footer a{
    color:#008000;
    font-weight:600;
    text-decoration:none;
  }
</style>

<section class="faq-wrapper">
  <p class="section-subtitle text-primary">FAQ TanyaPC.id</p>
  <h2>Pertanyaan tentang Konsultasi PC:</h2>

  <div class="faq-card" id="faqCard">

    <!-- 1 -->
    <div class="faq-item">
      <button class="faq-question">Apa itu konsultasi PC?</button>
      <div class="faq-answer">
        Konsultasi PC adalah layanan untuk berdiskusi dengan pakar hardware
        agar Anda mendapatkan rekomendasi komponen, solusi troubleshooting,
        atau optimasi performa sesuai kebutuhan.
      </div>
    </div>

    <!-- 2 -->
    <div class="faq-item">
      <button class="faq-question">Masalah apa saja yang bisa diatasi?</button>
      <div class="faq-answer">
        Mulai dari pemilihan komponen, perakitan, overheat, blue‑screen,
        upgrade GPU/CPU, hingga tuning BIOS dan overclock ringan.
      </div>
    </div>

    <!-- 3 -->
    <div class="faq-item">
      <button class="faq-question">Berapa biaya konsultasi?</button>
      <div class="faq-answer">
        Sesi tanya‑jawab dasar bersifat gratis. Paket premium (analisis rinci
        dan rekomendasi tertulis) mulai Rp 150 000 per sesi 30 menit.
      </div>
    </div>

    <!-- 4 -->
    <div class="faq-item">
      <button class="faq-question">Bagaimana cara memulai sesi konsultasi?</button>
      <div class="faq-answer">
        Klik tombol “Mulai Konsultasi”, pilih jadwal kosong, lalu isi formulir
        singkat mengenai kebutuhan dan spesifikasi perangkat Anda.
      </div>
    </div>

    <!-- 5 -->
    <div class="faq-item">
      <button class="faq-question">Apakah saya perlu booking jadwal?</button>
      <div class="faq-answer">
        Ya, untuk memastikan pakar kami tersedia. Booking dapat dilakukan
        minimal 1 jam sebelum sesi dimulai.
      </div>
    </div>

    <!-- 6 -->
    <div class="faq-item">
      <button class="faq-question">Apakah konsultasi bisa dilakukan online?</button>
      <div class="faq-answer">
        Bisa. Kami mendukung chat, voice, dan video call melalui platform
        WhatsApp atau Google Meet.
      </div>
    </div>

    <!-- 7 -->
    <div class="faq-item">
      <button class="faq-question">Berapa lama durasi satu sesi?</button>
      <div class="faq-answer">
        Durasi standar 30 menit. Anda dapat memperpanjang per 30 menit
        dengan biaya tambahan.
      </div>
    </div>

    <!-- 8 -->
    <div class="faq-item">
      <button class="faq-question">Apakah data pribadi saya aman?</button>
      <div class="faq-answer">
        Ya. Semua data klien disimpan secara terenkripsi dan tidak akan
        dibagikan tanpa persetujuan Anda.
      </div>
    </div>

    <!-- 9 -->
    <div class="faq-item">
      <button class="faq-question">Apakah ada garansi setelah konsultasi?</button>
      <div class="faq-answer">
        Kami menyediakan garansi follow‑up gratis 3 hari jika solusi awal
        belum menyelesaikan masalah Anda.
      </div>
    </div>

    <!-- 10 -->
    <div class="faq-item">
      <button class="faq-question">Apakah kalian membantu instalasi OS?</button>
      <div class="faq-answer">
        Ya. Kami dapat memandu instalasi Windows, Linux, maupun dual‑boot
        secara remote atau on‑site (area Jakarta).
      </div>
    </div>

    <!-- 11 -->
    <div class="faq-item">
      <button class="faq-question">Apakah melayani perakitan PC gaming?</button>
      <div class="faq-answer">
        Tentu. Kami spesialis merancang build gaming 1080p hingga 4K,
        termasuk rekomendasi RGB, casing, dan airflow.
      </div>
    </div>

    <!-- 12 -->
    <div class="faq-item">
      <button class="faq-question">Bisakah saya berkonsultasi soal laptop?</button>
      <div class="faq-answer">
        Bisa. Kami membantu upgrade RAM/SSD, thermal repaste, hingga pemilihan
        laptop baru sesuai kebutuhan.
      </div>
    </div>

    <!-- 13 -->
    <div class="faq-item">
      <button class="faq-question">Berapa lama pengerjaan rakitan?</button>
      <div class="faq-answer">
        Rata‑rata 1–2 hari kerja setelah semua komponen tersedia.
      </div>
    </div>

    <!-- 14 -->
    <div class="faq-item">
      <button class="faq-question">Apakah tersedia layanan express?</button>
      <div class="faq-answer">
        Ya, layanan express 24 jam tersedia dengan biaya tambahan 20% dari
        total paket.
      </div>
    </div>

    <!-- 15 -->
    <div class="faq-item">
      <button class="faq-question">Bagaimana metode pembayaran?</button>
      <div class="faq-answer">
        Kami menerima transfer bank, e‑wallet (OVO, GoPay, DANA), dan kartu
        kredit.
      </div>
    </div>

  </div><!-- /.faq-card -->

  <p class="faq-footer">
    Masih memiliki pertanyaan? Hubungi Customer Happiness via
    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener">WhatsApp</a>
  </p>
</section>

<script>
  /* ---------- Accordion Toggle ---------- */
  document.querySelectorAll('#faqCard .faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
      btn.parentElement.classList.toggle('open');
    });
  });
</script>




@include('partials.footer')
</body>
</html>

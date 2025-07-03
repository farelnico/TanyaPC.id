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
<!-- Section: Statistik -->
<section class="statistik-section">
  <div class="image-wrapper">
    <img src="{{ asset('assets/kantor.png') }}" alt="Konsultasi" class="main-image" />
  </div>
</section>


<section id="about" class="about-section">
  <!-- Sub-judul -->
  <p class="section-subtitle text-primary">Tentang TanyaPC.id</p>

  <!-- Judul utama -->
  <h2 class="about-title">
    Kami percaya bahwa teknologi dapat<br>
    membuat hidup manusia menjadi lebih baik.
  </h2>

  <!-- Isi 2-kolom -->
  <div class="about-wrapper">

    <!-- Foto founder -->
    {{-- <figure class="founder-photo">
      <img src="{{ asset('assets/founder.jpg') }}" alt="Andreas Handani">
      <figcaption>
        <h4>Raihan Zuffar</h4>
        <span>Founder &amp; CEO TanyaPC.id</span>
      </figcaption>
    </figure> --}}


<!-- =================  FOUNDER PHOTO SWAP  ================= -->
<style>
  .founder-photo{
    position:relative;
    max-width:280px;
    width:100%;
    overflow:hidden;
    border-radius:12px;
  }
  .founder-photo img{
    width:100%;
    height:auto;
    object-fit:contain;
    transition:opacity .3s ease;
    background:#f0f0f0;
  }
  .founder-photo img.fade-out{opacity:0;}

  .founder-photo figcaption{margin-top:12px;text-align:center;}
</style>

<figure class="founder-photo" id="founderPhoto">
  <img src="{{ asset('assets/founder.jpg') }}" alt="M Raihan Zuffar Musyaffa – Formal">
  <figcaption>
    <h4 id="founderName">M Raihan Zuffar Musyaffa</h4>
    <span id="founderRole">Founder &amp; CEO TanyaPC.id</span>
  </figcaption>
</figure>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const img   = document.querySelector('#founderPhoto img');
  const name  = document.getElementById('founderName');
  const role  = document.getElementById('founderRole');

  /* Foto + caption yang diputar */
  const pics = [
    {
      src : "{{ asset('assets/founder.jpg') }}",
      alt : "M Raihan Zuffar Musyaffa – Formal",
      name: "M Raihan Zuffar Musyaffa",
      role: "Founder & CEO TanyaPC.id"
    },
    {
      src : "{{ asset('assets/founder1.jpg') }}",
      alt : "Farel Nicolessuranto – Casual",
      name: "Farel Nicolessuranto",
      role: "Co‑Founder TanyaPC.id"
    }
  ];

  let idx = 0;

  setInterval(() => {
    idx = (idx + 1) % pics.length;        // 0 → 1 → 0 …
    img.classList.add('fade-out');

    setTimeout(() => {                    // sinkron dengan durasi fade (.3 s)
      img.src = pics[idx].src;
      img.alt = pics[idx].alt;
      name.textContent = pics[idx].name;  // ganti nama
      role.textContent = pics[idx].role;  // ganti jabatan/teks lain
      img.classList.remove('fade-out');
    }, 300);
  }, 5000);                               // ganti tiap 3 detik
});
</script>




    <!-- Narasi -->
    <div class="about-text">
      <p>Kami yakin, karena kami telah merasakannya sendiri.</p>
      <p>TanyaPC.id lahir dari pengalaman saya membantu teman-teman yang kesulitan merakit &amp; memperbaiki komputer mereka, lalu berkembang menjadi platform konsultasi hardware.</p>
      <p>Lewat pengalaman pribadi, saya percaya orang yang mencari bantuan bukanlah individu lemah—melainkan cerdas karena mau belajar.</p>
      <p>Tidak ada yang lebih membanggakan selain melihat seseorang berani jujur pada diri sendiri, terbuka pada ahli, lalu menemukan solusi terbaik.</p>
      <p>Salam <strong>#NgoprekBareng!</strong></p>
    </div>

  </div> <!-- /.about-wrapper -->
</section>



<section class="happiness-section">

  <!-- Judul -->
  {{-- <p class="section-subtitle text-primary">Customer Happiness</p>
  <h2 class="happiness-title">
    Senantiasa melayani para <span class="highlight">Pembicara (klien)</span><br>
    dengan hormat &amp; senang hati
  </h2> --}}

  <!-- Baris foto staff -->
  {{-- <div class="staff-grid">
    @foreach (['a.jpg','f.jpg','g.jpg','h.jpg'] as $img)
      <div class="staff-card">
        <img src="{{ asset('assets/'.$img) }}" alt="Staff">
      </div>
    @endforeach
  </div> --}}


  <!-- Judul -->
  <p class="section-subtitle text-primary">Customer Happiness</p>
  <h2 class="happiness-title">
    Senantiasa melayani para <span class="highlight">Pembicara (klien)</span><br>
    dengan hormat &amp; senang hati
  </h2>

  <!-- Baris foto staff -->
  <div class="staff-grid">
    @foreach (['teknisi1.png','teknisi2.png','teknisi3.png','teknisi4.png'] as $img)
      <div class="staff-card">
        <img src="{{ asset('assets/'.$img) }}" alt="Staff">
      </div>
    @endforeach
  </div>


  <!-- Kutipan -->
  <blockquote class="staff-quote">
    <p>
      Kami mengerti bahwa bukan hal mudah untuk mencari pertolongan ketika&nbsp;kamu sedang tidak baik-baik saja.
      Itulah mengapa kami akan melayanimu dengan senaksimal mungkin sehingga kamu nyaman dalam perjalanan ini 🧡
    </p>
    <cite>— Farel</cite>
  </blockquote>

  <!-- Visi & Misi -->
  {{-- <div class="vision-mission">
    <div class="vm-item">
      <div class="vm-icon">❝</div>
      <div class="vm-text">
        <h4><span class="text-primary">Visi</span><br>Konsultasi PC</h4>
        <p>Membangun masyarakat Indonesia yang sejahtera secara teknologi &amp; informasi.</p>
      </div>
    </div>

    <div class="vm-item">
      <div class="vm-icon">❝</div>
      <div class="vm-text">
        <h4><span class="text-primary">Misi</span><br>Konsultasi PC</h4>
        <p>Menyediakan layanan konsultasi, asesmen, dan perakitan yang mendukung proses penyelesaian masalah komputer sampai tuntas.</p>
      </div>
    </div>
  </div> --}}

  <!-- Visi & Misi -->
<div class="vision-mission">

  <!-- VISI -->
  <div class="vm-item">
    <div class="vm-text">
      <div class="vm-icon">❝</div>
      <h4><span>Visi</span><br>TanyaPC.id</h4>
    </div>
    <p class="vm-desc">
      Membangun masyarakat Indonesia yang sejahtera secara teknologi.
    </p>
  </div>

  <!-- MISI -->
  <div class="vm-item">
    <div class="vm-text">
      <div class="vm-icon">❝</div>
      <h4><span>Misi</span><br>TanyaPC.id</h4>
    </div>
    <p class="vm-desc">
      Menyediakan layanan konsultasi, asesmen, dan perakitan yang mendukung proses penyelesaian masalah komputer sampai tuntas.
    </p>
  </div>

</div>



</section>

<!-- =========  TIM KONSULTAN  ========= -->
<section class="team-section">
  <p class="section-subtitle text-primary">Tim Konsultan</p>
  <h2 class="team-title">
    Mereka yang senantiasa mendampingimu dalam<br>
    membangun pengalaman komputasi yang lebih baik
  </h2>

  @php
    // (Idealnya ini di controller)
    $photos = array_filter(
      scandir(public_path('assets/team')),
      fn ($f) => preg_match('/\.(jpe?g|png|webp)$/i', $f)
    );
  @endphp

  <div class="team-grid">
    @foreach ($photos as $file)
      <div class="team-card">
        <img src="{{ asset('assets/team/' . $file) }}" alt="Foto {{ $loop->iteration }}">
      </div>
    @endforeach
  </div>
</section>   {{-- ← JANGAN dikomentari --}}


<!-- =========  OUR VALUES  ========= -->
<section class="values-section">
  <p class="section-subtitle text-primary">Our Values</p>
  <h2 class="values-title">Nilai-nilai yang kami percayai dan hidupi</h2>

  <div class="values-wrap">
    <div class="value-item">
      <img src="{{ asset('assets/values.png') }}" alt="Comprehensive">
      <h4>Comprehensive</h4>
      <p>Memproses isu komputer sampai ke akarnya.</p>
    </div>

    <div class="value-item">
      <img src="{{ asset('assets/values2.png') }}" alt="Compassionate">
      <h4>Compassionate</h4>
      <p>Berempati pada pengguna tanpa menghakimi.</p>
    </div>

    <div class="value-item">
      <img src="{{ asset('assets/values3.png') }}" alt="Helpful">
      <h4>Helpful</h4>
      <p>Melayani dengan sepenuh hati dan niat baik.</p>
    </div>

    <div class="value-item">
      <img src="{{ asset('assets/values4.png') }}" alt="Growing">
      <h4>Growing</h4>
      <p>Mendukung klien untuk tak hanya “sembuh”, tapi juga bertumbuh.</p>
    </div>
  </div>
</section>


<section class="section-review">
    {{-- <h2 class="review-title">1,378+ Review 5-Stars di Google</h2>

    <div class="review-stats">
        <div>
            <p class="big-number">21.789+</p>
            <p>Orang terbantu</p>
        </div>
        <div>
            <p class="big-number">42+</p>
            <p>Teknisi Aktif</p>
        </div>
    </div>

    <div class="testimonial-list">
        <div class="testimonial-card">
            <div class="user">
                <img src="{{ asset('img/user1.jpg') }}" alt="User">
                <div>
                    <strong>Lia, 29 tahun</strong><br>
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
            <p>Dia bisa memberi jawaban logis untuk permasalahan pelik yang saya alami. Semoga ini jadi titik awal saya sembuh.</p>
        </div>
        <div class="testimonial-card">
            <div class="user">
                <img src="{{ asset('img/user2.jpg') }}" alt="User">
                <div>
                    <strong>Muhammad, 29 tahun</strong><br>
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
            <p>Terima kasih sudah mendengarkan dan memahami apa yang saya rasakan. I can finally breathe now.</p>
        </div>
        <div class="testimonial-card">
            <div class="user">
                <img src="{{ asset('img/user3.jpg') }}" alt="User">
                <div>
                    <strong>Aditya, 24 tahun</strong><br>
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
            <p>Sangat membantu mengurai benang kusut di kepala saya menjadi mudah dipahami.</p>
        </div>
        <div class="testimonial-card">
            <div class="user">
                <img src="{{ asset('img/user4.jpg') }}" alt="User">
                <div>
                    <strong>Immaculata C., 26 tahun</strong><br>
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
            <p>Bicara dengan teknisi membantu aku menyadari hal-hal yang tidak kusadari selama ini.</p>
        </div>
        <div class="testimonial-card">
            <div class="user">
                <img src="{{ asset('img/user5.jpg') }}" alt="User">
                <div>
                    <strong>Maira, 33 tahun</strong><br>
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
            <p>Saya merasa nyaman dan didengarkan. Beliau tidak pernah menyepelekan masalah saya.</p>
        </div>
    </div> --}}

        <p class="media-title">Sudah diliput oleh:</p>
    <div class="media-logos">
        <img src="{{ asset('assets/sponsor.png') }}" alt="CNN">
    </div>
</section>


@php
$branches = [
  'bintaro' => [
    'label'   => 'Bintaro, Jakarta Selatan',
    'address' => 'Jl. Merak IV No.23 Blok N3, Bintaro, Jakarta Selatan 12330',
    'embed'   => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.9222360344684!2d106.75171400803423!3d-6.273955561385217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f04468682173%3A0x396cb1a6be4ff1e1!2sJl.%20Merak%20IV%20Blok%20N3%20No.23%2C%20RT.2%2FRW.8%2C%20Bintaro%2C%20Kec.%20Pesanggrahan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012330!5e0!3m2!1sid!2sid!4v1750928649031!5m2!1sid!2sid',
  ],
  // ... cabang lain
];

$default = 'bintaro';
@endphp

<section class="location-section">
  <div class="location-wrapper">

    <!-- kolom kiri -->
    <div class="location-info">
      <p class="label text-primary">Lokasi Tempat Konsultasi</p>
      <h2 class="loc-title">Rumah Bicara</h2>

      <!-- dropdown (kirim data branches via data-*) -->
      <select id="branchSelect"
              class="branch-select"
              data-branches='@json($branches)'>
        @foreach($branches as $key=>$b)
          <option value="{{ $key }}" {{ $key==$default?'selected':'' }}>{{ $b['label'] }}</option>
        @endforeach
      </select>

      <!-- detail -->
      <div class="detail-box" id="branchDetail">
        <p class="detail-title">Detail Lokasi</p>
        <address>{{ $branches[$default]['address'] }}</address>
        <p class="rating-line">
          <span class="stars">★★★★★</span>
          <span class="rating">5.0</span>
          <span class="reviews">(98+ Reviews)</span>
        </p>
      </div>

      <a href="/konseling_online" class="btn-primary">Konseling Di sini</a>
    </div>

    <!-- kolom kanan -->
    <div class="location-gallery">
      <iframe id="mapFrame"
              src="{{ $branches[$default]['embed'] }}"
              width="100%" height="240"
              style="border:0;border-radius:6px"
              loading="lazy" allowfullscreen
              referrerpolicy="no-referrer-when-downgrade"></iframe>

      <!-- contoh jarak -->
      <ul class="distance-list">
        <li><i class="fa fa-train"></i>Pondok Ranji St. <span>7 m</span></li>
        <li><i class="fa fa-bus"></i>Fithub Bintaro <span>1 m</span></li>
      </ul>
    </div>

  </div>
</section>

<!-- panggil JS -->
<script src="{{ asset('js/location.js') }}"></script>

<footer class="site-footer">
  <div class="footer-inner">

@include('partials.footer')

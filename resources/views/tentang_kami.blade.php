{{-- resources/views/tentang_kami.blade.php --}}
@extends('layouts.app')

@section('title', 'Tentang Kami • TanyaPC.id')

{{-- ========== STYLE KHUSUS HALAMAN (jika perlu) ========== --}}
@push('styles')
  <style>
    /* ——— animasi swap foto founder ——— */
    .founder-photo{
      position:relative;max-width:280px;width:100%;overflow:hidden;border-radius:12px;
    }
    .founder-photo img{
      width:100%;height:auto;object-fit:contain;transition:opacity .3s ease;background:#f0f0f0;
    }
    .founder-photo img.fade-out{opacity:0;}
    .founder-photo figcaption{margin-top:12px;text-align:center;}
  </style>
@endpush



@section('content')

<!-- =========  HERO GAMBAR / STATISTIK ========= -->
<section class="statistik-section">
  <div class="image-wrapper">
    <img src="{{ asset('assets/kantor.png') }}" alt="Konsultasi" class="main-image"/>
  </div>
</section>



<!-- =========  ABOUT ========= -->
<section id="about" class="about-section">
  <p class="section-subtitle text-primary">Tentang TanyaPC.id</p>
  <h2 class="about-title">
    Kami percaya bahwa teknologi dapat<br>
    membuat hidup manusia menjadi lebih baik.
  </h2>

  <div class="about-wrapper">
    {{-- Foto founder (akan berganti tiap 5 detik) --}}
    <figure class="founder-photo" id="founderPhoto">
      <img src="{{ asset('assets/founder.jpg') }}" alt="M Raihan Zuffar Musyaffa – Formal">
      <figcaption>
        <h4 id="founderName">M Raihan Zuffar Musyaffa</h4>
        <span id="founderRole">Founder &amp; CEO TanyaPC.id</span>
      </figcaption>
    </figure>

    {{-- Narasi --}}
    <div class="about-text">
      <p>Kami yakin, karena kami telah merasakannya sendiri.</p>
      <p>TanyaPC.id lahir dari pengalaman saya membantu teman‑teman yang kesulitan merakit &amp; memperbaiki komputer mereka, lalu berkembang menjadi platform konsultasi hardware.</p>
      <p>Lewat pengalaman pribadi, saya percaya orang yang mencari bantuan bukanlah individu lemah—melainkan cerdas karena mau belajar.</p>
      <p>Tidak ada yang lebih membanggakan selain melihat seseorang berani jujur pada diri sendiri, terbuka pada ahli, lalu menemukan solusi terbaik.</p>
      <p>Salam <strong>#NgoprekBareng!</strong></p>
    </div>
  </div>
</section>



<!-- =========  CUSTOMER HAPPINESS ========= -->
<section class="happiness-section">
  <p class="section-subtitle text-primary">Customer Happiness</p>
  <h2 class="happiness-title">
    Senantiasa melayani para <span class="highlight">Pembicara (klien)</span><br>
    dengan hormat &amp; senang hati
  </h2>

  {{-- Foto‑foto staff --}}
  <div class="staff-grid">
    @foreach (['teknisi1.png','teknisi2.png','teknisi3.png','teknisi4.png'] as $img)
      <div class="staff-card">
        <img src="{{ asset('assets/'.$img) }}" alt="Staff">
      </div>
    @endforeach
  </div>

  {{-- Kutipan --}}
  <blockquote class="staff-quote">
    <p>Kami mengerti bahwa bukan hal mudah untuk mencari pertolongan ketika kamu sedang tidak baik‑baik saja.
       Itulah mengapa kami akan melayanimu dengan senaksimal mungkin sehingga kamu nyaman dalam perjalanan ini 🧡</p>
    <cite>— Farel</cite>
  </blockquote>


  <!-- =========  VISI & MISI ========= -->
  <div class="vision-mission">
    <div class="vm-item">
      <div class="vm-text">
        <div class="vm-icon">❝</div><h4><span>Visi</span><br>TanyaPC.id</h4>
      </div>
      <p class="vm-desc">Membangun masyarakat Indonesia yang sejahtera secara teknologi.</p>
    </div>

    <div class="vm-item">
      <div class="vm-text">
        <div class="vm-icon">❝</div><h4><span>Misi</span><br>TanyaPC.id</h4>
      </div>
      <p class="vm-desc">Menyediakan layanan konsultasi, asesmen, dan perakitan yang mendukung proses penyelesaian masalah komputer sampai tuntas.</p>
    </div>
  </div>
</section>



<!-- =========  TIM KONSULTAN ========= -->
<section class="team-section">
  <p class="section-subtitle text-primary">Tim Konsultan</p>
  <h2 class="team-title">
    Mereka yang senantiasa mendampingimu dalam<br>
    membangun pengalaman komputasi yang lebih baik
  </h2>

  @php
    $photos = array_filter(
      scandir(public_path('assets/team')),
      fn ($f) => preg_match('/\.(jpe?g|png|webp)$/i', $f)
    );
  @endphp

  <div class="team-grid">
    @foreach ($photos as $file)
      <div class="team-card">
        <img src="{{ asset('assets/team/'.$file) }}" alt="Foto {{ $loop->iteration }}">
      </div>
    @endforeach
  </div>
</section>



<!-- =========  OUR VALUES ========= -->
<section class="values-section">
  <p class="section-subtitle text-primary">Our Values</p>
  <h2 class="values-title">Nilai‑nilai yang kami percayai dan hidupi</h2>

  <div class="values-wrap">
    <div class="value-item">
      <img src="{{ asset('assets/values.png') }}" alt="Comprehensive">
      <h4>Comprehensive</h4><p>Memproses isu komputer sampai ke akarnya.</p>
    </div>
    <div class="value-item">
      <img src="{{ asset('assets/values2.png') }}" alt="Compassionate">
      <h4>Compassionate</h4><p>Berempati pada pengguna tanpa menghakimi.</p>
    </div>
    <div class="value-item">
      <img src="{{ asset('assets/values3.png') }}" alt="Helpful">
      <h4>Helpful</h4><p>Melayani dengan sepenuh hati dan niat baik.</p>
    </div>
    <div class="value-item">
      <img src="{{ asset('assets/values4.png') }}" alt="Growing">
      <h4>Growing</h4><p>Mendukung klien untuk tak hanya “sembuh”, tapi juga bertumbuh.</p>
    </div>
  </div>
</section>



<!-- =========  REVIEW & MEDIA ========= -->
<section class="section-review text-center">
  <p class="media-title">Sudah diliput oleh:</p>
  <div class="media-logos">
    <img src="{{ asset('assets/sponsor.png') }}" alt="Media">
  </div>
</section>



<!-- =========  LOKASI ========= -->
@php
  $branches = [
    'bintaro' => [
      'label'   => 'Bintaro, Jakarta Selatan',
      'address' => 'Jl. Merak IV No.23 Blok N3, Bintaro, Jakarta Selatan 12330',
      'embed'   => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.9222360344684!2d106.75171400803423!3d-6.273955561385217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f04468682173%3A0x396cb1a6be4ff1e1!2sJl.%20Merak%20IV%20Blok%20N3%20No.23%2C%20RT.2%2FRW.8%2C%20Bintaro%2C%20Kec.%20Pesanggrahan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012330!5e0!3m2!1sid!2sid!4v1750928649031!5m2!1sid!2sid',
    ],
  ];
  $default = 'bintaro';
@endphp

<section class="location-section">
  <div class="location-wrapper">
    <div class="location-info">
      <p class="label text-primary">Lokasi Tempat Konsultasi</p>
      <h2 class="loc-title">Rumah Bicara</h2>

      <select id="branchSelect" class="branch-select" data-branches='@json($branches)'>
        @foreach($branches as $key=>$b)
          <option value="{{ $key }}" {{ $key==$default?'selected':'' }}>{{ $b['label'] }}</option>
        @endforeach
      </select>

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

    <div class="location-gallery">
      <iframe id="mapFrame"
              src="{{ $branches[$default]['embed'] }}"
              width="100%" height="240"
              style="border:0;border-radius:6px"
              loading="lazy" allowfullscreen
              referrerpolicy="no-referrer-when-downgrade"></iframe>

      <ul class="distance-list">
        <li><i class="fa fa-train"></i>Pondok Ranji St.<span>7 m</span></li>
        <li><i class="fa fa-bus"></i>Fithub Bintaro<span>1 m</span></li>
      </ul>
    </div>
  </div>
</section>

@include('partials.footer')

@endsection  {{-- /content --}}



{{-- ========== SCRIPT KHUSUS HALAMAN ========== --}}
@push('scripts')
  {{-- rotasi foto founder --}}
  <script>
    document.addEventListener('DOMContentLoaded',()=>{
      const img  = document.querySelector('#founderPhoto img');
      const name = document.getElementById('founderName');
      const role = document.getElementById('founderRole');
      const pics = [
        {src:"{{ asset('assets/founder.jpg') }}",  alt:"M Raihan Zuffar Musyaffa – Formal", name:"M Raihan Zuffar Musyaffa", role:"Founder & CEO TanyaPC.id"},
        {src:"{{ asset('assets/founder1.jpg') }}", alt:"Farel Nicolessuranto – Casual",     name:"Farel Nicolessuranto",     role:"Co‑Founder TanyaPC.id"}
      ];
      let idx = 0;
      setInterval(()=>{
        idx = (idx+1)%pics.length;
        img.classList.add('fade-out');
        setTimeout(()=>{
          img.src = pics[idx].src;
          img.alt = pics[idx].alt;
          name.textContent = pics[idx].name;
          role.textContent = pics[idx].role;
          img.classList.remove('fade-out');
        },300);
      },5000);
    });
  </script>

  {{-- logika ganti peta lokasi --}}
  <script src="{{ asset('js/location.js') }}"></script>
@endpush

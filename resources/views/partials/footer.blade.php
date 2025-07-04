<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


<footer class="site-footer">
  <div class="footer-inner">

    <!-- ① Logo & tagline + store badge -->
    <div class="footer-brand">
      <img src="{{ asset('assets/logo.png') }}" alt="TanyaPC.id" class="footer-logo">
      <p class="tagline">“Ngobrolin rakitanmu, temukan solusi PC terbaik”</p>
    </div>

    <!-- ② Link kolom -->
    <div class="footer-columns">
      <div class="footer-col">
        <h4>Layanan</h4>
        <ul>
          <li><a href="#">Video / Voice Call</a></li>
          <li><a href="#">Konsultasi Tatap Muka</a></li>
          <li><a href="#">Konsultasi untuk Gamer</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Tentang Kami</h4>
        <ul>
          <li><a href="#">Tentang Konsultasi PC</a></li>
          <li><a href="#">Hubungi Kami</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Karier</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Lainnya</h4>
        <ul>
          <li><a href="#">Panduan Konsultasi</a></li>
          <li><a href="#">Peraturan Layanan</a></li>
          <li><a href="#">Aplikasi Konsultasi PC</a></li>
          <li><a href="#">Blog Hardware</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Lokasi</h4>
        <ul>
          <li><a href="#">Workshop Jakarta</a></li>
          {{-- <li><a href="#">Workshop Bandung</a></li> --}}
        </ul>
      </div>
    </div><!-- /.footer-columns -->

  </div><!-- /.footer-inner -->

  <hr class="footer-separator">

  <div class="footer-bottom">
    <div class="legal-links">
      <a href="#">Kebijakan Privasi</a>
      <span>•</span>
      <a href="#">Syarat &amp; Ketentuan</a>
    </div>

    <p class="copyright">© {{ date('Y') }} Konsultasi PC</p>

    <div class="social-links">
      <a href="#"><i class="fab fa-whatsapp"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-tiktok"></i></a>
      <a href="https://youtu.be/AqDyPdoti2g"><i class="fab fa-youtube"></i></a>
      <a href="#"><i class="fab fa-linkedin-in"></i></a>
    </div>
  </div>
</footer>

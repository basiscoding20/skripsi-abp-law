<div class="module-small bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="widget">
          <h5 class="widget-title font-alt">ABP LAW FIRM</h5>
          <p>ABP Law Firm merupakan salah satu badan usaha yang terdiri dari beberapa advokat berpengalaman untuk membantu mengatasi permasalahan hukum seperti layanan hukum pidana dan perdata, pelayanan secara non-litigasi, hukum lingkungan, hukum teknologi dan informasi, serta perburuhan dan ketenagakerjaan.</p>
          <p style="margin-bottom: 5px;">Phone: +1 234 567 89 10</p>
          <p>Email:<a href="#">somecompany@example.com</a></p>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="widget">
          <h5 class="widget-title font-alt">Menu</h5>
          <ul class="icon-list">
            <li><a href="{{ route('permohonan', 'perdata') }}">Perdata</a></li>
            <li><a href="{{ route('permohonan', 'pidana') }}">Pidana</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<hr class="divider-d">
<footer class="footer bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <p class="copyright font-alt text-center">&copy; {{date('Y')}}&nbsp;<a href="{{ url('/') }}">ABP LAW FIRM</a>, All Rights Reserved</p>
      </div>
      {{-- <div class="col-sm-6">
        <div class="footer-social-links"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a>
        </div>
      </div> --}}
    </div>
  </div>
</footer>
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6 footer-info">
          <!-- <img src="img/logo.png" alt="TheEvenet"> -->
          <h1 style="color:white;">{{ env('APP_NAME', 'The Event') }}</p>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
            <!-- <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li> -->
            <!-- <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li> -->
            <!-- @guest
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('home.index') }}">Login</a></li>
            @endguest
            @auth
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('admin.home') }}">Admin Panel</a></li>
            @endauth -->
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
            <!-- <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li> -->
            <!-- <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li> -->
            <!-- @guest
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('home.index') }}">Login</a></li>
            @endguest
            @auth
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('admin.home') }}">Admin Panel</a></li>
            @endauth -->
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-contact">
          <h4>Contact Us</h4>
          <p>
            {{ env('CONTACT_ADDRESS')}}<br>
            <strong>Phone:</strong> {{ env('CONTACT_NUMBER') }}<br>
            <strong>Email:</strong> {{ env('CONTACT_EMAIL')}}<br>
          </p>

          <div class="social-links">
            <a href="https://x.com/sixx6spirits" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="https://www.facebook.com/profile.php?id=61553678562291" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a>
            <!-- <a href="" class="instagram"><i class="fa fa-instagram"></i></a> -->
            <!-- <a href=" " class="google-plus"><i class="fa fa-google-plus"></i></a> -->
            <!-- <a href="" class="linkedin"><i class="fa fa-linkedin"></i></a> -->
          </div>

        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong>SIXX Spirits Limited</strong>. All Rights Reserved
    </div>
    <!-- <div class="credits">
      Designed by <a href="https://sbong.xyz">sbong</a>
    </div> -->
  </div>
</footer><!-- #footer -->

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
            <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            @guest
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('login') }}">Login</a></li>
            @endguest
            @auth
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('admin.home') }}">Admin Panel</a></li>
            @endauth
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            @guest
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('login') }}">Login</a></li>
            @endguest
            @auth
              <li><i class="fa fa-angle-right"></i> <a href="{{ route('admin.home') }}">Admin Panel</a></li>
            @endauth
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-contact">
          <h4>Contact Us</h4>
          <p>
            00100, Off Mombasa Road, Nairobi<br>
            <strong>Phone:</strong> 0000000000<br>
            <strong>Email:</strong> sixx@sixx-spirits.com<br>
          </p>

          <div class="social-links">
            <a href="" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="" class="instagram"><i class="fa fa-instagram"></i></a>
            <a href=" " class="google-plus"><i class="fa fa-google-plus"></i></a>
            <a href="" class="linkedin"><i class="fa fa-linkedin"></i></a>
          </div>

        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong>{{ env('APP_NAME', 'TheEvent') }}</strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://sbong.xyz">sbong</a>
    </div>
  </div>
</footer><!-- #footer -->

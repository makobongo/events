<section id="subscribe">
  <div class="container wow fadeInUp">
    <div class="section-header">
      <h2>News</h2>
      <p>Subscribe to receive regular <span style="color:#FFFF00;">{{env('APP_NAME')}}</span> updates.</p>
    </div>

    <form method="post" action="{{ route('event.subscriber') }}">
      @csrf
      <div class="form-row justify-content-center">
        <div class="col-auto">
          <input type="text" class="form-control" name="email" placeholder="Enter your Email">
        </div>
        <div class="col-auto">
          <input type="text" class="form-control" name="phone" placeholder="Phone e.g. 07........">
        </div>
        <div class="col-auto">
          <button type="submit">Subscribe</button>
        </div>
      </div>
    </form>

  </div>
</section>
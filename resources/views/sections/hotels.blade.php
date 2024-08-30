<section id="hotels" class="section-with-bg wow fadeInUp">

  <div class="container">
    <div class="section-header">
      <h2>Hotels</h2>
      <p>Here are some nearby hotels</p>
    </div>

    <div class="row">
      @foreach($hotels as $hotel)
      <div class="col-lg-4 col-md-6">
        <div class="hotel">
          <div class="hotel-img">
            <img src="{{ asset('storage/gallery/'.$hotel->img) }}" alt="{{$hotel->name}}" class="img-fluid">
          </div>
          <h3><a href="#">{{$hotel->name}}</a></h3>
          <div class="stars">
            <i class="fa fa-star"></i>
          </div>
          <p>{{$hotel->description}}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>

</section>
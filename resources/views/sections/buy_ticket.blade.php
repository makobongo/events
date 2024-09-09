<section id="buy-tickets" class="section-with-bg wow fadeInUp">
  <div class="container">

    <div class="section-header">
      <h2>Buy Tickets</h2>
      <p>Buy tickets for the <span style="color:#FFC300;">{{ env('APP_NAME') }}</span> event</p>
    </div>

    <div class="row">
      @foreach($prices as $price)
      <div class="col-lg-4">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">{{ $price->name }}</h5>
            <h6 class="card-price text-center">Ksh {{ number_format($price->price) }}</h6>
            <hr>
            <ul class="fa-ul">
              @foreach($amenities as $amenity)
              <li @if(!$price->amenities->contains($amenity->id))class="text-muted"@endif>
                <span class="fa-li"><i class="fa fa-{{ $price->amenities->contains($amenity->id) ? 'check' : 'times' }}"></i></span>{!! $amenity->name !!}
              </li>
              @endforeach
            </ul>
            <hr>
            <div class="text-center">
              <!-- <button type="button" class="btn" data-toggle="modal" data-target="#buy-ticket-modal" data-ticket-type="">Buy Now</button> -->
               <a href="https://sixxspirits.hustlesasa.shop" class="btn" target="_blank">buy ticket</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Modal Order Form -->
    <div id="buy-ticket-modal" class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Buy Tickets</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('ticket.store') }}">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-sm">
                  <input type="text" class="form-control" value="" name="first_name" placeholder="First Name" required autofocus>
                  </div>
                  <div class="col-sm">
                  <input type="text" class="form-control" value="" name="second_name" placeholder="Second Name" required>
                  </div>
                </div>

              </div>
              <div class="form-group">
                <input type="email" class="form-control" value="" name="email" placeholder="Your Email" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" placeholder="(Mpesa number) e.g. 07........ or 01........." value="" name="phone" required>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group">
                @include('partials.terms')
              </div>
              <div class="form-group">
                <label>Select Number of Ticket you are purchasing <b>(default is 1)</b></label>
                <select name="number_of_tickets" class="form-control">
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div class="form-group">
                <select id="ticket-type" name="ticket" class="form-control" required>
                  <option value="">-- Select Your Ticket Type --</option>
                  @foreach($prices as $price)
                  <option value="{{ $price->price }},{{ $price->name }}">{{ $price->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn">Buy Now</button>
              </div>
            </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</section>
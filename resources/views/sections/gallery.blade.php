<section id="gallery" class="wow fadeInUp">

    <div class="container">
        <div class="section-header">
            <h2>Events Highlights</h2>
            <p>checkout our hightlights</p>
        </div>
    </div>
    <div class="owl-carousel gallery-carousel">
        @foreach ($galleries as $gallery)
            <a href="#" class="venobox" data-gall="gallery-carousel">
                <img src="{{ asset('img/gallery/'.$gallery->name) }}" alt="{{ $gallery->name }}">
            </a>
        @endforeach
    </div>
</section>

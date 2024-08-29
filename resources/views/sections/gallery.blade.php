<section id="gallery" class="wow fadeInUp">

    <div class="container">
        <div class="section-header">
            <h2>Gallery</h2>
            <p>Check our gallery from the recent events</p>
        </div>
    </div>
    <div class="owl-carousel gallery-carousel">
        @foreach ($galleries as $gallery)
            <a href="#" class="venobox" data-gall="gallery-carousel">
                <img src="{{ asset('storage/gallery/'.$gallery->name) }}" alt="{{ $gallery->name }}">
            </a>
        @endforeach
    </div>
</section>

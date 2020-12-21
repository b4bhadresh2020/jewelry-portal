<div class='item'>
    <div class="testimonial-block">
        <img src="{{ $testimonial->media->path }}">
        <div class="testimonial-text">
            <h4>{{ $testimonial->name }}</h4>
            <h6>{{ $testimonial->role }}</h6>
        </div>
        <p>{{ $testimonial->description }}</p>
    </div>
</div>

<div class="section" id="slider-wp">
    <div class="section-detail">
        @foreach ($sliders as $slider)
        <div class="item">
            <a href="{{ $slider->url }}">
                <img src="{{ $slider->thumb }}" alt="{{ $slider->name }}">
            </a>
        </div>
        @endforeach
    </div>
</div>
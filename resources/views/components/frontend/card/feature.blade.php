<div class="card card-feature {{ $attributes->get('class') }}" onclick="location.href='{{ $attributes->get('link') }}'">
    <img src="{{ $attributes->get('image') }}" alt="{{ $attributes->get('title') }}">
    <h1>{{ $attributes->get('title') }}</h1>
    <p>{{ $attributes->get('caption') }}</p>
    <a href="{{ $attributes->get('link') }}">
        {{ $attributes->get('cta') }}
    </a>
</div>

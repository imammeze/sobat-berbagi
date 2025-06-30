<div class="card card-feature {{ $attributes->get('class') }} align-items-center "
    onclick="location.href='{{ $attributes->get('link') }}'">
    <img src="{{ $attributes->get('image') }}" alt="{{ $attributes->get('title') }}">
    <h1>{{ $attributes->get('title') }}</h1>
</div>

<div
    class="card banner-cta align-items-center flex-row p-5 justify-content-between d-none d-sm-none d-md-flex d-lg-flex">
    <div class="left">
        <h1>{!! $attributes->get('title') !!}</h1>
        <p class="mt-4">{!! $attributes->get('caption') !!}</p>
        <div class="d-flex gap-2 mt-4">
            <x-button.primary class="rounded-5" onclick="window.location.href='{{ $attributes->get('link') }}'">
                {{ $attributes->get('cta-1') }}
            </x-button.primary>
            @if ($attributes->has('cta-2'))
                <x-button.primary-outline class="rounded-5">
                    {{ $attributes->get('cta-2') }}
                </x-button.primary-outline>
            @endif
        </div>
    </div>
    <div class="right">
        <img src="{{ $attributes->get('image') }}" alt="banner-cta" class="img-fluid">
    </div>
</div>

<div class="card banner-cta d-block d-sm-block d-md-none d-lg-none p-3 ">
    <h1>{!! $attributes->get('title') !!}</h1>
    <x-button.primary class="rounded-5 mt-4" onclick="window.location.href='{{ $attributes->get('link') }}'">
        {{ $attributes->get('cta-1') }}
    </x-button.primary>
    <img src="{{ $attributes->get('image') }}" alt="banner-cta" class="img-fluid">

</div>

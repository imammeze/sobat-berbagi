@props([
    'title' => false,
    'subtitle' => false,
    'footer' => false,
    'footerClass' => false,
    'headerClass' => false,
    'bodyClass' => false,
    'header' => false,
    'body' => false,
])

@php
    $classes = 'card';
    $classes .= $attributes->get('class') ? ' ' . $attributes->get('class') : '';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    @if ($header || $title || $subtitle)
        <div class="card-header {{ $headerClass }}">
            @if ($title || $subtitle)
                <div class="card-title">
                    @if ($title)
                        <h4>{{ $title }}</h4>
                    @endif
                    @if ($subtitle)
                        <h6>{{ $subtitle }}</h6>
                    @endif
                </div>
            @endif
            {{ $header }}
        </div>
    @endif
    @if ($body)
        <div class="card-body {{ $bodyClass }}">
            {{ $body }}
        </div>
    @endif
    @if ($footer)
        <div class="card-footer {{ $footerClass }}">
            {{ $footer }}
        </div>
    @endif
</div>

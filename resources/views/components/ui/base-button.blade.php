@props([
    'type' => 'button',
    'color' => 'primary',
    'size' => 'md',
    'outline' => false,
    'block' => false,
    'disabled' => false,
    'href' => false,
    'target' => false,
])

@php
    $classes = 'btn';
    $classes .= $outline ? '' : ' btn-' . $color;
    $classes .= ' btn-' . $size;
    $classes .= $outline ? ' btn-outline-' . $color : '';
    $classes .= $block ? ' btn-block' : '';
@endphp

@if ($href)
    <a href="{{ $href }}" target="{{ $target }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }} {{ $disabled ? 'disabled' : '' }}>
        {{ $slot }}
    </button>
@endif

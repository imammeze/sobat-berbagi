{{-- table --}}
@props([
    'thead' => false,
    'tbody' => false,
    'tfoot' => false,
    'class' => false,
    'id' => false,
])

@php
    $classes = 'table';
    $classes .= $attributes->get('class') ? ' ' . $attributes->get('class') : '';
@endphp

<table {{ $attributes->merge(['class' => $classes]) }} id="{{ $id }}">
    @if ($thead)
        <thead>
            {{ $thead }}
        </thead>
    @endif
    @if ($tbody)
        <tbody>
            {{ $tbody }}
        </tbody>
    @endif
    @if ($tfoot)
        <tfoot>
            {{ $tfoot }}
        </tfoot>
    @endif
</table>

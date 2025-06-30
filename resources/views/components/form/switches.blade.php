@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => null,
    'checked' => false,
    'disabled' => false,
    'help' => null,
    'error' => null,
])

@php
    $classes = 'form-check-input';
    $classes .= $errors->has($name) ? ' is-invalid' : '';

@endphp

<div class="form-check form-switch">
    <input type="checkbox" name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ $value }}"
        class="{{ $classes }}" {{ $checked ? 'checked' : '' }} {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => $classes]) }}>
    <label for="{{ $id ?? $name }}" class="form-check-label">{{ $label }}</label>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    @if ($help)
        <small class="form-text text-muted">{{ $help }}</small>
    @endif
    @if ($error)
        <div class="invalid-feedback">
            {{ $error }}
        </div>
    @endif
</div>

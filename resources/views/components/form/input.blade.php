@props([
    'type' => 'text',
    'name' => '',
    'id' => '',
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'customClass' => '',
    'mb' => '3',
])

@php
    $classes = 'form-control';
    $classes .= $errors->has($name) ? ' is-invalid' : '';
    $classes .= ' ' . $customClass;
@endphp

<div class="mb-{{ $mb }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}" {{ $attributes->merge(['class' => $classes]) }}>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

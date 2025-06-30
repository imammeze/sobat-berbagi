<div class="mb-3">
    <label for="{{ $attributes->get('name') }}" class="form-label">{{ $attributes->get('label') }}</label>
    <textarea name="{{ $attributes->get('name') }}" id="{{ $attributes->get('name') }}" cols="30" rows="10"
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($attributes->get('name')) ? ' is-invalid' : '')]) }}>{{ $attributes->get('value') }}</textarea>

    @if ($errors->has($attributes->get('name')))
        <div class="invalid-feedback">
            {{ $errors->first($attributes->get('name')) }}
        </div>
    @endif
</div>

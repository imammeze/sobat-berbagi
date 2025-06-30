<div class="mb-3">
    <label for="{{ $attributes->get('name') }}" class="form-label">{{ $attributes->get('label') }}</label>
    <select name="{{ $attributes->get('name') }}" id="{{ $attributes->get('name') }}"
        {{ $attributes->merge(['class' => 'form-select' . ($errors->has($attributes->get('name')) ? ' is-invalid' : '')]) }}>
        <option value="">Pilih {{ $attributes->get('label') }}</option>
        @foreach ($options as $option)
            <option
                value="
                @if ($attributes->get('name') == 'campaign_category_id') {{ $option->id }}
                @elseif($attributes->get('name') == 'mitra_id')
                    {{ $option->mitraRelation->id }}
                @else
                    {{ $option->id }} @endif
            "
                {{ $option->id == $attributes->get('value') ? 'selected' : '' }}>
                @if ($attributes->get('name') == 'campaign_category_id')
                    {{ $option->name }}
                @elseif($attributes->get('name') == 'faq_category_id')
                    {{ $option->name }}
                @elseif($attributes->get('name') == 'mitra_id')
                    {{ $option->mitraRelation->name }}
                @else
                    {{ $option->title }}
                @endif
            </option {{ $option->id == $attributes->get('value') ? 'selected' : '' }}>
        @endforeach
    </select>
    @error($attributes->get('name'))
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

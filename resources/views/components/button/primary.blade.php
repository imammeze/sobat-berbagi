<button type="{{ $attributes->get('type', 'button') }}" {{ $attributes->merge(['class' => 'btn btn-primary']) }}>
    {{ $slot }}
</button>

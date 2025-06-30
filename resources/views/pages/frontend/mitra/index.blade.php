<x-layouts.frontend title="Mitra Kami">
    @push('styles')
        <style>
            .logo {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                padding: 1rem;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #fff;
            }
        </style>
    @endpush
    <div class="container ">
        <h3 class="text-center mt-5">
            Mitra Kami
        </h3>
        <div class="row">
            @foreach ($mitras as $mitra)
                <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                    <div class="card shadow-sm border-0 mt-3" style="min-height: 220px;">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <div class="logo">
                                <img src="{{ $mitra->mitraRelation->logo }}" alt="" class="img-fluid">
                            </div>
                            <h6 class="text-center mt-3 text-primary">
                                {{ $mitra->mitraRelation->name }}
                            </h6>
                            <p class="text-center text-muted">
                                Bergabung sejak {{ $mitra->mitraRelation->created_at->diffForHumans() }}
                            </p>
                            <p class="text-center">
                                Memiliki {{ $mitra->mitraRelation->campaigns->count() }} campaign
                            </p>
                            <x-button.primary-outline href="" class=" w-100 rounded-5 px-4 mt-3" target="_blank"
                                onclick="window.open('{{ route('mitra.show', $mitra->mitraRelation->slug) }}')">
                                Lihat Mitra
                            </x-button.primary-outline>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.frontend>

<x-layouts.frontend title="Berita">
    <x-frontend.header-section subheading="Artikel Kami" heading="Info & Berita Terbaru dari Kami"
        supporting-text="Kumpulan info terbaru dari Lazismu Banyumas" />

    <div class="container">
        <div class="row">
            @foreach ($news as $item)
                <div class="col-12 col-md-6 col-lg-4 mb-5">
                    <div class="card shadow-sm card-articles"
                        onclick="window.location.href='{{ route('news.show', $item->slug) }}'">
                        <div class="card-body">
                            <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}" class="img-fluid mb-2">
                            @foreach ($item->categories as $category)
                                <span class="badge bg-primary">{{ $category->name }}</span>
                            @endforeach
                            <h6 class="card-title mt-2">{{ $item->title }}</h6>
                            <p class="card-text">
                                {!! \Illuminate\Support\Str::limit($item->content, 100, '...') !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $news->links() }}
        </div>
    </div>
</x-layouts.frontend>

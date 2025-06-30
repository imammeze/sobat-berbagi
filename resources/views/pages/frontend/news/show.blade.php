<x-layouts.frontend title="{{ $news->title }}" description="{{ $news->title }}"
    thumbnail="{{ asset($news->thumbnail) }}">

    @push('styles')
        <style>
            article img {
                width: 100%;
                height: auto;
            }

            .latest-news:hover {
                background-color: #f1f1f1;
            }
        </style>
    @endpush

    <div class="container mt-3 d-block d-md-none">
        {{-- breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb item">
                    <a href="{{ route('home') }}" class="text-decoration-none text-dark">Home</a>
                </li>
                <li class="breadcrumb item">
                    <a href="{{ route('news.index') }}" class="text-decoration-none text-dark">Berita</a>
                </li>
                <li class="breadcrumb item active" aria-current="page">{{ $news->title }}</li>
            </ol>
        </nav>

        <img src="{{ asset($news->thumbnail) }}" alt="{{ $news->title }}" class="img-news-show mb-3 rounded">
        <div class="d-flex justify-content-between align-items-center mb-3">

            {{-- <div class="d-flex gap-1">
                @foreach ($news->tags as $tag)
                    <div class="badge bg-primary">{{ $tag->name }}</div>
                @endforeach
            </div> --}}

            <p>
                {{ $news->created_at->isoFormat('dddd, D MMMM Y') }}
            </p>
        </div>
        <h4 class="mb-3">{{ $news->title }}</h4>
        <article>
            {!! \Illuminate\Support\Str::markdown($news->content) !!}
        </article>

        <p class="mt-5 fw-bold text-dark">Tag:</p>
        <div class="d-flex gap-1 flex-wrap mt-2">
            @foreach ($news->tags as $tag)
                <div class="badge bg-primary">{{ $tag->name }}</div>
            @endforeach
        </div>
        <p class="mt-3 fw-bold text-dark">Kategori:</p>
        <div class="d-flex gap-1 flex-wrap mt-2">
            @foreach ($news->categories as $category)
                <div class="badge bg-primary">{{ $category->name }}</div>
            @endforeach
        </div>

        <div class="btn-share text-center" data-bs-toggle="modal" data-bs-target="#modalShare">
            <i class="bi bi-share-fill"></i>
        </div>

    </div>


    <div class="container mt-3 d-none d-md-block">
        {{-- breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Berita</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>
            </ol>
          </nav>
        <main>
            <img src="{{ asset($news->thumbnail) }}" alt="{{ $news->title }}" class="img-news-show mb-3 rounded">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p>
                    {{ $news->created_at->isoFormat('dddd, D MMMM Y') }}
                </p>
                <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalShare">
                    <i class="bi bi-share-fill"></i>
                    Bagikan
                </div>
            </div>
            <h4 class="mb-3">{{ $news->title }}</h4>
        </main>
        <div class="row">
            <div class="col-8 col-md-12 col-lg-8">
                <article>
                    {!! \Illuminate\Support\Str::markdown($news->content) !!}
                </article>

                <p class="mt-5 fw-bold text-dark">Tag:</p>
                <div class="d-flex gap-1 flex-wrap mt-2">
                    @foreach ($news->tags as $tag)
                        <div class="badge bg-primary">{{ $tag->name }}</div>
                    @endforeach
                </div>
                <p class="mt-3 fw-bold text-dark">Kategori:</p>
                <div class="d-flex gap-1 flex-wrap mt-2">
                    @foreach ($news->categories as $category)
                        <div class="badge bg-primary">{{ $category->name }}</div>
                    @endforeach
                </div>

            </div>
            <div class="col-4 col-md-12 col-lg-4 mt-md-3 mt-lg-0">
                <aside>
                    <h5 class="mb-3">Berita Terbaru</h5>
                    @foreach ($latestNews as $latest)
                        <div class="d-flex mb-3 latest-news" style="cursor: pointer;"
                            onclick="window.location.href='{{ route('news.show', $latest->slug) }}'">
                            <img src="{{ asset($latest->thumbnail) }}" alt="{{ $latest->title }}"
                                class="img-fluid rounded" width="100" style="object-fit: cover;">
                            <div class="ms-3">
                                <p class="mb-0">{{ $latest->title }}</p>
                                <small>{{ $latest->created_at->isoFormat('dddd, D MMMM Y') }}</small>
                            </div>
                        </div>
                    @endforeach
                </aside>
            </div>
        </div>
    </div>

    <x-ui.share-modal :route="route('news.show', $news->slug)" text="Ayo baca berita terbaru dari {{ config('app.name') }}:%0A%0A" />

</x-layouts.frontend>

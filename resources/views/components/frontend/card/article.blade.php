<div class="card shadow-sm border-0 card-article" onclick="window.location.href='{{ route('news.show', $new->slug) }}'">
    <div class="card-body row flex-column-reverse flex-md-row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="entry-content">
                <p class="post-name">BERITA</p>
                <p class="post-date">{{ $new->created_at->format('d M Y') }}</p>
                <h1 class="post-title mt-3">{{ $new->title }}</h1>
                <p class="post-caption mt-3">{!! Str::limit($new->content, 150) !!}</p>
                <a href="{{ 'berita/' . $new->slug }}" class="post-link mt-5">Selengkapnya ></a>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <img src="{{ asset($new->thumbnail) }}" alt="{{ $new->title }}" class="img-news">
        </div>
    </div>
</div>

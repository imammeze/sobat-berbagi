<x-layouts.frontend title="FAQ">
    <x-frontend.header-section subheading="Frequently asked questions" heading="Kami Siap untuk Menjawab Pertanyaan Anda"
        supporting-text="Ingin Tahu Lebih? Berikut Pertanyaan yang Sering Ditanyakan." />

    @php
        $request = request();

        if (!$request->has('category')) {
            $request->merge(['category' => 'umum']);
        }
    @endphp
    <div class="container">
        <div class="d-flex flex-column align-items-center">
            <ul class="nav  gap-3" id="myTab" role="tablist">
                @foreach ($categories as $category)
                    <li class="nav-item" role="presentation">
                        <button onclick="window.location.href='{{ route('faq', ['category' => $category->slug]) }}'"
                            class="btn btn-link text-decoration-none text-dark {{ request()->get('category') == $category->slug ? 'text-white btn-primary' : '' }}">
                            {{ $category->name }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="tab-content mt-3" id="myTabContent">
            @foreach ($categories as $category)
                <div class="tab-pane fade {{ $request->get('category') == $category->slug ? 'show active' : '' }}"
                    aria-labelledby="{{ $category->slug }}-tab">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach ($category->faqs as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading{{ $faq->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse{{ $faq->id }}" aria-expanded="false"
                                        aria-controls="flush-collapse{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="flush-collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="flush-heading{{ $faq->id }}"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        {!! \Illuminate\Support\Str::markdown($faq->answer) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.frontend>

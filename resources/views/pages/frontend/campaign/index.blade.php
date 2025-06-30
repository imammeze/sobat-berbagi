<x-layouts.frontend title="Campaign">
    @push('styles')
        <style>

        </style>
    @endpush
    <div class="container ">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 d-none d-md-none d-lg-block">
                <div class="position-sticky" style="top: 8rem;">
                    <h6>Filter</h6>
                    <div class="card shadow-sm border-0 ">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select class="form-select" name="category" id="category">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}"
                                            {{ request()->get('category') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 mt-4">
                <div class="row">
                    @foreach ($campaigns as $campaign)
                        <x-frontend.card.campaigns :campaign="$campaign" />
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $campaigns->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#category').on('change', function() {
                    window.location.href = '{{ route('campaign.index') }}?category=' + $(this).val();
                })
            });
        </script>
    @endpush
</x-layouts.frontend>

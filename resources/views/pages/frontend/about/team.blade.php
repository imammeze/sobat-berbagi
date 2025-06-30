<x-layouts.frontend title="Tim Kami">
    <x-frontend.header-section subheading="" heading="Tim dibalik Lazismu Banyumas"
        supporting-text="Kumpulan orang hebat dibalik platform crowdfunding ini" />
    <div class="container">
        <div class="row mt-5">
            @foreach ($teams as $team)
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 mb-5">
                    <x-frontend.card.team :team="$team" />
                </div>
            @endforeach

        </div>
    </div>
</x-layouts.frontend>

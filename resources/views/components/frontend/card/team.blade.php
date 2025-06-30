<div class="card card-team">
    <img src="{{ $team['image'] }}" alt="team">
    <div class="card-body ">
        <h5 class="card-title">{{ $team['name'] }}</h5>
        <p class="card-text">{{ $team['position'] }}</p>
        <p class="card-text-description">{{ $team['description'] }}</p>
        {{-- <div class="d-flex mt-3">
            <a href="">
                <img src="{{ asset('frontend/assets/images/icon/ic_twitter.svg') }}" alt="ic_twtitter" class="ic-sosmed">
            </a>
            <a href="">
                <img src="{{ asset('frontend/assets/images/icon/ic_linkedin.svg') }}" alt="ic_linkedin"
                    class="ic-sosmed">
            </a>
            <a href="">
                <img src="{{ asset('frontend/assets/images/icon/ic_website.svg') }}" alt="ic_webste" class="ic-sosmed">
            </a>
        </div> --}}
    </div>
</div>

<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">


        <ul class="navbar-nav">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle"
                        src="https://ui-avatars.com/api/?name={{ Auth::user()->email }}&color=7F9CF5&background=EBF4FF"
                        alt="">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle"
                                src="https://ui-avatars.com/api/?name={{ Auth::user()->email }}&color=7F9CF5&background=EBF4FF"
                                alt="">
                        </div>
                        <div class="text-center">
                            @if (Auth::user()->hasRole('mitra'))
                                <p class="tx-12 text-muted">
                                    {{ Auth::user()->profile->name }}
                                </p>
                            @endif
                            <p class="tx-12 text-muted">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>

                    <ul class="list-unstyled p-1">

                        <li class="dropdown-item py-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link text-body m-0 p-0">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

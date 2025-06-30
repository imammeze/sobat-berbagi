<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-text">
                    <i data-feather="search"></i>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form>
        <ul class="navbar-nav">



            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <div class="indicator">
                        <div class="circle"></div>
                    </div>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>
                            {{ Auth::user()->webNotifications->count() }} Notifications
                        </p>
                        <a href="javascript:;" class="text-muted">
                            Clear all
                        </a>
                    </div>
                    <div class="p-1">
                        @foreach (Auth::user()->webNotifications as $notification)
                            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                <div
                                    class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                    <i class="icon-sm text-white" data-feather="{{ $notification->icon }}"></i>
                                </div>
                                <div class="flex-grow-1 me-2">
                                    <p>{{ $notification->title }}</p>
                                    <p class="tx-12 text-muted">{{ $notification->message }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm">
                        <img src="{{ asset(Auth::user()->mitraRelation->logo) }}" class="img-fluid" alt="">
                    </div>

                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <div class="avatar">
                                <img src="{{ asset(Auth::user()->mitraRelation->logo) }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">
                                {{ Auth::user()->mitraRelation->name }}
                            </p>
                            <p class="tx-12 text-muted">
                                {{ Auth::user()->mitraRelation->email }}
                            </p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{ route('mitra.profile.index') }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Ubah Profil</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link text-body m-0 p-0">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

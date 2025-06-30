<nav class="sidebar">
    <div class="sidebar-header">

        <img src="{{ asset('admin/assets/images/logo-sobat-berbagi-2025.png') }}" class="sidebar-brand" width="60">
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>

            @can('dashboard')
                <li class="nav-item {{ request()->is('admin/dashboard') ? ' active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
            @endcan

            @can('contact-list')
                <li class="nav-item {{ request()->is('admin/contact') ? ' active' : '' }}">
                    <a href="{{ route('admin.contact.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Data Form Kontak</span>
                    </a>
                </li>
            @endcan


            @can('website-management')
                <li class="nav-item {{ request()->is('admin/banners*') ? ' active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#website-management" role="button"
                        aria-expanded="{{ request()->is('admin/banners*') ? ' true' : '' }}"
                        aria-controls="website-management">
                        <i class="link-icon" data-feather="globe"></i>
                        <span class="link-title">Manajemen Website</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->is('admin/banners*', 'admin/teams*') ? 'show' : '' }}"
                        id="website-management">
                        <ul class="nav sub-menu">

                            @can('banner-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.banners.index') }}"
                                        class="nav-link {{ request()->is('admin/banners*') ? ' active' : '' }}">Banner</a>
                                </li>
                            @endcan

                            @can('team-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.teams.index') }}"
                                        class="nav-link {{ request()->is('admin/teams*') ? ' active' : '' }}">Team</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan

            @can('article-management')
                <li
                    class="nav-item {{ request()->is('admin/news-categories*', 'admin/news-tags*', 'admin/news*') ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#news-management" role="button"
                        aria-expanded="{{ request()->is('admin/news-categories*', 'admin/news-tags*', 'admin/news*') ? 'true' : '' }}"
                        aria-controls="news-management">
                        <i class="link-icon" data-feather="file-text"></i>
                        <span class="link-title">Manajemen Berita</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->is('admin/news-categories*', 'admin/news-tags*', 'admin/news*') ? 'show' : '' }}"
                        id="news-management">
                        <ul class="nav sub-menu">

                            @can('article-category-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.news-categories.index') }}"
                                        class="nav-link {{ request()->is('admin/news/categories*') ? 'active' : '' }}">Kategori</a>
                                </li>
                            @endcan

                            @can('article-tag-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.news-tags.index') }}"
                                        class="nav-link {{ request()->is('admin/news-tags*') ? 'active' : '' }}">Tag</a>
                                </li>
                            @endcan

                            @can('article-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.news.index') }}"
                                        class="nav-link {{ request()->is('admin/news*') && !request()->is('admin/news/categories*') && !request()->is('admin/news-tags*') ? 'active' : '' }}">Berita</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan

            @can('faq-management')
                <li class="nav-item {{ request()->is('admin/faq-categories*', 'admin/faqs*') ? ' active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#faq-management" role="button"
                        aria-expanded="{{ request()->is('admin/faq-categories*', 'admin/faqs*') ? ' true' : '' }}"
                        aria-controls="faq-management">
                        <i class="link-icon" data-feather="message-circle"></i>
                        <span class="link-title">Manajemen Faq</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->is('admin/faq-categories*', 'admin/faqs*') ? 'show' : '' }}"
                        id="faq-management">
                        <ul class="nav sub-menu">

                            @can('faq-category-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.faq-categories.index') }}"
                                        class="nav-link {{ request()->is('admin/faq-categories*') ? ' active' : '' }}">Kategori</a>
                                </li>
                            @endcan

                            @can('faq-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.faqs.index') }}"
                                        class="nav-link {{ request()->is('admin/faqs*') ? ' active' : '' }}">FAQ</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan


            @can('campaign-management')
                <li class="nav-item {{ request()->is('admin/campaign-categories*', 'admin/campaign*') ? ' active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#campaign-management" role="button"
                        aria-expanded="{{ request()->is('admin/campaign-categories*', 'admin/news*', 'admin/campaign') ? ' true' : '' }}"
                        aria-controls="campaign-management">
                        <i class="link-icon" data-feather="heart"></i>
                        <span class="link-title">Manajemen Campaign</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->is('admin/campaign-categories*', 'admin/campaign*') ? 'show' : '' }}"
                        id="campaign-management">
                        <ul class="nav sub-menu">

                            @can('campaign-category-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.campaign-categories.index') }}"
                                        class="nav-link {{ request()->is('admin/campaign-categories*') ? ' active' : '' }}">Kategori</a>
                                </li>
                            @endcan

                            @can('campaign-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.campaigns.index') }}"
                                        class="nav-link {{ request()->is('admin/campaign*') && !request()->is('admin/campaign-categories*') && !request()->is('admin/campaign-latest-news*') ? 'active' : '' }}">Campaign</a>
                                </li>
                            @endcan

                            @can('campaign-latest-news-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.campaign-latest-news.index') }}"
                                        class="nav-link {{ request()->is('admin/campaign-latest-news*') ? 'active' : '' }}">Berita
                                        Campaign</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan

            @can('transaction-management')
                <li
                    class="nav-item {{ request()->is('admin/metode-pembayaran*', 'admin/transaksi-campaign*') ? ' active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#transaction-management" role="button"
                        aria-expanded="{{ request()->is('admin/metode-pembayaran*', 'admin/transaksi-campaign*') ? ' true' : '' }}"
                        aria-controls="transaction-management">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Manajemen Transaksi</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->is('admin/metode-pembayaran*', 'admin/transaksi-campaign*', 'admin/transaksi-zakat*') ? 'show' : '' }}"
                        id="transaction-management">
                        <ul class="nav sub-menu">

                            @can('payment-method-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.metode-pembayaran.index') }}"
                                        class="nav-link {{ request()->is('admin/metode-pembayaran*') ? ' active' : '' }}">Metode
                                        Pembayaran</a>
                                </li>
                            @endcan

                            @can('campaign-donation-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.transaksi-campaign.index', ['payment_method_code' => 'manual']) }}"
                                        class="nav-link {{ request()->is('admin/transaksi-campaign*') ? ' active' : '' }}">
                                        Transaksi Campaign
                                    </a>
                                </li>
                            @endcan

                            @can('zakat-transaction-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.transaksi-zakat.index', ['payment_method_code' => 'manual']) }}"
                                        class="nav-link {{ request()->is('admin/transaksi-zakat*') ? ' active' : '' }}">
                                        Transaksi Zakat
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan

            @can('user-management')
                <li class="nav-item {{ request()->is('admin/donatur', 'admin/roles*') ? ' active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#user-management" role="button"
                        aria-expanded="{{ request()->is('admin/donatur', 'admin/roles*') ? ' true' : '' }}"
                        aria-controls="user-management">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Manajemen User</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->is('admin/donatur', 'admin/roles*', 'admin/mitra*') ? ' show' : '' }}"
                        id="user-management">
                        <ul class="nav sub-menu">
                            @can('role-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                        class="nav-link  {{ request()->is('admin/roles*') ? ' active' : '' }}">Role</a>
                                </li>
                            @endcan

                            @can('donatur-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.donatur.index') }}"
                                        class="nav-link {{ request()->is('admin/donatur') ? ' active' : '' }}">Donatur</a>
                                </li>
                            @endcan

                            @can('mitra-list')
                                <li class="nav-item">
                                    <a href="{{ route('admin.mitra.index') }}"
                                        class="nav-link {{ request()->is('admin/mitra') ? ' active' : '' }}">Mitra</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
        </ul>
    </div>
</nav>

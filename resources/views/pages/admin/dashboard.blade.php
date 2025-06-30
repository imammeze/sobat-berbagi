<x-layouts.admin title="Dashboard">
    @push('plugin-styles')
        <link href="{{ asset('admin/assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    @endpush


    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
        </div>
    </div>

    @can('dashboard-admin')
        @include('pages.admin.dashboard-admin')
    @endcan

    @can('dashboard-mitra')
        @include('pages.admin.dashboard-mitra')
    @endcan

    @can('dashboard-manager-campaign')
        @include('pages.admin.dashboard-manager-campaign')
    @endcan

    @can('dashboard-finance')
        @include('pages.admin.dashboard-finance')
    @endcan

    @push('plugin-scripts')
        <script src="{{ asset('admin/assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('admin/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    @endpush
</x-layouts.admin>

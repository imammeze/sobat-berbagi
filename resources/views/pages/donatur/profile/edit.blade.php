<x-layouts.frontend title="Profil">
    @push('styles')
        <style>
            .fas {
                font-size: 1.5rem;
            }


            .menu-item {
                background-color: #F6F7F9
            }

            .menu-item:hover {
                background-color: #E5E5E5
            }

            .menu-item:active {
                background-color: #E5E5E5
            }

            .fa-chevron-right {
                font-size: 1rem;
            }
        </style>
    @endpush

    <div class="bg-primary">
        <h6 class="text-white py-3 px-3">Edit Profil</h6>
    </div>

    <div class="container mt-3">

    </div>

    @push('custom-scripts')
        <script>
            $('footer').hide();
            $('.footer-border').hide();
        </script>
    @endpush
</x-layouts.frontend>

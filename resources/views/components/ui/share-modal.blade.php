@props([
    'route' => '',
    'text' => '',
])

@include('sweetalert::alert')


<div class="modal fade" tabindex="-1" id="modalShare">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Bagikan Lewat</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 px-3 pb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="share-item facebook">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $route }}" target="_blank"
                            rel="noopener noreferrer">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <span>Facebook</span>
                    </div>
                    <div class="share-item twitter">
                        <a href="https://twitter.com/intent/tweet?url={{ $route }}" target="_blank"
                            rel="noopener noreferrer">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <span>Twitter</span>
                    </div>
                    <div class="share-item whatsapp">
                        <a href="https://wa.me/?text={{ $text }} {{ $route }}" target="_blank"
                            rel="noopener noreferrer">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <span>Whatsapp</span>
                    </div>
                    <div class="share-item linee">
                        <a href="https://line.me/R/msg/text/?{{ $text }} {{ $route }}" target="_blank"
                            rel="noopener noreferrer">
                            <i class="bi bi-line"></i>
                        </a>
                        <span>Line</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <input type="text" class="form-control" value="{{ $route }}" id="shareLink" readonly>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary w-100" onclick="copyToClipboard()">
                            Salin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('plugin-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('custom-scripts')
    <script>
        function copyToClipboard() {
            var url = "{{ $route }}";

            if (navigator.clipboard) {
                navigator.clipboard.writeText(url)
                    .then(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Link berhasil disalin',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        })
                    })
                    .catch(function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Browser tidak mendukung fitur ini',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Browser tidak mendukung fitur ini',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    </script>
    <script>
        $('.btnCopy').on('click', function() {
            $('#modalShare').modal('show');
        });
    </script>
@endpush

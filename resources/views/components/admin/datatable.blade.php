@props([
    'thead' => null,
    'tbody' => null,
    'useButtons' => false,
    'exportFileName' => '',
])

@push('plugin-styles')
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

<div class="table-responsive">
    <table id="dataTableExample" class="table table-striped">
        <thead>
            {{ $thead ?? '' }}
        </thead>
        <tbody>
            {{ $tbody }}
        </tbody>
    </table>
</div>

@push('plugin-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.js">
    </script>
@endpush

@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('#dataTableExample').DataTable({
                @if ($useButtons)
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'excel',
                            className: 'btn btn-success',
                            exportOptions: {
                                columns: ':visible:not(.noExport)'
                            },
                            customize: function(xlsx) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                $('row c[r^="C"]', sheet).attr('s', '2');
                            },
                            filename: function() {
                                return "{{ $exportFileName }}"
                            },
                            text: '<i class="fa fa-file-excel-o"></i> Export Excel'
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-danger',
                            exportOptions: {
                                columns: ':visible:not(.noExport)'
                            },
                            customize: function(doc) {
                                doc.defaultStyle.fontSize = 8;
                                doc.pageMargins = [20, 20, 20, 20];
                                doc.styles.tableHeader.fontSize = 8;
                                doc.styles.tableFooter.fontSize = 8;
                                doc.styles.title.fontSize = 10;
                                doc.styles.title.alignment = 'center';
                                doc.content[1].table.widths = Array(doc.content[1].table.body[0]
                                    .length + 1).join(
                                    '*').split('');

                            },
                            filename: function() {
                                return "{{ $exportFileName }}"
                            },
                            text: '<i class="fa fa-file-pdf-o"></i> Export PDF'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-primary',
                            exportOptions: {
                                columns: ':visible:not(.noExport)'
                            },
                            customize: function(win) {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');
                                $(win.document.body).find('table').addClass(
                                    'compact').css('font-size', 'inherit');
                            },
                            filename: function() {
                                return "{{ $exportFileName }}"
                            },
                            text: '<i class="fa fa-print"></i> Print'
                        },
                    ]
                @endif
            });

            $('.dataTables_filter input[type="search"]').addClass('form-control');
            $('.dataTables_length select').addClass('form-select');
            $('.dataTables_filter input[type="search"]').attr('placeholder', 'Cari...');

        });
    </script>
@endpush

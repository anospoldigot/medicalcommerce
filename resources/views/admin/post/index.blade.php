@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active">Post
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
    <a class="btn btn-primary mb-1" href="{{ route('post.create') }}">
    <i data-feather='plus'></i> Create
    </a>
    <div class="card">
        <div class="card-datatable">
            <table class="datatables-ajax table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("post.index") }}', // memanggil route yang menampilkan data json
                columns: [
                    { // mengambil & menampilkan kolom sesuai tabel database
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category.name',
                        name: 'category.name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                dom: `<"card-header border-bottom p-1"<"head-label">
                    <"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12
                            col-md-6"l>
                            <"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i>
                                    <"col-sm-12 col-md-6"p>>`,
                drawCallback: function( settings ) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                },
                rowCallback: function(row, data, index) {
                    $('td:eq(0)', row).html(index + 1);
                }
        });

        $('div.head-label').html('<h6 class="mb-0">Data Post</h6>');
    </script>
@endpush
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
        Create
    </a>
    
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Data Artikel</h4>
        </div>
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
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'tags',
                        name: 'tags'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                drawCallback: function( settings ) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
        });
    </script>
@endpush
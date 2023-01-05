@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Product
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
<a class="btn btn-primary mb-1" href="{{ route('product.create') }}">
    <i data-feather='plus'></i> Create
</a>

<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Data Product</h4>
    </div>
    <table class="datatables-basic table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Berat</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
           $('form.create').submit(function(){
                event.preventDefault();
                const data = $(this).serialize();
    
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data,
                    dataType: 'json',
                    success: function(res){
                        alert(JSON.stringify(res));
                    },
                    error: function(err){
                        alert(JSON.stringify(err));
                    }
                })
            })
         $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("product.index") }}', // memanggil route yang menampilkan data json
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
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'weight',
                        name: 'weight'
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
    })
</script>
@endpush
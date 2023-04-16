@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a>
            </li>
            <li class="breadcrumb-item active">Review
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
<div class="card">
    <table class="datatables-basic table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        const table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("products.reviews.index", $product->slug) }}', // memanggil route yang menampilkan data json
                columns: [
                    { 
                        data: 'id',
                        name: 'id'
                    },
                    { 
                        data: 'name',
                        name: 'name'
                    },
                    { 
                        data: 'comment',
                        name: 'comment'
                    },
                    { 
                        data: 'action',
                        name: 'action'
                    },
                    
                ],
                dom: `<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>`,
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
        $('div.head-label').html('<h6 class="mb-0">Data Review {{ $product->title }}</h6>');
    })
</script>
@endpush
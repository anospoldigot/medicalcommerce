@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Warehouse
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
<a class="btn btn-primary mb-1" href="{{ route('warehouses.create') }}">
    <i data-feather='plus'></i> Create
</a>

<div class="card">
    <table class="datatables-basic table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
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

        const table =
         $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("warehouses.index") }}', // memanggil route yang menampilkan data json
                columns: [
                    { // mengambil & menampilkan kolom sesuai tabel database
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
        $('div.head-label').html('<h6 class="mb-0">Data Warehouse</h6>');

        $(document).on('submit', 'form.delete', function(){
            event.preventDefault();
            const data = $(this).serialize();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(this);
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data,
                        dataType: 'json',
                        success: function(res){
                            if(res.success){
                                toastr['success'](res.message, 'Success!', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
                                });
                                table.ajax.reload();
                            }else{
                                toastr['error'](res.message, 'Error!', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
                                });
                            }
                        },
                        error: function(err){
                            toastr['error'](err.responseJSON.message, 'Error!', {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl
                            });
                        }
                    })
                }
            })
        })
    })
</script>
@endpush
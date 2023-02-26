@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Category Post
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
<button class="btn btn-primary mb-1" type="button" data-toggle="modal" data-target="#createModal">
    <i data-feather='plus'></i> Create
</button>
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route("tags.store") }}" method="post" class="create">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Tag</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tag">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i data-feather='save' class="mr-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Data Order</h4>
    </div>
    <table class="datatables-basic table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Date</th>
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
                ajax: '{{ route("tags.index") }}', // memanggil route yang menampilkan data json
                columns: [
                    { 
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    { 
                        data: 'name',
                        name: 'name'
                    },
                    { 
                        data: 'created_at',
                        name: 'created_at'
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

        $('form.create').submit(function(){
            event.preventDefault();
            const data = $(this).serializeArray();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data,
                dataType: 'json',
                success: function(res){
                    toastr['success'](res.message, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    $('#createModal').modal('hide');
                    table.ajax.reload();
                },
                error: function(err){
                    console.log(err);
                    toastr['error'](err.responseJSON.message, 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    $('#createModal').modal('hide');
                }
            })
        })

        $(document).on('submit', 'form.edit', function(){
            event.preventDefault();
            const data = $(this).serializeArray();

            $.ajax({
                url: $(this).attr('action'),
                method: 'PATCH',
                data,
                dataType: 'json',
                success: function(res){
                    toastr['success'](res.message, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    $('.modal').modal('hide');
                    table.ajax.reload();
                },
                error: function(err){
                    console.log(err);
                    toastr['error'](err.responseJSON.message, 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    $('.modal').modal('hide');
                }
            })
        })
    })
</script>
@endpush
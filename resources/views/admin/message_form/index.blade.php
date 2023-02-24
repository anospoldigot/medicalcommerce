@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Message Form
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
<a class="btn btn-primary mb-1" href="{{ route('coupons.create') }}">
    <i data-feather='plus'></i> Create
</a>

<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Message Form</h4>
    </div>
    <table class="datatables-basic table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Subject</th>
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
                ajax: '{{ route("message_forms.index") }}', // memanggil route yang menampilkan data json
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
                        data: 'email',
                        name: 'email'
                    },
                    { 
                        data: 'subject',
                        name: 'subject'
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
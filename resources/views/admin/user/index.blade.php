@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Users
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
<a class="btn btn-primary mb-1" href="{{ route('users.create') }}">
    <i data-feather='plus'></i> Create
</a>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            {{-- <th></th>
                            <th></th> --}}
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="modal modal-slide-in fade" id="modals-slide-in">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname"
                            placeholder="John Doe" aria-label="John Doe" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Post</label>
                        <input type="text" id="basic-icon-default-post" class="form-control dt-post"
                            placeholder="Web Developer" aria-label="Web Developer" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <input type="text" id="basic-icon-default-email" class="form-control dt-email"
                            placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                        <small class="form-text text-muted"> You can use letters, numbers & periods
                        </small>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                        <input type="text" class="form-control dt-date" id="basic-icon-default-date"
                            placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" for="basic-icon-default-salary">Salary</label>
                        <input type="text" id="basic-icon-default-salary" class="form-control dt-salary"
                            placeholder="$12000" aria-label="$12000" />
                    </div>
                    <button type="button" class="btn btn-primary data-submit mr-1">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
         $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("users.index") }}', // memanggil route yang menampilkan data json
                columns: [
                    { // mengambil & menampilkan kolom sesuai tabel database
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
                        data: 'action',
                        name: 'action'
                    },
                ],
                dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                drawCallback: function( settings ) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
        });
        $('div.head-label').html('<h6 class="mb-0">Data Users</h6>');
    })
</script>
@endpush
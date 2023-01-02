@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active">Category
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
<button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#exampleModal">
    Create
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route("category.store") }}" method="post" class="create">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Category</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Category">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Data Category</h4>
    </div>
    <div class="card-datatable">
        <table class="datatables-ajax table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
        const table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("category.index") }}', // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
            
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

        $(document).on('submit', 'form.edit', function(){
            event.preventDefault();
            const data = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data,
                dataType: 'json',
                success: function(res){
                    alert(JSON.stringify(res));
                    table.ajax.reload();
                },
                error: function(err){
                    alert(JSON.stringify(err));
                }
            })
        })

        

        
</script>
@endpush
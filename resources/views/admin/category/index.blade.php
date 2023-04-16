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
<button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#createModal"><i data-feather='plus'></i> Create</button>

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route("category.store") }}" method="post" class="create">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Category</h5>
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
                    <div class="form-group">
                        <input type="file" name="image" id="image" onchange="loadFile(event)">
                    </div>
                    <div><img id="output" class="img-fluid" /></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card">
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
                        data: 'id',
                        name: 'id'
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

        $('div.head-label').html('<h6 class="mb-0">Data Category</h6>');
            
        $('form.create').submit(function(){
            event.preventDefault();
            const data      = $(this).serializeArray();
            const formData  = new FormData($(this)[0]);

            for (const key in data) {
                formData.append(data[key].name, data[key].value);
            }
            formData.append('image', $('#image')[0].files[0]);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
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
            console.log(data)
            var formData = new FormData($(this)[0]);
            formData.append('other_data',$("#someInputData").val());
            // $.ajax({
            //     url: $(this).attr('action'),
            //     method: 'POST',
            //     processData: false,
            //     contentType: false,
            //     data,
            //     dataType: 'json',
            //     success: function(res){
            //         toastr['success'](res.message, 'Success!', {
            //             closeButton: true,
            //             tapToDismiss: false,
            //             rtl: isRtl
            //         });
            //         $('.modal').modal('hide');
            //         table.ajax.reload();
            //     },
            //     error: function(err){
            //         toastr['error'](err.responseJSON.message, 'Error!', {
            //             closeButton: true,
            //             tapToDismiss: false,
            //             rtl: isRtl
            //         });
            //         $('.modal').modal('hide');
            //     }
            // })
        })


        
        const loadFile = function(event) {
            const output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
        };
        
</script>
@endpush
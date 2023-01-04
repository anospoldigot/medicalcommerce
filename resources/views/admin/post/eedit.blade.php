@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Post</a>
            </li>
            <li class="breadcrumb-item active">Create
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
@foreach ($errors->all() as $error)
{{ $error }}<br />
@endforeach
<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Post</h4>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control" id="tags" name="tags" placeholder="tags">
                    </div>
                    <div class="form-group">
                        <label for="body">Konten</label>
                        <textarea id="body" name="body" autocomplete="off"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thumbnail</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="file" name="image" onchange="loadFile(event)">
                    </div>
                    <div><img id="output" class="img-fluid" /></div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    $('#body').summernote({
            placeholder: 'Write content here..',
            tabsize: 2,
            height: 120,
        });

        const loadFile = function(event) {
            const output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
</script>
@endpush
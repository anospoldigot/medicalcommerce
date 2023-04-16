@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Slider</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('coupons.index') }}">Slider</a>
            </li>
            <li class="breadcrumb-item active">Create
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Slider</h4>
            </div>
            <div class="card-body">
                <form id="my-dropzone" class="dropzone mb-3"></form>

                <form action="{{ route('sliders.store') }}" method="POST" id="create-slider" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" name="code" value="{{ Str::random(6) }}" class="form-control" readonly @error('code') is-invalid @enderror>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" name="url" value="{{ old('url') }}" class="form-control @error('url') is-invalid
                            @enderror" >
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-right">
                        <a href="{{ route('sliders.index') }}" class="btn btn-outline-primary"><i data-feather='corner-up-left'></i> Batal</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        Dropzone.options.myDropzone = {
            url: "{{ route('upload') }}", // URL untuk mengupload file
            paramName: "file", // Nama parameter untuk file
            maxFiles: 5, // Jumlah maksimum file
            acceptedFiles: "image/*", // Jenis file yang diterima
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            previewTemplate: `<div class="dz-preview dz-file-preview">
                <div class="dz-image"><img data-dz-thumbnail /></div>
                <div class="dz-details">
                    <div class="dz-filename"><span data-dz-name></span></div>
                    <div class="dz-size" data-dz-size></div>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                <div class="dz-success-mark"><span></span></div>
                <div class="dz-error-mark"><span></span></div>
            </div>`,
            dictDefaultMessage: "Drag and drop files here or click to upload", // Pesan default
            init: function() {
                this.on("addedfile", function(file) {
                    // Buat elemen gambar pratinjau
                    // var previewElement = document.createElement("div");
                    // previewElement.classList.add("dz-preview");
                    
                    // // Buat elemen gambar
                    // var img = document.createElement("img");
                    // img.src = URL.createObjectURL(file);
                    // previewElement.appendChild(img);
                    
                    // // Tambahkan gambar pratinjau ke dropzone
                    // file.previewElement = previewElement;
                    // this.element.appendChild(previewElement);
                    
                });
                this.on("success", function(file, response) {
                    $('form#create-slider')
                        .find('.form-group')
                        .append(`<input type="hidden" name="filename[]" id="filename" value="${response.filename}">`)
                });
            }
        };
    </script>
@endpush
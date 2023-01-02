@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Product</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a>
            </li>
            <li class="breadcrumb-item active">Create
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="title">Nama Product</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control select2" id="category_id" name="category_id">
                                <option value="">==PILIH==</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Price" oninput="currencyInput()">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="weight">Berat</label>
                            <input type="number" class="form-control" id="weight" name="weight" placeholder="Berat (Gram)">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="images">Gambar Product</label>
                            {{-- <input type="file" name="images" id="images" class="form-control-file" multiple> --}}
                            <div id="output-image"></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="description">Deskripsi Product</label>
                            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const quill = new Quill('#description', {
            theme: 'snow',
        });
        $('#output-image').imageUploader();
    </script>
@endpush
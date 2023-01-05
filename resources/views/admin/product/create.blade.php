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
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Name" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control select2" id="category_id" name="category_id">
                                <option value="" selected disabled>==PILIH==</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id')) >{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" oninput="currencyInput()" value="{{ old('price') }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="Stock" value="{{ old('stock') }}">
                        </div>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="weight">Berat</label>
                            <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" placeholder="Berat (Gram)" value="{{ old('weight') }}">
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group mt-1">
                    <div class="custom-control custom-control-primary custom-switch">
                        <input type="checkbox" checked class="custom-control-input" id="is_discount" name="is_discount" />
                        <label class="custom-control-label" for="is_discount">Discount</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="discount">Discount Type</label>
                            <select name="discount_type" class="form-control" id="discount_type">
                                <option value="" selected disabled>==PILIH==</option>
                                <option value="persentase">Persentase</option>
                                <option value="nominal">Nominal</option>
                            </select>
                            @error('discount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="discount">Discount Value</label>
                            <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount"
                                placeholder="Discount (%)" value="{{ old('discount') }}">
                            @error('discount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="description">Deskripsi Product</label>
                            <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="images">Gambar Product</label>
                            
                            {{-- <input type="file" name="images" id="images" class="form-control-file" multiple> --}}
                            <div id="output-image"></div>
                            @error('images')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="text-right">
                    <a href="{{ route('product.index') }}" class="btn btn-outline-primary"><i data-feather='corner-up-left'></i> Batal</a>
                    <button type="submit" class="btn btn-primary"><i data-feather='save'></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#description').summernote({
            placeholder: 'Alamat',
            tabsize: 2,
            height: 120,
            toolbar: [
            ['font', ['bold', 'underline', 'clear', 'italic']],
            ]
        });
        $('#output-image').imageUploader();


        $('#discount').on('input', function(){
            if($('#discount_type').val() == 'persentase'){
            }else if($('#discount_type').val() == 'nominal'){
            }else{
                $('#discount').input(function(){
                    alert('Silahkan pilih tipe discount terlebih dahulu')
                })
            }
        });

        $('#is_discount').change(function(){
            // if($('#discount_type').val() == 'persentase'){
            //     $('#discount').input(inputPercentage())
            // }else if($('#discount_type').val() == 'nominal'){
            //     $('#discount').input(inputNominal())
            // }else{
            //     $('#discount').input(function(){
            //         alert('Silahkan pilih tipe discount terlebih dahulu')
            //     })
            // }
        });




    </script>
@endpush
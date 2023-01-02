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
@foreach ($errors->all() as $error)
{{ $error }}<br />
@endforeach
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="title">Nama Product</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name" value="{{ $product->title }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control select2" id="category_id" name="category_id">
                                <option value="" selected disabled>==PILIH==</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($product->category_id ?? '' == $category->id)>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Price" oninput="currencyInput()" value="{{ number_format($product->price) }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="{{$product->stock}}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="weight">Berat</label>
                            <input type="number" class="form-control" id="weight" name="weight" placeholder="Berat (Gram)" value="{{ $product->weight }}">
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
                            <textarea class="form-control" id="description" rows="3" name="description">{!!$product->description!!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
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

        let preloaded = {!! json_encode($product->assets) !!}

        $('#output-image').imageUploader({
            preloaded: preloaded.map(value => ({ id: value.filename, src:value.src })),
            preloadedInputName: 'oldImageProduct'
        });
    </script>
@endpush

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
            <li class="breadcrumb-item active">Show
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Product</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <b>Nama Product</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $product->title }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <b>SKU</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $product->sku }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <b>Harga</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : Rp. {{ number_format($product->price,2,',','.') }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <b>Stock</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $product->stock }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <b>Berat</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $product->weight }} (Gram)
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <b>Category</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {!! $product->category ? '<span class="badge badge-success">' . $product->category->title .' </span>' : '-' !!}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <b>Total Review</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $product->reviews_count }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <b>Description</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $product->description }}
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-12 col-lg-6">
                    <b>Gambar Product</b>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach ($product->assets as $key => $asset)
                                <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" class="{{ $loop->first ? 'active' : ''}}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            @foreach ($product->assets as $asset)
                                <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                                    <img class="img-fluid" src="{{ $asset->src }}" alt="First slide" />
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.frontend')

@push('styles')
<style>
    .product-hero {
        background-image: linear-gradient(to left, rgba(245, 246, 252, 0.52) , rgba(113, 88, 226,0.7)),
        url('{{asset("frontend/img/headerdoctor.jpg")}}');
        background-size: cover;
        background-position: top right;
        height: 400px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-5 mb-5 product-hero">
    <div class="container py-5">
        <div class="row justify-content-start">
            <div class="col-lg-8 text-center text-lg-start">
                <h1 class="display-1 text-uppercase text-dark mb-lg-4 ">Permedik</h1>
                <h1 class="text-uppercase text-white mb-lg-4">Product & Kits Medical</h1>
                <p class="fs-4 text-white mb-lg-4">Dolore tempor clita lorem rebum kasd eirmod dolore diam eos kasd.
                    Kasd clita ea justo est sed kasd erat clita sea</p>
                <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                    <a href="" class="btn btn-outline-light border-2 py-md-3 px-md-5 me-5">Read More</a>
                    <button type="button" class="btn-play" data-bs-toggle="modal"
                        data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                        <span></span>
                    </button>
                    <h5 class="font-weight-normal text-white m-0 ms-4 d-none d-sm-block">Play Video</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-3">
            <div class="bg-light p-4 mb-3">
                <h6 class="mb-4">Category</h6>
                @foreach ($categories as $category)
                <div><small><a href="{{ route('product.index') }}?category={{$category->id}}" class="text-capitalize">{{ $category->title }}</a></small></div>
                @endforeach
            </div>
            <div class="bg-light p-4">
                <h6 class="mb-4">Harga</h6>
                <label for="customRange2" class="form-label">Rp. <span id="price">100000</span></label>
                <input type="range" class="form-range" min="10000" max="1000000" value="100000" id="customRange2"
                    oninput="return $('#price').html(event.target.value)">
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <input type="text" id="search" class="form-control" placeholder="Search..." aria-label="Search..."
                            aria-describedby="button-addon2">
                        <button class="btn btn-success" id="search-button" type="button" id="button-addon2"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            @if ($products->isNotEmpty())
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-lg-4 mb-5">
                        <div class="product-item position-relative bg-light d-flex flex-column text-center"
                            style="height: 100%; object-fit: cover;">
                            <img class="img-fluid mb-4" src="{{ $product->assets->first()->src }}" alt="">
                            <h6 class="text-uppercase">{{ $product->title }}</h6>
                            <span class=" mb-3">{{ $product->category->title ?? '-' }}</span>
                
                            @if ($product->is_discount)
                                <small class="text-muted text-decoration-line-through mb-0">Rp. {{ number_format  ($product->price,2,",",".") }}
                                </small>
                                @if ($product->discount_type == 'persen')
                                    <span class="text-primary  mb-0">Rp. {{ number_format (($product->price / 100) * $product->discount,2,",",".") }}
                                    </span>
                                @else
                                    <span class="text-primary  mb-0">Rp. {{ number_format ($product->price - $product->discount,2,",",".") }}
                                    </span>
                                @endif
                            @else
                                <span class="text-primary  mb-0">Rp. {{ number_format  ($product->price,2,",",".") }}
                                </span>
                            @endif 
                            <div class="btn-action d-flex justify-content-center">
                                <button class="btn btn-primary py-2 px-3" onclick="addToCart({{ $product->id }})"><i class="bi bi-cart"></i></button>
                                <a class="btn btn-primary py-2 px-3" href="{{ route('products.show', $product->slug) }}"><i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            @else
                <div class="text-center my-5">Product Not Found</div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $('#search-button').click(function(){
            window.location.href = '{{ route('product.index') }}?q=' + $('#search').val(); 
        })
        
        const addToCart = function(product_id){
            $.ajax({
                url: '{{ route("cart.store") }}',
                method: 'POST',
                data: {
                    product_id
                },
                success: function(res){
                    console.log(res);
                    if(res.success){
                        window.location.href = res.redirect_url
                    }
                },
                error: function(err){
                    console.log(err);
                    alert(JSON.stringify(err))
                }
            })
        }

    </script>
@endpush
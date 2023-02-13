@extends('layouts.frontend', [
'disableHero' => 1
])

@push('styles')
<style>
    
</style>
    
@endpush

@section('content')
<!-- Hero  -->
{{-- <div class="hero-container">
    <div class="h-100 hero-container-opacity">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-12 col-lg-6 text-secondary">
                    <div class="mb-4">
                        <span class="text-uppercase fw-600 fs-30">Permedik</h1>
                            <h6 style="">Product Kits & <span class="text-primary">Medical</span></h6>
                    </div>
                    <p class="mb-4">
                        Temukan beragam alat medis rumah sakit di permedik dengan kualkitas yang baik pengiriman
                        cepat
                    </p>
                    <button class="btn btn-primary px-3">Shop Now</button>
                </div>
                <div class="col-12 col-lg-6">
                    <img src="{{ asset('frontend/img/hero.svg') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-light text-center py-2">
    <span style="font-weight: 900; font-size: 40px; color: #b4b6b8;">PERMATA MITRA MEDIKA</span>
</div> --}}
<div class="bg-light">
    <div class="container py-5">
        <div class="card bg-white border-0" style="border-radius: 12px">
            <div class="card-body">
                <div class="row my-2">
                    <div class="col-12 col-md-5">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <img src="{{ $product->assets->first()->src }}" class="img-fluid product-img"
                                alt="product image" />
                        </div>
                        {{-- <div class="swiper" id="product">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                @foreach ($product->assets as $asset)
                                <div class="swiper-slide">
                                    <img src="{{ $asset->src }}" alt="" class="img-fluid">
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            
                        </div> --}}
                        <div class="glide">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">
                                    @foreach ($product->assets as $asset)
                                        <li class="glide__slide">
                                            <img src="{{ $asset->src }}" alt="" class="img-fluid">
                                        </li>
                                        <li class="glide__slide">
                                            <img src="{{ $asset->src }}" alt="" class="img-fluid">
                                        </li>
                                        <li class="glide__slide">
                                            <img src="{{ $asset->src }}" alt="" class="img-fluid">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="glide__arrows" data-glide-el="controls">
                                <button class="glide__arrow btn btn-primary glide__arrow--left" data-glide-dir="<">prev</button>
                                <button class="glide__arrow btn btn-primary glide__arrow--right" data-glide-dir=">">next</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <h4 class="text-capitalize">{{ $product->title }}</h4>
                        <span class="card-text item-company">Category : <a href="javascript:void(0)"
                                class="company-name text-capitalize">({{ $product->category->title ?? '-' }})</a></span>
                        <div class="ecommerce-details-price  mt-1">
                            @if ($product->is_discount)
                            <div>
                                <del>
                                    <small class="text-muted text-decoration-line-through mb-0">Rp. {{
                                        number_format ($product->price,2,",",".") }}
                                    </small>
                                </del>
                            </div>
                            @if ($product->discount_type == 'persen')
                            <div>
                                <h4 class="item-price text-primary mr-1">Rp. {{ number_format (($product->price / 100) *
                                    $product->discount,2,",",".") }}
                                </h4>

                            </div>
                            @else
                            <div>
                                <h4 class="item-price text-primary mr-1">Rp. {{ number_format ($product->price -
                                    $product->discount,2,",",".") }}
                                </h4>
                            </div>
                            @endif
                            @else
                            <h4 class="item-price text-primary mr-1">Rp. {{ number_format ($product->price,2,",",".") }}
                            </h4>
                            @endif
                            <ul class="unstyled-list list-inline pl-1 border-left">
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                            </ul>
                        </div>
                        <p class="card-text">Available - <span class="text-success">{{ $product->stock }}</span></p>
                        <p class="card-text">
                            {{$product->description}}
                        </p>
                        <ul class="product-features list-unstyled">
                            <li><i data-feather="shopping-cart"></i> <span>Free Shipping</span></li>
                            <li>
                                <i data-feather="dollar-sign"></i>
                                <span>EMI options available</span>
                            </li>
                        </ul>
                        <hr />

                        <div class="d-flex flex-column flex-sm-row pt-1">
                            <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})"
                                class="btn btn-primary">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a>
                            <div class="btn-group dropdown-icon-wrapper btn-share">
                                <button type="button"
                                    class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i data-feather="facebook"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i data-feather="twitter"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i data-feather="youtube"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i data-feather="instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
        </div>
    </div>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h4 class="mb-2">Related Products</h4>
            <h6 class="text-muted">People also search for this items</h6>
        </div>
        <div class="swiper" id="relatedProduct">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                
            </div>
        
            <div class="glide related-product">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach ($relatedProducts as $relate)
                            <div class="glide__slide" style="height: 100%">
                                <div class="card mb-3 border-0 bg-white" style="height: 100%">
                                    <div class="card-img-top">
                                        <img src="{{ $relate->assets->first()->src }}" class="card-img-top" alt="..."
                                            style="max-height:250px; object-fit: cover;">
                                        {{-- <img src="https://source.unsplash.com/random/{{ $relate->id }}" class="card-img-top" alt="..."
                                            style="max-height:250px; object-fit: cover;">
                                        --}}
                                        @if ($relate->is_discount && $relate->discount_type == 'persen')
                                        <span class="badge badge-success" style="position: absolute;top: 0; right: 0">-{{
                                            $relate->discount }}%</span>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title text-secondary text-capitalize"><a
                                                    href="{{ route('fe.products.show', $relate->slug) }}">{{ $relate->title
                                                    }}</a> </h5>
                                            @if ($relate->category)
                                            <div class="text-center text-capitalize mb-3">({{ $relate->category->title ??
                                                '-' }})
                                            </div>
                                            @endif
                                        </div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow btn btn-primary glide__arrow--left" data-glide-dir="<">prev</button>
                    <button class="glide__arrow btn btn-primary glide__arrow--right" data-glide-dir=">">next</button>
                </div>
            </div>
    
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    const product = new Glide('.glide', {
            startAt: 0,
            perView: 4
        })
        .mount()

    const relatedProduct = new Glide('.related-product', {
            startAt: 0,
            perView: 3,
            gap: 20
        })
        .mount()
</script>
@endpush
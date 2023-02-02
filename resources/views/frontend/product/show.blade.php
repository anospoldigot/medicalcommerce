@extends('layouts.frontend', [
'disableHero' => 1
])

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
<div style="background: #7158e226">
    <div class="container py-5">
        <div class="card border-0">
            <!-- Product Details starts -->
            <div class="card-body">
                <div class="row my-2">
                    <div class="col-12 col-md-5">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ $product->assets->first()->src }}" class="img-fluid product-img"
                                alt="product image" />
                        </div>
                        <div class="swiper" id="product">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                @foreach ($product->assets as $asset)
                                <div class="swiper-slide">
                                    <img src="{{ $asset->src }}" alt="" class="img-fluid">
                                </div>
                                @endforeach
                            </div>
                            {{-- <div class="swiper-pagination"></div> --}}
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            {{-- <div class="swiper-scrollbar"></div> --}}
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
                            <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})" class="btn btn-primary btn-cart mr-0 mr-sm-1 mb-1 mb-sm-0">
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
                <div class="bg-light text-center py-2 my-5">
                    <span style="font-weight: 900; font-size: 40px; color: #b4b6b8;">PERMATA MITRA MEDIKA</span>
                </div>
                <div class="text-center mb-5">
                    <h4 class="mb-2">Related Products</h4>
                    <h6 class="text-muted">People also search for this items</h6>
                </div>
                <div class="swiper" id="relatedProduct">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach ($relatedProducts as $relate)
                        <div class="swiper-slide" style="height: 100%">
                            <div class="card mb-3 border-0 bg-light" style="height: 100%">
                                <div class="card-img-top">
                                    <img src="{{ $relate->assets->first()->src }}" class="card-img-top" alt="..."
                                        style="max-height:250px; object-fit: cover;">
                                    {{-- <img src="https://source.unsplash.com/random/{{ $relate->id }}"
                                        class="card-img-top" alt="..." style="max-height:250px; object-fit: cover;">
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
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev bottom-nav__item"></div>
                    <div class="swiper-button-next bottom-nav__item"></div>

                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
            <!-- Product Details ends -->

            <!-- Item features starts -->
            {{-- <div class="item-features">
                <div class="row text-center">
                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="w-75 mx-auto">
                            <i data-feather="award"></i>
                            <h4 class="mt-2 mb-1">100% Original</h4>
                            <p class="card-text">Chocolate bar candy canes ice cream toffee. Croissant pie cookie
                                halvah.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="w-75 mx-auto">
                            <i data-feather="clock"></i>
                            <h4 class="mt-2 mb-1">10 Day Replacement</h4>
                            <p class="card-text">Marshmallow biscuit donut dragée fruitcake. Jujubes wafer cupcake.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="w-75 mx-auto">
                            <i data-feather="shield"></i>
                            <h4 class="mt-2 mb-1">1 Year Warranty</h4>
                            <p class="card-text">Cotton candy gingerbread cake I love sugar plum I love sweet croissant.
                            </p>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Item features ends -->

            <!-- Related Products starts -->
            {{-- <div class="card-body">
                <div class="mt-4 mb-2 text-center">
                    <h4>Related Products</h4>
                    <p class="card-text">People also search for this items</p>
                </div>
                <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="javascript:void(0)">
                                <div class="item-heading">
                                    <h5 class="text-truncate mb-0">Apple Watch Series 6</h5>
                                    <small class="text-body">by Apple</small>
                                </div>
                                <div class="img-container w-50 mx-auto py-75">
                                    <img src="../../../app-assets/images/elements/apple-watch.png" class="img-fluid"
                                        alt="image" />
                                </div>
                                <div class="item-meta">
                                    <ul class="unstyled-list list-inline mb-25">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i>
                                        </li>
                                    </ul>
                                    <p class="card-text text-primary mb-0">$399.98</p>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0)">
                                <div class="item-heading">
                                    <h5 class="text-truncate mb-0">Apple MacBook Pro - Silver</h5>
                                    <small class="text-body">by Apple</small>
                                </div>
                                <div class="img-container w-50 mx-auto py-50">
                                    <img src="../../../app-assets/images/elements/macbook-pro.png" class="img-fluid"
                                        alt="image" />
                                </div>
                                <div class="item-meta">
                                    <ul class="unstyled-list list-inline mb-25">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i>
                                        </li>
                                    </ul>
                                    <p class="card-text text-primary mb-0">$2449.49</p>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0)">
                                <div class="item-heading">
                                    <h5 class="text-truncate mb-0">Apple HomePod (Space Grey)</h5>
                                    <small class="text-body">by Apple</small>
                                </div>
                                <div class="img-container w-50 mx-auto py-75">
                                    <img src="../../../app-assets/images/elements/homepod.png" class="img-fluid"
                                        alt="image" />
                                </div>
                                <div class="item-meta">
                                    <ul class="unstyled-list list-inline mb-25">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i>
                                        </li>
                                    </ul>
                                    <p class="card-text text-primary mb-0">$229.29</p>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0)">
                                <div class="item-heading">
                                    <h5 class="text-truncate mb-0">Magic Mouse 2 - Black</h5>
                                    <small class="text-body">by Apple</small>
                                </div>
                                <div class="img-container w-50 mx-auto py-75">
                                    <img src="../../../app-assets/images/elements/magic-mouse.png" class="img-fluid"
                                        alt="image" />
                                </div>
                                <div class="item-meta">
                                    <ul class="unstyled-list list-inline mb-25">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                    </ul>
                                    <p class="card-text text-primary mb-0">$90.98</p>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0)">
                                <div class="item-heading">
                                    <h5 class="text-truncate mb-0">iPhone 12 Pro</h5>
                                    <small class="text-body">by Apple</small>
                                </div>
                                <div class="img-container w-50 mx-auto py-75">
                                    <img src="../../../app-assets/images/elements/iphone-x.png" class="img-fluid"
                                        alt="image" />
                                </div>
                                <div class="item-meta">
                                    <ul class="unstyled-list list-inline mb-25">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i>
                                        </li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i>
                                        </li>
                                    </ul>
                                    <p class="card-text text-primary mb-0">$1559.99</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div> --}}
            <!-- Related Products ends -->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const swiperProduct = new Swiper('#product', {
        // Optional parameters
        // direction: 'vertical',
        loop: true,
        slidesPerView: 4,
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: false
        // navigation: {
        //     nextEl: '.swiper-button-next',
        //     prevEl: '.swiper-button-prev',
        // },

        });

        const relatedProductSwiper = new Swiper('#relatedProduct', {
            // Optional parameters
            loop: true,
            slidesPerView: 3,
            spaceBetween: 40,

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },


        });
</script>
@endpush
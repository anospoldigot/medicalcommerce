@extends('layouts.frontend', [
'disableHero' => 1
])

@push('styles')
<style>
    .br-theme-fontawesome-stars .br-widget a {
        font-size: 16px !important;
    }
    
    /* .br-theme-fontawesome-stars .br-widget a::after {
    color: #000 !important;
    }
    
    .br-theme-fontawesome-stars .br-widget a.br-selected::after {
    color: blue !important;
    } */
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
                            <img src="{{ $product->assets->first()->src }}" class="img-fluid product-img" style="border-radius: 10px;"
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
                                            <a target="_blank" href="{{ $asset->src }}"><img src="{{ $asset->src }}" alt="" class="img-fluid" style="border-radius: 10px;"></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="glide__arrows" data-glide-el="controls">
                                <button class="glide-arrow glide-arrow-left btn btn-arrow rounded-pill" data-glide-dir="<"><i
                                        class="fa-solid fa-chevron-left"></i></button>
                                <button class="glide-arrow glide-arrow-right btn btn-arrow rounded-pill" data-glide-dir=">"><i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <h4 class="text-capitalize">{{ $product->title }}</h4>
                        <span class="card-text item-company">Category : <a href="{{ route('fe.categories.products.index', $product->category->slug) }}"
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
                                <h4 class="item-price text-primary mr-1">Rp. {{ number_format ($product->price - (($product->price / 100) * $product->discount),2,",",".") }}
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
                        <p class="card-text">{{ $product->stock > 0 ? 'Available' : ''}} - <span class="text-success">{{ $product->stock }}</span></p>
                        <p class="card-text">
                            {!!$product->description!!}
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
                            @auth
                                <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})"
                                    class="btn btn-primary">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span class="add-to-cart">Add to cart</span>
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="btn btn-primary">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span class="add-to-cart">Add to cart</span>
                                </a>

                            @endauth

                            <div class="btn-group dropdown-icon-wrapper btn-share">
                                <button type="button"
                                    class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.toko-online.com/produk-123" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 48 48">
                                            <path fill="#039be5" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"></path>
                                            <path fill="#fff"
                                                d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z">
                                            </path>
                                        </svg>
                                        Bagikan Ke Facebook
                                    </a>
                                    <a class="dropdown-item" href="https://twitter.com/intent/tweet?url=https://www.toko-online.com/produk-123" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 48 48">
                                            <path fill="#03A9F4"
                                                d="M42,12.429c-1.323,0.586-2.746,0.977-4.247,1.162c1.526-0.906,2.7-2.351,3.251-4.058c-1.428,0.837-3.01,1.452-4.693,1.776C34.967,9.884,33.05,9,30.926,9c-4.08,0-7.387,3.278-7.387,7.32c0,0.572,0.067,1.129,0.193,1.67c-6.138-0.308-11.582-3.226-15.224-7.654c-0.64,1.082-1,2.349-1,3.686c0,2.541,1.301,4.778,3.285,6.096c-1.211-0.037-2.351-0.374-3.349-0.914c0,0.022,0,0.055,0,0.086c0,3.551,2.547,6.508,5.923,7.181c-0.617,0.169-1.269,0.263-1.941,0.263c-0.477,0-0.942-0.054-1.392-0.135c0.94,2.902,3.667,5.023,6.898,5.086c-2.528,1.96-5.712,3.134-9.174,3.134c-0.598,0-1.183-0.034-1.761-0.104C9.268,36.786,13.152,38,17.321,38c13.585,0,21.017-11.156,21.017-20.834c0-0.317-0.01-0.633-0.025-0.945C39.763,15.197,41.013,13.905,42,12.429">
                                            </path>
                                        </svg>
                                        Bagikan Ke Twitter
                                    </a>
                                    <a class="dropdown-item" href="https://wa.me/?text={{ $product->title }}%0A{{ request()->url() }}"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 48 48">
                                            <path fill="#fff"
                                                d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z">
                                            </path>
                                            <path fill="#fff"
                                                d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z">
                                            </path>
                                            <path fill="#cfd8dc"
                                                d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z">
                                            </path>
                                            <path fill="#40c351"
                                                d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z">
                                            </path>
                                            <path fill="#fff" fill-rule="evenodd"
                                                d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Bagikan Ke Whatsapp
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="CopyMe('{{ request()->url() }}')">
                                        Salin Tautan
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
        <div class="bg-white p-4">
            <div class="text-center mb-5">
                <h4 class="mb-2">Review</h4>
                <h6 class="text-muted">People Review For this product</h6>
            </div>
            
            @forelse ($product->latest_reviews as $review)
            <div class="mb-5">
                <div class="d-flex mb-1">
                    <img src="{{ asset('upload/images/' . $review->user->profile) }}"
                        onerror="this.onerror=null;this.src='{{ $review->user->profile }}';" width="40" height="40"
                        alt="profile-user" class="rounded-circle mx-1">
                    <h6 class="mx-1">{{ $review->user->name }}</h6>
                </div>
            
                <select class="rating" id="example">
                    <option value="1" @selected($review->rating == 1)>1</option>
                    <option value="2" @selected($review->rating == 2)>2</option>
                    <option value="3" @selected($review->rating == 3)>3</option>
                    <option value="4" @selected($review->rating == 4)>4</option>
                    <option value="5" @selected($review->rating == 5)>5</option>
                </select>
                <p>{{ $review->comment }}</p>
            </div>
            @empty
            <div class="text-center text-muted">Belum ada review</div>
            @endforelse
            <a href="{{ route('fe.products.review', $product->slug) }}">Lihat Detail</a>
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
            gap: 20,
            autoplay: 3000,
        })
        .mount()

    $('.rating').barrating({
        theme: 'fontawesome-stars',
        readonly: true
    });
    
</script>
@endpush
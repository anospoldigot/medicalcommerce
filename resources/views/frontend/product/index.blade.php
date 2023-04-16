@extends('layouts.frontend', [
    'disableHero' => 1,
    'disableFooter' => 1
])

@push('styles')
<style>


</style>
@endpush

@section('content')

<div class="bg-light">
    <div class="row mb-4 d-block d-lg-none">
        <div class="col-12">
            <div class="glide" id="banner-slider">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <li class="glide__slide">
                            <img src="{{ asset('frontend/img/banner1.jpg') }}" alt=""
                                style="height: 100%; object-fit: cover">
                        </li>
                        <li class="glide__slide">
                            <img src="{{ asset('frontend/img/banner2.jpg') }}" alt=""
                                style="height: 100%; object-fit: cover">
                        </li>
                    </ul>
                    <div class="glide__arrows" data-glide-el="controls">
                        <button class="glide-arrow glide-arrow-left btn btn-arrow rounded-pill" data-glide-dir="<"><i
                                class="fa-solid fa-chevron-left"></i></button>
                        <button class="glide-arrow glide-arrow-right btn btn-arrow rounded-pill" data-glide-dir=">"><i
                                class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="d-none d-lg-block">
            <div class="row mb-4">
                <div class="col-12 col-lg-8">
                    <div class="glide" id="banner-slider">
                        <div class="glide__track" data-glide-el="track">
                            <ul class="glide__slides">
                                <li class="glide__slide">
                                    <img src="{{ asset('frontend/img/banner1.jpg') }}" alt=""
                                        style="height: 100%; object-fit: cover">
                                </li>
                                <li class="glide__slide">
                                    <img src="{{ asset('frontend/img/banner2.jpg') }}" alt=""
                                        style="height: 100%; object-fit: cover">
                                </li>
                            </ul>
                            <div class="glide__arrows" data-glide-el="controls">
                                <button class="glide-arrow glide-arrow-left btn btn-arrow rounded-pill" data-glide-dir="<"><i
                                        class="fa-solid fa-chevron-left"></i></button>
                                <button class="glide-arrow glide-arrow-right btn btn-arrow rounded-pill" data-glide-dir=">"><i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-flex flex-column">
                    <div class="py-1">
                        <img src="{{ asset('frontend/img/banner1.jpg') }}" alt="" style="height: 100%; object-fit: cover">
                    </div>
                    <div class="py-1">
                        <img src="{{ asset('frontend/img/banner2.jpg') }}" alt="" style="height: 100%; object-fit: cover">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-none d-lg-block">
            <h6 class="text-center mb-3">Kategori</h6>
            <div class="row mb-4">
                @foreach ($categories as $category)
                <div class="col-2 p-1">
                    <a href="{{ route('fe.categories.products.index', $category->slug) }}">
                        <div class="rounded category-product">
                            <img src="{{ asset('upload/images/' . $category->image) }}" alt="" class="card-img-top rounded">
                            <div class="p-3">
                                <small>{{ $category->title }}</small>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <h6 class="text-center mb-3">Product Terlaris</h6>
        <div class="row mb-4" >
            <div class="glide" id="product-slider" style="height: 100%">
                <div class="glide__track" style="height: 100%" data-glide-el="track">
                    <ul class="glide__slides" style="height: 100%">
                        @foreach ($products as $product)
                            <li class="glide__slide" style="height: 100%">
                                <a href="{{ route('fe.products.show', $product->slug) }}">
                                    <div class="rounded card-product" style="height: 100%">
                                        <img src="{{ $product->assets->first()->src }}" alt="" class="card-img-top rounded">
                                        <span class="badge badge-success label-sell-product">50 Terjual</span>
                                        <div class="p-3">
                                            <div class="mb-3">
                                                {{ $product->title }}
                                            </div>
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
                                                <span class="text-primary  mb-0">Rp. {{ number_format ($product->price - (($product->price / 100) * $product->discount),2,",",".") }}
                                                </span>

                                            </div>
                                            @else
                                            <div>
                                                <span class="text-primary  mb-0">Rp. {{ number_format
                                                    ($product->price-$product->discount,2,",",".") }}
                                                </span>
                                            </div>
                                            @endif
                                            @else
                                            <span class="text-primary  mb-0">Rp. {{ number_format
                                                ($product->price,2,",",".") }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="glide__arrows" data-glide-el="controls">
                        <button class="glide-arrow glide-arrow-left btn btn-arrow rounded-pill" data-glide-dir="<"><i
                                class="fa-solid fa-chevron-left"></i></button>
                        <button class="glide-arrow glide-arrow-right btn btn-arrow rounded-pill" data-glide-dir=">"><i
                                class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <h6 class="text-center mb-3">Semua Product</h6>
        <div class="row mb-4" id="content">
            @foreach ($products as $product) 
            <div class="col-6 col-md-4 col-xl-2 p-1">
                <a href="{{ route('fe.products.show', $product->slug) }}">
                    <div class="rounded card-product" style="height: 100%">
                        <img src="{{ $product->assets->first()->src }}" alt="" class="card-img-top rounded">
                        <span class="badge badge-success label-sell-product">50 Terjual</span>
                        <div class="p-3">
                            <div class="mb-3">
                                {{ $product->title }}
                            </div>
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
                                <span class="text-primary  mb-0">Rp. {{ number_format ($product->price - (($product->price / 100) * $product->discount),2,",",".") }}
                                </span>
            
                            </div>
                            @else
                            <div>
                                <span class="text-primary  mb-0">Rp. {{ number_format
                                    ($product->price-$product->discount,2,",",".") }}
                                </span>
                            </div>
                            @endif
                            @else
                            <span class="text-primary  mb-0">Rp. {{ number_format
                                ($product->price,2,",",".") }}
                            </span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        {{-- <div class="row">
            <div class="col-lg-3">
                <div class="p-4  mb-3" style="background: #7158e226">
                    <h6 class="mb-4">Category</h6>
                    @foreach ($categories as $category)
                    <div><small><a href="{{ route('fe.products.index') }}?category={{$category->id}}"
                                class="text-capitalize">{{
                                $category->title }}</a></small></div>
                    @endforeach
                </div>
                <div class="p-4" style="background: #7158e226">
                    <h6 class="mb-4">Harga</h6>
                    <div class="form-group">
                        <label for="min"><small>Min</small></label>
                        <input type="text" class="form-control form-control-sm" id="min" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label for="max"><small>Max</small></label>
                        <input type="text" class="form-control form-control-sm" id="max" placeholder="max">
                    </div>
                    <div>
                        <button class="btn btn-primary" id="filter-btn" type="button">Filter</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="text" id="search" class="form-control" placeholder="Search..."
                                        aria-label="Search..." aria-describedby="button-addon2">
                                    <button class="btn btn-success" id="search-button" type="button"
                                        id="button-addon2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($products as $product)
                    <div class="col-lg-4 mb-4">
                        <div class="card mb-3" style="height: 100%">
                            <div class="card-img-top">
                                <img src="{{ $product->assets->first()->src }}" class="card-img-top" alt="..."
                                    style="max-height:250px; object-fit: cover;">
                                @if ($product->is_discount && $product->discount_type == 'persen')
                                <span class="badge badge-success" style="position: absolute;top: 0; right: 0">-{{
                                    $product->discount }}%</span>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-secondary text-capitalize"><a
                                            href="{{ route('fe.products.show', $product->slug) }}">{{ $product->title
                                            }}</a> </h5>
                                    @if ($product->category)
                                    <div class="text-center text-capitalize mb-3">({{ $product->category->title ?? '-'
                                        }})
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="mb-4">
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
                                            <span class="text-primary  mb-0">Rp. {{ number_format (($product->price /
                                                100) *
                                                $product->discount,2,",",".") }}
                                            </span>

                                        </div>
                                        @else
                                        <div>
                                            <span class="text-primary  mb-0">Rp. {{ number_format
                                                ($product->price-$product->discount,2,",",".") }}
                                            </span>
                                        </div>
                                        @endif
                                        @else
                                        <span class="text-primary  mb-0">Rp. {{ number_format
                                            ($product->price,2,",",".") }}
                                        </span>
                                        @endif

                                    </div>
                                    <div class="d-flex justify-content-between mb-2"><small>Stock : {{ $product->stock
                                            }}</small><small>Terjual : 10</small></div>
                                    <button class="btn btn-block btn-sm btn-primary text-capitalize"><i
                                            class="fa-solid fa-cart-shopping mr-2"></i> add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" id="prev-product"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="btn btn-primary" id="next-product"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div> --}}
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('#search-button').click(function(){
            window.location.href = '{{ route('fe.products.index') }}?q=' + $('#search').val();
        })
        $('#filter-btn').click(function(){
            window.location.href = `{{ route('fe.products.index') }}?min=${$('#min').val()}&max=${$('#max').val()}`;
        })

        const banner = new Glide('#banner-slider', {
            height: 300,
            autoplay: 3000,
        }).mount()

        const product = new Glide('#product-slider', {
            perView: 6,
            breakpoints: {
                600: {
                    perView: 2
                },
            }
        }).mount()
        
        $(document).ready(function() {
            let page = 1; 
            let isLoad = false; 
            let isFinish = false; 

            function productTemplate(data){
                let priceRender = '';

                if(data.is_discount){
                    priceRender += `<div>
                        <del>
                            <small class="text-muted text-decoration-line-through mb-0">Rp. {{
                                number_format ($product->price,2,",",".") }}
                            </small>
                        </del>
                    </div>`;
                    
                    if (data.discount_type == 'persen') {
                        priceRender += `<div>
                            <span class="text-primary  mb-0">${formatRupiah((data.price / 100) * data.discount, 'Rp. ', ',00')}</span>
                        </div>`
                    }else{
                        priceRender += `<div>
                            <span class="text-primary  mb-0">${formatRupiah(data.price -data.discount, 'Rp. ', ',00')}</span>
                        </div>`
                    }
                }else{
                    priceRender += `<span class="text-primary  mb-0">${formatRupiah(data.price, 'Rp. ', ',00')}</span>`
                }

                return `<div class="col-6 col-md-4 col-xl-2 p-1">
                    <a href="{{ route('fe.products.index') }}/${data.slug}">
                        <div class="rounded card-product" style="height: 100%">
                            <img src="${data.assets[0].src}" alt="${data.title}-image" class="card-img-top rounded">
                            <span class="badge badge-success label-sell-product">50 Terjual</span>
                            <div class="p-3">
                                <div class="mb-3">
                                    ${data.title}
                                </div>
                                ${priceRender}
                            </div>
                        </div>
                    </a>
                </div>`
            }

            function loadContent(page) {
                $.ajax({
                    url: window.location.href,
                    method: "GET",
                    data: { page: page + 1},
                    beforeSend: function() {
                        isLoad = true; 
                        $("#content").append('<div class="loading col-12 text-center my-3">Loading...</div>');
                    },
                    success: function(data) {
                        if(data.length == 0) isFinish = true
                        isLoad = false; 
                        $(".loading").remove();
                        $("#content").append(data.map(value => productTemplate(value)));
                    }
                });
            }

            $(window).scroll(function() {
                if ($(window).scrollTop() == $(document).height() - $(window).height() && !isLoad) {
                    if(!isFinish){
                        page++; // mengubah halaman
                        loadContent(page); // memuat konten
                    }
                }
            });
                loadContent(page);
            });

</script>
@endpush
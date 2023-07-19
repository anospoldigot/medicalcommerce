@extends('layouts.frontend')

@push('styles')
    <style>
        .company-title-style {
            font-weight: 900;
            font-size: 40px;
            color: #b4b6b8;
        }



        @media only screen and (max-width: 600px) {
            .company-title-style {
                font-size: 20px;
            }
        }

        .hero-title {
            font-size: 25px;
            font-weight: 700;
        }

        .hero-subtitle {
            font-size: 80px;
            font-weight: 700;
        }

        .hero-paragraph{
            color: rgb(106, 106, 106);
            font-size: : 15
        }
    </style>
@endpush

@section('content')
    <!-- Hero  -->
    <div class="hero-container">
        <div class="h-100 hero-container-opacity">
            <div class="container h-100 py-5 py-lg-0">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-12 col-lg-6 mb-lg-0 text-secondary px-2 order-1 order-lg-0">
                        <div class="mb-4">
                            <h6 class="hero-subtitle">Product Kits & <span class="text-primary">Medical</span></h6>
                            <span class="text-uppercase hero-title mb-4">Pertama Mitra Medika</span>
                        </div>
                        <p class="mb-4 hero-paragraph">
                            Temukan beragam alat medis rumah sakit di permedik dengan kualitas yang baik pengiriman
                            cepat
                        </p>
                        <a href="{{ route('fe.products.index') }}" class="btn btn-primary px-3">Shop Now</a>
                    </div>
                    <div class="col-12 col-lg-6 mb-3 mb-lg-0 order-0 order-lg-1">
                        <div id="heroAnimation"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light text-center py-2">
        <span class="company-title-style">PERTAMA MITRA MEDIKA</span>
    </div>

    <div class="bg-white">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-12 col-lg-5">
                    <div id="product-to-cart-animation" class="mb-3"></div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="mb-5">
                        <div class="mb-3">
                            <span class="text-primary font-weight-bold">PERTAMA MITRA MEDIKA</span> Didirikan
                            pada tahun 2015 yang bergerak pada
                            bidang distribusi alat – alat kesehatan
                            dengan kualitas dan pelayanan terbaik.
                            Perusahaan ini berkedudukan
                            di gedung Artha, Ruko Rose Garden
                            RRG 5 Nomor 115 Galaxy Bekasi
                            Selatan, Kel.Jakasetia, Kec. Bekasi
                            Selatan, Kota Bekasi, Prov. Jawa Barat!
                        </div>
                        <a href="">Read More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <span class="bg-light p-2">
                                <i class="fa-solid fa-store text-primary mb-3" style="font-size: 35px; "></i>
                            </span>
                            <h4 class="text-secondary font-weight-bold">Market Leader</h4>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci quasi dolores, perferendis
                                voluptatum alias, quia vitae impedit cum !
                            </p>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <span class="bg-light p-2">
                                <i class="fa-solid fa-building-columns text-primary mb-3" style="font-size: 35px; "></i>
                            </span>
                            <h4 class="text-secondary font-weight-bold">Market Leader</h4>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci quasi dolores, perferendis
                                voluptatum alias, quia vitae impedit cum !
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5" style="background: #7158e226">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h3 class="mb-2 text-secondary">Services</h3>
                <h2 class="text-secondary font-weight-bold">
                    Check out the great services we offer
                </h2>
            </div>
            <div class="row mx-lg-n5">
                <div class="col-lg-3 px-lg-4 mb-3">
                    <div class="bg-white shadow border-botton text-center border-primary px-3 py-4"
                        style="border-radius: 12px; height: 100%;">
                        <i class="fa-solid fa-rotate-left text-secondary mb-3" style="font-size: 35px;"></i>
                        <h5 class="mb-3">Pengembalian Mudah</h5>
                        <p>
                            Salah beli barang bukan jadi halangan untuk anda, kami menyediakan return barang untuk anda yang
                            merasa tidak sesuai
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 px-lg-4 mb-3">
                    <div class="bg-white shadow border-botton text-center border-primary px-3 py-4"
                        style="border-radius: 12px; height: 100%;">
                        <i class="fa-sharp fa-solid fa-comments text-secondary mb-3" style="font-size: 35px;"></i>
                        <h5 class="mb-3">CS support 24/7</h5>
                        <p>
                            Customer Service kami terhubung setiap saat dan siap membantu anda
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 px-lg-4 mb-3">
                    <div class="bg-white shadow border-botton text-center border-primary px-3 py-4"
                        style="border-radius: 12px; height: 100%;">
                        <i class="fa-solid fa-truck-fast text-secondary mb-3" style="font-size: 35px;"></i>
                        <h5 class="mb-3">Pengiriman cepat</h5>
                        <p>
                            Tidak perlu menunggu lama, setelah anda checkout pesanan langsung dikirim
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 px-lg-4 mb-3">
                    <div class="bg-white shadow border-botton text-center border-primary px-3 py-4"
                        style="border-radius: 12px; height: 100%;">
                        <i class="fa-solid fa-credit-card text-secondary mb-3" style="font-size: 35px;"></i>
                        <h5 class="mb-3">Pembayaran Lengkap</h5>
                        <p>
                            Menyediakan banyak jenis pembayaran yang mempermudah proses pesanan ada tanpa ribet
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 ">
        <div class="container py-3">
            <h1 class="text-center text-secondary mb-5">Popular Products</h1>
            <div class="d-none d-lg-block">
                <div class="row ">
                    @foreach ($products as $product)
                        <div class="col-lg-3">
                            <div class="card mb-3" style="height: 100%">
                                <div class="card-img-top">
                                    <img src="{{ $product->assets->first()->src }}" class="card-img-top" alt="..."
                                        style="max-height:250px; object-fit: cover;">
                                    {{-- <img src="https://source.unsplash.com/random/{{ $product->id }}" class="card-img-top"
                                alt="..." style="max-height:250px; object-fit: cover;"> --}}
                                    @if ($product->is_discount && $product->discount_type == 'persen')
                                        <span class="badge badge-success"
                                            style="position: absolute;top: 0; right: 0">-{{ $product->discount }}%</span>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title text-secondary text-capitalize"><a
                                                href="{{ route('fe.products.show', $product->slug) }}">{{ $product->title }}</a>
                                        </h5>
                                        @if ($product->category)
                                            <div class="text-center text-capitalize mb-3">
                                                ({{ $product->category->title ?? '-' }})
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            @if ($product->is_discount)
                                                <div>
                                                    <del>
                                                        <small class="text-muted text-decoration-line-through mb-0">Rp.
                                                            {{ number_format($product->price, 2, ',', '.') }}
                                                        </small>
                                                    </del>
                                                </div>
                                                @if ($product->discount_type == 'persen')
                                                    <div>
                                                        <span class="text-primary  mb-0">Rp.
                                                            {{ number_format($product->price - ($product->price / 100) * $product->discount, 2, ',', '.') }}
                                                        </span>

                                                    </div>
                                                @else
                                                    <div>
                                                        <span class="text-primary  mb-0">Rp.
                                                            {{ number_format($product->price - $product->discount, 2, ',', '.') }}
                                                        </span>
                                                    </div>
                                                @endif
                                            @else
                                                <span class="text-primary  mb-0">Rp.
                                                    {{ number_format($product->price, 2, ',', '.') }}
                                                </span>
                                            @endif

                                        </div>
                                        <div class="d-flex justify-content-between mb-2"><small>Stock :
                                                {{ $product->stock }}</small><small>Terjual : 10</small></div>

                                        @auth
                                            <button onclick="addToCart({{ $product->id }})"
                                                class="btn btn-block btn-sm btn-primary text-capitalize">
                                                <i class="fa-solid fa-cart-shopping mr-2"></i> Add to cart
                                            </button>
                                        @else
                                            <button onclick="return window.location.href='{{ route('login') }}'"
                                                class="btn btn-block btn-sm btn-primary text-capitalize">
                                                <i class="fa-solid fa-cart-shopping mr-2"></i>
                                                add to cart
                                            </button>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="glide d-block d-lg-none" id="product-slider">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach ($products as $product)
                            <li class="glide__slide">

                                <div class="card mb-3" style="height: 100%">
                                    <div class="card-img-top">
                                        <img src="{{ $product->assets->first()->src }}" class="card-img-top"
                                            alt="..." style="max-height:250px; object-fit: cover;">
                                        {{-- <img src="https://source.unsplash.com/random/{{ $product->id }}"
                                        class="card-img-top" alt="..." style="max-height:250px; object-fit: cover;"> --}}
                                        @if ($product->is_discount && $product->discount_type == 'persen')
                                            <span class="badge badge-success"
                                                style="position: absolute;top: 0; right: 0">-{{ $product->discount }}%</span>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title text-secondary text-capitalize"><a
                                                    href="{{ route('fe.products.show', $product->slug) }}">{{ $product->title }}</a>
                                            </h5>
                                            @if ($product->category)
                                                <div class="text-center text-capitalize mb-3">
                                                    ({{ $product->category->title ?? '-' }})
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="mb-4">
                                                @if ($product->is_discount)
                                                    <div>
                                                        <del>
                                                            <small class="text-muted text-decoration-line-through mb-0">Rp.
                                                                {{ number_format($product->price, 2, ',', '.') }}
                                                            </small>
                                                        </del>
                                                    </div>
                                                    @if ($product->discount_type == 'persen')
                                                        <div>
                                                            <span class="text-primary  mb-0">Rp.
                                                                {{ number_format(($product->price / 100) * $product->discount, 2, ',', '.') }}
                                                            </span>

                                                        </div>
                                                    @else
                                                        <div>
                                                            <span class="text-primary  mb-0">Rp.
                                                                {{ number_format($product->price - $product->discount, 2, ',', '.') }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                @else
                                                    <span class="text-primary  mb-0">Rp.
                                                        {{ number_format($product->price, 2, ',', '.') }}
                                                    </span>
                                                @endif

                                            </div>
                                            <div class="d-flex justify-content-between mb-2"><small>Stock :
                                                    {{ $product->stock }}</small><small>Terjual : 10</small></div>
                                            <button class="btn btn-block btn-sm btn-primary text-capitalize"><i
                                                    class="fa-solid fa-cart-shopping mr-2"></i> add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="glide__arrows" data-glide-el="controls">
                        <button class="glide-arrow btn-sm glide-arrow-left btn btn-outline-dark rounded-pill"
                            data-glide-dir="<"><i class="fa-solid fa-chevron-left text-dark"></i></button>
                        <button class="glide-arrow btn-sm glide-arrow-right btn btn-outline-dark rounded-pill"
                            data-glide-dir=">"><i class="fa-solid fa-chevron-right text-dark"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 bg-white">
        <div class="container py-3">
            <h1 class="text-center text-secondary mb-2">Kurir</h1>
            <div class="d-flex justify-content-center mb-5">
                <div class="col-12 col-lg-6">
                    <small>
                        Kami menyediakan berbagai jenis kurir untuk mempermudah transaksi anda
                    </small>
                </div>
            </div>
            <div class="glide" id="kurir-slider">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <li class="glide__slide">
                            <img src="{{ asset('source/jnt.png') }}" alt="" class="img-fluid">
                        </li>
                        <li class="glide__slide">
                            <img src="{{ asset('source/jne.png') }}" alt="" class="img-fluid">
                        </li>
                        <li class="glide__slide">
                            <img src="{{ asset('source/pos.png') }}" alt="" class="img-fluid">
                        </li>
                        <li class="glide__slide">
                            <img src="{{ asset('source/grab.png') }}" alt="" class="img-fluid">
                        </li>
                        <li class="glide__slide">
                            <img src="{{ asset('source/gojek.png') }}" alt="" class="img-fluid">
                        </li>
                        <li class="glide__slide">
                            <img src="{{ asset('source/anteraja.png') }}" alt="" class="img-fluid">
                        </li>
                        <li class="glide__slide">
                            <img src="{{ asset('source/deliveree.png') }}" alt="" class="img-fluid">
                        </li>
                        <li class="glide__slide">
                            <img src="{{ asset('source/sicepat.png') }}" alt="" class="img-fluid">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 bg-white">
        <div class="container py-3">
            <h1 class="text-center text-secondary mb-2">Payment</h1>
            <div class="d-flex justify-content-center mb-5">
                <div class="col-12 col-lg-6">
                    <small>
                        Kami menyediakan berbagai jenis payment untuk mempermudah transaksi anda
                    </small>
                </div>
            </div>
            <div class="glide" id="payment-slider">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach ($paymentMethodList->paymentFee as $payment)
                            <li class="glide__slide">
                                <img src="{{ $payment->paymentImage }}" alt="" class="img-fluid">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5" style="background: #7158e226">
        <div class="container py-5">
            <h1 class="text-center text-secondary mb-5">Latest Article</h1>
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-6">
                        <div class="bg-white shadow card border-0 mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="rounded"
                                        style="height: 100%; object-fit: cover">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title text-secondary">{{ $post->title }}</h5>
                                        <p class="card-text">{!! Str::limit(strip_tags($post->body), 250) !!}</p>
                                        <p class="card-text"><small
                                                class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        var animation = bodymovin.loadAnimation({
            container: document.getElementById("product-to-cart-animation"),
            renderer: "svg",
            loop: true,
            autoplay: true,
            path: "https://assets4.lottiefiles.com/packages/lf20_IcvJ1B.json"
        });

        var heroAnimation = bodymovin.loadAnimation({
            container: document.getElementById("heroAnimation"),
            renderer: "svg",
            loop: true,
            autoplay: true,
            path: "https://lottie.host/e2fdc9c1-2929-4600-b833-46152ec82513/PthvrPpQMz.json"
        });

        const product = new Glide('#product-slider', {
            breakpoints: {
                600: {
                    perView: 2
                }
            }
        }).mount()

        const kurir = new Glide('#kurir-slider', {
            perView: 6,
            autoplay: 3000,
            breakpoints: {
                600: {
                    perView: 2
                }
            },
            gap: 20
        }).mount()

        const payment = new Glide('#payment-slider', {
            perView: 6,
            autoplay: 3000,
            breakpoints: {
                600: {
                    perView: 2
                },
            }
        }).mount()
    </script>
@endpush

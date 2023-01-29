@extends('layouts.frontend')

@push('styles')
    {{-- <style>
        .whatsapp-name {
            font-size: 16px;
            font-weight: 600;
            padding-bottom: 0;
            margin-bottom: 0;
            line-height: 0.5;
        }
        a:link,
        a:visited {
            color: #444;
            text-decoration: none;
            transition: all 0.4s ease-in-out;
        }
        #whatsapp-chat {
            box-sizing: border-box !important;
            outline: none !important;
            position: fixed;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 1px 15px rgba(32, 33, 36, 0.28);
            bottom: 90px;
            right: 30px;
            overflow: hidden;
            z-index: 99;
            animation-name: showchat;
            animation-duration: 1s;
            transform: scale(1);
        }

            a.blantershow-chat {
            /*   background: #009688; */
            background: #fff;
            color: #404040;
            position: fixed;
            display: flex;
            font-weight: 400;
            justify-content: space-between;
            z-index: 98;
            bottom: 25px;
            right: 30px;
            font-size: 15px;
            padding: 10px 20px;
            border-radius: 30px;
            box-shadow: 0 1px 15px rgba(32, 33, 36, 0.28);
            }

            a.blantershow-chat svg {
            transform: scale(1.2);
            margin: 0 10px 0 0;
            }

            .header-chat {
            /*   background: linear-gradient(to right top, #6f96f3, #164ed2); */
            background: #009688;
            background: #095e54;
            color: #fff;
            padding: 20px;
            }

            .header-chat h3 {
            margin: 0 0 10px;
            }

            .header-chat p {
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
            }

            .info-avatar {
            position: relative;
            }

            .info-avatar img {
            border-radius: 100%;
            width: 50px;
            float: left;
            margin: 0 10px 0 0;
            }

            a.informasi {
            padding: 20px;
            display: block;
            overflow: hidden;
            animation-name: showhide;
            animation-duration: 0.5s;
            }

            a.informasi:hover {
            background: #f1f1f1;
            }

            .info-chat span {
            display: block;
            }

            #get-label,
            span.chat-label {
            font-size: 12px;
            color: #888;
            }

            #get-nama,
            span.chat-nama {
            margin: 5px 0 0;
            font-size: 15px;
            font-weight: 700;
            color: #222;
            }

            #get-label,
            #get-nama {
            color: #fff;
            }

            span.my-number {
                display: none;
            }

            .blanter-msg {
                color: #444;
                font-size: 12.5px;
                text-align: center;
                border-top: 1px solid #ddd;
            }
            textarea#chat-input {
                border: none;
                width: 100%;
                height: 20px;
                outline: none;
                resize: none;
                padding: 10px;
                font-size: 14px;
            }

            a#send-it {
            width: 30px;
            font-weight: 700;
            padding: 10px 10px 0;
            background: #eee;
            border-radius: 10px;
            }
            a#send-it svg {
            fill: #a6a6a6;
            height: 24px;
            width: 24px;
            }

            .first-msg {
            background: transparent;
            padding: 30px;
            text-align: center;
            }
            .first-msg span {
            background: #e2e2e2;
            color: #333;
            font-size: 14.2px;
            line-height: 1.7;
            border-radius: 10px;
            padding: 15px 20px;
            display: inline-block;
            }

            .start-chat .blanter-msg {
            display: flex;
            }

            #get-number {
            display: none;
            }

            a.close-chat {
            position: absolute;
            top: 5px;
            right: 15px;
            color: #fff;
            font-size: 30px;
            }

            @keyframes ZpjSY {
            0% {
                background-color: #b6b5ba;
            }
            15% {
                background-color: #111111;
            }
            25% {
                background-color: #b6b5ba;
            }
            }
            @keyframes hPhMsj {
            15% {
                background-color: #b6b5ba;
            }
            25% {
                background-color: #111111;
            }
            35% {
                background-color: #b6b5ba;
            }
            }
            @keyframes iUMejp {
            25% {
                background-color: #b6b5ba;
            }
            35% {
                background-color: #111111;
            }
            45% {
                background-color: #b6b5ba;
            }
            }
            @keyframes showhide {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            }
            @keyframes showchat {
            from {
                transform: scale(0);
                opacity: 0;
            }
            }
            @media screen and (max-width: 480px) {
            #whatsapp-chat {
                width: auto;
                left: 5%;
                right: 5%;
                font-size: 80%;
            }
            }
            .hide {
            display: none;
            animation-name: showhide;
            animation-duration: 0.5s;
            transform: scale(1);
            opacity: 1;
            }

            .show {
            display: block;
            animation-name: showhide;
            animation-duration: 0.5s;
            transform: scale(1);
            opacity: 1;
            }

            .whatsapp-message-container {
            display: flex;
            z-index: 1;
            }

            .whatsapp-message {
            padding: 7px 14px 6px;
            background-color: white;
            border-radius: 0px 8px 8px;
            position: relative;
            transition: all 0.3s ease 0s;
            opacity: 0;
            transform-origin: center top 0px;
            z-index: 2;
            box-shadow: rgba(0, 0, 0, 0.13) 0px 1px 0.5px;
            margin-top: 4px;
            margin-left: -54px;
            max-width: calc(100% - 66px);
            }

            .whatsapp-chat-body {
            padding: 20px 20px 20px 10px;
            background-color: #e6ddd4;
            position: relative;
            }
            .whatsapp-chat-body::before {
            display: block;
            position: absolute;
            content: "";
            left: 0px;
            top: 0px;
            height: 100%;
            width: 100%;
            z-index: 0;
            opacity: 0.08;
            background-image: url("https://elfsight.com/assets/chats/patterns/whatsapp.png");
            }

            .dAbFpq {
            display: flex;
            z-index: 1;
            }

            .eJJEeC {
            background-color: white;
            width: 52.5px;
            height: 32px;
            border-radius: 16px;
            display: flex;
            -moz-box-pack: center;
            justify-content: center;
            -moz-box-align: center;
            align-items: center;
            margin-left: 10px;
            opacity: 0;
            transition: all 0.1s ease 0s;
            z-index: 1;
            box-shadow: rgba(0, 0, 0, 0.13) 0px 1px 0.5px;
            }

            .hFENyl {
            position: relative;
            display: flex;
            }

            .ixsrax {
            height: 5px;
            width: 5px;
            margin: 0px 2px;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            animation-duration: 1.2s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
            top: 0px;
            background-color: #9e9da2;
            animation-name: ZpjSY;
            }

            .dRvxoz {
            height: 5px;
            width: 5px;
            margin: 0px 2px;
            background-color: #b6b5ba;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            animation-duration: 1.2s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
            top: 0px;
            animation-name: hPhMsj;
            }

            .kAZgZq {
            padding: 7px 14px 6px;
            background-color: white;
            border-radius: 0px 8px 8px;
            position: relative;
            transition: all 0.3s ease 0s;
            opacity: 0;
            transform-origin: center top 0px;
            z-index: 2;
            box-shadow: rgba(0, 0, 0, 0.13) 0px 1px 0.5px;
            margin-top: 4px;
            margin-left: -54px;
            max-width: calc(100% - 66px);
            }
            .kAZgZq::before {
            position: absolute;
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAmCAMAAADp2asXAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAACQUExURUxpccPDw9ra2m9vbwAAAAAAADExMf///wAAABoaGk9PT7q6uqurqwsLCycnJz4+PtDQ0JycnIyMjPf3915eXvz8/E9PT/39/RMTE4CAgAAAAJqamv////////r6+u/v7yUlJeXl5f///5ycnOXl5XNzc/Hx8f///xUVFf///+zs7P///+bm5gAAAM7Ozv///2fVensAAAAvdFJOUwCow1cBCCnqAhNAnY0WIDW2f2/hSeo99g1lBYT87vDXG8/6d8oL4sgM5szrkgl660OiZwAAAHRJREFUKM/ty7cSggAABNFVUQFzwizmjPz/39k4YuFWtm55bw7eHR6ny63+alnswT3/rIDzUSC7CrAziPYCJCsB+gbVkgDtVIDh+DsE9OTBpCtAbSBAZSEQNgWIygJ0RgJMDWYNAdYbAeKtAHODlkHIv997AkLqIVOXVU84AAAAAElFTkSuQmCC");
            background-position: 50% 50%;
            background-repeat: no-repeat;
            background-size: contain;
            content: "";
            top: 0px;
            left: -12px;
            width: 12px;
            height: 19px;
            }

            .bMIBDo {
            font-size: 13px;
            font-weight: 700;
            line-height: 18px;
            color: rgba(0, 0, 0, 0.4);
            }

            .iSpIQi {
            font-size: 14px;
            line-height: 19px;
            margin-top: 4px;
            color: #111111;
            }

            .iSpIQi {
            font-size: 14px;
            line-height: 19px;
            margin-top: 4px;
            color: #111111;
            }

            .cqCDVm {
            text-align: right;
            margin-top: 4px;
            font-size: 12px;
            line-height: 16px;
            color: rgba(17, 17, 17, 0.5);
            margin-right: -8px;
            margin-bottom: -4px;
            }
    </style> --}}
@endpush

@section('content')
    <!-- Hero  -->
    <div class="hero-container">
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
    </div>
    
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-12 col-lg-4">
                <img src="{{ asset('frontend/img/aboutus.jpg') }}" alt="" class="img-fluid shadow"
                    style="aspect-ratio: 4/5; object-fit: cover">
            </div>
            <div class="col-12 col-lg-8">
                <div class="mb-5">
                    <div class="mb-3">
                        <span class="text-primary font-weight-bold">PERMATA MITRA MEDIKA</span> Didirikan
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
                    <div class="col-6">
                        <i class="fa-solid fa-cube text-primary mb-3" style="font-size: 35px; "></i>
                        <h4 class="text-secondary font-weight-bold">Market Leader</h4>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci quasi dolores, perferendis
                            voluptatum alias, quia vitae impedit cum !
                        </p>
                    </div>
                    <div class="col-6">
                        <i class="fa-solid fa-cube text-primary mb-3" style="font-size: 35px; "></i>
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
    
    
    <div class="py-5" style="background: #7158e226">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h3 class="mb-2 text-secondary">Services</h3>
                <h2 class="text-secondary font-weight-bold">
                    Check out the great services we offer
                </h2>
            </div>
            <div class="row mx-lg-n5">
                <div class="col-lg-3 px-lg-4">
                    <div class="bg-white shadow border-botton text-center border-primary px-3 py-4"
                        style="border-radius: 12px;">
                        <i class="fa-solid fa-cube text-primary mb-3" style="font-size: 35px; "></i>
                        <h4 class="mb-3">Lorem Ipsum</h4>
                        <p>
                            Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                            cupiditate
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 px-lg-4">
                    <div class="bg-white shadow border-botton text-center border-primary px-3 py-4"
                        style="border-radius: 12px;">
                        <i class="fa-solid fa-cube text-primary mb-3" style="font-size: 35px; "></i>
                        <h4 class="mb-3">Lorem Ipsum</h4>
                        <p>
                            Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                            cupiditate
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 px-lg-4">
                    <div class="bg-white shadow border-botton text-center border-primary px-3 py-4"
                        style="border-radius: 12px;">
                        <i class="fa-solid fa-cube text-primary mb-3" style="font-size: 35px; "></i>
                        <h4 class="mb-3">Lorem Ipsum</h4>
                        <p>
                            Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                            cupiditate
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 px-lg-4">
                    <div class="bg-white shadow border-botton text-center border-primary px-3 py-4"
                        style="border-radius: 12px;">
                        <i class="fa-solid fa-cube text-primary mb-3" style="font-size: 35px; "></i>
                        <h4 class="mb-3">Lorem Ipsum</h4>
                        <p>
                            Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati
                            cupiditate
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 ">
        <div class="container py-3">
            <h1 class="text-center text-secondary mb-5">Popular Products</h1>
            <div class="row">
                @foreach ($products as $product )
                <div class="col-lg-3">
                    <div class="card mb-3" style="height: 100%">
                        <div class="card-img-top">
                            <img src="{{ $product->assets->first()->src }}" class="card-img-top" alt="..."
                                style="max-height:250px; object-fit: cover;">
                            {{-- <img src="https://source.unsplash.com/random/{{ $product->id }}" class="card-img-top"
                                alt="..." style="max-height:250px; object-fit: cover;"> --}}
                            @if ($product->is_discount && $product->discount_type == 'persen')
                                <span class="badge badge-success">{{ $product->discount }}% Off</span>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title text-secondary text-capitalize">{{ $product->title }}</h5>
                                @if ($product->category)
                                <div class="text-center text-capitalize mb-3">({{ $product->category->title ?? '-' }})
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
                                            <span class="text-primary  mb-0">Rp. {{ number_format (($product->price / 100) *
                                                $product->discount,2,",",".") }}
                                            </span>
                                            
                                        </div>
                                    @else
                                        <div>
                                            <span class="text-primary  mb-0">Rp. {{ number_format ($product->price -
                                                $product->discount,2,",",".") }}
                                            </span>
                                        </div>
                                    @endif
                                    @else
                                        <span class="text-primary  mb-0">Rp. {{ number_format ($product->price,2,",",".") }}
                                        </span>
                                    @endif
                                    
                                </div>
                                <div class="d-flex justify-content-between mb-2"><small>Stock : {{ $product->stock }}</small><small>Terjual : 10</small></div>
                                <button class="btn btn-block btn-sm btn-primary text-capitalize"><i
                                        class="fa-solid fa-cart-shopping mr-2"></i> add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="py-5" style="background: #7158e226">
        <div class="container py-5">
            <h1 class="text-center text-secondary mb-5">Latest Article</h1>
            <div class="row">
                <div class="col-lg-6">
                    <div class="bg-white card border-0 mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="https://source.unsplash.com/random" alt="..." class="rounded"
                                    style="height: 100%; object-fit: cover">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-secondary">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional
                                        content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white card border-0 mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="https://source.unsplash.com/random" alt="..." class="rounded">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-secondary">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional
                                        content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($posts as $post )
                @endforeach
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    {{-- <script>
            /* Whatsapp Chat Widget by www.bloggermix.com */
        $(document).on("click", "#send-it", function() {
            var a = document.getElementById("chat-input");
            if ("" != a.value) {
                var b = $("#get-number").text(),
                c = document.getElementById("chat-input").value,
                d = "https://web.whatsapp.com/send",
                e = b,
                f = "&text=" + c;
                if (
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                    navigator.userAgent
                )
                )
                var d = "whatsapp://send";
                var g = d + "?phone=+31 6 29320129" + e + f;
                window.open(g, "_blank");
            }
            }),
            $(document).on("click", ".informasi", function() {
                (document.getElementById("get-number").innerHTML = $(this)
                .children(".my-number")
                .text()),
                $(".start-chat,.get-new")
                    .addClass("show")
                    .removeClass("hide"),
                $(".home-chat,.head-home")
                    .addClass("hide")
                    .removeClass("show"),
                (document.getElementById("get-nama").innerHTML = $(this)
                    .children(".info-chat")
                    .children(".chat-nama")
                    .text()),
                (document.getElementById("get-label").innerHTML = $(this)
                    .children(".info-chat")
                    .children(".chat-label")
                    .text());
            }),
            $(document).on("click", ".close-chat", function() {
                $("#whatsapp-chat")
                .addClass("hide")
                .removeClass("show");
            }),
            $(document).on("click", ".blantershow-chat", function() {
                $("#whatsapp-chat")
                .addClass("show")
                .removeClass("hide");
        });

    </script> --}}
@endpush
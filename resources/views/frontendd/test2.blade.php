<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('test/scss/main.css') }}">
    <link rel="stylesheet" href="{{ asset('test/scss/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Hello, world!</title>
    <style>

        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            outline: none;
        }

        a,
        a:active,
        a:focus {
            color: #333;
            text-decoration: none;
            transition-timing-function: ease-in-out;
            -ms-transition-timing-function: ease-in-out;
            -moz-transition-timing-function: ease-in-out;
            -webkit-transition-timing-function: ease-in-out;
            -o-transition-timing-function: ease-in-out;
            transition-duration: .2s;
            -ms-transition-duration: .2s;
            -moz-transition-duration: .2s;
            -webkit-transition-duration: .2s;
            -o-transition-duration: .2s;
        }

        .ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        section {
            padding: 60px 0;
            /* min-height: 100vh;*/
        }

        .footer {
            background: #2D2C4C;
            padding-top: 80px;
            padding-bottom: 40px;
        }

        /*END FOOTER SOCIAL DESIGN*/
        .single_footer {}

        @media only screen and (max-width:768px) {
            .single_footer {
                margin-bottom: 30px;
            }
        }

        .single_footer h4 {
            color: #fff;
            margin-top: 0;
            margin-bottom: 25px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 20px;
        }

        .single_footer h4::after {
            content: "";
            display: block;
            height: 2px;
            width: 40px;
            background: #fff;
            margin-top: 20px;
        }

        .single_footer p {
            color: #fff;
        }

        .single_footer ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .single_footer ul li {}

        .single_footer ul li a {
            color: #fff;
            -webkit-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            line-height: 36px;
            font-size: 15px;
            text-transform: capitalize;
        }

        .single_footer ul li a:hover {
            color: #ff3666;
        }

        .single_footer_address {}

        .single_footer_address ul {}

        .single_footer_address ul li {
            color: #fff;
        }

        .single_footer_address ul li span {
            font-weight: 400;
            color: #fff;
            line-height: 28px;
        }

        .contact_social ul {
            list-style: outside none none;
            margin: 0;
            padding: 0;
        }

        /*START NEWSLETTER CSS*/
        .subscribe {
            display: block;
            position: relative;
            margin-top: 15px;
            width: 100%;
        }

        .subscribe__input {
            background-color: #fff;
            border: medium none;
            border-radius: 5px;
            color: #333;
            display: block;
            font-size: 15px;
            font-weight: 500;
            height: 60px;
            letter-spacing: 0.4px;
            margin: 0;
            padding: 0 150px 0 20px;
            text-align: center;
            text-transform: capitalize;
            width: 100%;
        }

        @media only screen and (max-width:768px) {
            .subscribe__input {
                padding: 0 50px 0 20px;
            }
        }

        .subscribe__btn {
            background-color: transparent;
            border-radius: 0 25px 25px 0;
            color: #01c7e9;
            cursor: pointer;
            display: block;
            font-size: 20px;
            height: 60px;
            position: absolute;
            right: 0;
            top: 0;
            width: 60px;
        }

        .subscribe__btn i {
            transition: all 0.3s ease 0s;
        }

        @media only screen and (max-width:768px) {
            .subscribe__btn {
                right: 0px;
            }
        }

        .subscribe__btn:hover i {
            color: #ff3666;
        }

        .button {
            padding: 0;
            border: none;
            background-color: transparent;
            -webkit-border-radius: 0;
            border-radius: 0;
        }

        /*END NEWSLETTER CSS*/

        /*START SOCIAL PROFILE CSS*/
        .social_profile {
            margin-top: 40px;
        }

        .social_profile ul {
            list-style: outside none none;
            margin: 0;
            padding: 0;
        }

        .social_profile ul li {
            float: left;
        }

        .social_profile ul li a {
            text-align: center;
            border: 0px;
            text-transform: uppercase;
            transition: all 0.3s ease 0s;
            margin: 0px 5px;
            font-size: 18px;
            color: #fff;
            border-radius: 30px;
            width: 50px;
            height: 50px;
            line-height: 50px;
            display: block;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @media only screen and (max-width:768px) {
            .social_profile ul li a {
                margin-right: 10px;
                margin-bottom: 10px;
            }
        }

        @media only screen and (max-width:480px) {
            .social_profile ul li a {
                width: 40px;
                height: 40px;
                line-height: 40px;
            }
        }

        .social_profile ul li a:hover {
            background: #ff3666;
            border: 1px solid #ff3666;
            color: #fff;
            border: 0px;
        }

        /*END SOCIAL PROFILE CSS*/
        .copyright {
            margin-top: 70px;
            padding-top: 40px;
            color: #fff;
            font-size: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.4);
            text-align: center;
        }

        .copyright a {
            color: #01c7e9;
            transition: all 0.2s ease 0s;
        }

        .copyright a:hover {
            color: #ff3666;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-3"
        style="position: fixed; width: 100%; z-index: 999">
        <div class="container">
            <a class="navbar-brand" href="#">Permedik</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Product</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item ml-lg-5">
                        <a class=" btn btn-primary rounded-pill px-3 text-white">Register</a>
                    </li>
                    <li class="nav-item ">
                        <a class=" btn btn-outline-primary rounded-pill px-3 ml-lg-2">Sign In</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li> --}}
                </ul>
                {{-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> --}}
            </div>
        </div>
    </nav>


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
                        </div>
                        <div class="card-body d-flex">
                            <div>
                                <h5 class="card-title text-secondary text-capitalize">{{ $product->title }}</h5>
                                @if ($product->category)
                                <div class="text-center text-capitalize mb-3">({{ $product->category->title ?? '-' }})</div>
                                @endif
                            </div>
                            <div>
                                <div class="mb-4">
                                    @if ($product->is_discount)
                                            <div>
                                                <del>
                                                    <small class="text-muted text-decoration-line-through mb-0">Rp. {{ number_format ($product->price,2,",",".") }}
                                                    </small>
                                                </del>
                                            </div>
                                        @if ($product->discount_type == 'persen')
                                            <div>
                                                <span class="text-primary  mb-0">Rp. {{ number_format (($product->price / 100) * $product->discount,2,",",".") }}
                                                </span>
                                            </div>
                                        @else
                                            <div>
                                                <span class="text-primary  mb-0">Rp. {{ number_format ($product->price - $product->discount,2,",",".") }}
                                                </span>
                                            </div>
                                        @endif
                                    @else
                                        <span class="text-primary  mb-0">Rp. {{ number_format  ($product->price,2,",",".") }}
                                        </span>
                                    @endif 
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary text-capitalize"><i
                                    class="fa-solid fa-cart-shopping mr-2"></i> add to cart</button>
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
                    <div class="bg-white card border-0 mb-3" >
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
                <div class="col-lg-6">
                    <div class="bg-white card border-0 mb-3" >
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
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <div class="single_footer">
                        <h4>Services</h4>
                        <ul>
                            <li><a href="#">Lorem Ipsum</a></li>
                            <li><a href="#">Simply dummy text</a></li>
                            <li><a href="#">The printing and typesetting </a></li>
                            <li><a href="#">Standard dummy text</a></li>
                            <li><a href="#">Type specimen book</a></li>
                        </ul>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single_footer single_footer_address">
                        <h4>Page Link</h4>
                        <ul>
                            <li><a href="#">Lorem Ipsum</a></li>
                            <li><a href="#">Simply dummy text</a></li>
                            <li><a href="#">The printing and typesetting </a></li>
                            <li><a href="#">Standard dummy text</a></li>
                            <li><a href="#">Type specimen book</a></li>
                        </ul>
                    </div>
                </div>
                <!--- END COL -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single_footer single_footer_address">
                        <h4>Subscribe today</h4>
                        <div class="signup_form">
                            <form action="#" class="subscribe">
                                <input type="text" class="subscribe__input" placeholder="Enter Email Address">
                                <button type="button" class="button subscribe__btn"><i
                                        class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="social_profile">
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <p class="copyright">Copyright © {{ date('Y') }} <a href="#">Permedik</a>.</p>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->

    <script>
        $(window).scroll(function () {
            if ($(this).scrollTop() > 40) {
                $('.navbar').removeClass('bg-transparent')
                $('.navbar').addClass('bg-white shadow')
            } else {
                $('.navbar').removeClass('bg-white shadow')
                $('.navbar').addClass('bg-transparent')
            }
        });
    </script>
</body>

</html>
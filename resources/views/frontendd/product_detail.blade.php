<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.frontend.head')
    <style>

        body {
            overflow-x: hidden;
            background-color: #000;
            margin: 0 auto;
        }


        body p,
        body h1,
        body h2,
        body h3,
        body h4,
        body h5,
        body h6 {
            margin: 0;
        }

        body a {
            color: #666;
            text-decoration: none;
        }

        body ul,
        body li {
            padding: 0;
            margin: 0;
            list-style-type: none;
        }

        .noScroll {
            overflow: hidden !important;
        }

        .productCard {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            align-content: center;
            width: 100%;
            min-height: 100vh;
            position: relative;
            perspective: 100px;
        }

        .productCard.morph .container .colorLayer {
            width: 70%;
            transform: none;
            transition-delay: 0s;
        }

        .productCard.morph .container .colorLayer:after {
            opacity: 1;
            transition-delay: 0.2s;
        }

        .productCard.morph .container .preview {
            width: 70%;
        }

        .productCard.morph .container .preview .brand {
            top: 50px;
        }

        .productCard.morph .container .preview .zoomControl {
            opacity: 0;
            pointer-events: none;
            transition-delay: 0s;
        }

        .productCard.morph .container .preview .closePreview {
            opacity: 1;
            pointer-events: all;
            transition-delay: 0.3s;
        }

        .productCard .container {
            width: 90%;
            margin: 0 auto;
            padding: 50px;
            background-color: #fff;
            box-sizing: border-box;
        }

        .productCard .container .info {
            width: calc(50% - 50px);
        }

        .productCard .container .info .name {
            color: darkgray;
            font-size: 16px;
            text-transform: uppercase;
        }

        .productCard .container .info .slogan {
            margin: 10px 0;
            font-size: 30px;
        }

        .productCard .container .info .price {
            font-size: 25px;
            font-weight: 900;
        }

        .productCard .container .info .attribs .attrib {
            margin-top: 40px;
        }

        .productCard .container .info .attribs .attrib.size .options .option.activ {
            color: #fff;
            border-color: #7158e2;
            background-color: #7158e2;
        }

        .productCard .container .info .attribs .attrib.color .options .option {
            width: 25px;
            height: 25px;
            position: relative;
            border: 3px solid currentColor;
        }

        .productCard .container .info .attribs .attrib.color .options .option:before {
            content: "";
            position: absolute;
            width: 60%;
            height: 60%;
            border-radius: 2px;
            background-color: currentColor;
            transform: scale(0);
            transition: cubic-bezier(0.68, -0.55, 0.27, 1.55) all 0.3s;
        }

        .productCard .container .info .attribs .attrib.color .options .option.activ:before {
            transform: scale(1);
        }

        .productCard .container .info .attribs .attrib .header {
            margin-bottom: 10px;
            color: darkgray;
            font-weight: 600;
        }

        .productCard .container .info .attribs .attrib .options {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-start;
            align-content: center;
        }

        .productCard .container .info .attribs .attrib .options .option {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            align-content: center;
            width: 35px;
            height: 35px;
            margin: 10px 10px 0 0;
            font-size: 14px;
            font-weight: 600;
            color: darkgray;
            border-radius: 5px;
            border: 1px solid darkgray;
            cursor: pointer;
            user-select: none;
            transition: ease all 0.3s;
        }

        .productCard .container .info .attribs .attrib .options .option:hover {
            box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.2);
        }

        .productCard .container .info .buttons {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-start;
            align-content: center;
            margin-top: 50px;
        }

        .productCard .container .info .buttons .button {
            margin: 20px 20px 0 0;
            min-width: 120px;
            padding: 15px;
            border-radius: 5px;
            color: #fff;
            font-weight: 600;
            text-align: center;
            letter-spacing: 1px;
            text-transform: uppercase;
            background-color: #3a3a31;
            user-select: none;
            cursor: pointer;
            transition: ease all 0.3s;
        }

        .productCard .container .info .buttons .button:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.5);
        }

        .productCard .container .info .buttons .button.colored {
            background-color: #ff5263;
        }

        .productCard .container .colorLayer {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background-color: #7158e2;
            transform: rotateY(-8deg);
            transform-origin: right;
            perspective: 100px;
            transition: ease all 0.3s 0.2s;
        }

        .productCard .container .colorLayer:after {
            content: "";
            position: absolute;
            top: 0;
            right: 100%;
            width: 50%;
            height: 100%;
            opacity: 0;
            background-color: rgba(0, 0, 0, 0.7);
            transition: ease all 0.3s;
        }

        .productCard .container .preview {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            align-content: center;
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            user-select: none;
            overflow: hidden;
            transition: ease all 0.3s;
        }

        .productCard .container .preview .brand {
            position: absolute;
            top: 150px;
            width: 90%;
            height: 200px;
            font-size: 150px;
            text-align: center;
            color: rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
            overflow: hidden;
            transition: ease all 0.3s;
        }

        .productCard .container .preview .imgs {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            align-content: center;
            width: 100%;
            height: 100%;
        }

        .productCard .container .preview .imgs img {
            position: absolute;
            top: 0;
            width: 70%;
            height: 100%;
            object-fit: contain;
            transform: translate(50%, -10%) rotate(-20deg);
            opacity: 0;
            pointer-events: none;
            transition: ease all 0.3s;
        }

        .productCard .container .preview .imgs img.activ {
            opacity: 1;
            transform: none;
        }

        .productCard .container .preview .zoomControl {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            align-content: center;
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #fff;
            background-color: rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: ease all 0.3s 0.5s;
        }

        .productCard .container .preview .zoomControl:before,
        .productCard .container .preview .zoomControl:after {
            content: "";
            position: absolute;
        }

        .productCard .container .preview .zoomControl:before {
            top: 20%;
            left: 20%;
            width: 40%;
            height: 40%;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .productCard .container .preview .zoomControl:after {
            bottom: 20%;
            right: 20%;
            width: 2px;
            height: 30%;
            background-color: #fff;
            transform: rotate(-45deg);
            transform-origin: bottom left;
        }

        .productCard .container .preview .closePreview {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            align-content: center;
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            opacity: 0;
            cursor: pointer;
            pointer-events: none;
            transition: ease all 0.3s;
        }

        .productCard .container .preview .closePreview:before,
        .productCard .container .preview .closePreview:after {
            content: "";
            position: absolute;
            width: 1px;
            height: 100%;
            background-color: #fff;
            transform: rotate(45deg);
        }

        .productCard .container .preview .closePreview:after {
            transform: rotate(-45deg);
        }

        .productCard .container .preview .movControls {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            align-content: center;
            position: absolute;
            bottom: 150px;
        }

        .productCard .container .preview .movControls .movControl {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: flex-end;
            align-content: center;
            width: 40px;
            height: 30px;
            margin: 0 15px;
            position: relative;
            cursor: pointer;
        }

        .productCard .container .preview .movControls .movControl.left {
            transform: rotateY(180deg);
        }

        .productCard .container .preview .movControls .movControl:before {
            content: "";
            position: absolute;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #fff;
        }

        .productCard .container .preview .movControls .movControl:after {
            content: "";
            width: 10px;
            height: 10px;
            border: 2px solid #fff;
            border-left: 0;
            border-bottom: 0;
            transform: rotate(45deg);
        }

        @media only screen and (max-width: 768px) {
            body * {
                cursor: default !important;
            }

            .productCard.morph .container .colorLayer {
                width: 100%;
                height: 80vh;
            }

            .productCard.morph .container .preview {
                width: 100%;
                height: calc(80vh - 100px);
            }

            .productCard.morph .container .preview .brand {
                top: 0;
            }

            .productCard .container {
                width: 100%;
            }

            .productCard .container .info {
                width: 100%;
                margin-bottom: 450px;
                text-align: center;
            }

            .productCard .container .info .attribs .attrib .options {
                justify-content: center;
            }

            .productCard .container .info .attribs .attrib .options .option {
                margin: 10px;
            }

            .productCard .container .info .buttons {
                justify-content: center;
                margin-top: 10px;
            }

            .productCard .container .info .buttons .button {
                margin: 20px;
            }

            .productCard .container .colorLayer {
                top: auto;
                bottom: 0;
                width: 100%;
                height: 300px;
                transform: none;
            }

            .productCard .container .colorLayer:after {
                top: -20vh;
                right: 0;
                width: 100%;
                height: 20vh;
            }

            .productCard .container .preview {
                top: auto;
                bottom: 50px;
                width: 100%;
                height: 400px;
            }

            .productCard .container .preview .brand {
                top: 0;
                left: 0;
                text-align: left;
                -webkit-text-stroke: 3px #7158e2;
            }

            .productCard .container .preview .closePreview {
                top: 0;
            }

            .productCard .container .preview .movControls {
                bottom: 0;
            }
        }

        @media only screen and (max-width: 500px) {
            .productCard .container .info {
                margin-bottom: 300px;
            }

            .productCard .container .info .buttons .button {
                width: 100%;
                margin: 20px 0 0 0;
            }

            .productCard .container .colorLayer {
                height: 200px;
            }

            .productCard .container .preview {
                height: 250px;
            }

            .productCard .container .preview .brand {
                height: 150px;
                font-size: 150px;
            }
        }
    </style>
</head>

<body>
    <section class="productCard">
        <div class="container">
            <div class="info">
                <h3 class="name">{{ $product->category->title ?? '' }}</h3>
                <h1 class="slogan text-capitalize">{{ $product->title }}</h1>
                <p class="price mb-3">Rp. {{ number_format($product->price,2,",",".") }}</p>
                <p>
                  {{ $product->description }}  
                </p>
                <div class="attribs">
                    {{-- <div class="attrib size">
                        <p class="header">Select Size</p>
                        <div class="options">
                            <div class="option">6</div>
                            <div class="option">7</div>
                            <div class="option">8</div>
                            <div class="option">9</div>
                            <div class="option">10</div>
                            <div class="option">11</div>
                        </div>
                    </div> --}}
                    {{-- <div class="attrib color">
                        <p class="header">Select Color</p>
                        <div class="options">
                            <div class="option" style="color: #60aec1;"></div>
                            <div class="option" style="color: #ef525e;"></div>
                            <div class="option" style="color: #000000;"></div>
                        </div>
                    </div> --}}
                </div>
                <div class="buttons">
                    <a href='{{ route('product.index') }}' class="btn btn-warning">Back</a>
                    <button class="btn btn-dark">Add To Cart</button>
                    <button class="btn btn-primary">Buy Now</button>
                </div>
            </div>
            <div class="colorLayer"></div>
            <div class="preview">
                <h1 class="brand">{{ config('app.name') }}</h1>
                <div class="imgs">
                    @foreach ($product->assets as $asset)
                    <img class="{{ $loop->first ? 'activ' : '' }}"
                        src="{{ $asset->src }}"
                        alt="img 1">
                        
                    @endforeach
                    {{-- <img src="https://firebasestorage.googleapis.com/v0/b/fotos-3cba1.appspot.com/o/tenis%2Ffila%2Ft3.png?alt=media&token=b2352ce3-be90-411d-b112-cfc6453760a0"
                        alt="img 2">
                    <img src="https://firebasestorage.googleapis.com/v0/b/fotos-3cba1.appspot.com/o/tenis%2Ffila%2Ft1.png?alt=media&token=9b161cad-8068-418e-a0d3-ee2e0975e6f4"
                        alt="img 3"> --}}
                </div>
                <div class="zoomControl"></div>
                <div class="closePreview"></div>
                <div class="movControls">
                    <div class="movControl left"></div>
                    <div class="movControl right"></div>
                </div>
            </div>
        </div>
    </section>
    @include('partials.frontend.script')
    <script>
        $(function(){
                $('.attrib .option').click(function(){
                    $(this).siblings().removeClass('activ');
                    $(this).addClass('activ');
                })
                $('.zoomControl').click(function(){
                    $(this).parents('.productCard').addClass('morph');
                    $('body').addClass('noScroll');
                })
                $('.closePreview').click(function(){
                    $(this).parents('.productCard').removeClass('morph');
                    $('body').removeClass('noScroll');
                })
                $('.movControl').click(function(){
                    let imgActiv = $(this).parents('.preview').find('.imgs img.activ');
                    if ($(this).hasClass('left')) {
                        imgActiv.index() == 0 ? $('.imgs img').last().addClass('activ') : $('.imgs img.activ').prev().addClass('activ');
                    } else {
                        imgActiv.index() == ($('.imgs img').length - 1) ? $('.imgs img').first().addClass('activ') : $('.imgs img.activ').next().addClass('activ');
                    }
                        imgActiv.removeClass('activ');
                })
                })
    </script>
</body>

</html>
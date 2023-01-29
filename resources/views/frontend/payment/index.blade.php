@extends('layouts.frontend', [
    'disableHero' => 1
])

@section('content')
    <div class="container">
        <div id="payMethod-form" class="form-style-8">
            <div class="main-title"><img class="img-valign" style="width: 60px; height:auto"
                    src="{{ url('/img/nicepay_logo.jpg') }}" alt="Logo">E-Wallet V1 Professional</div>
            <form action="/requestEWallet" method="post">
                @csrf
                <input type="hidden" name="payMethod" value="05">
        
                <div class="group">
                    <div class="row">
                        <div class="column left"><img class="img-valign" style="width: 150px; height:auto"
                                src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone11-select-2019-family?wid=882&amp;hei=1058&amp;fmt=jpeg&amp;qlt=80&amp;op_usm=0.5,0.5&amp;.v=1567022175704"
                                alt="Logo"></div>
                        <div class="column right">
                            <p style="text-align: justify">iPhone 11 succeeds the iPhone XR, and it features a 6.1-inch LCD
                                display that Apple calls a "Liquid Retina HD Display." It features a 1792 x 828 resolution at
                                326ppi, a 1400:1 contrast ratio, 625 nits max brightness, True Tone support for adjusting the
                                white balance to the ambient lighting, and wide color support for true-to-life colors.</p>
                        </div>
                    </div>
                </div>
        
                <div class="group">
                    <input type="text" name="referenceNo" value="{{uniqid('NCPAY-', true)}}" />
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Reference Number</label>
                </div>
        
                <div class="group">
                    <input type="number" min="1" name="amt" value="15000" />
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Price</label>
                </div>
        
                <div class="group">
                    <input type="number" min="1" name="paymentExpDt" value="{{date(" Ymd")}}" />
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Validation Date</label>
                </div>
        
                <div class="group">
                    <input type="number" min="1" name="paymentExpTm" value="235959" />
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Validation Time</label>
                </div>
        
        
                <input class="help-btn" type="button"
                    onclick="window.location='https://docs.nicepay.co.id/api-v1-ID.html#convenience-store'" id="home-btn"
                    value="?" />
                <input type="submit" value="Checkout" />
            </form>
        </div>
    </div>
@endsection
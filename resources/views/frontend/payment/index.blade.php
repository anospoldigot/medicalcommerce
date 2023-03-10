@extends('layouts.frontend', [
    'disableHero' => 1,
    'disableFooter' => 1
])

@push('styles')
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet"> --}}
    
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css"
        href="/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    {{-- <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.min.css"> --}}
    <!-- END: Vendor CSS-->
    
    <!-- BEGIN: Theme CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css"> --}}
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    {{-- <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css"> --}}
    
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-wizard.css">
    {{-- <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-pickadate.css">Zz --}}
    <!-- END: Page CSS-->
    
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
@endpush

@section('content')
<div class="app-content container ecommerce-application py-5">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="row">
            <div class="col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top" style="b">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0 mr-3">Checkout</h2>
                        <div class="breadcrumb-wrapper" >
                        <ol class="breadcrumb" style="background: rgba(0,0,0,0)">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">eCommerce</a>
                                </li>
                                <li class="breadcrumb-item active">Checkout
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="content-body">
            <div class="bs-stepper checkout-tab-steps">
                <!-- Wizard starts -->
                <div class="bs-stepper-header">
                    <div class="step" data-target="#step-cart">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Cart</span>
                                <span class="bs-stepper-subtitle">Your Cart Items</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i data-feather="chevron-right" class="font-medium-2"></i>
                    </div>
                    <div class="step" data-target="#step-address">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <i class="fa-solid fa-house"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Address</span>
                                <span class="bs-stepper-subtitle">Enter Your Address</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i data-feather="chevron-right" class="font-medium-2"></i>
                    </div>
                    <div class="step" data-target="#step-payment">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <i class="fa-solid fa-credit-card"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Payment</span>
                                <span class="bs-stepper-subtitle">Select Payment Method</span>
                            </span>
                        </button>
                    </div>
                </div>
                <!-- Wizard ends -->
                <form action="{{ url('payment') }}" method="post">
                    @csrf
                    <input type="hidden" name="amt" value="{{ $order_subtotal - $discount  + 10000 }}" id="amt" />
                    <input type="hidden" name="discount_amt" value="" id="discount_amt" />
                    <input type="hidden" name="payment_name" id="payment_name">
                    <div class="bs-stepper-content">
                        <!-- Checkout Place order starts -->
                        <div id="step-cart" class="content">
                            <div id="place-order" class="list-view product-checkout">
                                <!-- Checkout Place Order Left starts -->
                                <div class="checkout-items">
                                    @forelse ($carts as $cart)
                                        <div class="card ecommerce-card" data-product="{{ json_encode($cart->product->only(['title', 'stock', 'price', 'discount', 'is_discount', 'discount_type'])) }}">
                                            <div class="item-img">
                                                <a href="app-ecommerce-details.html">
                                                    <img src="{{ $cart->product->assets->first()->src }}" />
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <input type="hidden" name="product[]" value="{{ $cart->product->id }}">
                                                <div class="item-name">
                                                    <h6 class="mb-0">
                                                        <a href="app-ecommerce-details.html" class="text-body text-capitalize">{{$cart->product->title}} </a>
                                                    </h6>
                                                    <span class="badge badge-primary text-capitalize">
                                                        {{$cart->product->category->title}}
                                                    </span>
                                                    <div class="item-rating">
                                                        <ul class="unstyled-list list-inline">
                                                            <li class="ratings-list-item"><i data-feather="star"
                                                                    class="filled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star"
                                                                    class="filled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star"
                                                                    class="unfilled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star"
                                                                    class="unfilled-star"></i></li>
                                                            <li class="ratings-list-item"><i data-feather="star"
                                                                    class="unfilled-star"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                @if ($cart->product->stock > 0)
                                                    <span class="text-success mb-1">In Stock</span>
                                                @else
                                                    <span class="text-success mb-1">Out Stock</span>
                                                @endif
                                                <div class="item-quantity">
                                                    <span class="quantity-title">Qty:</span>
                                                    <div class="input-group quantity-counter-wrapper" >
                                                        <input type="text" class="quantity-counter" name="quantity[]" value="{{ $cart->quantity ?? 1 }}" />
                                                    </div>
                                                </div>
                                                <span class="delivery-date text-muted">Delivery by, Wed Apr 30</span>
                                                <span class="text-success">6% off 3 offers Available</span>
                                            </div>
                                            <div class="item-options text-center">
                                                <div class="item-wrapper">
                                                    <div class="item-cost">
                                                        <h6 class="item-price">
                                                            Rp. {{ number_format ($cart->product->price * $cart->quantity,2,",",".") }}
                                                        </h6>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-light mt-1 remove-wishlist">
                                                    <i class="fa-solid fa-xmark mr-2"></i>
                                                    <span>Remove</span>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-cart move-cart">
                                                    <i class="fa-solid fa-heart"></i>
                                                    <span class="text-truncate">Add to Wishlist</span>
                                                </button>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center">No Items Found</div>
                                    @endforelse
                                </div>
                                <!-- Checkout Place Order Left ends -->
    
                                <!-- Checkout Place Order Right starts -->
                                <div class="checkout-options">
                                    <div class="card">
                                        <div class="card-body">
                                            <label class="section-label mb-1">Options</label>
                                            <div class="coupons input-group input-group-merge">
                                                <input type="text" class="form-control input-coupons" placeholder="Coupons"
                                                    aria-label="Coupons" aria-describedby="input-coupons" name="code_coupon" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary px-3 input-group-text text-primary"
                                                     type="button" id="btn-coupons">Apply</button>
                                                    
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="price-details">
                                                <h6 class="price-title">Price Details</h6>
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title">Subtotal Product</div>
                                                        <div class="detail-amt subtotal-product">Rp. {{ number_format ($order_subtotal,2,",",".") }}</div>
                                                    </li>
                                                    <li class="price-detail">
                                                        <div class="detail-title">Potongan</div>
                                                        <div class="detail-amt text-danger discount">Rp. {{ number_format ($discount,2,",",".") }}</div>
                                                    </li>
                                                    
                                                    <li class="price-detail pengiriman-tax">
                                                        <div class="detail-title">Pengiriman</div>
                                                        <div class="detail-amt discount-amt text-success">Rp. {{ number_format (10000,2,",",".") }}</div>
                                                    </li>
                                                   
                                                </ul>
                                                <hr />
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title">Total</div>
                                                        <div class="detail-amt detail-total font-weight-bolder">Rp. {{ number_format ($order_subtotal - $discount + 10000,2,",",".") }}</div>
                                                    </li>
                                                </ul>
                                                <button type="button"
                                                    class="btn btn-primary btn-block btn-next place-order">Place
                                                    Order</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Checkout Place Order Right ends -->
                                </div>
                            </div>
                            <!-- Checkout Place order Ends -->
                        </div>
                        <!-- Checkout Customer Address Starts -->
                        <div id="step-address" class="content py-5">
                            <div id="checkout-address" class="list-view product-checkout">
                                <div class="card">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Select Address</h4>
                                        <p class="card-text text-muted mt-25">Be sure to check "Deliver to this address"
                                            when you have finished</p>
                                    </div>
                                    <div class="card-body" id="form-address">
                                        @if ($addresses->isNotEmpty())
                                            <div class="row p-4 bg-white rounded">
                                                @include('frontend.cart._address', compact('addresses'))
                                            </div>
                                        @endif
                                        <hr class="my-3">
                                        <div class="row py-5 p-4 bg-white rounded" id="form-add-address">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="provinsi">Provinsi</label>
                                                    <select class="form-control" id="provinsi">
                                                        <option selected disabled>==Pilih==</< /option>
                                        
                                                            @foreach ($provinces as $province)
                                                        <option value="{{ $province->id }}">{{ $province->name }}</< /option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="kota">Kabupaten/Kota</label>
                                                    <select class="form-control" id="kota">
                                                        <option selected disabled>==Pilih==</< /option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="kecamatan">Kecamatan</label>
                                                    <select class="form-control" id="kecamatan">
                                                        <option selected disabled>==Pilih==</< /option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="kelurahan">Desa/Kelurahan</label>
                                                    <select class="form-control" id="kelurahan">
                                                        <option selected disabled>==Pilih==</< /option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="detail">Detail Address</label>
                                                    <textarea class="form-control" id="detail" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="postal_code">Postal Code</label>
                                                    <input type="number" name="postal_code" id="postal_code" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div id="map"></div>
                                            </div>
                                            <div class="col-12">
                                                <button type="button" id="add-address" class="btn btn-primary" disabled>Tambah Alamat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Customer Address Left ends -->
    
                                <!-- Checkout Customer Address Right starts -->
                                <div class="customer-card">
                                    <div class="card text-capitalize">
                                        <div class="card-header">
                                            <h4 class="card-title">{{ auth()->user()->name }}</h4>
                                        </div>
                                        <div class="card-body actions">
                                            @php
                                                $address_selected = $addresses->where('is_priority', 1)->first();
                                            @endphp
                                            <p class="card-text mb-0">{{ strtolower($address_selected->province->name ?? '') }}</p>
                                            <p class="card-text">
                                                {{ strtolower($address_selected->regency->name ?? '') }}, {{ strtolower($address_selected->district->name ?? '') }}, {{ strtolower($address_selected->village->name ?? '') }}
                                            </p>
                                            <p class="card-text">
                                                {{ strtolower($address_selected->detail ?? '') }}
                                            </p>
                                            <p class="card-text">{{ $address_selected->postal_code ?? ''}}</p>
                                            <button type="button"
                                                class="btn btn-primary btn-block btn-next delivery-address mt-2">
                                                Deliver To This Address
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Customer Address Right ends -->
                            </div>
                        </div>
                        <!-- Checkout Customer Address Ends -->
    
                        <!-- Checkout Payment Starts -->
                        <div id="step-payment" class="content">
                            <div id="checkout-payment" class="list-view product-checkout" >
                                <div class="payment-type">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start">
                                            <h4 class="card-title">Payment options</h4>
                                            <p class="card-text text-muted mt-25">Be sure to click on correct payment option
                                            </p>
                                        </div>
                                        {{-- <div class="card-body">
                                            <h6 class="card-holder-name my-75">John Doe</h6>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customColorRadio1" name="paymentOptions"
                                                    class="custom-control-input" checked />
                                                <label class="custom-control-label" for="customColorRadio1">
                                                    US Unlocked Debit Card 12XX XXXX XXXX 0000
                                                </label>
                                            </div>
                                            <div class="customer-cvv mt-1">
                                                <div class="form-inline">
                                                    <label class="mb-50" for="card-holder-cvv">Enter CVV:</label>
                                                    <input type="password"
                                                        class="form-control ml-sm-75 ml-0 mb-50 input-cvv" name="input-cvv"
                                                        id="card-holder-cvv" />
                                                    <button type="button"
                                                        class="btn btn-primary btn-cvv ml-0 ml-sm-1 mb-50">Continue</button>
                                                </div>
                                            </div>
                                            <hr class="my-2" />
                                            <ul class="other-payment-options list-unstyled">
                                                <li class="py-50">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customColorRadio2" name="paymentOptions"
                                                            class="custom-control-input" />
                                                        <label class="custom-control-label" for="customColorRadio2"> Credit
                                                            / Debit / ATM Card </label>
                                                    </div>
                                                </li>
                                                <li class="py-50">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customColorRadio3" name="paymentOptions"
                                                            class="custom-control-input" />
                                                        <label class="custom-control-label" for="customColorRadio3"> Net
                                                            Banking </label>
                                                    </div>
                                                </li>
                                                <li class="py-50">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customColorRadio4" name="paymentOptions"
                                                            class="custom-control-input" />
                                                        <label class="custom-control-label" for="customColorRadio4"> EMI
                                                            (Easy Installment) </label>
                                                    </div>
                                                </li>
                                                <li class="py-50">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customColorRadio5" name="paymentOptions"
                                                            class="custom-control-input" />
                                                        <label class="custom-control-label" for="customColorRadio5"> Cash On
                                                            Delivery </label>
                                                    </div>
                                                </li>
                                            </ul>
                                            <hr class="my-2" />
                                            <div class="gift-card mb-25">
                                                <p class="card-text">
                                                    <i data-feather="plus-circle" class="mr-50 font-medium-5"></i>
                                                    <span class="align-middle">Add Gift Card</span>
                                                </p>
                                            </div>
                                        </div> --}}
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($paymentMethodList->paymentFee as $payment)
                                                <div class="col-6 mb-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input payment-option" 
                                                        type="radio" 
                                                        name="paymentMethod" 
                                                        id="paymentMethod{{$payment->paymentMethod}}"
                                                        value="{{$payment->paymentMethod}}"
                                                        required 
                                                        data-payment_name="{{$payment->paymentName}}"
                                                        />
                                                            <label class="form-check-label" for="paymentMethod{{$payment->paymentMethod}}">
                                                                <img src="{{ $payment->paymentImage }}" width="75" alt="" />
                                                                <span>{{$payment->paymentName}}</span>
                                                            </label>
                                                    </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="amount-payable checkout-options">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Price Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled price-details">
                                                <li class="price-detail">
                                                    <div class="detail-title">Subtotal Product</div>
                                                    <div class="detail-amt subtotal-product">Rp. {{ number_format ($order_subtotal,2,",",".") }}</div>
                                                </li>
                                                <li class="price-detail">
                                                    <div class="detail-title">Potongan</div>
                                                    <div class="detail-amt text-danger discount">Rp. {{ number_format ($discount,2,",",".") }}</div>
                                                </li>
                                                
                                                <li class="price-detail pengiriman-tax">
                                                    <div class="detail-title">Pengiriman</div>
                                                    <div class="detail-amt discount-amt text-success">Rp. {{ number_format (10000,2,",",".") }}</div>
                                                </li>
                                            </ul>
                                            <hr />
                                            <ul class="list-unstyled price-details">
                                                <li class="price-detail">
                                                    <div class="details-title">Total</div>
                                                    <div class="detail-amt detail-total font-weight-bolder" >
                                                        Rp. {{ number_format (($order_subtotal - $discount + 10000),2,",",".") }}
                                                    </div>
                                                </li>
                                            </ul>
                                            <button type="submit" class="btn btn-primary btn-block place-order">Place
                                                Order</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Checkout Payment Ends -->
                        <!-- </div> -->
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
@endsection


@push('scripts')

    {{-- <script>
        CounterMin = 1,
        CounterMax = 10,
    </script> --}}


    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <script src="/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="/app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <script src="/app-assets/js/scripts/pages/app-ecommerce-checkout.js"></script>
    @if ($addresses->isEmpty())
        <script> $('.customer-card').hide() </script>
    @endif
    <script>
        const options_temp = '<option value="" selected disabled>==Pilih==<option>';
        let ongkir = 10000;

        $('.item-price, .price-details').on('change', function(){
            let price = 0;
            let discount_amt = 0;
            let potongan_voucher = $('.discount-voucher').data('raw_price') ?? 0;
            console.log('potongan_voucher:' + potongan_voucher)
            $('.ecommerce-card').each(function(){
                const product = $(this).data('product');
                let discount = product.price;
                if(product.is_discount > 0){
                    if(product.discount_type =='persen'){
                        discount = (product.price / 100) * product.discount;
                    } else if (product.discount_type == 'nominal'){
                        discount = product.price - product.discount;
                    }
                    discount_amt += (product.price - discount) * $(this).find('.quantity-counter').val();;
                }
                price+= product.price  * $(this).find('.quantity-counter').val();
            }) 

            console.log(discount_amt)
            $('.subtotal-product').html(formatRupiah(price + ongkir, 'Rp. ', ',00'))
            $('.discount').html(formatRupiah(discount_amt, 'Rp. ', ',00'))
            $('.detail-total').html(formatRupiah((price - (discount_amt + potongan_voucher)) + ongkir, 'Rp. ', ',00'))
            $('#amt').val(price - (discount_amt + potongan_voucher) + ongkir);
            $('#discount_amt').val(potongan_voucher);
        })

            var map = L.map('map').setView([-6.405975, 106.994896], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);


            var theMarker = {};

            map.on('click', function(e){
                lat = e.latlng.lat;
                lon = e.latlng.lng;
                localStorage.setItem('latitude', lat)
                localStorage.setItem('longitude', lon)
                $('#add-address').prop('disabled', false);

                console.log("You clicked the map at LAT: "+ lat+" and LONG: "+lon );

                    //Clear existing marker, 
                    if (theMarker != undefined) {
                        map.removeLayer(theMarker);
                    };

                //Add a marker to show where you clicked.
                theMarker = L.marker([lat,lon]).addTo(map);  
            });

        $('#add-address').click(function(){

            const data = {
                province_id : $('#provinsi').val(),
                regency_id  : $('#kota').val(),
                district_id : $('#kecamatan').val(),
                village_id  : $('#kelurahan').val(),
                detail      : $('#detail').val(),
                postal_code : $('#postal_code').val(),
                latitude    : localStorage.getItem('latitude'),
                longitude   : localStorage.getItem('longitude'),
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("fe.addresses.store") }}',
                method: 'POST',
                data,
                success: function(res){
                    $('#form-address').html(res);
                    setTimeout(() => {
                        updateCardAddress('#form-address')
                    }, 500);
                    $('.customer-card').show()
                },
                error: function(err){
                    console.log(err)
                }
            })
        })

        $('#provinsi').change(function() {
            $('#kota, #kecamatan, #kelurahan').html(options_temp);
            if ($(this).val() != "") {
                getKabupatenKota($(this).val());
            }
        })

        $('#kota').change(function() {
            $('#kecamatan, #kelurahan').html(options_temp);
            if ($(this).val() != "") {
                getKecamatan($(this).val());
            }

        })

        $('#kecamatan').change(function() {
            $('#kelurahan').html(options_temp);
            if ($(this).val() != "") {
                getKelurahan($(this).val());
            }
        })

        $('#kelurahan').change(function() {
            if ($(this).val() != "") {
                $('#zip_code').val($(this).find(':selected').data('pos'))
            } else {
                $('#zip_code').val('')
            }
        });

        function getKabupatenKota(provinsiId) {
            let url = '{{ route('api.regencies', ':id') }}';
            url = url.replace(':id', provinsiId)
            $.ajax({
                url,
                method: 'GET',
                beforeSend: function() {
                    $('#kota').prop('disabled', true);
                },
                success: function(res) {
                    const options = res.map(value => {
                        return `<option value="${value.id}">${value.name}</option>`
                    });
                    $('#kota').html(options_temp + options)
                    $('#kota').prop('disabled', false);
                },
                error: function(err) {
                    $('#kota').prop('disabled', false);
                    alert(JSON.stringify(err))
                }

            })
        }

        function getKecamatan(kotaId) {
            let url = '{{ route('api.districts', ':id') }}';
            url = url.replace(':id', kotaId)
            $.ajax({
                url,
                method: 'GET',
                beforeSend: function() {
                    $('#kecamatan').prop('disabled', true);
                },
                success: function(res) {
                    const options = res.map(value => {
                        return `<option value="${value.id}">${value.name}</option>`
                    });
                    $('#kecamatan').html(options_temp + options);
                    $('#kecamatan').prop('disabled', false);
                },
                error: function(err) {
                    alert(JSON.stringify(err))
                    $('#kecamatan').prop('disabled', false);
                }
            })
        }

        function getKelurahan(kotaId) {
            let url = '{{ route('api.villages', ':id') }}';
            url = url.replace(':id', kotaId)
            $.ajax({
                url,
                method: 'GET',
                beforeSend: function() {
                    $('#kelurahan').prop('disabled', true);
                },
                success: function(res) {
                    const options = res.map(value => {
                        return `<option value="${value.id}" >${value.name}</option>`
                    });
                    $('#kelurahan').html(options_temp + options);
                    $('#kelurahan').prop('disabled', false);
                },
                error: function(err) {
                    alert(JSON.stringify(err))
                    $('#kelurahan').prop('disabled', false);
                }
            })
        }

        $(document).on('change', '#form-address', function(){
            updateCardAddress(this)
        })

        function updateCardAddress(formAddressSelector){
            $(formAddressSelector).find('input').each(function(){
                if($(this).is(':checked')){
                    const address = $(this).data('address');
                    $('.customer-card').find('p').eq(0).html(address.province.name.toLowerCase())
                    $('.customer-card').find('p').eq(1).html(`
                            ${address.regency.name.toLowerCase()}, 
                            ${address.district.name.toLowerCase()}, 
                            ${address.village.name.toLowerCase()}`
                    )
                    $('.customer-card').find('p').eq(2).html(address.detail)
                    $('.customer-card').find('p').eq(3).html(address.postal_code)
                }
            })
        }


        $(document).on('change', '.payment-option', function(){
            $('#payment_name').val($(this).data('payment_name'))
        })

        $('#btn-coupons').click(function(){

            $.ajax({
                url: '{{ route("fe.coupons.check") }}',
                data: { _token: '{{ csrf_token() }}', code: $('.input-coupons').val() },
                method: 'POST',
                success: function(res){
                    if(res.success){
                        
                        let price = 0;
                        let discount_amt = 0;
                        $('.ecommerce-card').each(function(){
                            const product = $(this).data('product');
                            let discount = product.price;
                            if(product.is_discount > 0){
                                if(product.discount_type =='persen'){
                                    discount = (product.price / 100) * product.discount;
                                } else if (product.discount_type == 'nominal'){
                                    discount = product.price - product.discount;
                                }
                                discount_amt += (product.price - discount) * $(this).find('.quantity-counter').val();;
                            }
                            price+= product.price  * $(this).find('.quantity-counter').val();
                        }) 

                        const total = price - discount_amt;
                        let discount = 0;
                        if(res.data.discount_type =='persen'){
                            discount = (total / 100) * res.data.discount;
                        } else if (res.data.discount_type == 'nominal'){
                            discount = res.data.discount;
                        }

                        const html = `
                            <li class="price-detail">
                                <div class="detail-title">Potongan Voucher</div>
                                <div class="detail-amt text-danger discount-voucher
                                " data-raw_price="${discount}">${formatRupiah(discount, 'Rp. ', '.00')}</div>
                            </li>
                        `;

                        $('.price-details').each(function(){
                            $(this).find('.price-detail').eq(1).after(html)
                        })
                        $('.price-details').trigger('change')

                        $('.input-coupons').prop('readonly', true)
                        $('#btn-coupons').prop('disabled', true)
                        PNotify.success({
                            title: 'Success!',
                            text: 'Berhasil memasang voucher!'
                        });
                        
                    }
                },
                error:function(err){

                }
                
            })

        })


    </script>
@endpush
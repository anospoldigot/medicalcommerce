@extends('layouts.frontend', [
'disableHero' => 1,
'disableFooter' => 1
])

@push('styles')
<link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
{{--
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
    rel="stylesheet"> --}}

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
{{--
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.min.css"> --}}
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
{{--
<link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css"> --}}
<link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
{{--
<link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css"> --}}

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-ecommerce.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-wizard.css">
{{--
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-pickadate.css">Zz --}}
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
                        <div class="breadcrumb-wrapper">
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
            <div class="bs-stepper checkout-tab-steps" id="stepper">
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
                    <input type="hidden" name="amt" value="{{ $order_subtotal - $discount }}" id="amt" />
                    <input type="hidden" name="discount_amt" value="0" id="discount_amt" />
                    <input type="hidden" name="voucher_amt" value="0" id="voucher_amt" />
                    <input type="hidden" name="fee_amt" value="0" id="fee_amt" />
                    <input type="hidden" name="shipping_amt" value="0" id="shipping_amt" />
                    <input type="hidden" name="ppn_amt" value="0" id="ppn_amt" />
                    <input type="hidden" name="shipping_type" value="" id="shipping_type" />
                    <input type="hidden" name="payment_name" id="payment_name">
                    <div class="bs-stepper-content">
                        <!-- Checkout Place order starts -->
                        <div id="step-cart" class="content">
                            <div id="place-order" class="list-view product-checkout">
                                <!-- Checkout Place Order Left starts -->
                                <div class="checkout-items">
                                    @forelse ($carts as $cart)
                                    <div class="card ecommerce-card"
                                        data-product="{{ json_encode($cart->product->only(['title', 'stock', 'price', 'discount', 'is_discount', 'discount_type', 'weight'])) }}">
                                        <div class="item-img" style="object-fit: cover">
                                            <a href="app-ecommerce-details.html">
                                                <img src="{{ $cart->product->assets->first()->src }}" style="object-fit: cover; height: 100%; width: 100%;" />
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="product[]" value="{{ $cart->product->id }}">
                                            <div class="item-name">
                                                <h6 class="mb-0">
                                                    <a href="app-ecommerce-details.html"
                                                        class="text-body text-capitalize">{{$cart->product->title}} </a>
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
                                                <div class="input-group quantity-counter-wrapper">
                                                    <input type="text" class="quantity-counter" name="quantity[]"
                                                        value="{{ $cart->quantity ?? 1 }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-cost">
                                                    <h6 class="item-price">
                                                        Rp. {{ number_format ($cart->product->price *
                                                        $cart->quantity,2,",",".") }}
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
                                            <div class="coupons input-group input-group-merge mb-2">
                                                <input type="text" class="form-control input-coupons"
                                                    placeholder="Coupons" aria-label="Coupons"
                                                    aria-describedby="input-coupons" name="code_coupon" />
                                                <div class="input-group-append">
                                                    <button
                                                        class="btn btn-outline-primary px-3 input-group-text text-primary"
                                                        type="button" id="btn-coupons">Apply</button>
                                                </div>
                                            </div>
                                            @if ($config->referral_type == 'user')
                                                <div class="coupons input-group input-group-merge">
                                                    <input type="text" class="form-control input-coupons"
                                                        placeholder="Referral" aria-label="Referral"
                                                        aria-describedby="input-Referral" name="referral_token" id="referral_token" />
                                                    <div class="input-group-append">
                                                        {{-- <button
                                                            class="btn btn-outline-primary px-3 input-group-text text-primary"
                                                            type="button" id="btn-coupons">Apply</button> --}}

                                                    </div>
                                                </div>
                                            @endif
                                            <hr />
                                            <div class="price-details">
                                                <h6 class="price-title">Price Details</h6>
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title">Subtotal Product</div>
                                                        <div class="detail-amt subtotal-product">Rp. {{ number_format
                                                            ($order_subtotal,2,",",".") }}</div>
                                                    </li>

                                                    @if ($discount > 0)
                                                        <li class="price-detail">
                                                            <div class="detail-title">Potongan</div>
                                                            <div class="detail-amt text-danger discount">Rp. {{
                                                                number_format ($discount,2,",",".") }}</div>
                                                        </li>
                                                    @endif
                                                    @if (!empty($ppn))
                                                        <li class="price-detail">
                                                            <div class="detail-title">PPN ({{ $ppn }}%)</div>
                                                            <div class="detail-amt text-success ppn-amount">Rp. {{
                                                                number_format ($ppn_amount,2,",",".") }}</div>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <hr />
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title">Total</div>
                                                        <div class="detail-amt detail-total font-weight-bolder">Rp. {{
                                                            number_format ($order_subtotal - $discount,2,",",".") }}</div>
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
                                        <div class="form-group">
                                            <label for="courier">Kurir</label>
                                            <select class="form-control" id="courier" name="courier">
                                                <option value="" selected disabled>==Pilih==</< /option>
                                                    @foreach ($couriers as $courier_name => $courier)
                                                <option value="{{ $courier->first()->courier_code }}" data-courier="{{ json_encode($courier->first()) }}">{{ $courier_name
                                                    }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="courier_service">Service</label>
                                            <select class="form-control" id="courier_service" name="courier_service" disabled>
                                                <option value="" selected disabled>==Pilih==</option>
                                            </select>
                                        </div>
                                        <hr class="my-3">
                                        <div class="row py-5 p-4 bg-white rounded" id="form-add-address">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="provinsi">Provinsi</label>
                                                    <select class="form-control" id="provinsi">
                                                        <option selected disabled>==Pilih==</< /option>

                                                            @foreach ($provinces as $province)
                                                        <option value="{{ $province->id }}">{{ $province->name }}</<
                                                                /option>
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
                                                    <input type="number" name="postal_code" id="postal_code"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div id="map"></div>
                                            </div>
                                            <div class="col-12">
                                                <button type="button" id="add-address" class="btn btn-primary"
                                                    disabled>Tambah Alamat</button>
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
                                            <p class="card-text mb-0">{{ strtolower($address_selected->province->name ??
                                                '') }}</p>
                                            <p class="card-text">
                                                {{ strtolower($address_selected->regency->name ?? '') }}, {{
                                                strtolower($address_selected->district->name ?? '') }}, {{
                                                strtolower($address_selected->village->name ?? '') }}
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
                            <div id="checkout-payment" class="list-view product-checkout">
                                @include('frontend.payment.index', compact('paymentMethodList'))
                                <div class="amount-payable checkout-options">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Price Details</h4>
                                        </div>
                                        <div class="card-body price-details">
                                            <ul class="list-unstyled">
                                                <li class="price-detail">
                                                    <div class="detail-title">Subtotal Product</div>
                                                    <div class="detail-amt subtotal-product">Rp. {{ number_format
                                                        ($order_subtotal,2,",",".") }}</div>
                                                </li>
                                                @if ($discount > 0)
                                                    <li class="price-detail">
                                                        <div class="detail-title">Potongan</div>
                                                        <div class="detail-amt text-danger discount">Rp. {{
                                                            number_format ($discount,2,",",".") }}</div>
                                                    </li>
                                                @endif
                                                @if (!empty($ppn))
                                                    <li class="price-detail">
                                                        <div class="detail-title">PPN ({{ $ppn }}%)</div>
                                                        <div class="detail-amt text-success ppn-amount">Rp. {{
                                                            number_format ($ppn_amount,2,",",".") }}</div>
                                                    </li>
                                                @endif
                                            </ul>
                                            <hr />
                                            <ul class="list-unstyled">
                                                <li class="price-detail">
                                                    <div class="details-title">Total</div>
                                                    <div class="detail-amt detail-total font-weight-bolder">
                                                        Rp. {{ number_format (($order_subtotal - $discount),2,",",".") }}
                                                    </div>
                                                </li>
                                            </ul>
                                            <button type="submit" class="btn btn-primary btn-block place-order">Place
                                                Order</button>
                                        </div>
                                    </div>
                                </div>
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

<script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
<script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<script src="/app-assets/js/scripts/pages/app-ecommerce-checkout.js"></script>
@if ($addresses->isEmpty())
<script>
    $('.customer-card').hide() 
</script>
@endif


@if (session()->has('ref') && $config->referral_type == 'user')
    <script>
        Swal.fire({
            title: 'Ada kode referral tercantum!',
            text: "Apakah anda ingin memakai kde referral tersebut?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Pakai',
            cancelButtonText: 'Tidak'
        }).then((result) => {
                if (result.isConfirmed) {
                    $('#referral_token').val('{{ $ref }}');
                }
        })
    </script>
@endif

<script>
    const options_temp = '<option value="" selected disabled>==Pilih==</option>';
        let ongkir = 0;
        let fee = 0;
        let ppn = '{{ $ppn }}';
        let ppn_amount = '{{ $ppn_amount }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.getElementById('stepper').addEventListener('show.bs-stepper', function (event) {
            
            if(event.detail.indexStep == 0){
                // Cart Page
            }else if(event.detail.indexStep == 1){
                // Shipper Page
                
            }else if(event.detail.indexStep == 2){
                const amount = $('#amt').val();

                $.ajax({
                    url: '{{ route("fe.payment.index") }}',
                    method: 'GET',
                    beforeSend: function(){
                        $('.payment-type').replaceWith(`<div class="payment-type">
                            <div class="card">
                                <div class="card-header flex-column align-items-start">
                                    <h4 class="card-title">Payment options</h4>
                                    <p class="card-text text-muted mt-25">Be sure to click on correct payment
                                        option
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">Loading...</div>
                                </div>
                            </div>
                        </div>`);
                    },
                    data: {
                        amount
                    }, 
                    success: function (res){
                        if(res.success){
                            $('.payment-type').replaceWith(res.html);
                        }else{
                            PNotify.error({
                                title: 'Error!',
                                text: res.message
                            });
                        }
                    },
                    error: function(err){
                        PNotify.error({
                            title: 'Error!',
                            text: err.responseJSON.message
                        });
                    }
                })
                
            }
        })



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
                        discount = product.price - ((product.price / 100) * product.discount);
                    } else if (product.discount_type == 'nominal'){
                        discount = product.price - product.discount;
                    }
                    discount_amt += (product.price - discount) * $(this).find('.quantity-counter').val();;
                }
                price+= product.price  * $(this).find('.quantity-counter').val();
            }) 

            if(ppn){
                ppn_amount = ((price - discount_amt) / 100) * ppn;
            }

            $('.subtotal-product').html(formatRupiah(price, 'Rp. ', ',00'))
            $('.discount').html(formatRupiah(discount_amt, 'Rp. ', ',00'))
            $('.ppn-amount').html(formatRupiah(ppn_amount, 'Rp. ', ',00'))
            $('#ppn_amt').val(ppn_amount);
            $('#shipping_amt').val(ongkir);
            $('#fee_amt').val(fee);
            $('#discount_amt').val(potongan_voucher);
            $('#amt').val(price - (discount_amt + potongan_voucher) + ongkir + ppn_amount + fee);
            $('.detail-total').html(formatRupiah((price - (discount_amt + potongan_voucher)) + ongkir + ppn_amount + fee, 'Rp. ', ',00'))
            
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
                    if(res.success){
                        PNotify.success({
                            title: 'Success!',
                            text: res.message
                        });
                        $('#form-address').html(res.html);
                        setTimeout(() => {
                            updateCardAddress('#form-address')
                        }, 500);
                        $('.customer-card').show()
                    }else{
                        PNotify.error({
                            title: 'Error!',
                            text: res.message
                        });
                    }

                },
                error: function(err){
                    PNotify.error({
                        title: 'Error!',
                        text: err.responseJSON.message
                    });
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
                                    discount = product.price - ((product.price / 100) * product.discount);
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

                        $('#voucher_amt').val(discount)
                        $('.price-details').each(function(){
                            $(this).find('ul').first().find('.price-detail').last().after(html)
                        })
                        $('.price-details').trigger('change')

                        $('.input-coupons').prop('readonly', true)
                        $('#btn-coupons').prop('disabled', true)
                        
                        PNotify.success({
                            title: 'Success!',
                            text: res.message
                        });
                    }else{
                        PNotify.error({
                            title: 'Failed!',
                            text: res.message
                        });
                    }
                },
                error:function(err){
                    PNotify.error({
                        title: 'Error!',
                        text: err.responseJSON.message
                    });
                }
                
            })

        })


        $('#courier').change(function(){
            cekOngkir();
        })

        function cekOngkir (){
            const data = {
                address_id: $('input[name="address_id"]:checked').val(),
                courier: $('#courier').val(),
                items: []
            }

            $('.ecommerce-card').each(function(){
                const product = $(this).data('product');
                let discount = product.price;
                if(product.is_discount > 0){
                    if(product.discount_type =='persen'){
                        discount = product.price - ((product.price / 100) * product.discount);
                    } else if (product.discount_type == 'nominal'){
                        discount = product.price - product.discount;
                    }
                    discount_amt += (product.price - discount) * $(this).find('.quantity-counter').val();;
                }

                data.items.push({
                    name        : product.title,
                    value       : product.price,
                    quantity    : $(this).find('.quantity-counter').val(),
                    weight      : product.weight
                })
            }) 


            $.ajax({
                url: '{{ route("fe.shipping.check") }}',
                method: 'POST',
                data,
                success: function(res){
                    if(res.success){
                        const html = res.pricing.map(value => {
                            return `<option value="${value.courier_service_code}" data-detail='${JSON.stringify(value)}' data-amt="${value.price}">${value.courier_service_name} - Rp. ${value.price}</option>`
                        });
                        $('#courier_service').prop('disabled', false)
                        $('#courier_service').html(options_temp+html)
                    }else{
                        Swal.fire({
                            icon: 'info',
                            text: res.error,
                        })
                    }
                },
                error: function (err){
                    console.log(err)
                }
            })
        }


        $('#courier_service').change(function(){
            ongkir = $(this).find(':selected').data('amt');
            const detail = $(this).find(':selected').data('detail')
            $('#shipping_type').val(detail.type);
            $('.pengiriman-tax').find('.detail-amt').html(formatRupiah(ongkir, 'Rp. ', ',00'))
            if($('.pengiriman-tax').length){
                $('.pengiriman-tax').find('.detail-amt').html(formatRupiah(ongkir, 'Rp. ', ',00'))
            }else{
            
            $('.price-details').each(function(){
                $(this).find('ul').first().find('.price-detail').last().after(`<li class="price-detail pengiriman-tax">
                    <div class="detail-title">Biaya Pengiriman</div>
                    <div class="detail-amt text-success">${formatRupiah(ongkir, 'Rp. ', ',00')}
                </li>`)
                })
            }


            $('.price-details').trigger('change')
        })


        $(document).on('change', '.payment-option', function(){
            fee = $(this).data('fee');
            $('#payment_name').val($(this).data('payment_name'))
            if($('.admin-tax').length){
                $('.admin-tax').find('.detail-amt').html(formatRupiah(fee, 'Rp. ', ',00'))
            }else{
                $('.price-details').each(function(){
                    $(this).find('ul').first().find('.price-detail').last().after(`<li class="price-detail admin-tax">
                        <div class="detail-title">Biaya Admin</div>
                        <div class="detail-amt text-success">${formatRupiah(fee, 'Rp. ', ',00')}
                    </li>`)
                })
            }

            $('.price-details').trigger('change')
            
        })

        $('.address_id').change(function(){
            resetOngkir(); 
        })

        function resetOngkir ()
        {
            $('.pengiriman-tax').remove();   
            $('#shipping_amt').val(0);
            $('#courier').val('');
            $('#courier_service').val('');
        }

        function refetchOngkir ()
        {

            const data = {
                address_id: $('input[name="address_id"]:checked').val(),
                courier: $('#courier').val(),
                items: []
            }

            $('.ecommerce-card').each(function(){
                const product = $(this).data('product');
                let discount = product.price;
                if(product.is_discount > 0){
                    if(product.discount_type =='persen'){
                        discount = product.price - ((product.price / 100) * product.discount);
                    } else if (product.discount_type == 'nominal'){
                        discount = product.price - product.discount;
                    }
                    discount_amt += (product.price - discount) * $(this).find('.quantity-counter').val();
                }

                data.items.push({
                    name        : product.title,
                    value       : product.price,
                    quantity    : $(this).find('.quantity-counter').val(),
                    weight      : product.weight
                });
            }) 


            $.ajax({
                url: '{{ route("fe.shipping.check") }}'
            })
        }

</script>
@endpush
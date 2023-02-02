@extends('layouts.frontend', [
    'disableHero' => 1
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
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Checkout</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
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
                    <input type="hidden" name="amt" value="{{ $order_subtotal + 10000 }}" id="amt" />
                    <div class="bs-stepper-content">
                        <!-- Checkout Place order starts -->
                        <div id="step-cart" class="content">
                            <div id="place-order" class="list-view product-checkout">
                                <!-- Checkout Place Order Left starts -->
                                <div class="checkout-items">
                                    @forelse ($carts as $cart)
                                        <div class="card ecommerce-card" data-product="{{ json_encode($cart->product->only(['title', 'stock', 'price'])) }}">
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
                                                        <h4 class="item-price">
                                                            Rp. {{ number_format ($cart->product->price * $cart->quantity,2,",",".") }}
                                                        </h4>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-light mt-1 remove-wishlist">
                                                    <i class="fa-solid fa-xmark"></i>
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
                                                <input type="text" class="form-control" placeholder="Coupons"
                                                    aria-label="Coupons" aria-describedby="input-coupons" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text text-primary"
                                                        id="input-coupons">Apply</span>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="price-details">
                                                <h6 class="price-title">Price Details</h6>
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title">Subtotal Product</div>
                                                        <div class="detail-amt">Rp. {{ number_format ($order_subtotal,2,",",".") }}</div>
                                                    {{-- </li>
                                                    <li class="price-detail">
                                                        <div class="detail-title">Bag Discount</div>
                                                        <div class="detail-amt discount-amt text-success">-25$</div>
                                                    </li>
                                                    <li class="price-detail">
                                                        <div class="detail-title">Estimated Tax</div>
                                                        <div class="detail-amt">$1.3</div>
                                                    </li>
                                                    <li class="price-detail">
                                                        <div class="detail-title">EMI Eligibility</div>
                                                        <a href="javascript:void(0)"
                                                            class="detail-amt text-primary">Details</a>
                                                    </li> --}}
                                                    <li class="price-detail pengiriman-tax">
                                                        <div class="detail-title">Pengiriman</div>
                                                        <div class="detail-amt discount-amt text-success">-</div>
                                                    </li>
                                                    {{-- <li class="price-detail">
                                                        <div class="detail-title">Pengiriman</div>
                                                        <div class="detail-amt discount-amt text-success">Free</div>
                                                    </li> --}}
                                                </ul>
                                                <hr />
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title detail-total">Total</div>
                                                        <div class="detail-amt font-weight-bolder">$574</div>
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
                                        <h4 class="card-title">Add New Address</h4>
                                        <p class="card-text text-muted mt-25">Be sure to check "Deliver to this address"
                                            when you have finished</p>
                                    </div>
                                    <div class="card-body">
                                        @if ($addresses->isNotEmpty())
                                            <div class="row p-4 bg-white rounded">
                                                @include('frontend.cart._address', compact('addresses'))
                                            </div>
                                        @endif
                                        <hr class="my-3">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-name">Full Name:</label>
                                                    <input type="text" id="checkout-name" class="form-control" name="fname"
                                                        placeholder="John Doe" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-number">Mobile Number:</label>
                                                    <input type="number" id="checkout-number" class="form-control"
                                                        name="mnumber" placeholder="0123456789" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-apt-number">Flat, House No:</label>
                                                    <input type="number" id="checkout-apt-number" class="form-control"
                                                        name="apt-number" placeholder="9447 Glen Eagles Drive" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-landmark">Landmark e.g. near apollo
                                                        hospital:</label>
                                                    <input type="text" id="checkout-landmark" class="form-control"
                                                        name="landmark" placeholder="Near Apollo Hospital" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-city">Town/City:</label>
                                                    <input type="text" id="checkout-city" class="form-control" name="city"
                                                        placeholder="Tokyo" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-pincode">Pincode:</label>
                                                    <input type="number" id="checkout-pincode" class="form-control"
                                                        name="pincode" placeholder="201301" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-state">State:</label>
                                                    <input type="text" id="checkout-state" class="form-control" name="state"
                                                        placeholder="California" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="add-type">Address Type:</label>
                                                    <select class="form-control" id="add-type">
                                                        <option>Home</option>
                                                        <option>Work</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary btn-next delivery-address">Save
                                                    And Deliver Here</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Customer Address Left ends -->
    
                                <!-- Checkout Customer Address Right starts -->
                                <div class="customer-card">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">John Doe</h4>
                                        </div>
                                        <div class="card-body actions">
                                            <p class="card-text mb-0">9447 Glen Eagles Drive</p>
                                            <p class="card-text">Lewis Center, OH 43035</p>
                                            <p class="card-text">UTC-5: Eastern Standard Time (EST)</p>
                                            <p class="card-text">202-555-0140</p>
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
                                                        <input class="form-check-input" 
                                                        type="radio"                                                name="paymentMethod" 
                                                        id="paymentMethod{{$payment->paymentMethod}}"
                                                        value="{{$payment->paymentMethod}}"
                                                        required 
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
                                                    <div class="detail-amt">Rp. {{ number_format ($order_subtotal,2,",",".") }}</div>
                                                <li class="price-detail pengiriman-tax">
                                                    <div class="detail-title">Pengiriman</div>
                                                    <div class="detail-amt discount-amt text-success">
                                                        Rp. {{ number_format (10000,2,",",".") }}
                                                    </div>
                                                </li>
                                            </ul>
                                            <hr />
                                            <ul class="list-unstyled price-details">
                                                <li class="price-detail">
                                                    <div class="details-title">Total</div>
                                                    <div class="detail-amt font-weight-bolder" >
                                                        Rp. {{ number_format ($order_subtotal + 10000,2,",",".") }}
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
    <script>
        $('.item-price, .price-details').on('change', function(){
            let price = 0;

            $('.ecommerce-card').each(function(){
                const product = $(this).data('product');
                price+= product.price  * $(this).find('.quantity-counter').val();
                
            }) 
            
            $('#amt').val(price + 10000);
        })
    </script>
@endpush
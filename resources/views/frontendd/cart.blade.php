@extends('layouts.frontend')

@push('styles')
<style>
    .cart-table-container {
        margin-bottom: 2.5rem;
    }

    .cart-table-container .input-group .form-control {
        height: 25px;
        border-color: rgba(0, 0, 0, 0.09);
    }

    .cart-table-container .btn-shop,
    .cart-table-container .btn-sm {
        border: none;
        background-color: #f4f4f4;
        color: #222529;
    }

    .cart-table-container .btn-shop:hover,
    .cart-table-container .btn-sm:hover {
        color: #fff;
        background-color: #08c;
    }

    .table.table-cart tr td,
    .table.table-cart tr th,
    .table.table-wishlist tr td,
    .table.table-wishlist tr th {
        vertical-align: middle;
    }

    .table.table-cart tr th,
    .table.table-wishlist tr th {
        border: 0;
        color: #222529;
        font-weight: 500;
        line-height: 2rem;
        font-size: 14px;
        text-transform: uppercase;
    }

    .table.table-cart tr td,
    .table.table-wishlist tr td {
        border-top: 1px solid #e7e7e7;
    }

    .table.table-cart tr td.product-col,
    .table.table-wishlist tr td.product-col {
        padding: 2rem 0.8rem 1.8rem 0;
    }

    .table.table-cart tr.product-action-row td,
    .table.table-wishlist tr.product-action-row td {
        padding: 0 0 2.2rem;
        border: 0;
    }

    .table.table-cart .product-image-container,
    .table.table-wishlist .product-image-container {
        position: relative;
        width: 8rem;
        margin: 0;
    }

    .table.table-cart .product-title,
    .table.table-wishlist .product-title {
        margin-bottom: 0;
        padding: 0;
        font-family: "Open Sans", sans-serif;
        font-weight: 400;
        line-height: 1.75;
        font-size: 16px;
    }

    .table.table-cart .product-title a,
    .table.table-wishlist .product-title a {
        color: inherit;
        text-decoration: none;
    }

    .table.table-cart .subtotal-price,
    .table.table-wishlist .subtotal-price {
        color: #222529;
        font-size: 1.6rem;
        font-weight: 600;
        font-size: 16px;
    }

    .table.table-cart .btn-remove,
    .table.table-wishlist .btn-remove {
        right: 15px;
        font-size: 1.1rem;
    }

    .table.table-cart tfoot td,
    .table.table-wishlist tfoot td {
        padding: 2rem 0.8rem 1rem;
    }

    .table.table-cart tfoot .btn,
    .table.table-wishlist tfoot .btn {
        padding: 1.2rem 2.4rem 1.3rem 2.5rem;
        font-size: 1.3rem;
        font-weight: 700;
        height: 43px;
        letter-spacing: -0.018em;
        font-size: 14px;
        padding: 0px 25px;
    }

    .table.table-cart tfoot .btn+.btn,
    .table.table-wishlist tfoot .btn+.btn {
        margin-left: 1rem;
    }

    .table.table-cart .bootstrap-touchspin.input-group,
    .table.table-wishlist .bootstrap-touchspin.input-group {
        margin-right: auto;
        margin-left: auto;
    }

    .table.table-cart .product-title a,
    .table.table-cart .subtotal-price {
        display: block;
        margin-bottom: 1px;
    }

    .table-cart tr th {
        padding: 1rem;
    }

    .table-cart tr th.thumbnail-col {
        width: 16%;
    }

    .table-cart tr th.product-col {
        width: 33%;
    }

    .table-cart tr th.price-col {
        width: 14%;
    }

    .table-cart td {
        padding: 1rem 1rem;
    }

    i.cart-empty {
        font-size: 100px;
        color: #d3d3d4;
    }


    .qty-col {
        min-width: 98px;
    }

    tbody .product-col {
        font-size: 0;
    }

    .product-col .product-image-container {
        display: table-cell;
        padding-right: 1.8rem;
        margin-bottom: 0;
        vertical-align: middle;
    }

    .product-col .product-image img {
        border: 1px solid #ccc;
    }

    .product-col .product-title {
        margin-bottom: 1px;
        display: table-cell;
        vertical-align: middle;
    }

    .cart-discount {
        margin-bottom: 2rem;
    }

    .cart-discount h4 {
        margin-bottom: 1.2rem;
        font-size: 1.6rem;
        font-weight: 400;
    }

    .cart-discount form {
        max-width: 420px;
    }

    .cart-discount .input-group-append {
        margin-left: 3px;
    }

    .cart-summary {
        margin-bottom: 1.6rem;
        padding: 1.5rem;
        border: 1px solid #e7e7e7;
        background: #fff;
    }

    .cart-summary h3 {
        margin-bottom: 10px;
        font-size: 16px;
        letter-spacing: -0.01em;
    }

    .product-image img {
        width: 100px;
        height: 100px;
    }

    .quantity-wrapper {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .quantity-wrapper label {
        font-weight: 300;
        color: #666666;
        font-size: 15px;
        margin-bottom: 0;
    }

    .quantity-wrapper .input-group {
        width: 100px;
        margin: 0 10px;
    }

    .quantity-wrapper input {
        width: 35px !important;
        pointer-events: none;
        padding: 0;
        border: 0;
        text-align: center;
        margin-left: auto !important;
        position: initial !important;
    }

    .quantity-wrapper .input-group-btn {
        border: 1px solid #d5d5d5;
        border-radius: 50px !important;
        display: flex;
    }

    .quantity-wrapper .btn {
        padding: 0;
        height: 28px;
        width: 28px;
        display: flex;
        justify-content: center;
        align-items: center;
        outline: none;
        box-shadow: none;
    }

    .quantity-wrapper .bx {
        font-size: 16px;
    }

    .promo-code-area h3 {
        font-size: 16px;
        font-weight: 400;
        margin: 10px 0;
    }

    .apply-coupon-btn {
        background-color: #4f1fff;
        color: #fff;
    }

    .apply-coupon-btn:hover {
        color: #fff;
    }

    .cart-discount input {
        box-shadow: none !important;
        outline: none !important;
    }

    .table-totals tfoot tr td:last-child {
        text-align: right;
    }

    .checkout-methods {
        text-align: center;
    }

    .btn-remove {
        position: absolute;
        top: -10px;
        right: -8px;
        width: 1.8rem;
        height: 1.8rem;
        border-radius: 50%;
        color: #474747;
        background-color: #fff;
        box-shadow: 0 2px 6px 0 rgb(0 0 0 / 40%);
        text-align: center;
        line-height: 2rem;
    }

    .icon-cancel {
        text-decoration: none;
    }

    .icon-cancel:before {
        content: "";
        font-family: "Font Awesome 5 Free";
        font-weight: 700;
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </nav>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="row cart-wrapper">
                        <div class="col-sm-8 col-md-12">
                            <div class="cart-table-container-fluid">
                                <table class="table table-cart bg-light">
                                    <thead>
                                        <tr>
                                            <th class="thumbnail-col"></th>
                                            <th class="product-col">Product</th>
                                            <th class="price-col">Price</th>
                                            <th class="qty-col">Quantity</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $cart)
                                            <tr class="product-row" id="product-{{ $cart->product->id }}">
                                                <td>
                                                    <figure class="product-image-container">
                                                        <a href="#!" class="product-image">
                                                            <img src="{{ $cart->product->assets->first()->src }}"
                                                                alt="product">
                                                        </a>

                                                        <a onclick="removeProduct('#product-{{ $cart->product->id }}')" class="btn-remove icon-cancel"
                                                            title="Remove Product"></a>
                                                    </figure>
                                                </td>
                                                <td class="product-col">
                                                    <h5 class="product-title text-capitalize">
                                                        <a href="product.html">{{ $cart->product->title }}</a>
                                                    </h5>
                                                </td>
                                                <td><small>Rp. {{ number_format ($cart->product->price,2,",",".") }}</small></td>
                                                <td>
                                                    <div class="quantity-wrapper">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-white ">
                                                                    <span class="fa fa-minus"></span>
                                                                </button>
                                                            </span>
                                                            <input type="text" name="quant[1]"
                                                                class="form-control input-number" value="{{ $cart->quantity }}" min="1"
                                                                max="30" id="prd-input-{{ $cart->product->id }}">
                                                            <span class="input-group-btn">
                                                                <button type="button" onclick="return $('#prd-input-{{ $cart->product->id }}')" class="btn btn-white ">
                                                                    <span class="fa fa-plus"></span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right"><span class="subtotal-price">Rp. {{ number_format ($cart->product->price * $cart->quantity,2,",",".") }}</span></td>
                                            </tr>
                                        @endforeach

                                        {{-- <tr class="product-row">
                                            <td>
                                                <figure class="product-image-container">
                                                    <a href="#!" class="product-image">
                                                        <img src="https://saaslandwp.com/demo/wp-content/uploads/2018/12/10-480x480.jpg"
                                                            alt="product">
                                                    </a>

                                                    <a href="#" class="btn-remove icon-cancel"
                                                        title="Remove Product"></a>
                                                </figure>
                                            </td>
                                            <td class="product-col">
                                                <h5 class="product-title">
                                                    <a href="product.html">Men Watch</a>
                                                </h5>
                                            </td>
                                            <td>$17.90</td>
                                            <td>
                                                <div class="quantity-wrapper">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default btn-number">
                                                                <span class="fa fa-minus"></span>
                                                            </button>
                                                        </span>
                                                        <input type="text" name="quant[1]"
                                                            class="form-control input-number" value="8" min="8"
                                                            max="30">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default btn-number">
                                                                <span class="fa fa-plus"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right"><span class="subtotal-price">$17.90</span></td>
                                        </tr>

                                        <tr class="product-row">
                                            <td>
                                                <figure class="product-image-container">
                                                    <a href="#!" class="product-image">
                                                        <img src="https://saaslandwp.com/demo/wp-content/uploads/2018/12/11-480x480.jpg"
                                                            alt="product">
                                                    </a>

                                                    <a href="#" class="btn-remove icon-cancel"
                                                        title="Remove Product"></a>
                                                </figure>
                                            </td>
                                            <td class="product-col">
                                                <h5 class="product-title">
                                                    <a href="product.html">Men Watch</a>
                                                </h5>
                                            </td>
                                            <td>$17.90</td>
                                            <td>
                                                <div class="quantity-wrapper">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default btn-number">
                                                                <span class="fa fa-minus"></span>
                                                            </button>
                                                        </span>
                                                        <input type="text" name="quant[1]"
                                                            class="form-control input-number" value="8" min="8"
                                                            max="30">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-default btn-number">
                                                                <span class="fa fa-plus"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right"><span class="subtotal-price">$17.90</span></td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-12">
                            <div class="cart-summary">
                                <h3>CART TOTALS</h3>

                                <table class="table table-totals">
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td>$17.90</td>
                                        </tr>


                                        <tr>
                                            <td colspan="2" class="text-left promo-code-area">
                                                <h3>Promo Code</h3>

                                                <div class="cart-discount">
                                                    <form action="#">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm"
                                                                placeholder="Coupon Code" required="">
                                                            <div class="input-group-append">
                                                                <button class="btn apply-coupon-btn" type="submit">Apply
                                                                    Coupon</button>
                                                            </div>
                                                        </div><!-- End .input-group -->
                                                    </form>
                                                </div>


                                                <button type="submit" class="btn btn-shop btn-update-total">
                                                    Update Totals
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td>Other charges</td>
                                            <td>$17.90</td>
                                        </tr>
                                        <tr>
                                            <td>Delivery charges</td>
                                            <td>$17.90</td>
                                        </tr>
                                        <tr>
                                            <td><b>Total</b></td>
                                            <td><b>$17.90</b></td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="checkout-methods">
                                    <a href="#!" class="btn btn-block fw-normal btn-dark">Proceed to Checkout
                                        <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div><!-- End .cart-summary -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        const removeProduct = function(selector){
            $(selector).remove();
        }
    </script>
@endpush
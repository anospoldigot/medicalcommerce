@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Message Form</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Order</a>
            </li>
            <li class="breadcrumb-item active">Show
            </li>
        </ol>
    </div>
</div>
@endsection



@section('content')
    <section class="invoice-preview-wrapper">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                         <div class="row">
                            <div class="col-4">Status</div>
                            <div class="col-8">: <span class="badge badge-{{ $order->order_status_color }}">{{ $order->status_label }}</span></div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-12 col-12">
                
                <div class="card invoice-preview-card">
                    <div class="card-body invoice-padding pb-0">
                        <!-- Header starts -->
                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                            <div>
                                {{-- <div class="logo-wrapper">
                                    <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                        <defs>
                                            <linearGradient id="invoice-linearGradient-1" x1="100%" y1="10.5120544%"
                                                x2="50%" y2="89.4879456%">
                                                <stop stop-color="#000000" offset="0%"></stop>
                                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                                            </linearGradient>
                                            <linearGradient id="invoice-linearGradient-2" x1="64.0437835%" y1="46.3276743%"
                                                x2="37.373316%" y2="100%">
                                                <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                                <stop stop-color="#FFFFFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-400.000000, -178.000000)">
                                                <g transform="translate(400.000000, 178.000000)">
                                                    <path class="text-primary"
                                                        d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                                        style="fill: currentColor"></path>
                                                    <path
                                                        d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                                        fill="url(#invoice-linearGradient-1)" opacity="0.2"></path>
                                                    <polygon fill="#000000" opacity="0.049999997"
                                                        points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                                    </polygon>
                                                    <polygon fill="#000000" opacity="0.099999994"
                                                        points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                                    </polygon>
                                                    <polygon fill="url(#invoice-linearGradient-2)" opacity="0.099999994"
                                                        points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288">
                                                    </polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <h3 class="text-primary invoice-logo">Vuexy</h3>
                                </div> --}}
                                <p class="card-text mb-25 col-6">{{ ucwords(strtolower($order->shipping_address)) }}</p>
                            </div>
                            <div class="mt-md-0 mt-2">
                                <h4 class="invoice-title">
                                    <span class="invoice-number">{{ $order->transaction->invoice_number }}</span>
                                </h4>
                                <div class="invoice-date-wrapper">
                                    <p class="invoice-date-title">Date Issued:</p>
                                    <p class="invoice-date">25/08/2020</p>
                                </div>
                                <div class="invoice-date-wrapper">
                                    <p class="invoice-date-title">Due Date:</p>
                                    <p class="invoice-date">29/08/2020</p>
                                </div>
                            </div>
                        </div>
                        <!-- Header ends -->
                    </div>
    
                    <hr class="invoice-spacing" />
    
                    <!-- Address and Contact starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row invoice-spacing">
                            <div class="col-xl-8 p-0">
                                <h6 class="mb-2">Invoice To:</h6>
                                <h6 class="mb-25">{{ $order->user->name }}</h6>
                                <p class="card-text mb-25">{{ $order->user->phone }}</p>
                                <p class="card-text mb-0">{{ $order->user->email }}</p>
                            </div>
                            <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                <h6 class="mb-2">Payment Details:</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pr-1">Total Due:</td>
                                            <td><span class="font-weight-bold">{{ number_format ($order->transaction->amount,2,",",".") }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="pr-1">Payment name:</td>
                                            <td>{{ $order->transaction->payment_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pr-1">Payment Code:</td>
                                            <td>{{ $order->transaction->payment_code }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pr-1">Payment Method:</td>
                                            <td>{{ $order->transaction->payment_method }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="pr-1">IBAN:</td>
                                            <td>ETD95476213874685</td>
                                        </tr>
                                        <tr>
                                            <td class="pr-1">SWIFT code:</td>
                                            <td>BR91905</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Address and Contact ends -->
    
                    <!-- Invoice Description starts -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="py-1">Item</th>
                                    <th class="py-1">Rate</th>
                                    <th class="py-1">Quantity</th>
                                    <th class="py-1">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25">{{ $item->name }}</p>
                                            {{-- <p class="card-text text-nowrap">
                                                Developed a full stack native app using React Native, Bootstrap & Python
                                            </p> --}}
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">Rp. {{ number_format ($item->price,2,",",".") }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{ $item->quantity }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">Rp. {{ number_format ($item->price * $item->quantity,2,",",".") }}</span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
    
                    <div class="card-body invoice-padding pb-0">
                        <div class="row invoice-sales-total-wrapper">
                            <div class="col-md-4 order-md-1 order-2 mt-md-0 mt-3">
                                {{-- <p class="card-text mb-0">
                                    <span class="font-weight-bold">Salesperson:</span> <span class="ml-75">Alfie
                                        Solomons</span>
                                </p> --}}
                            </div>
                            <div class="col-md-8 d-flex justify-content-end order-md-2 order-1">
                                <div class="invoice-total-wrapper">
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">Subtotal:</p>
                                        <p class="invoice-total-amount">Rp. {{ number_format ($item->price * $item->quantity, 2,",",".") }}</p>
                                    </div>
                                    {{-- @if ()
                                        
                                    @endif --}}
                                    {{-- <div class="invoice-total-item">
                                        <p class="invoice-total-title">Discount:</p>
                                        <p class="invoice-total-amount">$28</p>
                                    </div>
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">Tax:</p>
                                        <p class="invoice-total-amount">21%</p>
                                    </div> --}}
                                    <hr class="my-50" />
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">Total:</p>
                                        <p class="invoice-total-amount">
                                            Rp. {{ number_format ($item->price * $item->quantity, 2,",",".") }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Description ends -->
    
                    <hr class="invoice-spacing" />
    
                    <!-- Invoice Note starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row">
                            <div class="col-12">
                                <span class="font-weight-bold">Note:</span>
                                <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                                    future freelance
                                    projects. Thank You!</span>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Note ends -->
                </div>
            </div>
            <!-- /Invoice -->
    
            <!-- Invoice Actions -->
            {{-- <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary btn-block mb-75" data-toggle="modal"
                            data-target="#send-invoice-sidebar">
                            Send Invoice
                        </button>
                        <button class="btn btn-outline-secondary btn-block btn-download-invoice mb-75">Download</button>
                        <a class="btn btn-outline-secondary btn-block mb-75" href="./app-invoice-print.html"
                            target="_blank">
                            Print
                        </a>
                        <a class="btn btn-outline-secondary btn-block mb-75" href="./app-invoice-edit.html"> Edit </a>
                        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#add-payment-sidebar">
                            Add Payment
                        </button>
                    </div>
                </div>
            </div> --}}
            <!-- /Invoice Actions -->
        </div>
    </section>
@endsection
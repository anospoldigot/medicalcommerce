@extends('layouts.frontend', [
'disableHero' => 1,
'disableFooter' => 1
])

@push('styles')
    <style>
        .address-font{
            
        }
    </style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="px-1 mb-3">
                <h2>Invoice</h2>
                <h6>#{{ $order->transaction->invoice_number }}</h6>
            </div>
            <div class="bg-white p-4" style="border-radius: 10px;">
                <div class="row justify-content-between">
                    <div class="col-12 col-lg-5">
                        <div class="font-weight-bold text-secondary mb-3">To:</div>
                        <div>{{ ucwords(strtolower($order->shipping_address)) }}</div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-between mb-2">
                            <div>Date Issue :</div>
                            <div>{{ \Carbon\Carbon::create($order->created_at)->format('d/m/Y') }}</div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <div>Due Date :</div>
                            <div>{{ \Carbon\Carbon::create($order->created_at)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
                <hr class="my-5">
                <div class="row justify-content-between mb-5">
                    <div class="col-12 col-lg-6">
                        <div class="font-weight-bold text-secondary mb-3">Payment Details:</div>
                        <div class="row mb-1">
                            <div class="col-4">Total</div>
                            <div class="col-8">: Rp. {{ number_format ($order->transaction->amount,2,",",".") }} </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4">Payment Name</div>
                            <div class="col-8">: {{ $order->transaction->payment_name }}</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4">Payment Code</div>
                            <div class="col-8">: {{ $order->transaction->payment_code }}</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4">Status</div>
                            <div class="col-8">: <span class="badge alert-{{$order->order_status_color}}">{{ $order->status_label }}</span></div>
                        </div>
                    </div>
                    <div class="col-4">
                        
                    </div>
                </div>
                <div>
                    <div class="font-weight-bold text-secondary mb-3">Item Details:</div>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


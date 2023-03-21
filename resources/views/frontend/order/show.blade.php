@extends('layouts.frontend', [
'disableHero' => 1,
'disableFooter' => 1
])

@push('styles')
<style>
    .timeline {
        /* Used to position the left vertical line */
        position: relative;
    }

    .timeline__line {
        /* Border */
        border-right: 2px solid #a6b9d6;

        /* Positioned at the left */
        left: 0.75rem;
        position: absolute;
        top: 0px;

        /* Take full height */
        height: 100%;
    }

    .timeline__items {
        /* Reset styles */
        list-style-type: none;
        margin: 0px;
        padding: 0px;
    }

    .timeline__item {
        margin-bottom: 20px;
    }

    .timeline__top {
        /* Center the content horizontally */
        align-items: center;
        display: flex;
    }

    .timeline__circle {
        /* Rounded border */
        background-color: #a6b9d6;
        border-radius: 9999px;

        /* Size */
        height: 1.5rem;
        width: 1.5rem;
    }

    .timeline__title {
        /* Take available width */
        flex: 1;
        margin-left: 0.5rem;
    }

    .timeline__desc {
        /* Make it align with the title */
        margin-left: 2rem;
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
                <div class="mb-3">
                    <a href="" class="btn btn-outline-primary"><i class="fa-solid fa-box mr-1"></i>Pesanan Diterima</a>
                    <a href="" class="btn btn-outline-success"><i class="fa-solid fa-star mr-1"></i>Beri Ulasan</a>
                </div>
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
                        <div>
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
                                <div class="col-8">: <span class="badge alert-{{$order->order_status_color}}">{{
                                        $order->status_label }}</span></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="timeline">
                            <!-- Left vertical line -->
                            <div class="timeline__line"></div>

                            <!-- The timeline items timeline -->
                            <div class="timeline__items">
                                <!-- Each timeline item -->
                                @foreach (collect($response->history)->reverse() as $timeline)
                                <div class="timeline__item">
                                    <!-- The circle and title -->
                                    <div class="timeline__top">
                                        <!-- The circle -->
                                        <div class="timeline__circle"></div>

                                        <!-- The title -->
                                        <div class="timeline__title font-weight-bold">{{ strtoupper(str_replace("_", "", $timeline->status)) }}</div>
                                    </div>

                                    <!-- The description -->
                                    <div class="timeline__desc">
                                        <small class="text-muted">{{ $timeline->note }}</small>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-5">
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
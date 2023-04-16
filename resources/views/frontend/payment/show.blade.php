@extends('layouts.frontend', [
    'disableHero'   => 1,
    'disableFooter' => 1
])

@section('content')

<div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card border-0" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="text-center">
                            <h6 class="text-center">No. Virtual Account</h6>
                            <div class="d-flex justify-content-center">
                                <input type="text" class="d-none" id="payment_code" value="{{ $order->payment_code }}">
                                <h2 class="mr-3" style="letter-spacing: 2px;" >{{ $order->payment_code }}</h2>
                                <button class="btn btn btn-outline-dark" onclick="CopyMe({{ $order->payment_code }})"><i class="fa-solid fa-paste"></i></button>
                            </div>
                            @if ($order->transaction->status == "PAID")
                                <div>Status: <span class="badge badge-success">{{$order->transaction->status}}</span></div>
                            @elseif($order->transaction->status == "UNPAID")
                                <div>Status: <span class="badge badge-danger">{{$order->transaction->status}}</span></div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush
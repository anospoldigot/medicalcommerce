@extends('layouts.frontend', [
    'disableHero'       => 1,
    'disableFooter'       => 1
])

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">List Order</h2>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div id="list">
                    @forelse ($orders as $order)
                        <div class="bg-white mb-4 p-3" style="border-radius: 10px">
                            <div class="row justify-content-between">
                                <div class="col-2 d-flex">
                                    <img src="{{ $order->items->first()->product->assets->first()->src }}" alt="" class="img-fluid">
                                </div>
                                <div class="col-8">
                                    @foreach ($order->items as $item)
                                        <div><small>{{ $item->name }}</small></div>
                                    @endforeach
                                    <div class="badge alert-{{ $order->order_status_color }}"><small>{{ $order->status_label }}</small></div>
                                </div>
                                <div class="col-2 text-right"><a href="{{ route('fe.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Detail</a></div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">Tidak ada data pesanan</div>
                    @endforelse
                </div>
            </div>
            <div class="col-4 d-none">
                <div id="order-animation"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
            bodymovin.loadAnimation({
                container: document.getElementById("order-animation"),
                renderer: "svg",
                loop: true,
                autoplay: true,
                path: "https://assets1.lottiefiles.com/packages/lf20_hsy3fkkd.json"
            });
    </script>
@endpush
@extends('layouts.frontend', [
'disableHero' => 1,
'disableFooter' => 1,
])

@push('styles')
<style>
    .hero {}
</style>
@endpush

@section('content')

{{-- <div class="hero">
    <div class="container">
        <div class="row">
            <div class="col-6 col-xl-3">
                <img src="{{ asset('upload/images/' . $category->image) }}" alt="" class="img-fluid p-3 p-xl-5">
            </div>
            <div class="col d-flex align-items-center">
                <h5 class="">{{ $category->title }}</h5>
            </div>
        </div>
    </div>
</div> --}}
<div class="container py-5">
    <h6 class="text-center mb-3">{{ $category->title }}</h6>
    <div class="row">
        @foreach ($category->products as $product)
        <div class="col-12 col-xl-2 p-1 d-none d-md-block">
            <a href="{{ route('fe.products.show', $product->slug) }}">
                <div class="rounded card-product" style="height: 100%">
                    <img src="{{ $product->assets->first()->src }}" alt="" class="card-img-top rounded">
                    <span class="badge badge-success label-sell-product">50 Terjual</span>
                    <div class="p-3">
                        <div class="mb-3">
                            {{ $product->title }}
                        </div>
                        @if ($product->is_discount)
                        <div>
                            <del>
                                <small class="text-muted text-decoration-line-through mb-0">Rp. {{
                                    number_format ($product->price,2,",",".") }}
                                </small>
                            </del>
                        </div>
                        @if ($product->discount_type == 'persen')
                        <div>
                            <span class="text-primary  mb-0">Rp. {{ number_format (($product->price /
                                100) *
                                $product->discount,2,",",".") }}
                            </span>

                        </div>
                        @else
                        <div>
                            <span class="text-primary  mb-0">Rp. {{ number_format
                                ($product->price-$product->discount,2,",",".") }}
                            </span>
                        </div>
                        @endif
                        @else
                        <span class="text-primary  mb-0">Rp. {{ number_format
                            ($product->price,2,",",".") }}
                        </span>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-xl-2 p-1 d-block d-md-none">
            <a href="{{ route('fe.products.show', $product->slug) }}">
                <div class="card-product">
                    <div class="row no-gutters">
                        <div class="col-4">
                            <img src="{{ $product->assets->first()->src }}" alt="" class="rounded">
                        </div>
                        <div class="col-8">
                            <div class="p-3">
                                <div class="mb-3">
                                    {{ $product->title }}
                                </div>
                                @if ($product->is_discount)
                                <div>
                                    <del>
                                        <small class="text-muted text-decoration-line-through mb-0">Rp. {{
                                            number_format ($product->price,2,",",".") }}
                                        </small>
                                    </del>
                                </div>
                                @if ($product->discount_type == 'persen')
                                <div>
                                    <span class="text-primary  mb-0">Rp. {{ number_format (($product->price /
                                        100) *
                                        $product->discount,2,",",".") }}
                                    </span>
                    
                                </div>
                                @else
                                <div>
                                    <span class="text-primary  mb-0">Rp. {{ number_format
                                        ($product->price-$product->discount,2,",",".") }}
                                    </span>
                                </div>
                                @endif
                                @else
                                <span class="text-primary  mb-0">Rp. {{ number_format
                                    ($product->price,2,",",".") }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')

@endpush
@extends('layouts.frontend', [
'disableHero' => 1,
'disableFooter' => 1,
])

@push('styles')
<style>
    .badge-custom {
        background: rgb(45,44,76);
        background: linear-gradient(90deg, rgba(45,44,76,1) 24%, rgba(113,88,226,1) 100%);
    }
    hr {
        border: none;
        height: 10px;
        /* Set the hr color */
        color: rgb(190, 190, 190); /* old IE */
        background-color: rgb(190, 190, 190); /* Modern Browsers */
    }
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
<div class="container">
    <div class="glide pt-3" id="klien">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides d-flex">
                @foreach ($products as $product)
                <li class="glide__slide">
                    <div class="col-12 p-1 d-none d-md-block">
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
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <h6 class="text-center mb-3"><span class="badge badge-custom text-white p-3">{{ $category->title }}</span></h6>
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
    <script>
        const klien = new Glide('#klien', {
            autoplay: 3000,
            rewind: true,
            perView: 5,
            gap: 25
        }).mount()
    </script>
@endpush
@extends('layouts.frontend', [
'disableHero' => 1
])

@section('content')

<div class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-8">
                <div class="glide" id="product-slider">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <li class="glide__slide">
                                <img src="{{ asset('frontend/img/banner1.jpg') }}" alt="" style="height: 100%; object-fit: cover">
                            </li>
                            <li class="glide__slide">
                                <img src="{{ asset('frontend/img/banner2.jpg') }}" alt="" style="height: 100%; object-fit: cover">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-4 row flex-row">
                <div>
                    <img src="{{ asset('frontend/img/banner1.jpg') }}" alt="" style="height: 100%; object-fit: cover">
                </div>
                <div>
                    <img src="{{ asset('frontend/img/banner2.jpg') }}" alt="" style="height: 100%; object-fit: cover">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="p-4  mb-3" style="background: #7158e226">
                    <h6 class="mb-4">Category</h6>
                    @foreach ($categories as $category)
                    <div><small><a href="{{ route('fe.products.index') }}?category={{$category->id}}"
                                class="text-capitalize">{{
                                $category->title }}</a></small></div>
                    @endforeach
                </div>
                <div class="p-4" style="background: #7158e226">
                    <h6 class="mb-4">Harga</h6>
                    <div class="form-group">
                        <label for="min"><small>Min</small></label>
                        <input type="text" class="form-control form-control-sm" id="min" placeholder="min">
                    </div>
                    <div class="form-group">
                        <label for="max"><small>Max</small></label>
                        <input type="text" class="form-control form-control-sm" id="max" placeholder="max">
                    </div>
                    <div>
                        <button class="btn btn-primary" id="filter-btn" type="button">Filter</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="text" id="search" class="form-control" placeholder="Search..."
                                        aria-label="Search..." aria-describedby="button-addon2">
                                    <button class="btn btn-success" id="search-button" type="button"
                                        id="button-addon2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($products as $product)
                    <div class="col-lg-4 mb-4">
                        <div class="card mb-3" style="height: 100%">
                            <div class="card-img-top">
                                <img src="{{ $product->assets->first()->src }}" class="card-img-top" alt="..."
                                    style="max-height:250px; object-fit: cover;">
                                {{-- <img src="https://source.unsplash.com/random/{{ $product->id }}"
                                    class="card-img-top" alt="..." style="max-height:250px; object-fit: cover;"> --}}
                                @if ($product->is_discount && $product->discount_type == 'persen')
                                <span class="badge badge-success" style="position: absolute;top: 0; right: 0">-{{
                                    $product->discount }}%</span>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-secondary text-capitalize"><a
                                            href="{{ route('fe.products.show', $product->slug) }}">{{ $product->title
                                            }}</a> </h5>
                                    @if ($product->category)
                                    <div class="text-center text-capitalize mb-3">({{ $product->category->title ?? '-'
                                        }})
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="mb-4">
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
                                    <div class="d-flex justify-content-between mb-2"><small>Stock : {{ $product->stock
                                            }}</small><small>Terjual : 10</small></div>
                                    <button class="btn btn-block btn-sm btn-primary text-capitalize"><i
                                            class="fa-solid fa-cart-shopping mr-2"></i> add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" id="prev-product"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="btn btn-primary" id="next-product"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('#search-button').click(function(){
            window.location.href = '{{ route('fe.products.index') }}?q=' + $('#search').val();
        })
        $('#filter-btn').click(function(){
            window.location.href = `{{ route('fe.products.index') }}?min=${$('#min').val()}&max=${$('#max').val()}`;
        })

        const product = new Glide('#product-slider', {
            height: 300,
            autoplay: 2000,
        }).mount()
        
</script>
@endpush
@extends('layouts.frontend', [
'disableHero' => 1
])

@push('styles')
<style>
    .barrating .br-widget a {
        font-size: 2px;
    }

    *, *:before, *:after {
        box-sizing: border-box;
    }
    *, *:focus, *:active, *:focus:active {
        outline: none;
    }
    
    
    
    .review {
        border: 1px solid #cccccc;
        border-radius: 4px;
        padding: 1em;
    }
    .review + .review {
        margin-top: 1em;
    }

    .br-theme-fontawesome-stars .br-widget a {
        font-size: 16px !important;
    }

</style>
    
@endpush

@section('content')
<div class="bg-light">
    <div class="container py-5">
        <h2>Reviews</h2>
        <hr />
        {{-- <div class="no-reviews text-center">
            <p>There are currently no reviews for this product.</p>
            <button class="btn btn-primary btn-lg">Write a Review</button>
            <hr />
        </div> --}}
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <div class="visible-xs-block">
                    
                    <div class="form-group">
                        <select class="form-control" id="filter">
                            <option value="0" @selected(request()->isNotFilled('rating'))>show all ({{$product->reviews->count()}})</option>
                            <option value="5" @selected(request()->query('rating') == 5)>★★★★★ ({{ $product->reviews->where('rating', 5)->count() }})
                            </option>
                            <option value="4" @selected(request()->query('rating') == 4)>★★★★☆ ({{ $product->reviews->where('rating', 4)->count() }})
                            </option>
                            <option value="3" @selected(request()->query('rating') == 3)>★★★☆☆ ({{ $product->reviews->where('rating', 3)->count() }})
                            </option>
                            <option value="2" @selected(request()->query('rating') == 2)>★★☆☆☆ ({{ $product->reviews->where('rating', 2)->count() }})
                            </option>
                            <option value="1" @selected(request()->query('rating') == 1)>★☆☆☆☆ ({{ $product->reviews->where('rating', 1)->count() }})
                            </option>
                        </select>
                    </div>
                </div>
                <div class="hidden-xs">
                    <div class="form-group">
                        <h5>Filter Reviews</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{ request()->url() . '?=rating=5' }}">★★★★★ ({{ $product->reviews->where('rating', 5)->count() }})</a></li>
                            <li class="list-group-item"><a href="{{ request()->url() . '?=rating=4' }}">★★★★☆ ({{ $product->reviews->where('rating', 4)->count() }})</a></li>
                            <li class="list-group-item"><a href="{{ request()->url() . '?=rating=3' }}">★★★☆☆ ({{ $product->reviews->where('rating', 3)->count() }})</a></li>
                            <li class="list-group-item"><a href="{{ request()->url() . '?=rating=2' }}">★★☆☆☆ ({{ $product->reviews->where('rating', 2)->count() }})</a></li>
                            <li class="list-group-item"><a href="{{ request()->url() . '?=rating=1' }}">★☆☆☆☆ ({{ $product->reviews->where('rating', 1)->count() }})</a></li>
                        </ul>
                    </div>
                    <div class="form-group"><a class="btn btn-primary btn-block btn-lg" href="#">Write a Review</a></div>
                </div>
            </div>
            <div class="col-sm-8 col-md-9">
                <form name="form" method="post" action="#">
                    <div class="row">
                        <div class="col-sm-6 col-sm-push-6 col-md-4 col-md-push-8">
                            <select class="form-control mb-3">
                                <option value="new">sort newest to oldest</option>
                                <option value="old">sort oldest to newest</option>
                                <option value="good">sort best to worst</option>
                                <option value="bad">sort worst to best</option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-sm-pull-6 col-md-8 col-md-pull-4">
                            {{-- <h5>Showing 1230 - 1235 of 1346</h5> --}}
                        </div>
                    </div>
                </form>
                @forelse ($product->reviews as $review)
                    <div class="review">
                        <div class="row">
                            <div class="col-sm-3">
                                <select class="rating" id="example">
                                    <option value="1" @selected($review->rating == 1)>1</option>
                                    <option value="2" @selected($review->rating == 2)>2</option>
                                    <option value="3" @selected($review->rating == 3)>3</option>
                                    <option value="4" @selected($review->rating == 4)>4</option>
                                    <option value="5" @selected($review->rating == 5)>5</option>
                                </select>
                            </div>
                            <div class="col-sm-9">
                                <h5>{{ $review->name }}</h5>
                                <p>{{ $review->comment }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    
                @endforelse
                
                {{-- <nav class="text-center" aria-label="Page navigation">
                    <ul class="pagination">
                        <li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                    </ul>
                </nav> --}}
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    

    $('.rating').barrating({
        theme: 'fontawesome-stars',
        readonly: true
    });
    
    $('#filter').change(function(){
        const url = '{{ request()->url() }}';    

        window.location.href = url+'?rating='+this.value

    })

</script>
@endpush
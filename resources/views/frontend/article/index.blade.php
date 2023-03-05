@extends('layouts.frontend', [
'disableHero' => 1,
'disableFooter' => 1
])

@push('styles')
<style>
    .icon-style {
        font-size: 50px;
    }

    .text-icon-style {
        vertical-align: center
    }

    .hero-container-contact {
        background: url('{{ asset('frontend/img/headerdoctor.jpg')}}');
        background-size: cover;
        background-position: center center;
    }

    .hero-contact {
        background-color: rgba(255, 255, 255, 0.8);
        height: 400px;
    }
</style>
@endpush

@section('content')


<div class="container py-5">
    <div class="row mb-5">
        @foreach ($articles->take(4) as $article)
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="card border-0 mb-4">
                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="card-img-top rounded"
                    style="height: 100%; object-fit: cover">
                <div class="card-body">
                    <a href="{{ route('fe.articles.show', $article->slug) }}">
                        <h6 class="card-title text-secondary">{{ $article->title }}</h6>
                    </a>
                    <p class="card-text"><small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="row">
                <div class="col-12">
                    <div class="card  border-0 text-dark mb-5">
                        <img src="{{ $articles->first()->image_url }}" class="card-img" alt="..." style="filter: brightness(0.9)">
                        <div class="card-img-overlay">
                            <h5 class="card-title">{{ $article->first()->title }}</h5>
                            
                            <p class="card-text">{{ $articles->first()->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
                @foreach ($articles as $article)
                <div class="col-lg-12">
                    <div class="bg-white card border-0 mb-4">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}-image" class="rounded"
                                    style="height: 100%; object-fit: cover">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a href="{{ route('fe.articles.show', $article->slug) }}">
                                        <h5 class="card-title text-secondary">{{ $article->title }}</h5>
                                    </a>
                                    <p class="card-text">{!! Str::limit(strip_tags($article->body), 200) !!}</p>
                                    <p class="card-text"><small class="text-muted">{{
                                            $article->created_at->diffForHumans() }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="p-4  mb-3 rounded-lg" style="background: #7158e226">
                <h6 class="mb-4">Category</h6>
                @foreach ($categories as $category)
                <div class="mb-2"><a href="{{ route('fe.articles.index' ) }}?category={{ $category->name }}"><small
                            class="text-primary font-weight-bolder mr-2"><i
                                class="fa-solid fa-chevron-right"></i></small> {{ $category->name }}</a></div>
                @endforeach
            </div>
            <div class="p-4  mb-3 rounded-lg" style="background: #7158e226">
                <h6 class="mb-4">Latest Post</h6>
                @foreach ($articles->take(4) as $article)
                <div class="row mx-n2 mb-3 no-gutters">
                    <div class="col-4 px-1">
                        <img src="{{ $article->image_url }}" alt="" class="img-fluid rounded-lg">
                    </div>
                    <div class="col-8 px-1">
                        <h6><a class="font-weight-bol" href={{ route('fe.articles.show', $article->slug) }}>{{
                                $article->title }}</a></h6>
                        <div><small><i class="fa-solid fa-calendar-days"></i> {{
                                \Carbon\Carbon::create($article->created_at)->format('d M Y') }}</small></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="p-4  mb-3 rounded-lg bg-white">
                <h6 class="mb-4">Tag Populer</h6>
                @foreach ($tags as $tag)
                    <div class="mb-2"><h6>#{{ $tag->name }}</h6></div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
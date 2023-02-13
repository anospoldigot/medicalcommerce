@extends('layouts.frontend', [
    'disableHero'       => 1,
    'disableFooter'     => 1
])

@push('styles')
    <style>
        .icon-style{
            font-size: 50px;
        }

        .text-icon-style {
            vertical-align: center
        }
        
        .hero-container-contact{
            
        }

        .hero-contact{
            height: 300px;
            background: linear-gradient(
            to right,
            rgba(50, 115, 251, 0.4) 40%, rgba(255, 0, 0, 0) 100%
            ), url({{ asset('frontend/img/headerdoctor.jpg') }});
            background-size: cover;
            background-position: center center;
        }
    </style>
@endpush

@section('content')

    <div class="hero-container-contact mb-5">
        <div class="hero-contact">
            <div class="container h-100 d-flex align-items-center">
                <div class="text-white">
                    <h1>Article</h1>
                    <h6>Pertama mitra medika</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="row">
                    @foreach ($articles as $article)
                    <div class="col-lg-12">
                        <div class="bg-white card border-0 mb-4">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="rounded"
                                        style="height: 100%; object-fit: cover">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <a href="{{ route('fe.articles.show', $article->slug) }}"><h5 class="card-title text-secondary">{{ $article->title }}</h5></a>
                                        <p class="card-text">{!! Str::limit(strip_tags($article->body), 200) !!}</p>
                                        <p class="card-text"><small class="text-muted">{{ $article->created_at->diffForHumans() }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="bg-white card border-0 mb-4">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="rounded"
                                        style="height: 100%; object-fit: cover">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <a href="{{ route('fe.articles.show', $article->slug) }}"><h5 class="card-title text-secondary">{{ $article->title }}</h5></a>
                                        <p class="card-text">{!! Str::limit(strip_tags($article->body), 200) !!}</p>
                                        <p class="card-text"><small class="text-muted">{{ $article->created_at->diffForHumans() }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="bg-white card border-0 mb-4">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="rounded"
                                        style="height: 100%; object-fit: cover">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <a href="{{ route('fe.articles.show', $article->slug) }}"><h5 class="card-title text-secondary">{{ $article->title }}</h5></a>
                                        <p class="card-text">{!! Str::limit(strip_tags($article->body), 200) !!}</p>
                                        <p class="card-text"><small class="text-muted">{{ $article->created_at->diffForHumans() }}</small></p>
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
                        <div class="mb-2"><a href="{{ route('fe.articles.index' ) }}?category={{ $category->name }}"><small class="text-primary font-weight-bolder mr-2"><i class="fa-solid fa-chevron-right"></i></small> {{ $category->name }}</a></div>
                    @endforeach
                </div>
                <div class="p-4  mb-3 rounded-lg" style="background: #7158e226">
                    <h6 class="mb-4">Recent Post</h6>
                    @foreach ($articles as $article)
                        <div class="row mx-n2 mb-3 no-gutters">
                            <div class="col-4 px-1">
                                <img src="{{ $article->image_url }}" alt="" class="img-fluid rounded-lg">
                            </div>
                            <div class="col-8 px-1">
                                <h6><a class="font-weight-bol" href={{ route('fe.articles.show', $article->slug) }}>{{ $article->title }}</a></h6>
                                <div><small><i class="fa-solid fa-calendar-days"></i> {{ \Carbon\Carbon::create($article->created_at)->format('d M Y') }}</small></div>
                            </div>
                        </div>
                        <div class="row mx-n2 mb-3 no-gutters">
                            <div class="col-4 px-1">
                                <img src="{{ $article->image_url }}" alt="" class="img-fluid rounded-lg">
                            </div>
                            <div class="col-8 px-1">
                                <h6><a class="font-weight-bol" href={{ route('fe.articles.show', $article->slug) }}>{{ $article->title }}</a></h6>
                                <div><small><i class="fa-solid fa-calendar-days"></i> {{ \Carbon\Carbon::create($article->created_at)->format('d M Y') }}</small></div>
                            </div>
                        </div>
                        <div class="row mx-n2 mb-3 no-gutters">
                            <div class="col-4 px-1">
                                <img src="{{ $article->image_url }}" alt="" class="img-fluid rounded-lg">
                            </div>
                            <div class="col-8 px-1">
                                <h6><a class="font-weight-bol" href={{ route('fe.articles.show', $article->slug) }}>{{ $article->title }}</a></h6>
                                <div><small><i class="fa-solid fa-calendar-days"></i> {{ \Carbon\Carbon::create($article->created_at)->format('d M Y') }}</small></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{ $articles->links() }}
    </div>
@endsection

@push('scripts')
    
@endpush
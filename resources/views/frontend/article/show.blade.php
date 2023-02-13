@extends('layouts.frontend', [
    'disableHero'       => 1,
    'disableFooter'     => 1
])


@push('styes')
    <style>
        .text-gray{
            color: #808080;
        }
    </style>
@endpush

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-lg-8">
                <h1 class="mb-3">{{ $post->title }}</h1>
                Upload : {{ \Carbon\Carbon::create($post->created_at)->format('d M Y') }}
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="img-fluid mb-5">
                <div>
                    {!! $post->body !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-4">
                    <h6 class="text-gray mb-3">Tags</h6>
                    @foreach (explode(',', $post->tags) as $tag)
                        <span class="badge p-2 alert-primary">#{{ $tag }}</span>
                    @endforeach
                </div>
                <div class="mb-4">
                    <h6 class="text-gray mb-3">Kategori</h6>
                    <span class="badge p-2 alert-primary">Kesehatan</span>
                </div>

                <div class="p-4  mb-3 rounded-lg" style="background: #7158e226">
                    <h6 class="mb-4">Artikel Terkait</h6>
                    @foreach ($articles as $article)
                    <div class="row mx-n2 mb-3 no-gutters">
                        <div class="col-4 px-1">
                            <img src="{{ $article->image_url }}" alt="" class="img-fluid rounded-lg">
                        </div>
                        <div class="col-8 px-1">
                            <h6><a class="font-weight-bol" href={{ route('fe.articles.show', $article->slug) }}>{{ $article->title
                                    }}</a></h6>
                            <div><small><i class="fa-solid fa-calendar-days"></i> {{
                                    \Carbon\Carbon::create($article->created_at)->format('d M Y') }}</small></div>
                        </div>
                    </div>
                    <div class="row mx-n2 mb-3 no-gutters">
                        <div class="col-4 px-1">
                            <img src="{{ $article->image_url }}" alt="" class="img-fluid rounded-lg">
                        </div>
                        <div class="col-8 px-1">
                            <h6><a class="font-weight-bol" href={{ route('fe.articles.show', $article->slug) }}>{{ $article->title
                                    }}</a></h6>
                            <div><small><i class="fa-solid fa-calendar-days"></i> {{
                                    \Carbon\Carbon::create($article->created_at)->format('d M Y') }}</small></div>
                        </div>
                    </div>
                    <div class="row mx-n2 mb-3 no-gutters">
                        <div class="col-4 px-1">
                            <img src="{{ $article->image_url }}" alt="" class="img-fluid rounded-lg">
                        </div>
                        <div class="col-8 px-1">
                            <h6><a class="font-weight-bol" href={{ route('fe.articles.show', $article->slug) }}>{{ $article->title
                                    }}</a></h6>
                            <div><small><i class="fa-solid fa-calendar-days"></i> {{
                                    \Carbon\Carbon::create($article->created_at)->format('d M Y') }}</small></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
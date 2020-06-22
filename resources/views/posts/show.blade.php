@extends('layout')

@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)
  
@section('content')
<article class="post container">
    @if ($post->photos->count() === 1)
      <figure><img src="{{ $post->photos->first()->url}}" alt="" class="img-responsive"></figure>
    @elseif($post->photos->count() > 1)
      @include('posts.carousel')
    @elseif($post->iframe)
    <div class="iframe-wrapper">
      {!! $post->iframe !!}
    </div>
    @endif
    <div class="content-post">
      <header class="container-flex space-between">
        <div class="date">
          <span class="c-gris">{{ $post->published_at->format('M d')}}</span>
        </div>
        <div class="post-category">
          <span class="category">{{ $post->category->name }}</span>
        </div>
      </header>
    <h1>{{ $post->title }}</h1>
    <div class="divider"></div>
    <div class="image-w-text">
        <div>
            {!! $post->body !!}
        </div>
    </div>

    <footer class="container-flex space-between">
          
          @include('partials.social-links', ['description' => $post->title])

          <div class="tags container-flex">
            @foreach ($post->tags as $tag)
                <span class="tag c-gray-1 text-capitalize"># {{ $tag->name }}</span>
            @endforeach
          </div>
    </footer>
    @include('partials.disqus-script')
    </div>
</article>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/twitter-bootstrap.css') }}">
@endpush

@push('script')
    <script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/twitter-bootstrap.js')}}"></script>
@endpush


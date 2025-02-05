@extends('layout')

@section('content')
	<section class="posts container">
		@isset($title)
			<h3>{{ $title }}</h3>
		@endisset
		@foreach ($posts as $post)
			<article class="post">
				@if ($post->photos->count() === 1)
					<figure><img src="{{ Storage::url($post->photos->first()->url) }}" alt="" class="img-responsive"></figure>
				@elseif($post->photos->count() > 1)
					<div class="gallery-photos" data-masonry='{ "itemSelector" : ".grid-item", "columnWidth" : 464 }'>
						@foreach ($post->photos->take(4) as $photo)
							<figure class="grid-item  grid-item--height2">
								@if ($loop->iteration === 4)
									<div class="overlay">{{ $post->photos->count() }} Fotos</div>
								@endif
								<img src="{{ asset($photo->url) }}" class="img-responsive" alt="">
							</figure>
						@endforeach
					</div>
				@elseif($post->iframe)
					<div class="iframe-wrapper">
					  {!! $post->iframe !!}
					</div>
				@endif
				<div class="content-post">
					<header class="container-flex space-between">
						<div class="date">
							<span class="c-gray-1">{{ $post->published_at->format('M d') }}</span>
						</div>
						<div class="post-category">
							<span class="category text-capitalize">
								<a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a>
							</span>
						</div>
					</header>
					<h1>{{ $post->title }}</h1>
					<div class="divider"></div>
					<p>{{ $post->excerpt }}</p>
					<footer class="container-flex space-between">
						<div class="read-more">
							<a href="{{ route('posts.show', $post) }}" class="text-uppercase c-green">Leer más</a>
						</div>
						<div class="tags container-flex">
							@foreach ($post->tags as $tag)
								<span class="tag c-gray-1 text-capitalize"><a href="{{ route('tags.show', $tag) }}"># {{ $tag->name }}</a></span>
							@endforeach
						</div>
					</footer>
				</div>
			</article>
		@endforeach

	</section><!-- fin del div.posts.container -->
	
	{{ $posts->links() }}
	
@endsection


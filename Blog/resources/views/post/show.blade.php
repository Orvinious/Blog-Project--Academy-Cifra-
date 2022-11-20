@extends('layouts.main')
@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{ $post->title }}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up" data-aos-delay="200">• {{ $date->translatedFormat('F') }} {{ $date->day }}, {{ $date->year }} г. • {{ $date->format('H:i') }} • {{ $post->comments->count() }} Комментариев</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img src="{{asset('storage/' . $post->main_image)}}" alt="featured image" class="w-100">
            </section>
            <section class="py-4" data-aos="fade-up" data-aos-delay="200">
                @auth
                    <form action="{{ route('post.like.store', $post->id) }}" method="post">
                        @csrf
                        <span>{{$post->liked_users_count}}</span>
                        <button type="submit" class="border-0 bg-transparent">
                            @if(auth()->user()->likedPosts->contains($post->id))
                                <i class="fas fa-heart "></i> <a>  Нравится</a>
                            @else
                                <i class="far fa-heart "></i> <a>  Нравится</a>
                            @endif

                        </button>
                    </form>
                @endauth
                @guest()
                    <div>
                        <span>{{$post->liked_users_count}}</span>
                        <i class="fas fa-heart "></i> <a>  Нравится</a>
                    </div>
                @endguest
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto" data-aos="fade-up">
                        {!! $post->content !!}
                    </div>
                </div>

            </section>
            <section class="py-4" data-aos="fade-up" data-aos-delay="200">
                @auth
                <form action="{{ route('post.like.store', $post->id) }}" method="post">
                    @csrf
                    <span>{{$post->liked_users_count}}</span>
                    <button type="submit" class="border-0 bg-transparent">
                        @if(auth()->user()->likedPosts->contains($post->id))
                            <i class="fas fa-heart "></i> <a>  Нравится</a>
                        @else
                            <i class="far fa-heart "></i> <a>  Нравится</a>
                        @endif

                    </button>
                </form>
                @endauth
                @guest()
                    <div>
                        <span>{{$post->liked_users_count}}</span>
                        <i class="fas fa-heart "></i> <a>  Нравится</a>
                    </div>
                @endguest
            </section>
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <section class="related-posts">
                        <h2 class="section-title mb-4" data-aos="fade-up" data-aos-delay="200">Похожие посты</h2>
                        <div class="row">
                            @foreach($relatedPosts as $relatedPosts)
                            <div class="col-md-4" data-aos="fade-right" data-aos-delay="300">
                                <img src="{{ asset('storage/' . $relatedPosts->preview_image) }}" alt="related post" class="post-thumbnail">
                                <p class="post-category">{{ $relatedPosts->category->title }}</p>
                                <a href="{{route('post.show', $relatedPosts->id)}}"><h5 class="post-title">{{$relatedPosts->title}}</h5></a>
                            </div>
                            @endforeach
                        </div>
                    </section>

                    <section class="comment-list mb-6">
                        <h2 class="section-title mb-5" data-aos="fade-up" data-aos-delay="200">Комментарии ({{ $post->comments->count() }})</h2>
                    </section>

                    <section class="comment-list mb-6">
                        @foreach($post->comments as $comment)
                        <div class="comment-text mb-5">
                            <span class="username">
                                <div>
                                    {{ $comment->user->name }}
                                </div>
                                <span class="text-muted float-right">{{ $comment->dateAsCarbon->diffForHumans() }}</span>
                            </span>
                            {{ $comment->message }}
                        </div>
                        @endforeach
                    </section>
                    @auth
                    <section class="comment-section">
                        <h2 class="section-title mb-5" data-aos="fade-up">Оставить комментарий</h2>
                        <form action="{{route('post.comment.store', $post->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12" data-aos="fade-up">
                                    <label for="comment" class="sr-only">Comment</label>
                                    <textarea name="message" id="comment" class="form-control" placeholder="Ваш комментарий" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" data-aos="fade-up">
                                    <input type="submit" value="Отправить" class="btn btn-warning">
                                </div>
                            </div>
                        </form>
                    </section>
                    @endauth
                </div>
            </div>
        </div>
    </main>
@endsection

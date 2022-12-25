@extends('frontend.layouts.app')

@section('content')
    @include('frontend.partials.breadcrumb')

    <main class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="post-content">
                        <h5 class="title">{{ $post->title }}</h5>
                        <div class="published">
                            <span>
                                <i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') }}
                            </span>
                            <span>
                                <i class="fas fa-user"></i>
                                {{ $post->user->name }}
                            </span>
                        </div>
                        <div class="medsos-share">
                            <h6>Bagikan:</h6>
                            <div class="sosmed-group">
                                <a class="btn-sosmed btn-facebook"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}"
                                    role="button" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-sosmed btn-twitter"
                                    href="https://twitter.com/share?text={{ $post->excerpt }}&url={{ Request::fullUrl() }}/ %23simkesdatapsel %23tapsel %23dinkes %23kesehatan %23dinkestapsel"
                                    role="button" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a class="btn-sosmed btn-whatsapp"
                                    href="whatsapp://send?text=*{{ $post->title }}* %0A%0A{{ $post->excerpt }} %0A%0A{{ Request::fullUrl() }}"
                                    role="button" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>

                        <img src="{{ $post->image ? $post->image_path : 'https://source.unsplash.com/900x600/?covid' }}"
                            alt="Berita Image" class="w-100 mt-3">

                        <article class="main-article">
                            {!! $post->body !!}
                        </article>

                        @include('frontend.partials.content.nav-page', [
                            'route' => 'post.show',
                            'prev' => $prevPost,
                            'next' => $nextPost,
                        ])
                    </div>
                </div>
                <div class="col-lg-4 widget-side">
                    @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </main>
@endsection

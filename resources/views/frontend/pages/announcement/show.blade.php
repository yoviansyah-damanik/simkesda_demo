@extends('frontend.layouts.app')

@section('content')
    @include('frontend.partials.breadcrumb')

    <main class="main">

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="post-content">
                        <h5 class="title">{{ $announcement->title }}</h5>
                        <div class="published">
                            <span>
                                <i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($announcement->published_at)->translatedFormat('d F Y') }}
                            </span>
                            <span>
                                <i class="fas fa-user"></i>
                                {{ $announcement->user->name }}
                            </span>
                        </div>
                        <div class="medsos-share">
                            <h6>Bagikan:</h6>
                            <div class="sosmed-group">
                                <a class="btn-sosmed btn-facebook"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}"
                                    role="button" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-sosmed btn-twitter"
                                    href="https://twitter.com/share?text={{ $announcement->excerpt }}&url={{ Request::fullUrl() }}/ %23simkesdatapsel %23tapsel %23dinkes %23kesehatan %23dinkestapsel"
                                    role="button" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a class="btn-sosmed btn-whatsapp"
                                    href="whatsapp://send?text=*{{ $announcement->title }}* %0A%0A{{ $announcement->excerpt }} %0A%0A{{ Request::fullUrl() }}"
                                    role="button" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>

                        <article class="main-article">
                            {!! $announcement->body !!}
                        </article>

                        @include('frontend.partials.content.nav-page', [
                            'route' => 'announcement.show',
                            'prev' => $prevAnnouncement,
                            'next' => $nextAnnouncement,
                        ])
                    </div>
                </div>
                <div class="col-md-4">
                    @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </main>
@endsection

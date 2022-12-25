@extends('frontend.layouts.app')

@section('content')
    {{-- SLIDER --}}
    <div class="slider">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-0">
                    <div id="homepageSlider" class="carousel my-auto slide" data-bs-ride="true">
                        <div class="carousel-indicators">
                            @for ($x = 0; $x < $sliders->count(); $x++)
                                <button type="button" data-bs-target="#homepageSlider" data-bs-slide-to="{{ $x }}"
                                    class="active" aria-current="true" aria-label="Slide {{ $x + 1 }}"></button>
                            @endfor
                        </div>
                        <div class="carousel-inner">
                            @foreach ($sliders as $slider)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img src="{{ $slider->image_path }}" class="w-100" alt="Slider">
                                    @if ($slider->title)
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{ $slider->title }}</h5>
                                            <p>{{ $slider->description }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#homepageSlider"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#homepageSlider"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="slider-body">
                        <div class="slider-title">
                            Sarana Pelayanan Kesehatan Tahun {{ date('Y') }}
                        </div>
                        <div class="row justify-content-center mx-0">
                            @foreach ($counts as $count)
                                <div class="col-4 col-md-6 px-1 px-md-3 @if (!$loop->last) mb-3 @endif">
                                    <div class="counter-box">
                                        <div class="title">
                                            {{ $count['label'] }}
                                        </div>
                                        <div class="counter">
                                            {{ $count['count'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="slider-closing">
                            *) Data diperoleh dari profil puskesmas yang telah terdata pada SIMKESDA.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END OF SLIDER --}}

    {{-- COUNTING --}}
    {{-- END OF COUNTING --}}

    {{-- MAIN CONTENT --}}
    <main class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    {{-- BERITA --}}
                    <div class="content-box">
                        <div class="title">Berita Terkini</div>
                        <div class="subtitle">
                            Seputar Informasi Kesehatan di Demo Version.
                        </div>
                        @if ($posts->count())
                            <div class="content-data">
                                <div class="row">
                                    @foreach ($posts as $post)
                                        <div class="col-6 col-md-4 mb-2 px-1">
                                            @include('frontend.partials.content.post-box')
                                        </div>
                                    @endforeach
                                </div>
                                <a href="{{ route('post') }}" class="see-more">
                                    <i class="fas fa-reply-all"></i>
                                    Lihat selengkapnya
                                </a>
                            </div>
                        @else
                            @include('frontend.partials.content.data-not-found')
                        @endif
                    </div>

                    {{-- END OF BERITA --}}
                    {{-- PENGUMUMAN --}}
                    <div class="content-box">
                        <div class="title">Pengumuman</div>
                        <div class="subtitle">
                            Pengumuman resmi Dinas Kesehatan Demo Version.
                        </div>
                        @if ($announcements->count())
                            <div class="content-data">
                                <div class="row">
                                    @foreach ($announcements as $announcement)
                                        <div class="col-md-6 mb-2 px-1">
                                            @include('frontend.partials.content.announcement-box')
                                        </div>
                                    @endforeach
                                </div>
                                <a href="{{ route('announcement') }}" class="see-more">
                                    <i class="fas fa-reply-all"></i>
                                    Lihat selengkapnya
                                </a>
                            </div>
                        @else
                            @include('frontend.partials.content.data-not-found')
                        @endif
                    </div>
                    {{-- END OF PENGUMUMAN --}}
                </div>
                <div class="col-md-4">
                    @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </main>
    {{-- END OF MAIN CONTENT --}}
@endsection

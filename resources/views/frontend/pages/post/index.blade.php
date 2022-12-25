@extends('frontend.layouts.app')

@section('content')
    @include('frontend.partials.breadcrumb')
    <main class="content">
        <div class="container">
            <div class="content-box">
                <h4 class="title">Berita</h4>
                <div class="subtitle">
                    Seputar Informasi Kesehatan di Kabupaten Tapanuli Selatan.
                </div>
                @if ($posts->count())
                    <div class="content-data">
                        <div class="row">
                            @foreach ($posts as $post)
                                <div class="col-6 col-md-3 mb-2 px-1">
                                    @include('frontend.partials.content.post-box')
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @include('frontend.partials.content.result-data', ['data' => $posts])
                @else
                    @include('frontend.partials.content.data-not-found')
                @endif
            </div>
        </div>
    </main>
@endsection

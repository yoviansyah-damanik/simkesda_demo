@extends('frontend.layouts.app')

@section('content')
    @include('frontend.partials.breadcrumb')
    <main class="content">
        <div class="container">
            <div class="content-box">
                <h4 class="title">Pengumuman</h4>
                <div class="subtitle">
                    Pengumuman resmi Dinas Kesehatan Kabupaten Tapanuli Selatan.
                </div>
                @if ($announcements->count())
                    <div class="content-data">
                        <div class="row">
                            @foreach ($announcements as $announcement)
                                <div class="col-md-4 mb-2 px-1">
                                    @include('frontend.partials.content.announcement-box')
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @include('frontend.partials.content.result-data', ['data' => $announcements])
                @else
                    @include('frontend.partials.content.data-not-found')
                @endif
            </div>
        </div>
    </main>
@endsection

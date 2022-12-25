@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        @if ($notification)
            <div class="announce">
                <div class="title">
                    <h4 class="content-title">{{ $notification->title }}</h4>
                    <small>
                        {{ \Carbon\Carbon::parse($notification->updated_at)->translatedFormat('l, d F Y H:i') }}
                        |
                        Oleh: {{ $notification->user->name }}
                    </small>
                </div>
                {!! $notification->body !!}
            </div>
        @else
            <div class="announce">
                <div class="title">
                    <h4 class="content-title">Pemberitahuan</h4>
                </div>
                <p>
                    Tidak ada pemberitahuan tersedia.
                </p>
            </div>
        @endif
        <hr />
        <div class="row">
            @foreach ($data_index as $val)
                <h4 class="content-title @if ($loop->iteration > 1) mt-3 @endif">
                    {{ $val['label'] }}
                </h4>
                @foreach ($val['items'] as $item)
                    <div class="col-md-6 col-xl-3">
                        <article class="stat-cards-item">
                            @php
                                if ($item['type'] == 0) {
                                    $status = 'warning';
                                } elseif ($item['type'] == 1) {
                                    $status = 'info';
                                } elseif ($item['type'] == 2) {
                                    $status = 'success';
                                } else {
                                    $status = 'danger';
                                }
                            @endphp
                            <div class="stat-cards-icon {{ $status }}">
                                <i class="fas fa-chart-column" aria-hidden="true"></i>
                            </div>
                            <div class="stat-cards-info">
                                <p class="stat-cards-info__num">
                                    @numb($item['item'])
                                </p>
                                <p class="stat-cards-info__title">
                                    @php
                                        if ($item['type'] == 0) {
                                            $class = 'text-warning';
                                        } elseif ($item['type'] == 1) {
                                            $class = 'text-info';
                                        } elseif ($item['type'] == 2) {
                                            $class = 'text-success';
                                        } else {
                                            $class = 'text-danger';
                                        }
                                    @endphp

                                    <span class="{{ $class }}">
                                        {{ $item['title'] }}
                                    </span>
                                </p>
                                <p class="stat-cards-info__progress">
                                    <span class="stat-cards-info__profit primary">
                                        <i class="fas fa-percent" aria-hidden="true"></i>
                                        @decimal($item['percentage'])
                                    </span>
                                </p>
                            </div>
                            <a href="{{ $item['link'] }}" class="stretched-link"></a>
                        </article>
                    </div>
                @endforeach
            @endforeach
        </div>
        <hr>
        {{-- TEMPLATE PRIORITAS --}}
        {{-- <h4 class="content-title">Template Prioritas</h4> --}}

        @foreach ($prioritas as $val)
            <h4 class="content-title @if ($loop->iteration > 1) mt-3 @endif">{{ $val['label'] }}</h4>
            <div class="row">
                @foreach ($val['items'] as $item)
                    <div class="col-md-6 col-xl-3">
                        <article class="stat-cards-item">
                            @php
                                if ($item['type'] == 0) {
                                    $status = 'warning';
                                } elseif ($item['type'] == 1) {
                                    $status = 'info';
                                } elseif ($item['type'] == 2) {
                                    $status = 'success';
                                } else {
                                    $status = 'danger';
                                }
                            @endphp
                            <div class="stat-cards-icon {{ $status }}">
                                <i class="fas fa-chart-column" aria-hidden="true"></i>
                            </div>
                            <div class="stat-cards-info">
                                <p class="stat-cards-info__num">
                                    @numb($item['item'])
                                </p>
                                <p class="stat-cards-info__title">
                                    @if ($item['type'] == 0)
                                        <span class="text-warning">
                                            Draft
                                        </span>
                                    @elseif ($item['type'] == 1)
                                        <span class="text-info">
                                            Proses Pemeriksaan
                                        </span>
                                    @elseif ($item['type'] == 2)
                                        <span class="text-success">
                                            Verifikasi
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            Periksa Kembali
                                        </span>
                                    @endif
                                </p>
                                <p class="stat-cards-info__progress">
                                    <span class="stat-cards-info__profit primary">
                                        <i class="fas fa-percent" aria-hidden="true"></i>
                                        @decimal($item['percentage'])
                                    </span>
                                </p>
                            </div>
                            <a href="{{ $item['link'] }}" class="stretched-link"></a>
                        </article>
                    </div>
                @endforeach
            </div>
        @endforeach
        <!-- Chart's container -->
        {{-- <div id="template-prioritas-chart" style="height: 300px;"></div> --}}

        <hr>

        {{-- SPM --}}
        {{-- <h4 class="content-title">SPM</h4> --}}

        {{-- <div id="spm-chart" style="height: 300px;"></div> --}}

        @foreach ($spm as $val)
            <h4 class="content-title @if ($loop->iteration > 1) mt-3 @endif">{{ $val['label'] }}</h4>
            <div class="row">
                @foreach ($val['items'] as $item)
                    <div class="col-md-6 col-xl-3">
                        <article class="stat-cards-item">
                            @php
                                if ($item['type'] == 0) {
                                    $status = 'warning';
                                } elseif ($item['type'] == 1) {
                                    $status = 'info';
                                } elseif ($item['type'] == 2) {
                                    $status = 'success';
                                } else {
                                    $status = 'danger';
                                }
                            @endphp
                            <div class="stat-cards-icon {{ $status }}">
                                <i class="fas fa-chart-column" aria-hidden="true"></i>
                            </div>
                            <div class="stat-cards-info">
                                <p class="stat-cards-info__num">
                                    @numb($item['item'])
                                </p>
                                <p class="stat-cards-info__title">
                                    @if ($item['type'] == 0)
                                        <span class="text-warning">
                                            Draft
                                        </span>
                                    @elseif ($item['type'] == 1)
                                        <span class="text-info">
                                            Proses Pemeriksaan
                                        </span>
                                    @elseif ($item['type'] == 2)
                                        <span class="text-success">
                                            Verifikasi
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            Periksa Kembali
                                        </span>
                                    @endif
                                </p>
                                <p class="stat-cards-info__progress">
                                    <span class="stat-cards-info__profit primary">
                                        <i class="fas fa-percent" aria-hidden="true"></i>
                                        @decimal($item['percentage'])
                                    </span>
                                </p>
                            </div>
                            <a href="{{ $item['link'] }}" class="stretched-link"></a>
                        </article>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

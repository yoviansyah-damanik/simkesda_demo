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
                    <div class="col-md-6 col-xl-3">
                        <article class="stat-cards-item">
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

        <hr />
        <h4 class="content-title">
            Notifikasi Sistem
        </h4>

        {{-- NOTIFIKASI PRIORITAS --}}
        <div class="row">
            @if ($nps)
                <div class="col-md-6 col-xl-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon danger">
                            <i class="fas fa-info" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                            <p class="stat-cards-info__num">
                                Tahun {{ $nps->tahun }}
                            </p>
                            <p class="stat-cards-info__title">
                                <span class="text-danger">
                                    Template Prioritas - Data Sasaran
                                </span>
                            </p>
                            <p class="stat-cards-info__progress">
                                <span class="stat-cards-info__profit primary">
                                    Segera diperbaiki
                                </span>
                            </p>
                        </div>
                        <a href="{{ route('dashboard.priority.target', ['v' => $nps->slug]) }}" class="stretched-link"></a>
                    </article>
                </div>
            @else
                <div class="col-md-6 col-xl-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon primary">
                            <i class="fas fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                            <p class="stat-cards-info__num">
                                Selesai
                            </p>
                            <p class="stat-cards-info__title">
                                <span class="text-primary">
                                    Template Prioritas - Data Sasaran
                                </span>
                            </p>
                            <p class="stat-cards-info__progress">
                                <span class="stat-cards-info__profit primary">
                                    Tidak ada perbaikan
                                </span>
                            </p>
                        </div>
                    </article>
                </div>
            @endif

            @if ($npb)
                <div class="col-md-6 col-xl-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon danger">
                            <i class="fas fa-info" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                            <p class="stat-cards-info__num">
                                Bulan {{ Carbon\Carbon::parse(date('Y-' . $npb->bulan . '-01'))->translatedFormat('F') }}
                                Tahun {{ $npb->tahun }}
                            </p>
                            <p class="stat-cards-info__title">
                                <span class="text-danger">
                                    Template Prioritas - Data Bulanan
                                </span>
                            </p>
                            <p class="stat-cards-info__progress">
                                <span class="stat-cards-info__profit primary">
                                    Segera diperbaiki
                                </span>
                            </p>
                        </div>
                        <a href="{{ route('dashboard.priority.monthly', ['v' => $npb->slug]) }}"
                            class="stretched-link"></a>
                    </article>
                </div>
            @else
                <div class="col-md-6 col-xl-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon primary">
                            <i class="fas fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                            <p class="stat-cards-info__num">
                                Selesai
                            </p>
                            <p class="stat-cards-info__title">
                                <span class="text-primary">
                                    Template Prioritas - Data Bulanan
                                </span>
                            </p>
                            <p class="stat-cards-info__progress">
                                <span class="stat-cards-info__profit primary">
                                    Tidak ada perbaikan
                                </span>
                            </p>
                        </div>
                    </article>
                </div>
            @endif

            @if ($npt)
                <div class="col-md-6 col-xl-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon danger">
                            <i class="fas fa-info" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                            <p class="stat-cards-info__num">
                                Tahun {{ $npt->tahun }}
                            </p>
                            <p class="stat-cards-info__title">
                                <span class="text-danger">
                                    Template Prioritas - Data Tahunan
                                </span>
                            </p>
                            <p class="stat-cards-info__progress">
                                <span class="stat-cards-info__profit primary">
                                    Segera diperbaiki
                                </span>
                            </p>
                        </div>
                        <a href="{{ route('dashboard.priority.yearly', ['v' => $npt->slug]) }}" class="stretched-link"></a>
                    </article>
                </div>
            @else
                <div class="col-md-6 col-xl-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon primary">
                            <i class="fas fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                            <p class="stat-cards-info__num">
                                Selesai
                            </p>
                            <p class="stat-cards-info__title">
                                <span class="text-primary">
                                    Template Prioritas - Data Bulanan
                                </span>
                            </p>
                            <p class="stat-cards-info__progress">
                                <span class="stat-cards-info__profit primary">
                                    Tidak ada perbaikan
                                </span>
                            </p>
                        </div>
                    </article>
                </div>
            @endif
        </div>

        {{-- NOTIFIKASI SPM --}}
        <div class="row">
            @if ($nss)
                <div class="col-md-6 col-xl-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon danger">
                            <i class="fas fa-info" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                            <p class="stat-cards-info__num">
                                Tahun {{ $nss->tahun }}
                            </p>
                            <p class="stat-cards-info__title">
                                <span class="text-danger">
                                    SPM - Data Tahunan
                                </span>
                            </p>
                            <p class="stat-cards-info__progress">
                                <span class="stat-cards-info__profit primary">
                                    Segera diperbaiki
                                </span>
                            </p>
                        </div>
                        <a href="{{ route('dashboard.spm.target', ['v' => $nss->slug]) }}" class="stretched-link"></a>
                    </article>
                </div>
            @else
                <div class="col-md-6 col-xl-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon primary">
                            <i class="fas fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                            <p class="stat-cards-info__num">
                                Selesai
                            </p>
                            <p class="stat-cards-info__title">
                                <span class="text-primary">
                                    Template Prioritas - Data Bulanan
                                </span>
                            </p>
                            <p class="stat-cards-info__progress">
                                <span class="stat-cards-info__profit primary">
                                    Tidak ada perbaikan
                                </span>
                            </p>
                        </div>
                    </article>
                </div>
            @endif

            @if ($nst)
                <div class="col-md-6 col-xl-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon danger">
                            <i class="fas fa-info" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                            <p class="stat-cards-info__num">
                                Tahun {{ $nst->tahun }}
                            </p>
                            <p class="stat-cards-info__title">
                                <span class="text-danger">
                                    SPM - Data Tahunan
                                </span>
                            </p>
                            <p class="stat-cards-info__progress">
                                <span class="stat-cards-info__profit primary">
                                    Segera diperbaiki
                                </span>
                            </p>
                        </div>
                        <a href="{{ route('dashboard.spm.yearly', ['v' => $nst->slug]) }}" class="stretched-link"></a>
                    </article>
                </div>
            @else
                <div class="col-md-6 col-xl-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon primary">
                            <i class="fas fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                            <p class="stat-cards-info__num">
                                Selesai
                            </p>
                            <p class="stat-cards-info__title">
                                <span class="text-primary">
                                    Template Prioritas - Data Bulanan
                                </span>
                            </p>
                            <p class="stat-cards-info__progress">
                                <span class="stat-cards-info__profit primary">
                                    Tidak ada perbaikan
                                </span>
                            </p>
                        </div>
                    </article>
                </div>
            @endif
        </div>
    </div>
@endsection

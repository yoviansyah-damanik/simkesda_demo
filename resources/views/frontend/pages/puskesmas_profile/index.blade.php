@extends('frontend.layouts.app')

@section('content')
    @include('frontend.partials.breadcrumb')

    <main class="content">

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="col-lg-8">
                        <form action="">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control shadow-4"
                                    placeholder="Cari puskesmas berdasarkan nama..." aria-label="Recipient's username"
                                    aria-describedby="button-addon2" name="cari" required value="{{ $cari }}">
                                <a class="btn btn-danger" href="/puskesmas">
                                    <i class="fas fa-redo"></i> Refresh
                                </a>
                                <button class="btn btn-primary" type="submit" id="button-addon2">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                    @if ($puskesmas->count() > 0)
                        <div class="row mt-4">
                            @foreach ($puskesmas as $item)
                                <div class="puskesmas-card col-12 wow animate__animated animate__fadeIn">
                                    <div class="puskesmas-year">
                                        {{ $item->tahun }}
                                    </div>
                                    <div class="puskesmas-body">
                                        <div class="title">
                                            {{ $item->user->name }}
                                        </div>
                                        <p class="type">
                                            {{ $item->jenis_puskesmas }}
                                        </p>
                                        <p class="address">
                                            {{ $item->alamat_puskesmas . ', ' . $item->village->name . ', ' . $item->district->name . ', ' . $item->regency->name . ', ' . $item->province->name . ', ' . $item->kode_pos }}
                                        </p>
                                        <span class="updated">
                                            Terakhir diperbaharui: {{ $item->updated_at->translatedFormat('d/m/Y H:i') }}
                                        </span>
                                        <div class="text-end mt-3 mt-md-0">
                                            <a type="button" class="read-more"
                                                href="{{ route('puskesmas.show', $item->slug) }}">
                                                Lihat Profil Puskesmas
                                                <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @include('frontend.partials.content.result-data', ['data' => $puskesmas])
                    @else
                        @include('frontend.partials.content.data-not-found')
                    @endif
                </div>
                <div class="col-lg-4">
                    @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </main>

@endsection

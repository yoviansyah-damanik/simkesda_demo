@extends('frontend.layouts.app')

@section('content')
    @include('frontend.partials.breadcrumb')

    <main class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="puskesmas-detail-header">
                        <div class="title">
                            {{ $puskesmas->nama_puskesmas }}
                        </div>

                        <h4 class="year-title">Tahun Profil</h4>
                        <div class="list-group">
                            @foreach ($years as $year)
                                <a href="{{ route('puskesmas.show', $year->slug) }}"
                                    class="list-group-item list-group-item-action @if ($year->tahun == $puskesmas->tahun) active @endif"
                                    aria-current="true">
                                    {{ $year->tahun }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="puskesmas-detail">
                        @include('backend.partials.field_data.profil_puskesmas', ['data' => $puskesmas])
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

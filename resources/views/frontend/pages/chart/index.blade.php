@extends('frontend.layouts.app')

@section('content')
    @include('frontend.partials.breadcrumb')

    <main class="content">
        <div class="container">
            <div class="content-box">
                <div class="title">
                    Grafik Data
                </div>
                <div class="subtitle">
                    Silahkan pilih data yang akan ditampilkan.
                </div>

                <div class="chart-option">
                    <div class="title">
                        Pelayanan Kesehatan
                    </div>
                    <div class="row justify-content-center align-items-center p-4">
                        @foreach ($priority as $item)
                            <div class="col-6 col-md-2 mb-3">
                                <div class="chart-box" title="{{ $item['title'] }}">
                                    <span>
                                        {{ $item['title'] }}
                                    </span>
                                    <a href="{{ route('chart.show', ['year' => date('Y'), 'chart' => $item['attribute']]) }}"
                                        class="stretched-link"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="chart-option">
                    <div class="title">
                        Standar Pelayanan Masyarakat
                    </div>
                    <div class="row justify-content-center align-items-center p-4">
                        @foreach ($spm as $item)
                            <div class="col-md-3 mb-3">
                                <div class="chart-box" title="{{ $item['title'] }}">
                                    <span>
                                        {{ $item['title'] }}
                                    </span>
                                    <a href="{{ route('chart.show', ['year' => date('Y'), 'chart' => $item['attribute']]) }}"
                                        class="stretched-link"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

{{-- @push('scripts')
    <script type="text/javascript">
        $(document).ready(() => {
            var year = $('#year').select2({
                theme: 'bootstrap-5',
                language: 'id',
                placeholder: '--Pilih Tahun--'
            })
            var chart = $('#chart').select2({
                theme: 'bootstrap-5',
                language: 'id',
                placeholder: '--Pilih Layanan--',
            })

            year.val(null).trigger('change')
            chart.val(null).trigger('change')
        })
    </script>
@endpush --}}

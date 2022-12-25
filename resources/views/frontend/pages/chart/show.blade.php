@extends('frontend.layouts.app')

@section('content')
    @include('frontend.partials.breadcrumb')

    <main class="content">
        <div class="container-fluid mx-0 px-0">
            <div class="content-box">
                <div class="title">
                    Grafik Data
                </div>

                <div class="chart-page">
                    <div class="chart-lists">
                        <div class="chart-filter">
                            <form action="">
                                <div class="form-group mb-3">
                                    <label for="year_change">Tahun</label>
                                    <select class="form-select" name="year_change" id="year_change">
                                        @for ($x = date('Y'); $x >= 2017; $x--)
                                            <option @if ($x == $year) selected @endif
                                                value="{{ $x }}">
                                                {{ $x }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <button class="btn btn-danger w-100 rounded-pill">
                                    <i class="fas fa-repeat"></i>
                                    Ubah
                                </button>
                            </form>
                        </div>
                        <div class="chart-list">
                            <div class="title">Pelayanan Kesehatan</div>
                            @foreach ($priority as $item)
                                <a {{ $item['active'] == true ? 'class=active' : '' }}
                                    href="{{ route('chart.show', ['year' => $year, 'chart' => $item['attribute']]) }}">
                                    {{ $item['title'] }}
                                    @if ($item['active'] == true)
                                        <i class="fas fa-arrow-left"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                        <div class="chart-list">
                            <div class="title">Standar Pelayanan Masyarakat</div>
                            @foreach ($spm as $item)
                                <a {{ $item['active'] == true ? 'class=active' : '' }}
                                    href="{{ route('chart.show', ['year' => $year, 'chart' => $item['attribute']]) }}">
                                    {{ $item['title'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="chart-view">
                        <div class="chart-profile">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th width=120px>Dataset</th>
                                    <td width=8px>:</td>
                                    <td>{{ $dataset }}</td>
                                </tr>
                                <tr>
                                    <th>Judul</th>
                                    <td>:</td>
                                    <td>{{ $title }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun</th>
                                    <td>:</td>
                                    <td>{{ $year }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="chart-display">
                            <div id="chartdiv"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script type="text/javascript">
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            // Add data
            chart.data = {!! $data !!};

            // Create axes
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "label";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 0;
            let label = categoryAxis.renderer.labels.template;
            label.fontSize = 10;
            label.tooltipText = "{category}";
            categoryAxis.events.on("sizechanged", function(ev) {
                var axis = ev.target;
                axis.renderer.labels.template.rotation = -65;
                axis.renderer.labels.template.horizontalCenter = "right";
                axis.renderer.labels.template.verticalCenter = "middle";
            })


            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY =
                "total";
            series.dataFields.categoryX = "label";
            series.name = "Total";
            series.columns.template
                .tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;

            series.columns.template.adapter.add("fill", (fill, target) => {
                return target.dataItem ? chart.colors.getIndex(target.dataItem.index) : fill;
            });

            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 2;
            columnTemplate
                .strokeOpacity = 1;

        }); // end am4core.ready()
    </script>
@endpush

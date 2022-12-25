<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-size: 10pt;
        }

        .symbol {
            text-align: center;
        }

        table {
            width: 100%;
        }

        .bordered {
            margin-top: 1rem;
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
        }

        .bordered th {
            text-align: center;
        }

        .bordered td,
        .bordered th {
            border: 1px solid #ddd;
            padding: 3px;
        }

        .bordered tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .bordered tr:hover {
            background-color: #ddd;
        }

        .bordered th {
            padding-top: 8px;
            padding-bottom: 8px;
            background-color: #04AA6D;
            color: white;
        }

        .bordered td {
            vertical-align: top;
        }

        .page-break {
            page-break-after: always;
        }

        .header {
            height: 100px;
            vertical-align: middle;
            border-bottom: 10px double #000;
            margin-bottom: 1rem;
            position: relative;
            /* width: 1100px; */
            margin-left: auto;
        }

        .top_right {
            text-align: right;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
        }

        .top_right h4 {
            font-size: 1.2em;
        }

        .top_right p {
            text-transform: uppercase;
            font-weight: bold;
        }

        .img-logo {
            height: 90px;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
        }

        ol.no_urut {
            margin: 0;
            font-size: .8em;
            padding: 0;
            list-style-type: none;
        }

        ol.no_urut li {
            display: inline;
            margin-right: 2px;
        }
    </style>
</head>

<body>

    @include('backend.pages.report.page_number_landscape')

    <div class="header">
        <img src="{{ asset('images/logo-dinkes.png') }}" class="img-logo">
        <div class="top_right">
            <h4 style="color:#267a5d; margin: 0">SIMKESDA</h4>
            <p style="margin: 0">Sistem Informasi Kesehatan Daerah</p>
            <p style="margin: 0">Kabupaten Tapanuli Selatan</p>
        </div>
    </div>

    <table>
        <tr>
            <th width="15%" style="text-align:left">Template Prioritas</th>
            <td>: Data Sasaran</td>
        </tr>
        <tr>
            <th style="text-align:left">Puskesmas</th>
            <td>: Semua Puskesmas</td>
        </tr>
        <tr>
            <th style="text-align:left">Tahun</th>
            <td>: {{ $tahun }}</td>
        </tr>
    </table>

    <table class="bordered">
        <thead>
            <tr>
                <th rowspan=2 width="3%">#</th>
                <th rowspan=2 width="30%">Uraian</th>
                <th colspan={{ $data->count() }}>Puskesmas</th>
                <th rowspan=2>Total</th>
            </tr>
            <tr>
                @foreach ($data as $val)
                    <th>({{ $loop->iteration }})</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @for ($x = 0; $x < count($att); $x++)
                @php
                    $total = 0;
                @endphp
                <tr>
                    <td style="text-align:center;">{{ $x + 1 }}</td>
                    <td>{{ $att[$x]['title'] }}</td>
                    {{-- @for ($y = 0; $y <= 5; $y++) --}}
                    {{-- @foreach ($data as $val)
                        <td style="text-align:right;">@numb(mt_rand(100,9999))</td>
                        @php
                            $total += mt_rand(100, 9999);
                        @endphp
                    @endforeach --}}
                    {{-- @endfor --}}
                    @foreach ($data as $val)
                        <td style="text-align:right;">@numb($val->{$att[$x]['attribute']})</td>
                        @php
                            $total += $val->{$att[$x]['attribute']};
                        @endphp
                    @endforeach
                    <td style="text-align:right; font-weight:bold;">@numb($total)</td>
                </tr>
            @endfor
        </tbody>
    </table>


    <p style="margin:0; margin-top:1rem; font-weight:bold; font-size:.8em">Nomor Urut Puskesmas:</p>

    <ol class="no_urut">
        {{-- @for ($x = 0; $x <= 5; $x++) --}}
        @foreach ($data as $val)
            <li>
                ({{ $loop->iteration }})
                {{ Str::upper($val->user->name) }};
            </li>
        @endforeach
        {{-- @endfor --}}
    </ol>

    {{-- @include('dashboard.laporan.ttd_kadis') --}}
</body>

</html>

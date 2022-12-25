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

        /* .bordered tr:nth-child(even) {
            background-color: #f2f2f2;
        } */

        .bordered tr:hover {
            background-color: #ddd;
        }

        .bordered th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #04AA6D;
            color: white;
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
    </style>
</head>

<body>

    @include('backend.pages.report.page_number')

    <div class="header">
        <img src="{{ asset('images/logo-dinkes.png') }}" class="img-logo">
        <div class="top_right">
            <h4 style="color:#267a5d; margin: 0">SIMKESDA</h4>
            <p style="margin: 0">Sistem Informasi Kesehatan Daerah</p>
            <p style="margin: 0">Demo Version</p>
        </div>
    </div>

    <table>
        <tr>
            <th width="25%" style="text-align:left">SPM</th>
            <td>: Data Tahunan</td>
        </tr>
        <tr>
            <th style="text-align:left">Puskesmas</th>
            <td>: {{ $data->user->name }}</td>
        </tr>
        <tr>
            <th style="text-align:left">Tahun</th>
            <td>: {{ $tahun }}</td>
        </tr>
    </table>

    <table class="bordered">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="65%">Uraian</th>
                <th>Satuan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @for ($x = 0; $x < count($att); $x++)
                <tr>
                    <th colspan=4 style="text-align:center; padding:0; background-color: #267a5d40; color:#000;">
                        {{ $att[$x]['label'] }}
                    </th>
                </tr>
                <tr>
                    <td style="text-align:center">{{ $x + 1 }}</td>
                    <td>{{ $att[$x]['title'] }}</td>
                    <td style="text-align:center">{{ $data->{$att[$x]['satuan']} }}</td>
                    <td style="text-align:right">@numb($data->{$att[$x]['attribute']})</td>
                </tr>
            @endfor
        </tbody>
    </table>

    @include('backend.pages.report.ttd_field_f')
</body>

</html>

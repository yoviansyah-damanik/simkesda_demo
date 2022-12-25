<style>
    .ttd-flex {
        text-align: right;
    }

    .ttd-field {
        display: inline-block;
        position: relative;
        text-align: center;
        margin-top: 1.5rem;
        /* border: 1px solid #ddd; */
    }

    .space-ttd {
        height: 3.5rem;
    }

    .ttd-field {
        font-size: 1em;
    }

    .ttd-field p {
        margin: 0;
    }

    .nama-ttd p {
        font-weight: bold;
    }

    .nama-ttd p:first-child {
        text-decoration: underline;
    }
</style>

<div class="ttd-flex">
    <div class="ttd-field">
        <p>Tapanuli Selatan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>
            <strong>KEPALA DINAS KESEHATAN</strong>
        </p>
        <p>
            <strong>Demo Version</strong>
        </p>
        <div class="space-ttd"></div>
        <div class="nama-ttd">
            <p>
                {{ $kadis['name'] }}
            </p>
            <p>
                NIP. {{ $kadis['nip'] }}
            </p>
        </div>
    </div>
</div>

@include('backend.pages.report.agent')

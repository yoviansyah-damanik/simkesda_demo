<style>
    .flex {
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
        padding: 1.7rem 0;
        /* height: 4.5rem; */
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

<div class="flex">
    <div class="ttd-field">
        <p>Tapanuli Selatan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <strong>KEPALA {{ Str::upper($data->user->name) }}</strong>
        <div class="space-ttd">
            ttd.
        </div>
        <div class="nama-ttd">
            <p>
                {{ $data->user->head_of_puskesmas }}
            </p>
            <p>
                NIP. {{ $data->user->head_of_puskesmas_nip }}
            </p>
        </div>
    </div>
</div>

@include('backend.pages.report.agent')

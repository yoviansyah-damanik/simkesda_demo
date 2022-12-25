<div class="history-side content mb-3">
    <h4 class="content-title">Riwayat Data</h4>

    <div class="row">
        <div class="col-lg-7 col-xxl-6">
            <div class="history-box">
                <div class="history-item">
                    <div class="box-item draft @if ($data->status_verifikasi == 0) active @endif">
                        <div class="box-side">
                            <span class="number">0</span>
                            <p>Draft</p>
                        </div>
                    </div>
                    <div class="line line-1 @if ($data->status_verifikasi == 0) active @endif"></div>
                    <div class="box-item proses @if ($data->status_verifikasi == 1) active @endif">
                        <div class="box-side">
                            <span class="number">1</span>
                            <p>Proses Pemeriksaan</p>
                        </div>
                    </div>
                    <div class="line-group">
                        <div class="line line-2 @if ($data->status_verifikasi == 1) active @endif"></div>
                        <div class="line line-3 @if ($data->status_verifikasi == 1) active @endif"></div>
                    </div>
                    <div class="box-flex-column">
                        <div class="box-item verifikasi @if ($data->status_verifikasi == 2) active @endif">
                            <div class="box-side">
                                <span class="number">2</span>
                                <p>Verifikasi</p>
                            </div>
                        </div>
                        <div class="box-item mt-3 periksa @if ($data->status_verifikasi == 3) active @endif">
                            <div class="box-side">
                                <span class="number">3</span>
                                <p>Periksa Kembali</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-xxl-6 mt-3 mt-lg-0 history-list">
            <div class="history-head">
                Detail Riwayat Data
            </div>
            <div class="history-body">
                @foreach ($riwayat as $val)
                    <div class="row">
                        <div class="col-9">
                            {{ $val->deskripsi }}
                        </div>
                        <div class="col-3 text-center">
                            {{ $val->created_at->translatedFormat('d/m/Y H:i') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

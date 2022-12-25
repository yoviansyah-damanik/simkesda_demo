<div class="content">
    <div class="filter-side filter-side-2">
        <form action="" method="get">
            <div class="input-group">
                <select name="tahun" id="tahun" class="form-select" required>
                    <option value="semua_data" @if (!$tahun) selected @endif>Semua tahun
                    </option>
                    @for ($x = date('Y'); $x >= 2017; $x--)
                        <option value="{{ $x }}" @if ($x == $tahun) selected @endif>
                            {{ $x }}</option>
                    @endfor
                </select>
                <select name="filter" id="filter" class="form-select">
                    <option value="semua_data" @if ($filter == 'semua_data' || !$filter) selected @endif>Semua filter
                    </option>
                    <option value="draft" @if ($filter == 'draft') selected @endif>Draft</option>
                    <option value="proses_pemeriksaan" @if ($filter == 'proses_pemeriksaan') selected @endif>Proses
                        Pemeriksaan</option>
                    <option value="verifikasi" @if ($filter == 'verifikasi') selected @endif>Verifikasi</option>
                    <option value="periksa_ulang" @if ($filter == 'periksa_ulang') selected @endif>Periksa Ulang
                    </option>
                </select>
                <button class="btn btn-danger">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-bordered yajra-datatable text-center puskesmas">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tahun</th>
                    <th>Waktu Draft</th>
                    <th>Waktu Pengajuan</th>
                    <th>Waktu Perubahan</th>
                    <th>Status Verifikasi</th>
                    <th>Waktu Verifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($data->count() > 0)
                    @foreach ($data as $val)
                        <tr>
                            <td>{{ $data->perPage() * ($data->currentPage() - 1) + $loop->iteration }}</td>
                            <td>{{ $val->tahun }}</td>
                            <td>{{ Carbon\Carbon::parse($val->created_at)->translatedFormat('d/m/Y H:i') }}</td>
                            <td>
                                @if ($val->waktu_pengajuan)
                                    {{ Carbon\Carbon::parse($val->waktu_pengajuan)->translatedFormat('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($val->waktu_perubahan)
                                    {{ Carbon\Carbon::parse($val->waktu_perubahan)->translatedFormat('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($val->status_verifikasi == 0)
                                    <span class="badge bg-warning">
                                        Draft
                                    </span>
                                @elseif ($val->status_verifikasi == 1)
                                    <span class="badge bg-info">
                                        Proses Pemeriksaan
                                    </span>
                                @elseif ($val->status_verifikasi == 2)
                                    <span class="badge bg-success">
                                        Verifikasi
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        Periksa Kembali
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($val->waktu_verifikasi)
                                    {{ Carbon\Carbon::parse($val->waktu_verifikasi)->translatedFormat('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info text-white"
                                    href="{{ route('dashboard.priority.target.show', $val->slug) }}"
                                    data-bs-tooltip="tooltip" data-bs-placement="bottom" title="Lihat!">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-warning text-white"
                                    href="{{ route('dashboard.priority.target.edit', $val->slug) }}"
                                    data-bs-tooltip="tooltip" data-bs-placement="bottom" title="Ubah!">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-danger hapus-data" data-type="data_sasaran"
                                    data-value="{{ $val->slug }}" data-year="{{ $val->tahun }}"
                                    data-bs-tooltip="tooltip" data-bs-placement="bottom" title="Hapus!">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan=8>Tidak ada data ditemukan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    @include('backend.partials.field_data.result_data')

    {{ $data->links() }}
</div>


<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Apakah anda yakin akan menghapus data sasaran tahun <span class="tahun"></span>?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <form action="{{ route('dashboard.priority.target.destroy') }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="v" id="data-value">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

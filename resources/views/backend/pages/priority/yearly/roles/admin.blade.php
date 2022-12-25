<div class="content">
    <div class="filter-side filter-side-2">
        <form action="" method="get">
            <div class="input-group">
                <select name="tahun" id="tahun" class="form-select" required>
                    <option value="semua_data" @if (!$tahun) selected @endif>Semua Data</option>
                    @for ($x = date('Y'); $x >= 2017; $x--)
                        <option value="{{ $x }}" @if ($x == $tahun) selected @endif>
                            {{ $x }}</option>
                    @endfor
                </select>
                <select name="filter" id="filter" class="form-select">
                    <option value="semua_data" @if ($filter == 'semua_data' || !$filter) selected @endif>Semua filter
                    </option>
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
                    <th>Kode dan Nama Puskesmas</th>
                    <th>Tahun</th>
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
                            <td>{{ $val->user->puskesmas_code . '-' . $val->user->name }}</td>
                            <td>{{ $val->tahun }}</td>
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
                                    href="{{ route('dashboard.priority.yearly.show', $val->slug) }}"
                                    data-bs-tooltip="tooltip" data-bs-placement="bottom" title="Lihat!">
                                    <i class="fas fa-eye"></i>
                                </a>
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

<div class="content">
    <div class="filter-side">
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
                <button class="btn btn-danger">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered yajra-datatable text-center puskesmas">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode dan Nama Puskesmas</th>
                    <th>Tahun</th>
                    <th>Waktu Pengisian</th>
                    <th>Waktu Perubahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($data->count() > 0)
                    @foreach ($data as $puskesmas)
                        <tr>
                            <td>{{ $data->perPage() * ($data->currentPage() - 1) + $loop->iteration }}
                            </td>
                            <td>{{ $puskesmas->user->puskesmas_code . '-' . $puskesmas->user->name }}</td>
                            <td>{{ $puskesmas->tahun }}</td>
                            <td>{{ Carbon\Carbon::parse($puskesmas->created_at)->translatedFormat('d/m/Y H:i') }}</td>
                            <td>
                                @if ($puskesmas->created_at != $puskesmas->updated_at)
                                    {{ Carbon\Carbon::parse($puskesmas->updated_at)->translatedFormat('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info text-white"
                                    href="{{ route('dashboard.puskesmas.show', $puskesmas->slug) }}"
                                    data-bs-tooltip="tooltip" data-bs-placement="bottom" title="Lihat!">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan=6>Tidak ada data ditemukan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    @include('backend.partials.field_data.result_data')

    {{ $data->links() }}
</div>

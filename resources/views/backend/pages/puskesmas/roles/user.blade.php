<div class="content">
    <div class="table-responsive">
        <table class="table table-bordered yajra-datatable text-center puskesmas">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tahun</th>
                    <th>Kode dan Nama Puskesmas</th>
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
                            <td>{{ $puskesmas->tahun }}</td>
                            <td>{{ Auth::user()->puskesmas_code . '-' . Auth::user()->name }}</td>
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
                                <a class="btn btn-sm btn-warning text-white"
                                    href="{{ route('dashboard.puskesmas.edit', $puskesmas->slug) }}"
                                    data-bs-tooltip="tooltip" data-bs-placement="bottom" title="Ubah!">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-danger hapus-data" data-type="data_bulanan"
                                    data-value="{{ $puskesmas->slug }}" data-bs-tooltip="tooltip"
                                    data-bs-placement="bottom" title="Hapus!">
                                    <i class="fas fa-trash"></i>
                                </button>
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
                    Apakah anda yakin akan menghapus profil puskesmas tersebut?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <form action="{{ route('dashboard.puskesmas.destroy') }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="v" id="data-value">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="text-center">
                        <th width=40px>#</th>
                        <th width=200px>Path</th>
                        <th>Prioritas</th>
                        <th width=250px>Judul</th>
                        <th width=250px>Deskripsi</th>
                        <th>Gambar</th>
                        <th width=120px>Aksi</th>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $slider)
                                <tr class="text-center">
                                    <td>
                                        {{ $data->perPage() * ($data->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>{{ $slider->path }}</td>
                                    <td>{{ $slider->priority }}</td>
                                    <td>{{ $slider->title ?? '-' }}</td>
                                    <td>{{ $slider->description ?? '-' }}</td>
                                    <td>
                                        <img src="{{ asset($slider->image_path) }}" alt="{{ $slider->image_path }}">
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm text-white btn-warning"
                                            href="{{ route('dashboard.slider.edit', $slider->id) }}"
                                            data-bs-placement="bottom" data-bs-tooltip="tooltip" title="Lihat!">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form class="d-inline" action="{{ route('dashboard.slider.destroy', $slider->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger hapus-data"
                                                data-bs-placement="bottom" data-bs-tooltip="tooltip" title="Hapus!">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan=7 class="text-center">Tidak ada slider ditemukan.</td>
                        @endif
                    </tbody>
                </table>
            </div>

            @include('backend.partials.field_data.result_data')
        </div>
    </div>
@endsection

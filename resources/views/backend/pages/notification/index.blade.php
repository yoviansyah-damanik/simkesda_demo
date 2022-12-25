@extends('backend.layouts.main')

@section('container')

    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <a href="{{ route('dashboard.notification.create') }}" class="btn-custom btn-next">
                <i class="fas fa-plus"></i>
                Tambah Data
            </a>
            <div class="table-responsive mt-4">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th style="width: 500px">Isi Notifikasi</th>
                            <th>Ditulis oleh</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($notifications->count() > 0)
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>{{ $notifications->perPage() * ($notifications->currentPage() - 1) + $loop->iteration }}
                                    </td>
                                    <td>{{ $notification->title }}</td>
                                    <td>{{ $notification->user->name }}</td>
                                    <td>{{ $notification->excerpt }}</td>
                                    <td>{{ $notification->created_at->translatedFormat('d/m/Y H:i') }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning text-white"
                                            href="{{ route('dashboard.notification.edit', $notification->slug) }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="bottom" title="Ubah!">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('dashboard.notification.activation') }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="stat" value=1>
                                            <input type="hidden" name="id" value={{ $notification->id }}>
                                            <button class="btn btn-sm btn-success" data-bs-tooltip="tooltip"
                                                data-bs-placement="bottom" title="Aktifkan!"
                                                @if ($notification->is_active == 1) disabled @endif>
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('dashboard.notification.activation') }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="stat" value=0>
                                            <input type="hidden" name="id" value={{ $notification->id }}>
                                            <button class="btn btn-sm btn-danger" data-bs-tooltip="tooltip"
                                                data-bs-placement="bottom" title="Nonaktifkan!"
                                                @if ($notification->is_active == 0) disabled @endif>
                                                <i class="fas fa-x"></i>
                                            </button>
                                        </form>
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

            {{ $notifications->links() }}

        </div>
    </div>

@endsection

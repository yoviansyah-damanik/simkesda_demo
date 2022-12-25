@extends('backend.layouts.main')

@section('container')

    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <a href="{{ route('dashboard.user.create') }}" class="btn-custom btn-next">
                <i class="fas fa-plus"></i>
                Tambah User
            </a>
            <div class="table-responsive mt-4">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Terakhir Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $user)
                                <tr>
                                    <td>{{ $data->perPage() * ($data->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role_name }}</td>
                                    <td>
                                        @if ($user->deleted_at)
                                            <span class="badge bg-dark">
                                                Ditangguhkan
                                            </span>
                                        @else
                                            @if ($user->is_active == 1)
                                                <span class="badge bg-success">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    Non aktif
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->translatedFormat('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td>
                                        @if ($user->deleted_at)
                                            <form action="{{ route('dashboard.user.restore', $user->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('put')
                                                <button class="btn btn-sm btn-success" data-bs-tooltip="tooltip"
                                                    data-bs-placement="bottom" title="Pulihkan!">
                                                    <i class="fas fa-user-plus"></i>
                                                </button>
                                            </form>
                                        @else
                                            @if ($user->id != Auth::id())
                                                <a class="btn btn-sm btn-warning text-white"
                                                    href="{{ route('dashboard.user.edit', $user->id) }}"
                                                    data-bs-tooltip="tooltip" data-bs-placement="bottom" title="Ubah!">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('dashboard.user.activation', $user->id) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="stat" value=1>
                                                    <button class="btn btn-sm btn-success" data-bs-tooltip="tooltip"
                                                        data-bs-placement="bottom" title="Aktifkan!"
                                                        @if ($user->is_active == 1) disabled @endif>
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>

                                                <form action="{{ route('dashboard.user.activation', $user->id) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="stat" value=0>
                                                    <button class="btn btn-sm btn-danger" data-bs-tooltip="tooltip"
                                                        data-bs-placement="bottom" title="Nonaktifkan!"
                                                        @if ($user->is_active == 0) disabled @endif>
                                                        <i class="fas fa-x"></i>
                                                    </button>
                                                </form>
                                                @if (!$user->hasRole('Superadmin'))
                                                    <form action="{{ route('dashboard.user.destroy', $user->id) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="stat" value=0>
                                                        <button class="btn btn-sm btn-dark" data-bs-tooltip="tooltip"
                                                            data-bs-placement="bottom" title="Tangguhkan!">
                                                            <i class="fas fa-user-minus"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan=5>Tidak ada val ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{ $data->links() }}

        </div>
    </div>

@endsection

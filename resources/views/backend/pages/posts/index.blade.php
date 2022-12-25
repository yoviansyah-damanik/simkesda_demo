@extends('backend.layouts.main')

@section('container')

    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <a href="{{ route('dashboard.post.create') }}" class="btn-custom btn-next">
                <i class="fas fa-plus"></i>
                Tambah Data
            </a>
            <div class="table-responsive mt-4">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th width=40px>#</th>
                            <th width=650px>Berita</th>
                            <th>Waktu Tulis</th>
                            <th>Waktu Terbit</th>
                            <th width=190px>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="text-center">
                                        {{ $posts->perPage() * ($posts->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $post->title }}</strong>
                                        @if ($post->published_at)
                                            <span class="small badge bg-success">Terbit</span>
                                        @else
                                            <span class="small badge bg-warning">Draft</span>
                                        @endif
                                        <br /><br />
                                        {{ $post->excerpt }}
                                        <br /><br />
                                        Ditulis oleh: <strong>{{ $post->user->name }}</strong>
                                    </td>
                                    <td class="text-center">{{ $post->created_at->translatedFormat('d/m/Y H:i') }}</td>
                                    @if ($post->published_at)
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d/m/Y H:i') }}
                                        </td>
                                    @else
                                        <td class="text-center">
                                            -
                                        </td>
                                    @endif
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-info text-white"
                                            href="{{ route('post.show', $post->slug) }}" data-bs-tooltip="tooltip"
                                            data-bs-placement="bottom" title="Lihat!" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a class="btn btn-sm btn-warning text-white"
                                            href="{{ route('dashboard.post.edit', $post->slug) }}" data-bs-tooltip="tooltip"
                                            data-bs-placement="bottom" title="Ubah!">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('dashboard.post.publish') }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="stat" value=1>
                                            <input type="hidden" name="id" value={{ $post->id }}>
                                            <button class="btn btn-sm btn-success" data-bs-tooltip="tooltip"
                                                data-bs-placement="bottom" data-bs-title="Terbitkan!"
                                                @if ($post->published_at) disabled @endif>
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('dashboard.post.publish') }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="stat" value=0>
                                            <input type="hidden" name="id" value={{ $post->id }}>
                                            <button class="btn btn-sm btn-dark" data-bs-tooltip="tooltip"
                                                data-bs-placement="bottom" data-bs-title="Batalkan Terbit!"
                                                @if ($post->published_at == null) disabled @endif>
                                                <i class="fas fa-x"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('dashboard.post.destroy', $post->slug) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger" data-bs-tooltip="tooltip"
                                                data-bs-placement="bottom" title="Hapus!">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan=8 class="text-center">Tidak ada data ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{ $posts->links() }}

        </div>
    </div>
@endsection

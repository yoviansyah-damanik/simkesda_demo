@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content announce">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="mb-3 fst-italic">
                    @if ($post->published_at)
                        Diterbitkan pada:
                        {{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i:s') }}
                        <br />
                        Oleh: {{ $post->user->name }}
                    @else
                        Belum diterbitkan.
                    @endif
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label form-label-bold">Judul</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $post->title) }}" required autofocus>
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label form-label-bold">Gambar Utama
                        <span class="text-danger small fw-light">
                            - Maksimal 2Mb (2048Kb)
                        </span>
                    </label>
                    <img class="img-preview img-fluid mb-3 col-sm-5"
                        @if ($post->image) src="{{ $post->image_path }}" @endif>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" accept="image/*"
                        id="image" name="image" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label form-label-bold">Isi Berita</label>
                    @error('body')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                    <trix-editor input="body"></trix-editor>
                </div>
                <button type="submit" class="btn-custom btn-submit">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </form>

        </div>
    </div>
@endsection

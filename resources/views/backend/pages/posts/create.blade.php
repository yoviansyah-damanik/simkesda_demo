@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content announce">

            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label form-label-bold">Judul</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}" required autofocus>
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
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" accept="image/*" onchange="previewImage()">
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
                    <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                    <trix-editor input="body"></trix-editor>
                </div>
                <button type="submit" class="btn-custom btn-submit">
                    <i class="fas fa-plus"></i>
                    Tambah Berita
                </button>
            </form>

        </div>
    </div>
@endsection

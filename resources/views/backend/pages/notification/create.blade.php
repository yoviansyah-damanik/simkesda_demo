@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content announce">

            <form action="" method="post">
                @csrf
                <div class="mb-3">
                    <div class="form-group">
                        <label for="title" class="form-label form-label-bold">Judul Notifikasi</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label form-label-bold">Isi Notifikasi Dasbor</label>
                    @error('body')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                    <trix-editor input="body"></trix-editor>
                </div>
                <button type="submit" class="btn-custom btn-submit">
                    <i class="fas fa-plus"></i>
                    Tambah Notifikasi
                </button>
            </form>

        </div>
    </div>
@endsection

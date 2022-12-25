@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content announce">

            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="title" class="form-label form-label-bold">Judul</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $announcement->title) }}" required autofocus>
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label form-label-bold">Isi Berita</label>
                    @error('body')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="body" type="hidden" name="body" value="{{ old('body', $announcement->body) }}">
                    <trix-editor input="body"></trix-editor>
                </div>
                <button type="submit" class="btn-custom btn-submit">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </form>

        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#image')
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader()
            oFReader.readAsDataURL(image.files[0])

            oFReader.onload = function(eFREvent) {
                imgPreview.src = eFREvent.target.result
            }
        }
    </script>
@endsection

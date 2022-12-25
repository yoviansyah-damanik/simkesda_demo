@extends('backend.layouts.main')

@section('container')
    <div class="container">
        @include('backend.partials.breadcrumb')

        <div class="content">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="form-label form-label-bold" for="image">File Slider
                                    <span class="text-danger small fw-light">
                                        Maksimal 2Mb (2048Kb) dan Dimensi Rasio 16:9
                                    </span>
                                </label>
                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                <input type="file" name="file" id="image" class="form-control" accept="image/*"
                                    onchange="previewImage()" required>
                                @error('file')
                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <div class="form-group w-50">
                                <label class="form-label form-label-bold" for="priority">Prioritas</label>
                                <select name="priority" id="priority" class="form-select" required>
                                    @for ($x = 1; $x < 10; $x++)
                                        <option value="{{ $x }}"
                                            @if ($x == old('priority')) selected @endif>{{ $x }}</option>
                                    @endfor
                                </select>
                                @error('priority')
                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label form-label-bold" for="title">
                                Judul Slider
                                <span class="text-danger small fw-light">
                                    Opsional
                                </span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title') }}">
                            @error('title')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label form-label-bold" for="description">
                                Deskripsi
                                <span class="text-danger small fw-light">
                                    Opsional
                                </span>
                            </label>
                            <input type="text" name="description" id="description" class="form-control"
                                value="{{ old('description') }}">
                            @error('description')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-custom btn-submit mt-3">
                    <i class="fas fa-plus"></i>
                    Tambah Slider
                </button>
            </form>
        </div>
    </div>
@endsection

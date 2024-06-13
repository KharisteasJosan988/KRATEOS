@extends('layouts.layout')

@section('title', 'KRATEOS')

@section('content')
    <h1 class="mt-4">Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('gallery.prosesUbah', ['id' => $gallery->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" value="{{ $gallery->deskripsi }}"
                        required>{{ $gallery->deskripsi }} </textarea>
                    @error('deskripsi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input class="form-control" type="file" id="gambar" name="gambar"
                        onchange="tampilkanPreview(this)">
                </div>
                <div class="mb-3">
                    <img id="preview" src="{{ asset($gallery->gambar) }}" alt="Preview Gambar" style="max-width: 300px;">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
    @push('js')
        <script>
            function tampilkanPreview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        document.getElementById('preview').src = e.target.result;
                    }

                    reader.readAsDataURL(input.files[0]); // Membaca data URL dari file yang dipilih
                }
            }
        </script>
    @endpush
@endsection

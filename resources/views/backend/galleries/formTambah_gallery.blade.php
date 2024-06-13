@extends('layouts.layout')

@section('title', 'KRATEOS')

@section('content')
    <h1 class="mt-4">Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin</li>
    </ol>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('gallery.prosesTambah') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" value="{{ old('deskripsi') }}" required></textarea>
                    @error('deskripsi')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="gambarInput" name="gambar" value="{{ old('gambar') }}"
                        onchange="tampilkanPreview(this, 'preview')" required>
                    @error('gambar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <img id="preview" src="#" alt="Preview" width="400">
                </div>
                <div class="mb-3">
                    <img id="preview" src="#" alt="Preview Gambar" style="max-width: 200px; display: none;">
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

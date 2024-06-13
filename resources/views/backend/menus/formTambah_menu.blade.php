@extends('layouts.layout')
@section('title', 'KRATEOS')
@section('content')
    <h1 class="mt-4">Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin</li>
    </ol>
    <form action="{{ route('menu.prosesTambah') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Menu</label>
            <select class="form-select" id="jenis" name="jenis">
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
            @error('nama')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Menu</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{ old('harga') }}">
            @error('harga')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Menu</label>
            <input type="file" class="form-control" id="gambarInput" name="gambar"
                onchange="tampilkanPreview(this, 'preview')">
            <img id="preview" src="#" alt="Preview" width="300">
            @error('gambar')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
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

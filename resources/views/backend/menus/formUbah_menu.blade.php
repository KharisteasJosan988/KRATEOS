@extends('layouts.layout')
@section('title', 'KRATEOS')
@section('content')

    <h1 class="mt-4">Menu</h1>
    <form action="{{ route('menu.prosesUbah', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Menu</label>
            <select class="form-select" id="jenis" name="jenis">
                <option value="Makanan" {{ $menu->jenis === 'Makanan' ? 'selected' : '' }}>Makanan
                </option>
                <option value="Minuman" {{ $menu->jenis === 'Minuman' ? 'selected' : '' }}>Minuman
                </option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $menu->nama }}">
            @error('nama')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga"
                value="{{ number_format($menu->harga, 0, '', '') }}">
            @error('harga')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar"
                onchange="tampilkanPreview(this, 'preview')">
            <img id="preview" src="{{ asset($menu->gambar) }}" alt="Preview" width="300">
        </div>
        <input type="hidden" id="gambarmenu" value="">
        <button type="submit" class="btn btn-primary">Simpan</button>
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

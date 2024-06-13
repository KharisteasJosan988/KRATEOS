<!-- resources/views/gallery.blade.php -->
@extends('layouts.layout')

@section('title', 'KRATEOS')

@section('content')
    <h1 class="mt-4">Gallery</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin</li>
    </ol>
    <form action="{{ route('gallery.formTambah') }}" method="GET">
        <button class="btn btn-info" type="submit">
            <i class="fas fa-plus"></i>
            Tambah Galeri
        </button>
    </form>

    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gallery as $index => $item)
                    <tr id="row_{{ $item->id }}">
                        <td>{{ $index + 1 }}</td>
                        <td><img src="{{ asset($item->gambar) }}" alt="{{ $item->deskripsi }}" width="230"></td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            <a href="{{ route('gallery.formUbah', ['id' => $item->id]) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('gallery.hapus', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @push('js')
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteGallery(id);
                    }
                });
            }

            function deleteGallery(id) {
                fetch(`{{ route('gallery.hapus', ':id') }}`.replace(':id', id), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => {
                    if (response.ok) {
                        document.getElementById('row_' + id).remove();
                        Swal.fire('Sukses!', 'Galeri berhasil dihapus.', 'success');
                    } else {
                        console.error('Gagal menghapus galeri');
                        Swal.fire('Gagal!', 'Tidak dapat menghapus menu.', 'error');
                    }
                }).catch(error => {
                    console.error('Terjadi kesalahan:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus galeri.', 'error');
                });
            }

            function tampilkanPreview(input, idPreview) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + idPreview).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection

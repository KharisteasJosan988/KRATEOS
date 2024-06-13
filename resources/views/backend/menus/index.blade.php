@extends('layouts.layout')
@section('title', 'KRATEOS')
@section('content')

    <h1 class="mt-4">Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin</li>
    </ol>
    <form action="{{ route('menu.formTambah') }}" method="GET">
        <button class="btn btn-info" type="submit">
            <i class="fas fa-plus"></i>
            Tambah Menu
        </button>
    </form>

    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Menu</th>
                    <th>Nama Menu</th>
                    <th>ID Menu</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($menus as $index => $menu)
                    <tr id="row_{{ $menu->id }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $menu->jenis }}</td>
                        <td>{{ $menu->nama }}</td>
                        <td>{{ $menu->id_menu }}</td>
                        <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                        <td><img id="preview_{{ $index }}" src="{{ asset($menu->gambar) }}" alt="{{ $menu->nama }}"
                                width="160"></td>
                        <td>
                            <a href="{{ route('menu.formUbah', ['id' => $menu->id]) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('menu.hapus', $menu->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="confirmDelete({{ $menu->id }})">
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
                    title: 'Anda yakin ingin menghapus?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteMenu(id);
                    }
                });
            }

            function deleteMenu(id) {
                fetch(`{{ route('menu.hapus', ':id') }}`.replace(':id', id), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    if (data.success) {
                        document.getElementById('row_' + id).remove();
                        Swal.fire('Sukses!', data.success, 'success');
                    } else {
                        console.error('Gagal menghapus menu');
                        Swal.fire('Gagal!', data.error, 'error');
                    }
                }).catch(error => {
                    console.error('Terjadi kesalahan:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus menu.', 'error');
                });
            }
        </script>

        <script>
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

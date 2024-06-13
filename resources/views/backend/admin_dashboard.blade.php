@extends('layouts.layout')

@section('title', 'KRATEOS')

@section('content')

    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin</li>
    </ol>

    <!-- Cards Summary -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">Total Menu</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="small text-white stretched-link">{{ $menus->count() }}</span>
                    <div class="small text-white"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Galeri</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="small text-white stretched-link">{{ $gallery->count() }}</span>
                    <div class="small text-white"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="mt-4">
        <h2>Menu KRATEOS</h2>
        <div class="row">
            @foreach ($menus as $menu)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($menu->gambar) }}" class="card-img-top img-fluid" alt="{{ $menu->nama }}"
                            style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nama }}</h5>
                            <p class="card-text">{{ $menu->jenis }}</p>
                            <p class="card-text">ID: {{ $menu->id_menu }}</p>
                            <p class="card-text">Harga: Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                            <form action="#" method="get" class="addToCartForm">
                                <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">
                                <div class="input-group mb-3">
                                    <input type="number" name="quantity" class="form-control" value="0" min="1"
                                        max="100">
                                    <button type="submit" class="btn btn-outline-primary addToCartBtn">Add to
                                        Cart</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="mt-4">
        <h2>Gallery</h2>
        <div class="row">
            @foreach ($gallery as $item)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($item->gambar) }}" class="card-img-top img-fluid" alt="{{ $item->deskripsi }}"
                            style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text fw-bold text-center">{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Menangani setiap form addToCartForm yang ada
                var addToCartForms = document.querySelectorAll('.addToCartForm');
                addToCartForms.forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // Menghentikan form dari submit

                        // Mengambil nilai id_menu dari input hidden dalam form ini
                        var id_menu = this.querySelector('input[name="id_menu"]').value;

                        // Menampilkan SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Ditambahkan!',
                            showConfirmButton: false,
                            timer: 1500 // Durasi alert ditampilkan (ms)
                        });
                    });
                });
            });
        </script>
    @endpush

@endsection

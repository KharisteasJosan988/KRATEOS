@extends('layouts.layout')
@section('judul', 'Pesanan')
@section('content')

    <h1 class="mt-4">Kasir Pesanan</h1>

    <div class="row mt-4">
        <div class="col-12">
            <input type="text" id="input-barcode" name="barcode" class="form-control" placeholder="Scan Id Menu" />
        </div>
    </div>
    <form method="post" action="{{ url('/app/insert') }}">
        <div class="row">
            @csrf
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="table-cart">
                            <thead class="thead-light">
                                <tr>
                                    <th>Id Menu</th>
                                    <th>Nama Menu</th>
                                    <th>@</th>
                                    <th>Qty</th>
                                    <th>SubTotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <label for="subtotal">Subtotal</label>
                                    <input type="text" readonly name="subtotal" id="subtotal"
                                        class="form-control text-right">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="discount">Discount (%)</label>
                                    <input type="number" min="0" max="100" name="discount" id="discount"
                                        value="0" class="form-control text-right">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="total">Total</label>
                                    <input type="text" readonly name="total" id="total"
                                        class="form-control text-right">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#input-barcode').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault(); // Mencegah submit form saat Enter ditekan
                    console.log('Enter ditekan');
                    $.ajax({
                        url: '{{ url('/app/search-barcode') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            barcode: $(this).val()
                        },
                        success: function(data) {
                            if (data.error) {
                                toastr.error(data.error, 'Error');
                            } else {
                                addProductToTable(data);
                                toastr.success('Barang berhasil masuk ke keranjang belanja',
                                    'Berhasil');
                            }
                            $('#input-barcode').val('');
                        },
                        error: function() {
                            toastr.error('Barang yang dicari tidak ditemukan', 'Error');
                            $('#input-barcode').val('');
                        }
                    });
                }
            });

            function addProductToTable(product) {
                let rowExist = $('#table-cart tbody').find('#p-' + product.id_menu);
                if (rowExist.length > 0) {
                    let qty = parseInt(rowExist.find('.qty').eq(0).val());
                    qty += 1;
                    rowExist.find('.qty').eq(0).val(qty);
                    rowExist.find('td').eq(3).text(qty.toLocaleString());
                    let subtotal = qty * product.harga;
                    rowExist.find('td').eq(4).text(subtotal.toLocaleString());
                } else {
                    let row = `<tr id='p-${product.id_menu}'>
                                <td>${product.id_menu}</td>
                                <td>${product.nama}</td>
                                <td>${product.harga.toLocaleString()}</td>
                                <input type='hidden' name='price[]' class='price' value="${product.harga}" />
                                <input type='hidden' name='qty[]' class='qty' value="1" />
                                <input type='hidden' name='id_product[]' value="${product.id_menu}" />
                                <td>1</td>
                                <td>${product.harga.toLocaleString()}</td>
                            </tr>`;
                    $('#table-cart tbody').append(row);
                }
                hitungTotalBelanja();
            }

            function hitungTotalBelanja() {
                let subtotal = 0;
                $('.price').each(function(index, element) {
                    let price = $(this).val();
                    let qty = $('.qty').eq(index).val();
                    subtotal += parseInt(price) * parseInt(qty);
                });
                let discount = parseInt($('#discount').val());
                let total = subtotal - (subtotal * discount / 100);
                $('#subtotal').val(subtotal.toLocaleString());
                $('#total').val(total.toLocaleString());
            }

            $('#discount').on('change', function() {
                hitungTotalBelanja();
            });
        });
    </script>
@endpush

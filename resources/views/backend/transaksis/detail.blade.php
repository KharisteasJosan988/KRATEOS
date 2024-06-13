@extends('layouts.layout')
@section('judul', 'Detail Transaksi')

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">Detail Transaksi Pesanan - {{ $row->code }}</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                    $subtotal = 0;
                                @endphp
                                @foreach ($row->ItemTransaksi as $item)
                                    @php
                                        $subtotal += $item->price * $item->qty;
                                    @endphp
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ isset($item->Menu) ? $item->Menu->nama : 'Menu Tidak Ditemukan' }}</td>
                                        <td class="right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="right">{{ $item->qty }}</td>
                                        <td class="right">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5"></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right fw-bold">Discount ({{ $row->discount }}%) :</td>
                                    <td class="right">Rp
                                        {{ number_format($subtotal * ($row->discount / 100), 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right fw-bold">Total :</td>
                                    @php
                                        $discountedAmount = $subtotal * ($row->discount / 100);
                                        $totalAfterDiscount = $subtotal - $discountedAmount;
                                    @endphp
                                    <td class="right">Rp {{ number_format($totalAfterDiscount, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ url('/transaksi') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

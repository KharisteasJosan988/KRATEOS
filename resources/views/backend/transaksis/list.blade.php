@extends('layouts.layout')
@section('judul', 'Transaksi')

@section('content')

    <h1 class="mt-4">Transaksi Pesanan</h1>
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <a target="_blank" href="#" class="btn btn-success">
                        <i class="fas fa-file-excel  "></i> Export XLS
                    </a> --}}
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($counter = 1)
                                @foreach ($rows as $row)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $row->code }}</td>
                                        <td>{{ $row->date }}</td>
                                        <td class="text-left">Rp {{number_format ($row->total, 0, ',', '.' )}}</td>
                                        <td>
                                            <a href="{{ url('/transaksi/' . $row->id . '/detail') }}"
                                                class="btn btn-sm btn-info ">
                                                <i class="fas fa-eye  "></i>
                                            </a>
                                            <a href="{{ url("transaksi/$row->id/pdf") }}" target="_blank"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-file-pdf  "></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

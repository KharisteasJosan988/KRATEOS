<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Export\TransaksiXLS;
use Illuminate\Support\Facades\Gate;

class TransaksiController extends Controller
{
    public function index()
    {
        if (Gate::allows('admin')) {
            $rows = Transaksi::query()->get();
            return view('backend.transaksis.list', [
                'rows' => $rows
            ]);
        } else {
            abort(403, 'Tidak punya akses');
        }
    }

    public function printPDF($id)
    {
        $row = Transaksi::query()->with('ItemTransaksi.Menu')->findOrFail($id);
        if ($row === null) {
            abort(404);
        }
        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('backend.transaksis.print-pdf', ['row' => $row])
            ->setPaper('A4');
        return $pdf->stream('Invoice ' . $row->code . '.pdf');
    }

    public function detail($id)
    {
        $row = Transaksi::query()->with('ItemTransaksi.Menu')->findOrFail($id);
        if ($row === null) {
            abort(404);
        }
        return view('backend.transaksis.detail', ['row' => $row]);
    }

    public function excel()
    {
        // return Excel::download(new TransaksiXLS(), 'transaksi_' . date('YmdHis') . '.xlsx');
    }
}

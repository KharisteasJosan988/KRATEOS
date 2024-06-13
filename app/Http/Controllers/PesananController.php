<?php

namespace App\Http\Controllers;

use App\Models\ItemTransaksi;
use App\Models\Menu;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PesananController extends Controller
{
    public function index()
    {
        if (Gate::allows('admin')) {
            return view('backend.pesanans.index');
        } else {
            abort(403, 'Tidak punya akses');
        }
    }

    public function searchMenu(Request $request)
    {
        $product = Menu::where('id_menu', $request->barcode)->first();
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function insert(Request $request)
    {
        DB::beginTransaction();
        try {
            $prefix = 'INV/' . date('Ymd') . '/';
            $code = Transaksi::getLastCode($prefix);
            $transaksi = new Transaksi();
            $transaksi->code = $code;
            $transaksi->date = date('Y-m-d');
            $transaksi->subtotal = 0;
            $transaksi->discount = 0;
            $transaksi->total = 0;
            $transaksi->created_by = Auth::id();
            $transaksi->save();

            $subtotal = 0;
            $itemCount = count($request->price);
            for ($i = 0; $i < $itemCount; $i++) {
                $it = new ItemTransaksi();
                $it->id_transaction = $transaksi->id;
                $it->id_product = $request->id_product[$i];
                $it->price = $request->price[$i];
                $it->qty = $request->qty[$i];
                $it->total = (int)$it->price * (int)$it->qty;
                $it->save();
                $subtotal += $it->total;
            }
            $transaksi->subtotal = $subtotal;
            $discount = $subtotal * (int)$request->discount / 100;
            $transaksi->discount = $request->discount;
            $transaksi->total = $subtotal - $discount;
            $transaksi->save();

            DB::commit();
            return redirect()->back()->with('berhasil', 'Transaksi Berhasil');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('gagal', 'Transaksi Gagal' . $e->getMessage());
        }
    }
}

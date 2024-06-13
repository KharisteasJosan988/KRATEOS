<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna memiliki izin untuk mengakses halaman ini (admin)
        if (Gate::allows('admin')) {
            $menus = Menu::all();

            foreach ($menus as $menu) {
                $menu->gambar_url = asset('menu_images/' . $menu->gambar);
            }

            return view('backend.menus.index', compact('menus'));
        } else {
            abort(403, 'Tidak punya akses');
        }
    }

    public function formTambah()
    {
        return view('backend.menus.formTambah_menu');
    }

    public function prosesTambah(Request $request)
    {
        // Validasi data
        $request->validate([
            'jenis' => 'required',
            'nama' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'harga' => [
                'required',
                'regex:/^[0-9]+$/',
            ],
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.regex' => 'Nama menu hanya boleh berisi huruf dan spasi.',
            'harga.regex' => 'Harga menu hanya boleh berisi angka.',
        ]);

        $gambar = $request->file('gambar');
        $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
        $gambar->move(public_path('menu_images'), $nama_gambar);

        // Menyimpan gambar
        $gambarPath = 'menu_images/' . $nama_gambar;

        // Membuat record baru dalam database
        Menu::create([
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function formUbah($id)
    {
        $menu = Menu::findOrFail($id);
        return view('backend.menus.formUbah_menu', compact('menu'));
    }

    // Menyimpan perubahan pada menu yang diubah ke database
    public function prosesUbah(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'jenis' => 'required',
            'nama' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'harga' => [
                'required',
                'regex:/^[0-9]+$/',
            ],
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Batasan ukuran gambar: 2MB
        ], [
            'nama.regex' => 'Nama menu hanya boleh terdiri dari huruf dan spasi.',
            'harga.regex' => 'Harga menu hanya boleh terdiri dari angka.',
        ]);

        // Menemukan menu yang akan diubah
        $menu = Menu::findOrFail($id);

        try {
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
                $gambar->move(public_path('menu_images'), $nama_gambar);

                // Menyimpan gambar
                $gambarPath = 'menu_images/' . $nama_gambar;
            } else {
                // Jika tidak ada gambar yang diunggah, gunakan gambar yang ada sebelumnya
                $gambarPath = $menu->gambar;
            }
            // Menyimpan perubahan pada menu
            $menu->update([
                'jenis' => $request->jenis,
                'nama' => $request->nama,
                'harga' => $request->harga,
                'gambar' => $gambarPath,
            ]);

            // Tambahkan pesan sukses ke session
            Session::flash('success', 'Menu berhasil diupdate.');

            // Kirim respons redirect
            return redirect()->route('menu.index');
        } catch (\Exception $e) {
            // Tambahkan pesan error ke session
            Session::flash('error', 'Terjadi kesalahan saat mengupdate menu.');

            // Kirim respons redirect
            return redirect()->route('menu.index');
        }
    }

    public function hapus($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();

            return response()->json(['success' => 'Menu berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus menu.'], 500);
        }
    }
}

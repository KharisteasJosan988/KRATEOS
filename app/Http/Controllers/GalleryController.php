<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GalleryController extends Controller
{
    public function index()
    {
        if (Gate::allows('admin')) {
            $gallery = Gallery::all();
            return view('backend.galleries.index', compact('gallery'));
        } else {
            abort(403, 'Tidak punya akses');
        }
    }

    public function formTambahGaleri()
    {
        return view('backend.galleries.formTambah_gallery');
    }

    public function prosesTambahGaleri(Request $request)
    {
        $request->validate([
            'deskripsi' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.regex' => 'Deskripsi hanya bisa diisi dengan huruf',
        ]);

        $gallery = new Gallery();
        $gallery->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('images'), $nama_gambar);
            $gallery->gambar = '/images/' . $nama_gambar;
        }

        $gallery->save();

        return redirect()->route('gallery.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function ubahGaleri($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('backend.galleries.formUbah_gallery', compact('gallery'));
    }

    public function prosesUbahGaleri(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.regex' => 'Deskripsi hanya bisa diisi dengan huruf',
        ]);

        $gallery = Gallery::findOrFail($id);
        $gallery->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('images'), $nama_gambar);
            $gallery->gambar = '/images/' . $nama_gambar;
        }

        $gallery->save();

        return redirect()->route('gallery.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function hapus($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->delete();
            return response()->json(['message' => 'Galeri berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus galeri'], 500);
        }
    }
}

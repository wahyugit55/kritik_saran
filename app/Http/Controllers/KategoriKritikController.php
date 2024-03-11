<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriKritik;
use Illuminate\Support\Facades\Auth;

class KategoriKritikController extends Controller
{
    /**
     * Store a newly created KategoriKritik in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        // Cek apakah pengguna adalah super_admin
        if (!Auth::user()->isSuperAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Membuat kategori kritik baru
        $kategoriKritik = KategoriKritik::create([
            'nama' => $request->nama,
            'status' => $request->status,
            'user_id' => Auth::id()
        ]);

        // Kembalikan respons
        return response()->json([
            'message' => 'Kategori Kritik berhasil dibuat',
            'kategoriKritik' => $kategoriKritik
        ]);
    }

    public function update(Request $request, $id)
    {
        $kategoriKritik = KategoriKritik::findOrFail($id);

        // Cek apakah pengguna adalah super_admin
        if (!Auth::user()->isSuperAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        $kategoriKritik->update($request->all());

        return response()->json([
            'message' => 'Kategori kritik berhasil diperbarui',
            'kategoriKritik' => $kategoriKritik
        ]);
    }

    public function show($id)
    {
        // $kategoriKritik = KategoriKritik::findOrFail($id);
        // Muat kategori kritik dan relasi 'user' secara eager loading
        $kategoriKritik = KategoriKritik::with('user')->findOrFail($id);

        return response()->json($kategoriKritik);
    }

    public function destroy($id)
    {
        $kategoriKritik = KategoriKritik::findOrFail($id);

        // Cek apakah pengguna adalah super_admin
        if (!Auth::user()->isSuperAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $kategoriKritik->delete();

        return response()->json(['message' => 'Kategori kritik berhasil dihapus']);
    }



}

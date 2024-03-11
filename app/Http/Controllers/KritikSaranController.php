<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KritikSaran;
use Illuminate\Support\Str;

class KritikSaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'isi' => 'required|string',
            'kategori_id' => 'required|exists:kategori_kritik,id',
            'gambar' => 'nullable|image|max:2048', // Jika Anda ingin mengizinkan upload gambar
        ]);

        $kritikSaran = new KritikSaran([
            'id' => Str::uuid(),
            'user_id' => auth()->user() ? auth()->user()->id : null, // Assign user_id jika user terautentikasi
            'isi' => $request->isi,
            'kategori_id' => $request->kategori_id,
            'status' => false, // Default status
        ]);

        // Handle file upload jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kritik_saran_images', 'public');
            $kritikSaran->gambar = $gambarPath;
        }

        $kritikSaran->save();

        return response()->json([
            'message' => 'Kritik dan saran berhasil disimpan',
            'kritikSaran' => $kritikSaran
        ], 201);
    }

    public function showByUser(Request $request)
    {
        // Pastikan pengguna terautentikasi
        $user = auth()->user();

        // Dapatkan semua kritik dan saran milik pengguna
        $kritikSaran = $user->kritikSaran()->with('kategoriKritik', 'user')->get(); // Asumsikan Anda memiliki relasi 'kategoriKritik' di model KritikSaran

        // Kembalikan data kritik dan saran sebagai respons JSON
        return response()->json($kritikSaran);
    }

    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'isi' => 'sometimes|string',
            'kategori_id' => 'sometimes|exists:kategori_kritik,id',
            'gambar' => 'nullable|image|max:2048', // Pastikan ini konsisten dengan aturan di method store
            'status' => 'sometimes|boolean',
        ]);

        // Cari kritik dan saran berdasarkan ID
        $kritikSaran = KritikSaran::findOrFail($id);

        // Periksa apakah pengguna terautentikasi adalah pemilik kritik dan saran atau memiliki hak untuk mengedit
        if (!auth()->user() || (auth()->user()->id != $kritikSaran->user_id && !auth()->user()->isSuperAdmin())) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Update kritik dan saran dengan data baru
        $kritikSaran->update($request->all());

        // Jika request memiliki file gambar, handle upload gambar
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kritik_saran_images', 'public');
            $kritikSaran->gambar = $gambarPath;
            $kritikSaran->save();
        }

        // Kembalikan data kritik dan saran yang telah diperbarui
        return response()->json([
            'message' => 'Kritik dan saran berhasil diperbarui',
            'kritikSaran' => $kritikSaran
        ]);
    }

    public function destroy($id)
    {
        // Cari kritik dan saran berdasarkan ID
        $kritikSaran = KritikSaran::findOrFail($id);

        // Periksa apakah pengguna terautentikasi adalah pemilik kritik dan saran atau memiliki hak untuk menghapus
        if (!auth()->user() || (auth()->user()->id != $kritikSaran->user_id && !auth()->user()->isSuperAdmin())) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Hapus kritik dan saran
        $kritikSaran->delete();

        // Kembalikan respons sukses
        return response()->json(['message' => 'Kritik dan saran berhasil dihapus']);
    }

    public function show($id)
    {
        // Cari kritik dan saran berdasarkan ID dan muat relasi yang relevan
        $kritikSaran = KritikSaran::with(['tanggapan', 'tanggapan.feedbacks'])->findOrFail($id);

        // Tentukan status kritik dan saran
        $status = $kritikSaran->tanggapan->isEmpty() ? 'Belum Ditanggapi' : 'Sudah Ditanggapi';

        // Siapkan data untuk respons
        $data = [
            'kritikSaran' => $kritikSaran,
            'status' => $status,
            'feedbacks' => $kritikSaran->tanggapan->isEmpty() ? [] : $kritikSaran->tanggapan->first()->feedbacks
        ];

        // Kembalikan data kritik dan saran sebagai respons JSON
        return response()->json($data);
    }



}

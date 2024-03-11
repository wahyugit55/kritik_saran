<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    /**
     * Store a new tanggapan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kritik_id' => 'required|exists:kritik_saran,id',
            'isi_tanggapan' => 'required|string',
            'level_prioritas' => 'required|integer|min:1|max:3'
        ]);

        // Memastikan bahwa user yang membuat tanggapan adalah staff sekolah
        if (!auth()->user() || auth()->user()->role !== 'school_staff') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $tanggapan = new Tanggapan([
            'user_id' => Auth::id(),
            'kritik_id' => $request->kritik_id,
            'isi_tanggapan' => $request->isi_tanggapan,
            'level_prioritas' => $request->level_prioritas,
        ]);

        $tanggapan->save();

        return response()->json([
            'message' => 'Tanggapan berhasil disimpan',
            'tanggapan' => $tanggapan
        ], 201);
    }
}

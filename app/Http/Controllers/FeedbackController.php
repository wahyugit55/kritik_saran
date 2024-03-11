<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Store a new feedback.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggapan_id' => 'required|exists:tanggapan,id',
            'isi_feedback' => 'required|string',
            'rating' => 'required|integer|between:1,5'
        ]);
    
        // Mengambil tanggapan berdasarkan tanggapan_id
        $tanggapan = Tanggapan::with('kritikSaran')->findOrFail($request->tanggapan_id);
    
        // Memeriksa apakah kritik dan saran yang terkait adalah milik pengguna terautentikasi
        if ($tanggapan->kritikSaran->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    
        // Membuat feedback baru
        $feedback = new Feedback([
            'user_id' => Auth::id(),
            'tanggapan_id' => $request->tanggapan_id,
            'isi_feedback' => $request->isi_feedback,
            'rating' => $request->rating
        ]);
    
        $feedback->save();
    
        return response()->json([
            'message' => 'Feedback berhasil disimpan',
            'feedback' => $feedback
        ]);
    }    

}
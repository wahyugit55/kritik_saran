<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            // Membuat token Sanctum
            $token = $user->createToken('authToken')->plainTextToken;

            // Mengembalikan data user dan token sesuai role
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
                'redirect' => $this->determineRedirectPath($user->role), // Arahkan user berdasarkan role
            ]);
        } else {
            // Mengembalikan pesan error dalam format JSON
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], 401); // Kode status 401 menunjukkan Unauthorized
        }
    }

    private function determineRedirectPath($role)
    {
        // Tentukan redirect path berdasarkan role
        switch ($role) {
            case 'super_admin':
                return '/super-admin/dashboard';
            case 'school_staff':
                return '/school-staff/dashboard';
            case 'student':
                return '/student/dashboard';
            default:
                return '/';
        }
    }

    public function superAdminDashboard(Request $request)
    {
        $user = Auth::user(); // Dapatkan pengguna yang saat ini terautentikasi

        // Pastikan pengguna adalah Super Admin
        if ($user->role !== 'super_admin') {
            return response()->json(['message' => 'Access denied. Only Super Admins are allowed.'], 402);
        }

        // Kembalikan data untuk dashboard Super Admin
        return response()->json([
            'name' => $user->name,
            'role' => $user->role,
            // Tambahkan data lain yang mungkin ingin Anda tampilkan di dashboard
        ]);
    }

    public function studentDashboard(Request $request)
    {
        $user = Auth::user(); // Dapatkan pengguna yang saat ini terautentikasi

        // Pastikan pengguna adalah siswa
        if ($user->role !== 'student') {
            return response()->json(['message' => 'Access denied. Only students are allowed.'], 403);
        }

        // Kembalikan data untuk dashboard siswa
        return response()->json([
            'name' => $user->name,
            'role' => $user->role,
            // Tambahkan data lain yang mungkin ingin Anda tampilkan di dashboard siswa
        ]);
    }

    public function schoolStaffDashboard(Request $request)
    {
        $user = Auth::user(); // Dapatkan pengguna yang saat ini terautentikasi

        // Pastikan pengguna adalah bagian dari pihak sekolah
        if ($user->role !== 'school_staff') {
            return response()->json(['message' => 'Access denied. Only school staff are allowed.'], 403);
        }

        // Kembalikan data untuk dashboard pihak sekolah
        return response()->json([
            'name' => $user->name,
            'role' => $user->role,
            // Tambahkan data lain yang mungkin ingin Anda tampilkan di dashboard pihak sekolah
        ]);
    }

}

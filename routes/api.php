<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\KategoriKritikController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route untuk user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route untuk autentikasi
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

// Route untuk dashboard berdasarkan role
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/super-admin/dashboard', [AuthController::class, 'superAdminDashboard']);
    Route::get('/student/dashboard', [AuthController::class, 'studentDashboard']);
    Route::get('/school-staff/dashboard', [AuthController::class, 'schoolStaffDashboard']);
});

// Route untuk kritik dan saran
Route::prefix('kritik-saran')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [KritikSaranController::class, 'store']);
    Route::get('/user', [KritikSaranController::class, 'showByUser']);
    Route::put('/{id}', [KritikSaranController::class, 'update']);
    Route::delete('/{id}', [KritikSaranController::class, 'destroy']);
    Route::get('/{id}', [KritikSaranController::class, 'show']);
});

// Route untuk feedback
Route::prefix('feedback')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [FeedbackController::class, 'store']);
});

// Route untuk tanggapan
Route::prefix('tanggapan')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [TanggapanController::class, 'store']);
});

// Route untuk kategori kritik
Route::prefix('kategori-kritik')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [KategoriKritikController::class, 'store']);
    Route::get('/{id}', [KategoriKritikController::class, 'show']);
    Route::put('/{id}', [KategoriKritikController::class, 'update']);
    Route::delete('/{id}', [KategoriKritikController::class, 'destroy']);
    Route::get('/', [KategoriKritikController::class, 'index']);
});

// Route untuk pengelolaan users
Route::prefix('users')->middleware('auth:sanctum')->group(function () {
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

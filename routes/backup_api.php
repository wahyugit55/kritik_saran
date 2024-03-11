<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\KategoriKritikController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/super-admin/dashboard', [AuthController::class, 'superAdminDashboard']);
Route::middleware('auth:sanctum')->get('/student/dashboard', [AuthController::class, 'studentDashboard']);
Route::middleware('auth:sanctum')->get('/school-staff/dashboard', [AuthController::class, 'schoolStaffDashboard']);

Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/kritik-saran/user', [KritikSaranController::class, 'showByUser']);
Route::put('/kritik-saran/{id}', [KritikSaranController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/kritik-saran/{id}', [KritikSaranController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/kritik-saran/{id}', [KritikSaranController::class, 'show'])->middleware('auth:sanctum');

Route::post('/feedback', [FeedbackController::class, 'store'])->middleware('auth:sanctum');

Route::post('/tanggapan', [TanggapanController::class, 'store'])->middleware('auth:sanctum');

Route::post('/kategori-kritik', [KategoriKritikController::class, 'store'])->middleware('auth:sanctum');
Route::get('/kategori-kritik/{id}', [KategoriKritikController::class, 'show'])->middleware('auth:sanctum');
Route::put('/kategori-kritik/{id}', [KategoriKritikController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/kategori-kritik/{id}', [KategoriKritikController::class, 'destroy'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});
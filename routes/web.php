<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware('auth')->group(function () { 

    Route::get('notification', [HomeController::class, 'notification']);

    Route::get('permohonan/{name}', [HomeController::class, 'permohonan'])->name('permohonan');

    Route::post('permohonan/{name}', [HomeController::class, 'permohonanStore'])->name('permohonan.store');
    
    Route::get('admin', [Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::post('pengajuan/{file}', [Admin\PengajuanController::class, 'active']);
    Route::get('pengajuan/{file}/chat', [Admin\PengajuanController::class, 'chatList']);
    Route::post('pengajuan/{file}/chat', [Admin\PengajuanController::class, 'chatStore']);

    Route::resource('pengajuan', Admin\PengajuanController::class)->except(['create','store', 'edit'])->parameters(['pengajuan' => 'file']);

    Route::resource('users', Admin\UserController::class)->except(['show']);

});

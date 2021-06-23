<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'direktur') return redirect()->route('dashboard')->with(['error' => 'Akses Ditolak!']);

        if (auth()->user()->role == 'administrator') {

            $laporanKasus = File::latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->paginate(env('PAGINATION') ?? 10);

        }elseif (auth()->user()->role == 'perdata') {

            $laporanKasus = File::whereHas('category', function($category){
                $category->where('name', 'perdata');
            })->latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->paginate(env('PAGINATION') ?? 10);

        }elseif(auth()->user()->role == 'pidana'){

            $laporanKasus = File::whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->paginate(env('PAGINATION') ?? 10);

        }else{

            $laporanKasus = File::where('user_id', auth()->id())->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->latest()->paginate(env('PAGINATION') ?? 10); 
        }
        return view('admin.konsultasi.index', compact('laporanKasus'));
    }

    public function show(File $file)
    {
        $notifUpdate =  File::where('id', $file->id)->first();

        if (auth()->user()->role == 'administrator') {

            $file = $file;

            if($notifUpdate) $notifUpdate->notifications()->whereHas('user', function($user){
                $user->where('role', 'user');
            })->update(['read' => 1]);

        }elseif (auth()->user()->role == 'perdata') {

            $file = File::where('id', $file->id)->whereHas('category', function($category){
                $category->where('name', 'perdata');
            })->first();

            if($notifUpdate) $notifUpdate->notifications()->whereHas('user', function($user){
                $user->where('role', 'user');
            })->update(['read' => 1]);

            if(!$file) return redirect()->route('pengajuan.index')->with(['error' => 'Akses Ditolak!']);
            
        }elseif(auth()->user()->role == 'pidana'){

            $file = File::where('id', $file->id)->whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->first();

            if($notifUpdate) $notifUpdate->notifications()->whereHas('user', function($user){
                $user->where('role', 'user');
            })->update(['read' => 1]);

            if(!$file) return redirect()->route('pengajuan.index')->with(['error' => 'Akses Ditolak!']);
        }else{

            $file = $file->where('user_id', auth()->id())->first(); 

            if($notifUpdate) $notifUpdate->notifications()->whereHas('user', function($user){
                $user->where('role', '!=' , 'user');
            })->update(['read' => 1]);

            if(!$file) return redirect()->route('pengajuan.index')->with(['error' => 'Akses Ditolak!']);

        }
        return view('admin.konsultasi.show', compact('file'));
    }

}

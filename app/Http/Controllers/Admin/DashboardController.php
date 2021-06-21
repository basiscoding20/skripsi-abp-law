<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'administrator') {

            $totalPerdata = File::whereHas('category', function($category){
                $category->where('name', 'perdata');
            })->count();

            $totalPidana = File::whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->count();

            $total = File::all()->count();

            $laporanKasus = File::latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->take(10)->get();

        }elseif (auth()->user()->role == 'perdata') {

            $totalPerdata = 0;

            $totalPidana = 0;

            $total = File::where('user_id', auth()->id())->whereHas('category', function($category){
                $category->where('name', 'perdata');
            })->count();

            $laporanKasus = File::whereHas('category', function($category){
                $category->where('name', 'perdata');
            })->latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->take(10)->get();

        }elseif(auth()->user()->role == 'pidana'){

            $totalPerdata = 0;

            $totalPidana = 0;

            $total = File::where('user_id', auth()->id())->whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->count();

            $laporanKasus = File::whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->take(10)->get();
            
        }else{
            $totalPerdata = File::where('user_id', auth()->id())->whereHas('category', function($category){
                $category->where('name', 'perdata');
            })->count();

            $totalPidana = File::where('user_id', auth()->id())->whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->count();

            $total = File::where('user_id', auth()->id())->count();

            $laporanKasus = File::where('user_id', auth()->id())->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->latest()->take(10)->get(); 
        }
        return view('admin.dashboard', compact('laporanKasus', 'totalPerdata', 'totalPidana', 'total'));
    }
}

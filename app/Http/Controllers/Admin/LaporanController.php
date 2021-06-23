<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Exports\PengajuanExport;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {

        if(auth()->user()->role != 'administrator' && auth()->user()->role != 'direktur') return redirect()->route('dashboard')->with(['error' => 'Akses Ditolak!']);

        $laporanKasus = File::where('status', '!=', 0)->latest()->paginate(env('PAGINATION') ?? 10);

        $categories = Category::pluck('name', 'id')->prepend('-- Pilih Kategori --', '')->toArray();

        return view('admin.laporan.index', compact('laporanKasus', 'categories'));
    }

    public function export(Request $request) 
    {
        $status = $request->status;
        $category = $request->category;
        return Excel::download(new PengajuanExport($status, $category), 'pengajuan.xlsx');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'administrator') {

            $laporanKasus = File::latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->paginate(env('PAGINATION') ?? 10);

        }elseif (auth()->user()->role == 'direktur') {

            $laporanKasus = File::where('status', '!=', 0)->latest()->when(request()->search, function($laporan) {
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
        return view('admin.pengajuan.index', compact('laporanKasus'));
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
        return view('admin.pengajuan.show', compact('file'));
    }

    public function active(Request $request, File $file)
    {
        return DB::transaction(function () use($request, $file) {
            $file->update([ 'status' => $request->status ]);

            if($request->status == 1) $status = 'disetujui';
            if($request->status == 2) $status = 'ditolak';

            Notification::create([
                'user_id' => auth()->id(),
                'file_id' => $file->id,
                'notif' => ucfirst($file->no_pengajuan).' Telah '.$status.' oleh '.auth()->user()->name
            ]);

            return response()->json(['success'=> true, 'message' => 'Akses '.$status.'!'], 200);
        });
    }

    public function update(Request $request, File $file)
    {

        $this->validate($request, [ 'tanggal_sidang' => 'required|string' ]);

        $file->update([ 'tgl_sidang' => $request->tanggal_sidang ]);

        return redirect()->back()->with(['success' => 'Tanggal Sidang berhasil dibuat!']);

    }

    public function chatList(File $file)
    {
        $chats = $file->chats()->with('user')->get();

        return response()->json(['success' => true, 'chats' => $chats], 200);
    }

    public function chatStore(Request $request, File $file)
    {
        return DB::transaction(function () use($request, $file) {
            $chat = $file->chats()->create([
                'user_id' => auth()->id(),
                'chat' => $request->chat,
                'is_admin' => auth()->user()->role != 'user' ? true : false,
            ]);
    
    
            return response()->json(['success' => true, 'message' => 'Terkirim.'], 200);
        });
        
        return response()->json(['success' => false, 'message' => 'Gagal terkirim.'], 400);
    }

    public function destroy(File $file)
    {
        if(auth()->user()->role != 'administrator') return response()->json(['status' => 'error', 'message' => 'Akses Ditolak!']);
        if(!$file) return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan!']);
        
        Storage::disk('public')->delete('dokumen/'.$file->file_1);
        Storage::disk('public')->delete('dokumen/'.$file->file_2);
        Storage::disk('public')->delete('dokumen/'.$file->file_3);

        $file->delete();

        return response()->json(['status' => 'success', 'message' => 'Berhasil di hapus!']);
    }

}

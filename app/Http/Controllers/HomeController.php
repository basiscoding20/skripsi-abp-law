<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function permohonan($name)
    {
        if(auth()->user()->role != 'user') return redirect()->route('home')->with(['error' => 'Admin tidak bisa membuat pengajuan!']);
        return view('permohonan', compact('name'));
    }

    public function permohonanStore(Request $request, $name)
    {
        $category = Category::where('name', $name)->firstOrFail();

        $this->validate($request, 
            [
                'file_1' => 'required|mimes:pdf|max:1000',
                'file_2' => 'sometimes|nullable|mimes:pdf|max:1000',
                'file_3' => 'sometimes|nullable|mimes:pdf|max:1000'
            ],
            [],
            [
                'file_1' => 'Dokumen Permasalahan 1',
                'file_2' => 'Dokumen Permasalahan 2',
                'file_3' => 'Dokumen Permasalahan 3',
            ]
        );

        $existFile = File::orderBy('id', 'desc')->first();
        $explode = $existFile ? explode('-', $existFile->no_pengajuan) : 0;
        $number = $explode != 0 ?  (int)$explode[1] + 1 : $explode + 1;
        $str = str_pad($number,5,0, STR_PAD_LEFT);
        $kode = $name;
        $noPengajuan = $kode.'-'.$str;

        $file1 = $request->file('file_1') ? $this->uploadDokumen($request->file('file_1')) : $request->file('file_1');
        $file2 = $request->file('file_2') ? $this->uploadDokumen($request->file('file_2')) : $request->file('file_2');
        $file3 = $request->file('file_3') ? $this->uploadDokumen($request->file('file_3')) : $request->file('file_3');


        return DB::transaction(function () use ($category, $noPengajuan, $file1, $file2, $file3, $name){
    
            $file = File::create([
                'user_id' => auth()->id(),
                'category_id' => $category->id,
                'no_pengajuan' => $noPengajuan,
                'file_1' => $file1,
                'file_2' => $file2,
                'file_3' => $file3,
            ]);
            
            Notification::with(['user', 'file'])->create([
                'user_id' => auth()->id(),
                'file_id' => $file->id,
                'notif' => 'Mengajukan kasus hukum '.$name
            ]);
    
            return redirect()->back()->with(['success' => 'Pengajuan Kasus Berhasil Dibuat!']);
        });

        return redirect()->back()->with(['error' => 'Pengajuan Kasus Gagal Dibuat!']);
    }

    private function uploadDokumen($inputFile)
    {
        $image_name = $inputFile;
        if($inputFile){
            $extension = $inputFile->extension();
            $image_name = time().rand(111,9999).'.'.$extension;
            $inputFile->storeAs('public/dokumen',$image_name);
            return $image_name;
        }
    }

    public function notification()
    {
        if(auth()->user()->role == 'administrator'){

            $notifications = Notification::with(['user', 'file'])->where('read', false)->whereHas('user', function($user){

                $user->where('role', 'user');

            })->latest()->get();

        }elseif(auth()->user()->role == 'pidana'){

            $notifications = Notification::with(['user', 'file'])->where('read', false)->whereHas('user', function($user){
                $user->where('role', 'user');
            })->whereHas('file', function($file){

                $file->whereHas('category', function($category){
                    $category->where('name', 'pidana');
                });

            })->latest()->get();

        }elseif(auth()->user()->role == 'perdata'){

            $notifications = Notification::with(['user', 'file'])->where('read', false)->whereHas('user', function($user){

                $user->where('role', 'user');

            })->whereHas('file', function($file){

                $file->whereHas('category', function($category){
                    $category->where('name', 'perdata');
                });

            })->whereHas('user', function($user){
                    $user->where('role', 'user');
                })->latest()->get();

        }else{

            $notifications = Notification::with(['user', 'file'])->where('read', false)->whereHas('user', function($user){

                $user->where('role', '!=' ,'user');

            })->whereHas('file', function($file){

                $file->where('user_id', auth()->id());

            })->latest()->get();

        }

        return response()->json(['success' => true, 'notifs' => $notifications], 200);
    }
}

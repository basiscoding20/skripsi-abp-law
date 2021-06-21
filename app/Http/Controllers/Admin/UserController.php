<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if(auth()->user()->role != 'administrator') return redirect()->route('dashboard')->with(['error' => 'Akses Ditolak!']);

        $users = User::latest()->when(request()->search, function($users) {
            $users = $users->where('name', 'like', '%'. request()->search . '%');
        })->paginate(env('PAGINATION') ?? 10);

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        if(auth()->user()->role != 'administrator') return redirect()->route('dashboard')->with(['error' => 'Akses Ditolak!']);
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
    {
        if(auth()->user()->role != 'administrator') return redirect()->route('dashboard')->with(['error' => 'Akses Ditolak!']);
        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'role'       => $request->role,
            'password'   => bcrypt($request->password),
        ]);

        if($user){
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(User $user)
    {
        if(auth()->user()->role != 'administrator') return redirect()->route('dashboard')->with(['error' => 'Akses Ditolak!']);

        return view('admin.user.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        if(auth()->user()->role != 'administrator') return redirect()->route('dashboard')->with(['error' => 'Akses Ditolak!']);
        
        $password = !empty($request->password) ? bcrypt($request->password) : $user->password;

        $user->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'role'       => $request->role,
            'password'   => $password
        ]);
 
        if($user){
             return redirect()->route('admin.users.index')->with(['success' => 'Data Berhasil Diupdate!']);
         }else{
             return redirect()->route('admin.users.index')->with(['error' => 'Data Gagal Diupdate!']);
         }
    }

    public function destroy(User $user)
    {
        if(auth()->user()->role != 'administrator') return redirect()->route('dashboard')->with(['error' => 'Akses Ditolak!']);
        if (auth()->id() == $user->id) {
            return response()->json(['status' => 'error', 'message' => 'Akun anda sendiri tidak bisa dihapus!']);
        }

        $user->delete();
    
        if($user){
            return response()->json(['status' => 'success', 'message' => 'Berhasil di hapus!']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan!']);
        }
    }
}

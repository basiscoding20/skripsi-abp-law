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
            })->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $totalPidana = File::whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $total = File::when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $laporanKasus = File::latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->take(10)->get();

        }elseif (auth()->user()->role == 'direktur') {

            $totalPerdata = File::where('status', '!=', 0)->whereHas('category', function($category){
                $category->where('name', 'perdata');
            })->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $totalPidana = File::where('status', '!=', 0)->whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $total = File::where('status', '!=', 0)->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $laporanKasus = File::where('status', '!=', 0)->latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->take(10)->get();

        }elseif (auth()->user()->role == 'perdata') {

            $totalPerdata = 0;

            $totalPidana = 0;

            $total = File::where('user_id', auth()->id())->whereHas('category', function($category){
                $category->where('name', 'perdata');
            })->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $laporanKasus = File::whereHas('category', function($category){
                $category->where('name', 'perdata');
            })->latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->take(10)->get();

        }elseif(auth()->user()->role == 'pidana'){

            $totalPerdata = 0;

            $totalPidana = 0;

            $total = File::where('user_id', auth()->id())->whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $laporanKasus = File::whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->latest()->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->take(10)->get();
            
        }else{
            $totalPerdata = File::where('user_id', auth()->id())->whereHas('category', function($category){
                $category->where('name', 'perdata');
            })->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $totalPidana = File::where('user_id', auth()->id())->whereHas('category', function($category){
                $category->where('name', 'pidana');
            })->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $total = File::where('user_id', auth()->id())->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->count();

            $laporanKasus = File::where('user_id', auth()->id())->when(request()->search, function($laporan) {
                $laporan->where('no_pengajuan', 'like', '%'. request()->search . '%');
            })->when(request()->status, function($status) {
                $status->where('status', request()->status);
            })->latest()->take(10)->get(); 
        }
        return view('admin.dashboard', compact('laporanKasus', 'totalPerdata', 'totalPidana', 'total'));
    }
}

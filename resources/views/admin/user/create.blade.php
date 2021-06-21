@extends('layouts.backEnd')

@section('title', 'CREATE USER | ABP LAW FIRM')

@section('content')
<div class="main-body">
    <div class="page-wrapper">

        {{-- components breadcrumb --}}
        <x-breadcrumb title="User" label="User" url="admin/users" label-active="Tambah User"/>

        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah User</h5>
                </div>
                <div class="card-block">
                    {!! Form::open(['route' => 'users.store']) !!}
                        @include('admin.user.input',['btn' => 'Simpan'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

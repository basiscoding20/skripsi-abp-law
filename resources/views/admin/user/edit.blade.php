@extends('layouts.backEnd')

@section('title', 'EDIT USER | ABP LAW FIRM')

@section('content')
<div class="main-body">
    <div class="page-wrapper">

        {{-- components breadcrumb --}}
        <x-breadcrumb title="User" label="User" url="admin/users" label-active="Edit User"/>

        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>Edit User</h5>
                </div>
                <div class="card-block">
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                        @include('admin.user.input',['btn' => 'Update'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

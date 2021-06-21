@extends('layouts.backEnd')

@section('title', 'USERS | ABP LAW FIRM')

@push('css_down')
<link rel="stylesheet" type="text/css" href="{{ asset('backEnd/assets/sweetalert/sweetalert.css') }}">  
@endpush

@section('content')
<div class="main-body">
    <div class="page-wrapper">

        {{-- components breadcrumb --}}
        <x-breadcrumb title="Users" label-active="Users"/>

        <div class="page-body">
            @if(Session::has('success')) <x-alert type="success"/> @endif
            @if(Session::has('error')) <x-alert type="danger"/> @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col-12 pull-left">
                            <h5>Daftar Users</h5>
                        </div>
                        <div class="col-md-6 col-12 pull-right text-right">
                            <a href="{{route('users.create')}}" class="btn btn-success"> Tambah Users</a>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-md-4 float-right">
                            {!! Form::open(['route' => 'users.index', 'method' => 'get']) !!}
                            <div class="input-group input-group-default">
                                {!! Form::text('search', request('search'), ['class' => 'form-control', 'placeholder' => 'Search']) !!}
                                {!! Form::button('<i class="icofont icofont-search"></i>', ['class' => 'btn btn-default input-group-addon', 'type' => 'submit', 'style' => 'padding: .5rem .75rem;']) !!}
                            </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" width="6%">No.</th>
                                    <th>Nama Users</th>
                                    <th>Email</th>
                                    <th width="200px">Role</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $no => $user)
                                <tr>
                                    <th class="text-center">
                                        {{ ++$no + ($users->currentPage()-1) * $users->perPage() }}
                                    </th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary p-2" data-toggle="tooltip" data-original-title="Edit Users">
                                            <span class="icofont icofont-ui-edit"></span>
                                        </a>

                                        <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger delete-data p-2" data-id="{{ $user->id }}" data-toggle="tooltip" data-original-title="Hapus Users"> 
                                            <span class="icofont icofont-ui-delete f-14"></span>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="5">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $users->appends(request()->only(['search']))->links('layouts.sections.admin.pagination') }}
                    
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('backEnd/assets/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backEnd/assets/sweetalert/custom-sweetalert.js') }}"></script>
@endpush
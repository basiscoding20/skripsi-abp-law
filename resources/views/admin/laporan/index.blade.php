@extends('layouts.backEnd')

@section('title', 'LAPORAN KASUS | ABP LAW FIRM')

@section('content')
<div class="main-body">
    <div class="page-wrapper">

        {{-- components breadcrumb --}}
        <x-breadcrumb title="Laporan" label-active="Laporan"/>

        <div class="page-body">
            @if(Session::has('success')) <x-alert type="success"/> @endif
            @if(Session::has('error')) <x-alert type="danger"/> @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 pull-left">
                            <h5>Laporan</h5>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    {{-- @if (auth()->user()->role != 'user') --}}
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-md-8 float-right">
                                {!! Form::open(['route' => 'laporan.export', 'method' => 'get']) !!}
                                <div class="form-group row">
                                    <div class="col"></div>
                                    <div class="col-md-4 float-right">
                                        {!! Form::select('status', ['' => '-- Pilih Status --', 1 => 'Disetujui', 2 => 'Ditolak'], request('status'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-4">
                                        {!! Form::select('category', $categories, request('category'), ['class' => 'form-control text-capitalize']) !!}
                                    </div>
                                    <div class="col-md-2">
                                        {!! Form::button('Export Excel', ['class' => 'btn btn-default input-group-addon', 'type' => 'submit', 'style' => 'padding: .5rem .75rem;']) !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                            </div>
                        </div>
                    {{-- @endif --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" width="6%">No.</th>
                                    <th>No Pengajuan</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Sidang</th>
                                    <th>Status</th>
                                    <th>User</th>  
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporanKasus as $no => $laporan)
                                <tr>
                                    <th class="text-center">
                                        {{ ++$no + ($laporanKasus->currentPage()-1) * $laporanKasus->perPage() }}
                                    </th>
                                    <td class="text-capitalize">{{ $laporan->no_pengajuan }}</td> 
                                    <td class="text-capitalize">{{ $laporan->category->name }}</td> 
                                    <td>{{ $laporan->tgl_sidang ? date('d/m/Y', strtotime($laporan->tgl_sidang)) : $laporan->tgl_sidang }}</td>
                                    <td>{{ ['Diajukan', 'Disetujui', 'Ditolak'][$laporan->status] }}</td>
                                    <td>{{ $laporan->user->name }}</td>  
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $laporanKasus->appends(request()->only(['search']))->links('layouts.sections.admin.pagination') }}
                    
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@extends('layouts.backEnd')

@section('title', 'DASHBOARD | ABP LAW FIRM')

@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">

            @if(Session::has('error')) <x-alert type="danger"/> @endif

            <div class="row">
                
                @if (auth()->user()->role == 'administrator' || auth()->user()->role == 'user')
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-blue f-w-600"> {{ $totalPerdata }}</h4>
                                    <h6 class="text-muted m-b-0">Total Perdata</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-calendar f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0">Total Pengajuan Perkara Perdata</p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-up text-white f-16"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-blue f-w-600">{{ $totalPidana }}</h4>
                                    <h6 class="text-muted m-b-0">Total Pidana</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-calendar f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0">Total Pengajuan Perkara Pidana</p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-up text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="text-c-blue f-w-600">{{ $total }}</h4>
                                    <h6 class="text-muted m-b-0">Total Pengajuan Perkara</h6>
                                </div>
                                <div class="col-4 text-right">
                                    <i class="feather icon-briefcase f-28"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-c-blue">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0">Semua Pengajuan Perkara</p>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="feather icon-trending-up text-white f-16"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!--  sale analytics start -->
            {{-- <div class="col-xl-12 col-md-12"> --}}
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Kasus Terbaru</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="feather icon-maximize full-card"></i></li>
                                <li><i class="feather icon-minus minimize-card"></i></li>
                                <li><i class="feather icon-trash-2 close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        {{-- @if (auth()->user()->role != 'user') --}}
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-md-4 float-right">
                                    {!! Form::open(['route' => 'dashboard', 'method' => 'get']) !!}
                                    <div class="input-group input-group-default">
                                        {!! Form::search('search', request('search'), ['class' => 'form-control', 'placeholder' => 'Search']) !!}
                                        {!! Form::button('<i class="icofont icofont-search"></i>', ['class' => 'btn btn-default input-group-addon', 'type' => 'submit', 'style' => 'padding: .5rem .75rem;']) !!}
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
                                        <th>Dokumen Permasalahan 1</th>
                                        <th>Dokumen Permasalahan 2</th>
                                        <th>Dokumen Permasalahan 3</th>
                                        <th>Tanggal Sidang</th>
                                        <th>Status</th>
                                        @if (auth()->user()->role != 'user')
                                        <th>User</th>   
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporanKasus as $no => $laporan)
                                    <tr>
                                        <th class="text-center">
                                            {{ ++$no }}
                                        </th>
                                        <td class="text-capitalize">{{ $laporan->no_pengajuan }}</td> 
                                        <td class="text-capitalize">{{ $laporan->category->name }}</td> 
                                        <td>
                                            @if ($laporan->file_1)
                                            <a href="{{ asset('storage/dokumen/'.$laporan->file_1) }}" target="_blank">
                                                {{ $laporan->file_1 }}
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($laporan->file_2)
                                            <a href="{{ asset('storage/dokumen/'.$laporan->file_2) }}" target="_blank">
                                                {{ $laporan->file_2 }}
                                            </a>   
                                            @endif
                                        </td>
                                        <td>
                                            @if ($laporan->file_3)
                                            <a href="{{ asset('storage/dokumen/'.$laporan->file_3) }}" target="_blank">
                                                {{ $laporan->file_3 }}
                                            </a>
                                            @endif
                                        </td>
                                        <td>{{ $laporan->tgl_sidang ? date('d/m/Y', strtotime($laporan->tgl_sidang)) : $laporan->tgl_sidang }}</td>
                                        <td>{{ ['Diajukan', 'Disetujui', 'Ditolak'][$laporan->status] }}</td>
                                        @if (auth()->user()->role != 'user')
                                        <td>{{ $laporan->user->name }}</td>   
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        @if (auth()->user()->role != 'user')
                                        <td class="text-center" colspan="9">Belum ada data</td>
                                        @else
                                        <td class="text-center" colspan="8">Belum ada data</td>
                                        @endif
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            {{-- </div> --}}
            <!--  sale analytics end -->

        </div>
    </div>
</div>
@endsection
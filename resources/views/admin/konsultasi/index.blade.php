@extends('layouts.backEnd')

@section('title', 'PENGAJUAN KASUS | ABP LAW FIRM')

@push('css_down')
<link rel="stylesheet" type="text/css" href="{{ asset('backEnd/assets/sweetalert/sweetalert.css') }}">  
@endpush

@section('content')
<div class="main-body">
    <div class="page-wrapper">

        {{-- components breadcrumb --}}
        <x-breadcrumb title="Konsultasi" label-active="Konsultasi"/>

        <div class="page-body">
            @if(Session::has('success')) <x-alert type="success"/> @endif
            @if(Session::has('error')) <x-alert type="danger"/> @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 pull-left">
                            <h5>Daftar Pengajuan Kasus</h5>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    {{-- @if (auth()->user()->role != 'user') --}}
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-md-8 float-right">
                                {!! Form::open(['route' => 'pengajuan.index', 'method' => 'get']) !!}
                                <div class="form-group row">
                                    <div class="col"></div>
                                    <div class="col-md-4 float-right">
                                        {!! Form::select('status', ['' => '-- Search Status --', 1 => 'Disetujui', 2 => 'Ditolak'], request('status'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-4">
                                        {!! Form::search('search', request('search'), ['class' => 'form-control', 'placeholder' => 'Search']) !!}
                                    </div>
                                    <div class="col-md-1">
                                        {!! Form::button('<i class="icofont icofont-search"></i>', ['class' => 'btn btn-default input-group-addon', 'type' => 'submit', 'style' => 'padding: .5rem .75rem;']) !!}
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
                                    <th class="text-center">Jumlah Konsultasi</th>
                                    @if (auth()->user()->role != 'user')
                                    <th>User</th>   
                                    @endif
                                    @if (auth()->user()->role != 'direktur')
                                        <th>Action</th>
                                    @endif
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
                                    <td class="text-center">{{ $laporan->chats()->count() }}</td>
                                    @if (auth()->user()->role != 'user')
                                    <td>{{ $laporan->user->name }}</td>   
                                    @endif
                                    @if (auth()->user()->role != 'direktur')
                                    <td class="text-center">
                                        <a href="{{ route('konsultasi.show', $laporan->id) }}" class="btn btn-primary p-2" data-toggle="tooltip" data-original-title="Konsultasi Pengajuan">
                                            <span class="icofont icofont-ui-text-chat"></span>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    @if (auth()->user()->role != 'user'  || auth()->user()->role != 'direktur')
                                    <td class="text-center" colspan="8">Belum ada data</td>
                                    @else
                                    <td class="text-center" colspan="9">Belum ada data</td>
                                    @endif
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

<!-- Modal -->
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">TANGGAL SIDANG</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formModal" method="post">
            @method('put')
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::date('tanggal_sidang', null, ['class' => 'form-control', 'placeholder' => 'Masukan Tanggal Sidang', 'id' => 'tglSidang', 'min' => date('Y-m-d')]) !!}
                    @error('tanggal_sidang')  
                    <span class = "messages col-md-10 offset-md-2"><p class="text-danger error">{{ $message }}</p></span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('backEnd/assets/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backEnd/assets/sweetalert/custom-sweetalert.js') }}"></script>

<script>
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        $('#formModal').attr('action', $(this).attr('data-attr'));
        $('#tglSidang').val($(this).attr('data-value'));
    });
</script>
@endpush
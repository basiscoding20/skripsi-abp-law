@extends('layouts.frontEnd')

@section('title', Str::upper($name).' | ABP LAW FIRM')

@push('meta')
  <meta name="title" content="ABP LAW FIRM">
  <meta name="description" content="ABP Law Firm merupakan salah satu badan usaha yang terdiri dari beberapa advokat berpengalaman">
  <meta name="keywords" content="perdata, pidana, hukum, advokat">
@endpush

@section('slider')
  <section class="module bg-dark-30 about-page-header" data-background="https://i2.wp.com/abplawfirm.co.id/wp-content/uploads/2021/01/Hall-Depan-Cibis-Nine-scaled.jpg">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <h1 class="module-title font-alt mb-0">Pengajuan Kasus {{ $name }}</h1>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('content')
<section class="module" style="padding: 90px 0;">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2">
        <div style="box-shadow: 0 0 8px 1px rgb(0 0 0 / 15%); padding: 15px 25px 25px 25px; border-radius: 5px;">
          <h4 class="font-alt mb-0">Formulir Pengajuan</h4>
          <hr class="divider-w mt-10 mb-20">
          @if(Session::has('success')) <x-alert type="success"/> @endif
          @if(Session::has('error')) <x-alert type="danger"/> @endif
          {!! Form::open(['route' =>  ['permohonan.store', $name], 'class' => 'form', 'role' => 'form', 'files' => true]) !!}
            <div class="form-group">
              {!! Form::label('name', 'Nama', ['style' => 'font-size:14px; font-weight:600; color: black;']) !!}
              {!! Form::text('name', auth()->check() ? auth()->user()->name : null, ['class' => 'form-control input-lg', 'readonly']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('email', 'Email', ['style' => 'font-size:14px; font-weight:600; color: black;']) !!}
              {!! Form::email('email', auth()->check() ? auth()->user()->email : null, ['class' => 'form-control input-lg', 'readonly']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('file_1', 'Dokumen Permasalahan 1', ['style' => 'font-size:14px; font-weight:600; color: black;']) !!}
              {!! Form::file('file_1', ['class' => 'form-control input-lg']) !!}
              @error('file_1')  
                <span class = "messages col-10 offset-2"><p class="text-danger" style="font-size:14px;">{{ $message }}</p></span>
              @enderror
            </div>
            <div class="form-group">
              {!! Form::label('file_2', 'Dokumen Permasalahan 2', ['style' => 'font-size:14px; font-weight:600; color: black;']) !!}
              {!! Form::file('file_2', ['class' => 'form-control input-lg']) !!}
              @error('file_2')  
              <span class = "messages col-10 offset-2"><p class="text-danger" style="font-size:14px;">{{ $message }}</p></span>
            @enderror
            </div>
            <div class="form-group">
              {!! Form::label('file_3', 'Dokumen Permasalahan 3', ['style' => 'font-size:14px; font-weight:600; color: black;']) !!}
              {!! Form::file('file_3', ['class' => 'form-control input-lg']) !!}
              @error('file_3')  
                <span class = "messages col-10 offset-2"><p class="text-danger" style="font-size:14px;">{{ $message }}</p></span>
              @enderror
            </div>
            <div class="text-center">
              <button class="btn btn-block btn-round btn-d" type="submit">Submit</button>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

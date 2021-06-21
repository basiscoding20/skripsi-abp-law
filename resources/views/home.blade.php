@extends('layouts.frontEnd')

@section('title', 'HOME | ABP LAW FIRM')

@push('meta')
  <meta name="title" content="ABP LAW FIRM">
  <meta name="description" content="ABP Law Firm merupakan salah satu badan usaha yang terdiri dari beberapa advokat berpengalaman">
  <meta name="keywords" content="perdata, pidana, hukum, advokat">
@endpush

@section('slider')
  <section class="home-section bg-dark bg-gradient" id="home" data-background="https://i2.wp.com/abplawfirm.co.id/wp-content/uploads/2021/01/Hall-Depan-Cibis-Nine-scaled.jpg">
    <div class="titan-caption">
      <div class="caption-content">
        <div class="font-alt mb-5 titan-title-size-4">ABP LAW FIRM</div>
        <div class="mb-30" style="padding: 0 18em; font-size: 18px; font-weight: 300; font-style: italic;"> 
            ABP Law Firm merupakan salah satu badan usaha yang terdiri dari beberapa advokat berpengalaman untuk membantu mengatasi permasalahan hukum seperti layanan hukum pidana dan perdata, pelayanan secara non-litigasi, hukum lingkungan, hukum teknologi dan informasi, serta perburuhan dan ketenagakerjaan.
        </div>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <section class="module" id="services" style="padding-top: 55px;">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <h2 class="module-title font-alt">Practice Areas Specialities</h2>
        </div>
      </div>
      @if(Session::has('error')) <x-alert type="danger"/> @endif
      <div class="row multi-columns-row">

        <div class="col-md-6 col-sm-6 col-xs-12" onclick="location.href='{{ route('permohonan', 'perdata')}}'">
          <div class="features-item">
            <div class="features-icon"><span class="icon-focus"></span></div>
            <h3 class="features-title font-alt">Perdata</h3>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12" onclick="location.href='{{ route('permohonan', 'pidana')}}'">
          <div class="features-item">
            <div class="features-icon"><span class="icon-attachment"></span></div>
            <h3 class="features-title font-alt">Pidana</h3>
          </div>
        </div>
        
      </div>
    </div>
  </section>
@endsection

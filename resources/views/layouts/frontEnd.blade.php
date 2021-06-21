<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('meta')
   
    <title>@yield('title', 'ABP LAW FIRM')</title>
   
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('front/images/favicons/apple-icon-57x57.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('front/images/favicons/favicon-16x16.png') }}">
    
    @include('layouts.sections.front.css')
  </head>
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
      
      @include('layouts.sections.front.navbar')

      @yield('slider')

      <div class="main">

        @yield('content')

        @include('layouts.sections.front.footer')
        
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>
    
    @include('layouts.sections.front.js')
   
  </body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title ?? config('app.name') }} - Auth</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Authentication ". {{$title ?? config('app.name')}}>
    <meta name="keywords" content="Admin , Authentication">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('backEnd/img/favicon.ico') }}" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backEnd/assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backEnd/assets/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backEnd/assets/icofont/css/icofont.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backEnd/css/style.css') }}">
    <style>
        .login-block{
            background: rgb(110,103,214);
            background: linear-gradient(72deg, rgba(110,103,214,1) 0%, rgba(64,193,205,1) 76%, rgba(0,212,255,1) 100%);
        }
    </style>
    @stack('css')
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    @yield('content')

    <script type="text/javascript" src="{{ asset('backEnd/js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backEnd/js/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backEnd/js/popper/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backEnd/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backEnd/assets/modernizr/js/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backEnd/assets/modernizr/js/css-scrollbars.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backEnd/js/common-pages.js') }}"></script>
    @stack('js')
</body>

</html>

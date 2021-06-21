<!DOCTYPE html>
<html lang="en">

<head>
    <title> @yield('title', 'ABP LAW FIRM')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="flat ui, admin Admin">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="icon" href="..\files\assets\images\favicon.ico" type="image/x-icon">

    @include('layouts.sections.admin.css')
</head>

<body>
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

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            @include('layouts.sections.admin.navbar')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    @include('layouts.sections.admin.sidebar')

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            @yield('content')

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('layouts.sections.admin.js')
</body>

</html>
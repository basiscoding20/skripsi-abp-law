<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">

            <li class="{{setActive('admin')}}">
                <a href="{{route('dashboard')}}">
                    <span class="pcoded-micon"><i class="feather icon-monitor"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>

            <li class="{{setActive('pengajuan*')}}">
                <a href="{{route('pengajuan.index')}}">
                    <span class="pcoded-micon"><i class="feather icon-calendar"></i></span>
                    <span class="pcoded-mtext">Pengajuan Hukum</span>
                </a>
            </li>

            @if (auth()->user()->role == 'administrator')
            <li class="{{setActive('user*')}}">
                <a href="{{route('users.index')}}">
                    <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                    <span class="pcoded-mtext">User</span>
                </a>
            </li>
            @endif

        </ul>
    </div>
</nav>
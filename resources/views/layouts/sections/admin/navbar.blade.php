<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="javascript:void(0)">
                <i class="feather icon-menu"></i>
            </a>
            <a href="{{route('dashboard')}}">
                <h3 class="title-logo">Dashboard</h3>
                {{-- <img class="img-fluid" src="" alt="Theme-Logo"> --}}
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <a href="javascript:void(0)" onclick="javascript:toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
                <li>
                    <a href="{{url('/')}}" target="_blank">
                        <i class="feather icon-home"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-bell"></i>
                            <span class="badge bg-c-pink count-notif">0</span>
                        </div>
                        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <h6>Notifications</h6>
                                <label class="label label-danger label-notif">New</label>
                            </li>
                            <span class="notif">
                            
                            </span>
                        </ul>
                    </div>
                </li>
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('backEnd/img/avatar.jpg')}}" class="img-radius" alt="User-Image">
                            <span>{{ auth()->user()->name }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                                {!! Form::open(['route' => 'logout', 'class' => 'd-none', 'id' => 'logout-form']) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('js_up')
<script>
    function notifications() {
        $.ajax({
            url: '{{url("notification")}}',
            dataType: 'json',
            success: function(response) {
                // json response
                let notifs = response.notifs, notif = '',
                    image = '{{asset("backEnd/img/avatar.jpg")}}';
                
                $('.label-notif').hide();
                if (notifs.length) {
                    $('.count-notif').html(notifs.length);
                    $('.label-notif').show();
                }

                $.each(notifs, function(index, value) {
                    let url = '{{ url("pengajuan") }}'+ '/' + value.file.id;
                    notif += `
                    <li>
                        <a href="${ url }" class="p-0">
                            <div class="media">
                                <img class="d-flex align-self-center img-radius" src="${image}" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="notification-user">${value.user.name}</h5>
                                    <p class="notification-msg">${value.notif}</p>
                                    <span class="notification-time">${value.format_date}</span>
                                </div>
                            </div>
                        </a>
                    </li>`;

                    $('.notif').html(notif);
                });
                // ===============================================================================\
            }
        })
    };

    notifications();

    setInterval(function() {
        notifications();
    }, 4000);
</script>
@endpush
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="{{ url('/') }}">ABP LAW FIRM</a>
    </div>
    <div class="collapse navbar-collapse" id="custom-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ url('/') }}">HOME</a></li>
        @guest
          @if (Route::has('login'))
            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
          @endif

          @if (Route::has('register'))
            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
          @endif
        @else
          <li class="dropdown">
            <a  class="dropdown-toggle" href="#" data-toggle="dropdown">{{ Auth::user()->name }}</a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li>
                <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
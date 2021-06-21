    <!-- Page-header start -->
    <div class="card">
        <div class="card-block caption-breadcrumb">
            <div class="breadcrumb-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{url('/')}}">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    @if (@count($breadcrumbs) > 0)
                        @foreach ($breadcrumbs as $crumb)
                            @if ($crumb->active)
                                <li class="breadcrumb-item active">{{ $crumb->label }}</li>
                            @else
                                <li class="breadcrumb-item">
                                    <a href="{{url($crumb->url)}}">{{ $crumb->label }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
@extends('auth.layout', ['title' => 'Login | ABP LAW FIRM'])
@section('content')
<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                {!! Form::open(['route' => 'login', 'class' => 'md-float-material form-material']) !!}
                {{-- <div class="text-center">
                        <img src="..\files\assets\images\logo.png" alt="logo.png">
                    </div> --}}
                    
                    <div class="auth-box card">
                        <div class="card-block p-4">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Sign In</h3>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-{{ $errors->first('email') ? 'danger' : 'primary'}} mb-0">
                                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Your Email Address']) !!}
                                    <span class="input-group-addon">
                                        <i class="icofont icofont-envelope-open"></i>
                                    </span>
                                </div>
                                @error('email')  
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-{{ $errors->first('password') ? 'danger' : 'primary'}} mb-0">
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!} 
                                    <span class="input-group-addon">
                                        <i class="icofont icofont-ui-unlock"></i>
                                    </span>
                                </div>
                                @error('password')  
                                <span class="messages">
                                    <p class="text-danger error">{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary d-">
                                        <label>
                                            <input type="checkbox" name="remember">
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">Remember me</span>
                                        </label>
                                    </div>
                                    <div class="forgot-phone text-right f-right">
                                        <a href="{{route('password.request')}}" class="text-right f-w-600"> Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    {!! Form::submit('Sign in', ['class' => 'btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20']) !!}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-inverse text-left"><a href="{{url('/')}}"><b class="f-w-600">Back to website</b></a></p>
                                </div>
                                <div class="col-md-4">
                                    <p class="text-inverse text-right"><a href="{{route('register')}}"><b class="f-w-600">Register</b></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- end of container-fluid -->
</section>   
@endsection
<div class="form-group row">
    {!! Form::label('name', 'Nama Lengkap', ['class' => 'col-sm-2 col-form-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Masukan Nama Lengkap']) !!}
    </div>
    @error('name')  
    <span class = "messages col-md-10 offset-md-2"><p class="text-danger error">{{ $message }}</p></span>
    @enderror
</div>

<div class="form-group row">
    {!! Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label']) !!}
    <div class="col-sm-10">
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Masukan Email', 'autocomplete' => 'off']) !!}
    </div>
    @error('email')  
    <span class = "messages col-10 offset-2"><p class="text-danger error">{{ $message }}</p></span>
    @enderror
</div>

<div class="form-group row">
    {!! Form::label('role', 'Role', ['class' => 'col-sm-2 col-form-label']) !!}
    <div class="col-sm-10">
        @php
            $role = ['' => '-- Pilih --','administrator' => 'administrator', 'pidana' => 'pidana', 'perdata' => 'perdata', 'user' => 'user'];
        @endphp
        {!! Form::select('role', $role, null ,['class' => 'form-control']) !!}
    </div>
    @error('role')  
    <span class = "messages col-10 offset-2"><p class="text-danger error">{{ $message }}</p></span>
    @enderror
</div>

<div class="form-group row">
    {!! Form::label('password', 'Password', ['class' => 'col-sm-2 col-form-label']) !!}
    <div class="col-sm-10">
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Masukan Password', 'autocomplete' => 'off']) !!}
    </div>
    @error('password')  
    <span class = "messages col-10 offset-2"><p class="text-danger error">{{ $message }}</p></span>
    @enderror
</div>

<div class="form-group row">
    {!! Form::label('password_confirmation', 'Konfirmasi Password', ['class' => 'col-sm-2 col-form-label']) !!}
    <div class="col-sm-10">
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Masukan Password Konfirmasi', 'autocomplete' => 'off']) !!}
    </div>
</div>


<div class="form-group row">
    {!! Form::label('', '', ['class' => 'col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::submit($btn, ['class' => 'btn btn-success btn-sm']) !!}
        {!! Form::button('Reset', ['class' => 'btn btn-warning btn-sm', 'type' => 'reset']) !!}
        <a href="{{ route('users.index') }}" class="btn btn-inverse btn-sm">Kembali</a>
    </div>
</div>
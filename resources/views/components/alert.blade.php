
@php
 $status =  [
     'profile-information-updated' => 'Profile has been updated.',
     'password-updated' => 'Password has been updated.',
     'two-factor-authentication-disabled' => 'Two factor authentication disabled.',
     'two-factor-authentication-enabled' => 'Two factor authentication enabled.',
     'recovery-codes-generated' => 'Recovery codes generated.'
     ]; 
@endphp

@if (session('status') || session('success') || session('error'))
<div class="alert alert-{{ $type }} background-{{ $type }} {{session('status') ? ' mb-0' : ''}}">
    <button type="button" class="close"
        data-dismiss="alert" aria-label="Close">
        <i class="icofont icofont-close-line-circled text-white"></i>
    </button> 
    <strong>
        {{ $status[session('status')] ?? session('status') ?? session('success') ?? session('error') }}
    </strong>
</div>
@endif

@component('mail::message')
Hello, {{ $user->userEmail }}
@component('mail::button', ['url' => route('passwordResetting', ['token' => $user->remember_token])])
Reset Your Password
@endcomponent
@endcomponent

Hello {{ $user->name }},

<br><br>

Your new login password is: <b>{{ $user->password_random }}</b>

<br><br>

Thank you,<br>
{{ config('app.name') }}

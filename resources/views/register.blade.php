<!-- resources/views/auth/register.blade.php -->

@extends('layouts.main')

@section('content')
<img src="/imgs/dotmotors.png" alt="logo" style="width: 150px; height: 50px; position: absolute; top: 10px; left: 50%; transform: translateX(-50%); border-radius: 8px 0px 0px 0px; opacity: 1;">
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Register</button>
</form>
@endsection

@extends('layouts.main')

@section('title', 'Laravel')

@section('content')
    <div style="position: relative; width: 100%; height: 100%;">
        <img src="/imgs/dotmotors.png" alt="logo" style="width: 450px; height: 150px; position: absolute; top: 60px; left: 50%; transform: translateX(-50%); border-radius: 8px 0px 0px 0px; opacity: 1;">
        <img src="/imgs/moto.png" alt="moto" style="width: 414px; height: 652px; position: absolute; top: 300px; left: 46%; transform: translateX(-50%); opacity: 1;">
        
        <a href="{{ route('register') }}" class="button create-account">Criar Conta</a>
        <a href="{{ route('login') }}" class="button sign-in">Iniciar Sessão</a>
    </div>

    <style>
        .button {
            width: 320px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        .create-account {
            background: #393939;
            top: 654px;
        }
        .sign-in {
            background: #FD7813;
            top: 582px;
        }
    </style>
@endsection

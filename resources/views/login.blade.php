@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('login') }}">
    <img src="/imgs/dotmotors.png" alt="logo" style="width: 150px; height: 50px; position: absolute; top: 20px; left: 50%; transform: translateX(-50%); border-radius: 8px 0px 0px 0px; opacity: 1;">
        <div class="content2">      
            <h1 class="login" input="text"> Iniciar Sessão </h1>
            @csrf
            <div>
                <label for="nomeCliente">Nome do Cliente</label>
                <input type="text" id="nomeCliente" name="nomeCliente">
            </div>
            <div>
                <label class="label" for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </div>
        <footer>
            <div class="footer1">
                <p> Dot Mind Ltda &copy; </p>
            </div>
        </footer>
</form>

<style> 
    .footer1 {
        width: 450px;
        height: 80px;
        background: #393939;
        font-size: 8px;
    }
    .content2 {
        height: 800px;
        width: 450px;
        align-items: center;
        background: #F9F9F9;
    }
    
    .login {
        width: 194px;
        height: 27px;
        top: 85px;
        left: 110px;
        color: #FD7813;
    }

    label {
        font-weight: bold;
        font-size: 14px;
        color: #333;
        display: block;
        margin-bottom: 8px;
    }

</style>
@endsection

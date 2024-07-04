<?php

namespace App\Http\Controllers;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Exception\AwsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $cognitoClient;

    public function __construct()
    {
        $this->cognitoClient = new CognitoIdentityProviderClient(config('aws'));
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        try {
            $result = $this->cognitoClient->signUp([
                'ClientId' => env('COGNITO_CLIENT_ID'),
                'Username' => $request->email,
                'Password' => $request->password,
                'UserAttributes' => [
                    [
                        'Name' => 'email',
                        'Value' => $request->email,
                    ],
                ],
            ]);

            // Se necessário, confirmar o registro aqui (envio de código de confirmação)

            return redirect()->route('login')->with('status', 'Registration successful. Please confirm your email.');
        } catch (AwsException $e) {
            return back()->withErrors(['error' => $e->getAwsErrorMessage()]);
        }
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        try {
            $result = $this->cognitoClient->adminInitiateAuth([
                'AuthFlow' => 'ADMIN_NO_SRP_AUTH',
                'ClientId' => env('COGNITO_CLIENT_ID'),
                'UserPoolId' => env('COGNITO_USER_POOL_ID'),
                'AuthParameters' => [
                    'USERNAME' => $request->email,
                    'PASSWORD' => $request->password,
                ],
            ]);

            $session = [
                'AccessToken' => $result->get('AuthenticationResult')['AccessToken'],
                'IdToken' => $result->get('AuthenticationResult')['IdToken'],
                'RefreshToken' => $result->get('AuthenticationResult')['RefreshToken'],
            ];

            Session::put('cognito_session', $session);

            return redirect()->route('dashboard'); // Altere para a rota de dashboard ou outra rota protegida
        } catch (AwsException $e) {
            return back()->withErrors(['error' => $e->getAwsErrorMessage()]);
        }
    }
}

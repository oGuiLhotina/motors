<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Exception\AwsException;

class RegisterController extends Controller {
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct() {
        $this->middleware('guest');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

        protected function create(array $data) {
        \Log::info('Iniciando registro do usuário no Cognito');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        \Log::info('Usuário criado no banco de dados local', ['user' => $user]);

        $cognitoClient = new CognitoIdentityProviderClient([
            'region' => env('AWS_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        try {
            $result = $cognitoClient->signUp([
                'ClientId' => env('COGNITO_CLIENT_ID'),
                'Username' => $data['email'],
                'Password' => $data['password'],
                'UserAttributes' => [
                    [
                        'Name' => 'email',
                        'Value' => $data['email'],
                    ],
                    [
                        'Name' => 'name',
                        'Value' => $data['name'],
                    ],
                ],
            ]);

            \Log::info('Usuário registrado no Cognito', ['result' => $result]);
        } catch (AwsException $e) {
            \Log::error('Erro ao registrar no Cognito: ' . $e->getMessage());
            throw new \Exception('Erro ao registrar no Cognito: ' . $e->getMessage());
        }

        return $user;
    }

    public function showRegistrationForm() {
        return view('auth.register');
    }
}


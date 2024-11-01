<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'document_type' => ['required', 'string', 'max:50'],
            'document_number' => ['required', 'string', 'max:50', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name_paternal' => ['required', 'string', 'max:255'],
            'last_name_maternal' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'nationality' => ['required', 'string', 'max:50'],
            'gender' => ['required', 'string', 'max:10'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'document_type' => $data['document_type'],
            'document_number' => $data['document_number'],
            'first_name' => $data['first_name'],
            'last_name_paternal' => $data['last_name_paternal'],
            'last_name_maternal' => $data['last_name_maternal'],
            'birth_date' => $data['birth_date'],
            'nationality' => $data['nationality'],
            'gender' => $data['gender'],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // O nome da sua view de registro (por exemplo, auth/register.blade.php)
    }
}

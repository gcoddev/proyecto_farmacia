<?php
namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function forgotPassword()
    {
        return view('template/authentication/forgotPassword');
    }

    public function signIn()
    {
        return view('template/authentication/signIn');
    }

    public function signUp()
    {
        return view('template/authentication/signUp');
    }
}

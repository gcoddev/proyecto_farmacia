<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function addUser()
    {
        return view('template/users/addUser');
    }

    public function usersGrid()
    {
        return view('template/users/usersGrid');
    }

    public function usersList()
    {
        return view('template/users/usersList');
    }

    public function viewProfile()
    {
        return view('template/users/viewProfile');
    }
}

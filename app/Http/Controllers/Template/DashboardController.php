<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('template/dashboard/index');
    }

    public function index2()
    {
        return view('template/dashboard/index2');
    }

    public function index3()
    {
        return view('template/dashboard/index3');
    }

    public function index4()
    {
        return view('template/dashboard/index4');
    }

    public function index5()
    {
        return view('template/dashboard/index5');
    }

    public function wallet()
    {
        return view('template/dashboard/wallet');
    }
}

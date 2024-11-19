<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function company()
    {
        return view('template/settings/company');
    }

    public function currencies()
    {
        return view('template/settings/currencies');
    }

    public function language()
    {
        return view('template/settings/language');
    }

    public function notification()
    {
        return view('template/settings/notification');
    }

    public function notificationAlert()
    {
        return view('template/settings/notificationAlert');
    }

    public function paymentGateway()
    {
        return view('template/settings/paymentGateway');
    }

    public function theme()
    {
        return view('template/settings/theme');
    }
}

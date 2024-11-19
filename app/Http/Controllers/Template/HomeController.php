<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function calendar()
    {
        return view('template/calendar');
    }

    public function chatMessage()
    {
        return view('template/chatMessage');
    }

    public function chatEmpty()
    {
        return view('template/chatEmpty');
    }

    public function veiwDetails()
    {
        return view('template/veiwDetails');
    }

    public function email()
    {
        return view('template/email');
    }

    public function error1()
    {
        return view('template/error');
    }

    public function faq()
    {
        return view('template/faq');
    }

    public function gallery()
    {
        return view('template/gallery');
    }

    public function kanban()
    {
        return view('template/kanban');
    }

    public function pricing()
    {
        return view('template/pricing');
    }

    public function termsCondition()
    {
        return view('template/termsCondition');
    }

    public function widgets()
    {
        return view('template/widgets');
    }
    public function chatProfile()
    {
        return view('template/chatProfile');
    }
}

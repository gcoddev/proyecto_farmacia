<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AiapplicationController extends Controller
{
    public function codeGenerator()
    {
        return view('template/aiapplication/codeGenerator');
    }

    public function codeGeneratorNew()
    {
        return view('template/aiapplication/codeGeneratorNew');
    }

    public function imageGenerator()
    {
        return view('template/aiapplication/imageGenerator');
    }

    public function textGenerator()
    {
        return view('template/aiapplication/textGenerator');
    }

    public function textGeneratorNew()
    {
        return view('template/aiapplication/textGeneratorNew');
    }

    public function videoGenerator()
    {
        return view('template/aiapplication/videoGenerator');
    }

    public function voiceGenerator()
    {
        return view('template/aiapplication/voiceGenerator');
    }
}

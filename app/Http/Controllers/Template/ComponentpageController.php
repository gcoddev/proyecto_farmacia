<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComponentpageController extends Controller
{
    public function alert()
    {
        return view('template/componentspage/alert');
    }

    public function avatar()
    {
        return view('template/componentspage/avatar');
    }

    public function badges()
    {
        return view('template/componentspage/badges');
    }

    public function button()
    {
        return view('template/componentspage/button');
    }

    public function calendar()
    {
        return view('template/calendar');
    }

    public function card()
    {
        return view('template/componentspage/card');
    }

    public function carousel()
    {
        return view('template/componentspage/carousel');
    }

    public function colors()
    {
        return view('template/componentspage/colors');
    }

    public function dropdown()
    {
        return view('template/componentspage/dropdown');
    }

    public function imageUpload()
    {
        return view('template/componentspage/imageUpload');
    }

    public function list()
    {
        return view('template/componentspage/list');
    }

    public function pagination()
    {
        return view('template/componentspage/pagination');
    }

    public function progress()
    {
        return view('template/componentspage/progress');
    }

    public function radio()
    {
        return view('template/componentspage/radio');
    }

    public function starRating()
    {
        return view('template/componentspage/starRating');
    }

    public function switch()
    {
        return view('template/componentspage/switch');
    }

    public function tabs()
    {
        return view('template/componentspage/tabs');
    }

    public function tags()
    {
        return view('template/componentspage/tags');
    }

    public function tooltip()
    {
        return view('template/componentspage/tooltip');
    }

    public function typography()
    {
        return view('template/componentspage/typography');
    }

    public function videos()
    {
        return view('template/componentspage/videos');
    }
}

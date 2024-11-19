<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function columnChart()
    {
        return view('template/chart/columnChart');
    }

    public function lineChart()
    {
        return view('template/chart/lineChart');
    }

    public function pieChart()
    {
        return view('template/chart/pieChart');
    }
}

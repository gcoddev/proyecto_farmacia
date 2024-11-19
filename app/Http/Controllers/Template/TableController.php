<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function tableBasic()
    {
        return view('template/table/tableBasic');
    }

    public function tableData()
    {
        return view('template/table/tableData');
    }
}

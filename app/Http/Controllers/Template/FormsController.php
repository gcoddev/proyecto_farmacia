<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function formLayout()
    {
        return view('template/forms/formLayout');
    }
    
    public function formValidation()
    {
        return view('template/forms/formValidation');
    }
    
    public function form()
    {
        return view('template/forms/form');
    }
    
    public function wizard()
    {
        return view('template/forms/wizard');
    }
    
}

<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoiceAdd()
    {
        return view('template/invoice/invoiceAdd');
    }

    public function invoiceEdit()
    {
        return view('template/invoice/invoiceEdit');
    }

    public function invoiceList()
    {
        return view('template/invoice/invoiceList');
    }

    public function invoicePreview()
    {
        return view('template/invoice/invoicePreview');
    }
}

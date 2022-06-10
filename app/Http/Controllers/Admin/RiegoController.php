<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiegoController extends Controller
{

    public function index()
    {
        return view('admin.reports.risks.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbonoController extends Controller
{

    public function index()
    {
        return view('admin.reports.fertilizers.index');
    }
}

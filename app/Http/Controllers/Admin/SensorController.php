<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SensorController extends Controller
{
    public function index()
    {
        return view('admin.sensores.index');
    }

    public function humedad_all(Request $request)
    {

        $sensor = DB::table('sensors')
            ->select('sensors.*')
            ->orderBy('id', 'DESC')->get();

        return response(json_encode($sensor), 200)->header('Content-type', 'text/plain');
    }
}

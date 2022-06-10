<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sensor;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //

    public function __invoke()
    {
        // $mensaje = "¡EMPEZÓ BLACK FRIDAY en Tiendamia! Hasta 90% dscto + ENVÍO INTL GRATIS  <a class='font-bold' href='" . route('orders.index') ."?status=1'>Ver Ofertas</a>";

        // session()->flash('flash.banner', $mensaje);

        if (auth()->user()) {

            // $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();

            $alkalinity =  Sensor::where('status_alkalinity', 0)->where('alkalinity', '<=', 4.8)->count();
            $humdity =   Sensor::where('status_humidity', 0)->where('humidity', '<=', 40)->count();

            if ($alkalinity) {
                $mensaje_alkalinity = "Usted tiene $alkalinity registro de nivel de PH inferior. <a class='font-bold px-2 py-1 ml-3' style='color: rgb(255, 255, 255);font-size : 14px;border-radius: 20px;border: 2px solid white;' href='" . route('reports.abono.index') . "'>Ir a registro de abono</a>";

                session()->flash('flash.banner', $mensaje_alkalinity);
                session()->flash('flash.bannerStyle', 'danger');
            }
            if ($humdity) {
                $mensaje_humdity = "Usted tiene $humdity registro de nivel de humedad inferior. <a class='font-bold px-2 py-1 ml-3' style='color: rgb(255, 255, 255);font-size : 14px;border-radius: 20px;border: 2px solid white;' href='" . route('reports.riego.index') . "'>Ir a registro de riesgo</a>";

                session()->flash('flash.bannerv', $mensaje_humdity);
                session()->flash('flash.bannerStylev', 'danger');
            }
        }

        $h1 = "Dashboard";
        $small = "Control panel";

        $products = Product::count();
        $users = User::count();

        return view('welcome', compact('h1', 'small', 'users', 'products'));
    }
}

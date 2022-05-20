<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sensor;
use Livewire\Component;

class ShowSensor extends Component
{
    public $status_type = 2;

    public function render()
    {
        $h1 = "Sensores";
        $small = "Lista Sensores";

        $sensores =  Sensor::orderBy('id', 'desc')->paginate(20);

        $data_sensores = Sensor::orderBy('id', 'desc')->first();

        return view('livewire.admin.show-sensor', compact('sensores', 'data_sensores', 'h1', 'small'));
    }
}

<?php
use Illuminate\Support\Facades\DB;
?>
<div>

    <section class="content-header">
        <h1>
            {{ $h1 }}
            <small>{{ $small }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{ $h1 }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <div class="content">

        <div x-data="{ status_type: @entangle('status_type') }">
            <!-- Create item content -->
            <div class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <div class="box box-default ">
                    <div class="box-header with-border">
                        <input x-model="status_type" type="radio" value="1" name="status_type" class="text-gray-600">
                        <h3 class="px-4 box-title">Grafico Sensor</h3>

                    </div>
                    <div class="box-body hidden " :class="{ 'hidden': status_type != 1 }">
                        {{-- <div class="box-body"> --}}

                        <section class=" ">
                            <div class=" ">
                                <div class=" ">
                                    <div class="box box-primary flex justify-center items-center">

                                        {{-- <div class="box-body">

                                            <div class="grid grid-cols-1 md:grid-cols-2">
                                                <div class="px-2 py-2">
                                                    <label for="input_name">Nombre y Apellido</label>
                                                    <input wire:model.defer="createForm.name" type="text"
                                                        class="form-control" id="input_name">
                                                    <x-jet-input-error for="createForm.name" />
                                                </div>

                                                <div class="px-2 py-2">
                                                    <label for="input_email">Correo Electronico</label>
                                                    <input wire:model.defer="createForm.email" type="text"
                                                        class="form-control" id="input_email">
                                                    <x-jet-input-error for="createForm.email" />
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2">
                                                <div class="px-2 py-2">
                                                    <label for="input_num_doc">Num. Documento</label>
                                                    <input wire:model.defer="createForm.num_doc" type="text"
                                                        class="form-control" id="input_num_doc"
                                                        onkeypress='javascript: return isNumber (event)'>
                                                    <x-jet-input-error for="createForm.num_doc" />
                                                </div>

                                                <div class="px-2 py-2">
                                                    <label for="input_phone">Telefono</label>
                                                    <input wire:model.defer="createForm.phone" type="text"
                                                        class="form-control" id="input_phone"
                                                        onkeypress='javascript: return isNumber (event)'>
                                                    <x-jet-input-error for="createForm.phone" />
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2">
                                                <div class="px-2 py-2">
                                                    <label for="input_gender">Sexo</label>
                                                     <div class="form-group" id="input_gender">
                                                        <label>
                                                            <input type="radio" value="1" name="gender"
                                                                class="minimal"
                                                                wire:model.defer="createForm.gender">
                                                            Hombre
                                                        </label>
                                                        <label style="margin-left:10px">
                                                            <input type="radio" value="2" name="gender"
                                                                class="minimal"
                                                                wire:model.defer="createForm.gender">
                                                            Mujer
                                                        </label>
                                                    </div>
                                                    <x-jet-input-error for="createForm.gender" />
                                                </div>

                                                <div class="px-2 py-2">
                                                    <label for="input_rol">Rol</label>
                                                    <!-- radio -->
                                                    <div class="form-group" id="input_rol">
                                                        <label>
                                                            <input type="radio" value="1" name="rol"
                                                                class="minimal"
                                                                wire:model.defer="createForm.rol">
                                                            Admin
                                                        </label>
                                                        <label style="margin-left:10px">
                                                            <input type="radio" value="2" name="rol"
                                                                class="minimal"
                                                                wire:model.defer="createForm.rol">
                                                            Empleado
                                                        </label>
                                                        <label style="margin-left:10px">
                                                            <input type="radio" value="3" name="rol"
                                                                class="minimal"
                                                                wire:model.defer="createForm.rol">
                                                            Ninguno
                                                        </label>
                                                    </div>
                                                    <x-jet-input-error for="createForm.rol" />
                                                </div>

                                            </div>

                                        </div> --}}

                                        <div class="box-body w-full md:w-1/2">

                                            {{-- <canvas id="myChart" width="400" height="400"></canvas> --}}

                                            <div class="grid grid-cols-1">
                                                <div class="flex flex-col px-4 py-2">
                                                    <h4> Humedad (0-100 %)</h4>
                                                    <div class="progress">
                                                        {{-- <div class="progress-bar progress-bar-danger" role="progressbar"
                                                            style="width: {{ (100 * $data_sensores->humidity) / 100 }}%">
                                                            {{ $data_sensores->humidity }} %
                                                        </div> --}}
                                                        <div class="progress-bar 
                                                        {{ $data_sensores->humidity >= 53.0 ? 'progress-bar-success' : ($data_sensores->humidity >= 28.0 && $data_sensores->humidity < 53.0 ? 'progress-bar-warning' : 'progress-bar-danger') }}
                                                        "
                                                            role="progressbar"
                                                            style="width: {{ (100 * $data_sensores->humidity) / 100 }}%">
                                                            {{ $data_sensores->humidity }} %
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="flex flex-col px-4 py-2">
                                                    <h4> Alcalinidad (0-10)</h4>
                                                    <div class="progress">
                                                        <div class="progress-bar
                                                        {{ $data_sensores->alkalinity >= 10 ? 'progress-bar-success' : ($data_sensores->alkalinity < 10 && $data_sensores->alkalinity >= 4 ? 'progress-bar-warning' : 'progress-bar-danger') }}
                                                        "
                                                            role="progressbar"
                                                            style="width: {{ (100 * $data_sensores->alkalinity) / 10 }}%">
                                                            {{ $data_sensores->alkalinity }}
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="flex flex-col px-4 py-2">
                                                    <h4> Temperatura (0-30 °C)</h4>
                                                    <div class="progress">
                                                        <div class="progress-bar
                                                        {{ $data_sensores->temperature >= 30 ? 'progress-bar-success' : ($data_sensores->temperature < 30 && $data_sensores->temperature >= 15 ? 'progress-bar-warning' : 'progress-bar-danger') }}
                                                        "
                                                            role="progressbar"
                                                            style="width: {{ (100 * $data_sensores->temperature) / 30 }}%">
                                                            {{ $data_sensores->temperature }} °C
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                    {{-- <div class="box-footer">

                                        <x-jet-button wire:loading.attr="disabled" wire:target="save" wire:click="save"
                                            class="btn btn-block btn-success">
                                            <i class="fa fa-fw fa-save"></i> Guardar
                                        </x-jet-button>

                                    </div> --}}
                                </div>

                            </div>
                        </section>

                    </div>
                </div>

            </div>

            <!-- /.row -->
            <x-table-responsive-up>
                <div class="box-header px-4">
                    <input x-model="status_type" type="radio" value="2" name="status_type" class="text-gray-600">
                    <h3 class="px-4 box-title">Responsive Table Sensor</h3>


                    {{-- <x-jet-input wire:model="search" type="text" class="w-full mx-3 my-3"
                        placeholder="Escriba el nombre del personal para filtrar" /> --}}


                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding hidden" :class="{ 'hidden': status_type != 2 }">
                    @if ($sensores->count())
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Humedad</th>
                                <th>Alcalinidad</th>
                                <th>Temperatura</th>
                                <th>Estacion</th>
                            </tr>
                            @foreach ($sensores as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td> {{ $item->humidity }} </td>
                                    <td> {{ $item->alkalinity }} </td>
                                    <td> {{ $item->temperature }} </td>

                                    @switch($item->station)
                                        @case(0)
                                            <td><span class="label label-danger">ERROR</span></td>
                                        @break

                                        @case(1)
                                            <td><span class="label label-success">Estación 1</span></td>
                                        @break

                                        @case(2)
                                            <td><span class="label label-success">Estación 2</span></td>
                                        @break

                                        @case(3)
                                            <td><span class="label label-success">Estación 3</span></td>
                                        @break

                                        @case(4)
                                            <td><span class="label label-success">Estación 4</span></td>
                                        @break

                                        @default
                                    @endswitch

                                    <td>

                                        <div class="col-md-3 col-sm-4 flex">
                                            {{-- <a class="btn btn-default" wire:click="edit('{{ $item->id }}')">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a> --}}
                                            {{-- <x-danger-button wire:click="$emit('deleteitem', '{{ $item->id }}')">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </x-danger-button> --}}

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="alert alert-warning alert-dismissible">
                            {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            No hay ningún registro coincidente
                        </div>
                    @endif

                    <div class="box-footer clearfix">
                        @if ($sensores->hasPages())
                            <div class="px-6 py-4">
                                {{ $sensores->links() }}
                            </div>
                        @endif
                    </div>

                </div>

            </x-table-responsive-up>


        </div>

        @push('script')
            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
            <script>
                document.addEventListener('livewire:load', function() {

                    var sensors = [];
                    var valores = [];
                    var valores_humidity = [];
                    var valores_alkalinity = [];
                    var valores_temperature = [];

                    $.ajax({
                        url: "sensor/humedad/all",
                        method: 'POST',
                        data: {
                            id: 1,
                            _token: $('input[name="_token"]').val()
                        }
                    }).done(function(res) {

                        var arreglo = JSON.parse(res);

                        console.log(arreglo);

                        for (var x = 0; x < 7; x++) {
                            sensors.push(arreglo[x].id);
                            valores.push(arreglo[x].humidity);
                            valores_humidity.push(arreglo[x].humidity);
                            valores_alkalinity.push(arreglo[x].alkalinity);
                            valores_temperature.push(arreglo[x].temperature);
                        }

                        generarGrafico();
                    });

                    // function generarGraficoHumedad() {
                    //     // Grafico Sensor
                    //     const ctx = document.getElementById('myChart').getContext('2d');
                    //     const myChart = new Chart(ctx, {
                    //         type: 'line',
                    //         data: {
                    //             labels: sensors,
                    //             datasets: [{
                    //                 label: 'Niveles de Humedad',
                    //                 data: valores,
                    //                 backgroundColor: [
                    //                     'rgba(255, 99, 132, 0.2)',
                    //                     'rgba(54, 162, 235, 0.2)',
                    //                     'rgba(255, 206, 86, 0.2)',
                    //                     'rgba(75, 192, 192, 0.2)',
                    //                     'rgba(153, 102, 255, 0.2)',
                    //                     'rgba(255, 159, 64, 0.2)'
                    //                 ],
                    //                 borderColor: [
                    //                     'rgba(255, 99, 132, 1)',
                    //                     'rgba(54, 162, 235, 1)',
                    //                     'rgba(255, 206, 86, 1)',
                    //                     'rgba(75, 192, 192, 1)',
                    //                     'rgba(153, 102, 255, 1)',
                    //                     'rgba(255, 159, 64, 1)'
                    //                 ],
                    //                 borderWidth: 1
                    //             }]
                    //         },
                    //         options: {
                    //             scales: {
                    //                 y: {
                    //                     beginAtZero: true
                    //                 }
                    //             }
                    //         }
                    //     });
                    // }

                    function generarGrafico() {
                        // Grafico Sensor
                        const ctx = document.getElementById('myChart').getContext('2d');
                        const myChart = new Chart(ctx, {
                            type: 'radar',
                            data: {
                                labels: sensors,
                                datasets: [{
                                    label: 'Niveles de Humedad',
                                    data: valores_humidity,
                                    backgroundColor: [
                                        'rgba(153, 102, 255, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgb(153, 102, 255)'
                                    ],
                                    borderWidth: 3
                                }, {
                                    label: 'Niveles de Alacalinidad',
                                    data: valores_alkalinity,
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgb(75, 192, 192)'
                                    ],
                                    borderWidth: 3
                                }, {
                                    label: 'Niveles de Temperatura',
                                    data: valores_temperature,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)'
                                    ],
                                    borderWidth: 3
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }


                });
            </script>
        @endpush
    </div>
    <!-- ./wrapper -->

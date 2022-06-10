<x-app-layout>
    <!-- Main -->
    @push('style')
        <style>
            @media (min-width: 768px) {
                .md\:block {
                    display: block !important;
                }
            }
        </style>
    @endpush

    <!-- Content Header (Page header) -->
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
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="grid grid-cols-2 md:grid-cols-4">
            <div class="hidden md:block"></div>
            <div>
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        @if ($products)
                            <h3>{{ $products }}</h3>
                        @else
                            <h3>0</h3>
                        @endif

                        <p>Producción</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-bag"></i> --}}
                        <x-svg-avocado size="70" color="#7f7979" colorline=" #ffffff" />
                    </div>
                    <a href="{{ route('productos.index') }}" class="small-box-footer">Más info. <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div>
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        @if ($users)
                            <h3>{{ $users }}</h3>
                        @else
                            <h3>0</h3>
                        @endif

                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-person-add"></i> --}}
                        <x-svg-people size="70" color="#7f7979" colorline=" #ffffff" />
                    </div>
                    @role('admin')
                        <a href="{{ route('persons.index') }}" class="small-box-footer">Más info. <i
                                class="fa fa-arrow-circle-right"></i></a>
                    @else
                        <a href="#" class="small-box-footer">Más info. <i class="fa fa-arrow-circle-right"></i></a>
                    @endrole
                </div>
            </div>
            <!-- ./col -->
            {{-- <div>
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        @if ($plans)
                            <h3>{{ $plans }}</h3>
                        @else
                            <h3>0</h3>
                        @endif

                        <p>Planes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div> --}}
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="grid grid-cols-1 md:grid-cols-3">
            <div class="px-4 py-4">
                <canvas id="myChartH" width="400" height="400"></canvas>
            </div>
            <div class="px-4 py-4">
                <canvas id="myChartA" width="400" height="400"></canvas>
            </div>
            <div class="px-4 py-4">
                <canvas id="myChartT" width="400" height="400"></canvas>
            </div>

        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->

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

                    generarGraficoHumedad();
                    generarGraficoAlcalinidad();
                    generarGraficoTemperatura();
                });

                function generarGraficoHumedad() {
                    // Grafico Sensor
                    const ctx = document.getElementById('myChartH').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sensors,
                            datasets: [{
                                label: 'Niveles de Humedad',
                                data: valores_humidity,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
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

                function generarGraficoAlcalinidad() {
                    // Grafico Sensor
                    const ctx = document.getElementById('myChartA').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sensors,
                            datasets: [{
                                label: 'Niveles de Alacalinidad',
                                data: valores_alkalinity,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
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

                function generarGraficoTemperatura() {
                    // Grafico Sensor
                    const ctx = document.getElementById('myChartT').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sensors,
                            datasets: [{
                                label: 'Niveles de Temperatura',
                                data: valores_temperature,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
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
</x-app-layout>

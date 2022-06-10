<?php

use App\Models\Sensor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->float('humidity', 15, 5); //humedad

            $table->float('alkalinity', 15, 5); //alcalinidad

            $table->float('temperature', 15, 5); //temperatura

            // $table->enum('station', [Sensor::EST_1, Sensor::EST_2, Sensor::EST_3, Sensor::EST_4])->default(Sensor::EST_ERROR); //estación
            $table->integer('station')->default(Sensor::EST_ERROR); //estación

            $table->integer('status_alkalinity')->default(0); //0 false -- 1 true
            $table->integer('status_humidity')->default(0); //0 false -- 1 true

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensors');
    }
}

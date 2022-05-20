<?php

namespace Database\Factories;

use App\Models\Sensor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SensorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sensor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'humidity' =>  $this->faker->randomElement([14.5, 20.8, 31.5, 45.9, 59.14, 68.42]),
            'alkalinity' =>  $this->faker->randomElement([9.57, 1.87, 6.48, 8.47, 10, 4.85, 8.12]),
            'temperature' =>  $this->faker->randomElement([12.45, 21.65, 35.47, 9.65, 18.94, 21.78, 33.84]),
            'station' =>  $this->faker->randomElement([0, 1, 2, 3, 4]),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' =>  $this->faker->randomElement([20, 25, 30, 35, 4, 45, 50, 55]),
            'user_id' => 2,
            'price' => $this->faker->randomElement([19.99, 49.99, 99.99]),
            'type_palta' => 1,
            'img_primary' => 'products/' . $this->faker->image('public/storage/products', 640, 480, null, false)


        ];
    }
}

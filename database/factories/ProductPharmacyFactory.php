<?php

namespace Database\Factories;

use App\Models\ProductPharmacy;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPharmacyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductPharmacy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pharmacy_id' => $this->faker->numberBetween(1, 20000),
            'product_id' => $this->faker->numberBetween(1,50000),
            'product_price' => $this->faker->randomFloat(2, 0, 1000),
            'product_quantity' => $this->faker->numberBetween(10,100)
        ];
    }
}

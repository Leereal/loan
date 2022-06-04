<?php

namespace Database\Factories;

use App\Models\LoanCollateral;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanCollateralFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoanCollateral::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'loan_id' => mt_rand(1,300),
            'name' => $this->faker->randomElement(['Car', 'House', 'Truck', 'Fridge','Stove','Sofas']),
            'collateral_type' => "Property",
            'serial_number' => $this->faker->numberBetween($min = 10000000, $max = 99999999) ,
            'estimated_price' => $this->faker->numberBetween($min = 1000, $max = 100000) ,
            'description' => $this->faker->text($maxNbChars = 200),
            'ip_address' => '127.0.0.1'     
        ];
    }
}

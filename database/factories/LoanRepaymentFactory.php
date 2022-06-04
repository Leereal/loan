<?php

namespace Database\Factories;

use App\Models\LoanRepayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanRepaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoanRepayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'loan_id' => mt_rand(1,300),
            'repayment_date' => $this->faker->dateTimeBetween('-1 year', '60 days'),
            'amount_to_pay' => $this->faker->numberBetween($min = 50, $max = 20000),
            'penalty' => 0,
            'principal_amount' => $this->faker->numberBetween($min = 100, $max = 20000),
            'interest' => $this->faker->numberBetween($min = 100, $max = 20000),
            'balance' => $this->faker->numberBetween($min = 100, $max = 20000),
            'status' => mt_rand(0,2),
            'ip_address' => '127.0.0.1'
        ];
    }
}


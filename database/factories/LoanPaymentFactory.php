<?php

namespace Database\Factories;

use App\Models\LoanPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoanPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'loan_id' => mt_rand(1,300),
            'paid_at' => $this->faker->dateTimeBetween('-1 year', '-1 days'),
            'amount_to_pay' => $this->faker->numberBetween($min = 50, $max = 20000),
            'late_penalties' => 0,
            'interest' => $this->faker->numberBetween($min = 20, $max = 5000),
            'user_id' => mt_rand(1,100), 
            'remarks' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'transaction_id' => $this->faker->numberBetween($min = 1, $max = 800),
            'repayment_id' => $this->faker->numberBetween($min = 1, $max = 1000),
            'ip_address' => '127.0.0.1'
        ];
    }
}

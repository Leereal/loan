<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(1,100),
            'currency_id' => mt_rand(1,4),
            'amount' => $this->faker->numberBetween($min = 50, $max = 20000),
            'dr_cr' => $this->faker->randomElement(['dr', 'cr']),
            'type' => $this->faker->randomElement(['Loan', 'Loan_Repayment']),
            'method' => "Manual",
            'status' => mt_rand(0,2),
            'note' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'loan_id' => mt_rand(1,300),
            'updated_user_id' => 1,
            'created_user_id' => 1,  
            'branch_id'=>$this->faker->numberBetween(1,7),
            'ip_address' => '127.0.0.1'           
        ];
    }
}


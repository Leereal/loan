<?php

namespace Database\Factories;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class LoanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Loan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'loan_id' => "LN-".uniqid(),
            'loan_product_id' => mt_rand(1,5),
            'withdraw_method_id' => mt_rand(1,5),
            'borrower_id' => mt_rand(1,100),
            'first_payment_date' => $this->faker->dateTimeBetween('-1 year', '60 days'),
            'release_date' => $this->faker->dateTimeBetween('-1 year', '5 days'),
            'currency_id' => mt_rand(1,4), 
            'applied_amount' => $this->faker->randomFloat(4, 0, 10000),
            'cash_out' => $this->faker->randomFloat(4, 0, 10000),
            'admin_fee' => $this->faker->numberBetween($min = 10, $max = 800),
            'total_payable' => $this->faker->randomFloat(4, 0, 10000),
            'total_paid' => $this->faker->randomFloat(4, 0, 10000), 
            'late_payment_penalties' => 0, 
            'description' => $this->faker->text($maxNbChars = 200),
            'remarks' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'status' => mt_rand(1,3),
            'approved_user_id' => 1,
            'created_user_id' => 1,           
            'branch_id'=>$this->faker->numberBetween(1,7),
            'ip_address' => '127.0.0.1'
        ];
    }
}

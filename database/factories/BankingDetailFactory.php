<?php

namespace Database\Factories;

use App\Models\BankingDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankingDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BankingDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'withdraw_method_id' => mt_rand(1,5),
            'name' => $this->faker->company,
            'branch' => $this->faker->city,
            'account_type' => "Savings",
            'account_number' => $this->faker->bankAccountNumber,
            'ip_address' => '127.0.0.1',
            'created_by_id' => 1,
        ];
    }
}

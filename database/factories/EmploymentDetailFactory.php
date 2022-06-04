<?php

namespace Database\Factories;

use App\Models\EmploymentDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmploymentDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmploymentDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all();
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'salary' => $this->faker->numberBetween($min = 300, $max = 50000),
            'name' => $this->faker->company,
            'limit' => $this->faker->numberBetween($min = 50, $max = 20000),
            'telephone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'created_by_id'=>1,
            'updated_by_id'=>1,
            'ip_address' => '127.0.0.1'
        ];
    }
}
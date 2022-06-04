<?php

namespace Database\Factories;

use App\Models\NextOfKin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NextOfKinFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NextOfKin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => $this->faker->name,
            'relationship' => "Relative",
            'cellphone' => $this->faker->phoneNumber,           
            'address' => $this->faker->address,
            'ip_address' => '127.0.0.1',          
            'created_by_id' => 1,
        ];
    }
}

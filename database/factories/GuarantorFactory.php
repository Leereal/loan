<?php

namespace Database\Factories;

use App\Models\Guarantor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuarantorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Guarantor::class;

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
            'employer' => $this->faker->company,
            'cellphone' => $this->faker->phoneNumber,           
            'address' => $this->faker->address,
            'ip_address' => '127.0.0.1',
            'created_by_id' => 1,
        ];
    }
}

$table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->string('employer')->nullable();       
            $table->string('cellphone')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
            $table->softDeletes();

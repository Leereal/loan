<?php 
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class UserFactory extends Factory
{
 /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
        return [
        'name' => $this->faker->name,
        'id_number' => $this->faker->ssn,
        'address' => $this->faker->address,
        'email' => $this->faker->unique()->safeEmail,//"leereal08@ymail.com"
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => $this->faker->text($maxNbChars = 50),
        'branch_id'=>$this->faker->numberBetween(1, 7),
        'status' => 1,
        'user_type' => "customer",//"admin",
        'sms_verified_at' => now(),
        'country_code' => "+27",
        'ip_address' => '127.0.0.1'
    ];
    }
}

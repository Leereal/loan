<?php
namespace Database\Seeders;

use App\Models\WithdrawMethod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // $this->call([
        //     // CurrencySeeder::class,
        //     // UtilitySeeder::class,
        //     // BranchSeeder::class,
        //     // WithdrawMethodSeeder::class,            
        // ]);
        \App\Models\User::factory(1)->create();
        // \App\Models\Loan::factory(500)->create();
        // \App\Models\LoanCollateral::factory(100)->create();
        // \App\Models\Transaction::factory(800)->create();
        // \App\Models\LoanRepayment::factory(1000)->create();
        // \App\Models\LoanPayment::factory(700)->create();
        // \App\Models\EmploymentDetail::factory()->create();
        // \App\Models\NextOfKin::factory(700)->create();
        // \App\Models\LoanPayment::factory(700)->create();
        // \App\Models\LoanPayment::factory(700)->create();
    }
}

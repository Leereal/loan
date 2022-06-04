<?php


namespace Database\Seeders;

use App\Models\WithdrawMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WithdrawMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // WithdrawMethod::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
         $cash = WithdrawMethod::create([
        	'name'=>'Cash',
            'currency_id'=>1,
            'maximum_amount'=>50000,  
            'minimum_amount'=>10,
            'fixed_charge'=>10,
            'charge_in_percentage'=>10,
               	        	
        ]); 

         $bank = WithdrawMethod::create([
            'name'=>'Bank',
            'currency_id'=>1,
            'maximum_amount'=>50000,  
            'minimum_amount'=>10,
            'fixed_charge'=>10,
            'charge_in_percentage'=>10,                  
        ]); 

         $swip = WithdrawMethod::create([
            'name'=>'Swip',
            'currency_id'=>1,
            'maximum_amount'=>50000,  
            'minimum_amount'=>10,
            'fixed_charge'=>10,
            'charge_in_percentage'=>10,                  
        ]);  

         $Ecocash = WithdrawMethod::create([
            'name'=>'Ecocash',
            'currency_id'=>1,
            'maximum_amount'=>50000,  
            'minimum_amount'=>10,
            'fixed_charge'=>10,
            'charge_in_percentage'=>10,                  
        ]); 
        
        $Ewallet = WithdrawMethod::create([
            'name'=>'Ewallet' ,
            'currency_id'=>1,
            'maximum_amount'=>50000,  
            'minimum_amount'=>10,
            'fixed_charge'=>10,
            'charge_in_percentage'=>10,                 
        ]); 
    }
}

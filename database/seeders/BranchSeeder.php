<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Branch::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $gweru = Branch::create([
        	'name'=>'Head Office',
        	'contact_email'=>'enquiries@loan.co.zw',
        	'contact_phone'=>'+263 54 222 3416',
        	'address'=>'Suite No 5 , 1st Floor Moonlight Building 5th Street,Gweru , Zimbabwe',
        ]);
        $mutare = Branch::create([
        	'name'=>'Mutare',
        	'contact_email'=>'enquiries@loan.co.zw',
        	'contact_phone'=>'024 2565656',
        	'address'=>'12 Kaguvi Street',
        ]);
        $masvingo = Branch::create([
        	'name'=>'Masvingo',
        	'contact_email'=>'enquiries@loan.co.zw',
        	'contact_phone'=>'0775 166 683',
        	'address'=>'Cnr. Hughes Street & Simon Mazorodze , Zimre Centre,4th Floor Left Wing ',
        ]);
        $harare = Branch::create([
        	'name'=>'Harare',
        	'contact_email'=>'enquiries@loan.co.zw',
        	'contact_phone'=>'0242759981',
        	'address'=>'7th Floor , West Wing, Karigamombe Centre Union Avenue ',
        ]);

        $bulawayo = Branch::create([
        	'name'=>'Bulawayo',
        	'contact_email'=>'enquiries@loan.co.zw',
        	'contact_phone'=>'0773 086 971',
        	'address'=>'3rd Floor Masiya Building, Office 8 & 9 Corner Fort Street & 9th Avenue',
        ]);

    }
    
}

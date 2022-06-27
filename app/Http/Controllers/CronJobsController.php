<?php

namespace App\Http\Controllers;

use App\Models\FixedDeposit;
use App\Models\Loan;
use App\Models\Transaction;
use App\Notifications\FDRMatured;
use Carbon\Carbon;
use DB;

class CronJobsController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }
    /**
     * Show the application CronJobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function run() {
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        DB::beginTransaction();

        $fixed_deposits = FixedDeposit::where('status', 1)
            ->where('mature_date', '<=', date('Y-m-d'))
            ->get();

        foreach ($fixed_deposits as $fixed_deposit) {
            $fixed_deposit->status = 3;
            $fixed_deposit->save();

            $transaction              = new Transaction();
            $transaction->user_id     = $fixed_deposit->user_id;
            $transaction->currency_id = $fixed_deposit->currency_id;
            $transaction->amount      = $fixed_deposit->return_amount;
            $transaction->dr_cr       = 'cr';
            $transaction->type        = 'Deposit';
            $transaction->method      = 'Online';
            $transaction->status      = 2;
            $transaction->note        = 'Return of Fixed deposit';

            $transaction->save();

            try {
                $transaction->user->notify(new FDRMatured($transaction));
            } catch (\Exception $e) {}
        }

        DB::commit();

        echo 'Scheduled task runs successfully';
    }

    public function loan_engine(){
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        
        $loans = Loan::where([['status',1],['next_due_date', '<', now()]])->get();  
        if($loans->isNotEmpty()){
            DB::beginTransaction();
                foreach($loans as $loan){ //Loop through each loan                    

                    //If loan is still in approved level 1 and exceed due date add half_interest 
                    if ($loan->default_status == 0 && Carbon::now() > Carbon::parse($loan->next_due_date)->addDays(7)) {
                        $next_due_date = Carbon::parse($loan->next_due_date)->addDays(21);                        
                        $this->default_charge($loan,1,$next_due_date);
                    }
                    else if ($loan->default_status == 1 && Carbon::now() > $loan->next_due_date) {  
                        $next_due_date = Carbon::parse($loan->first_payment_date)->addMonth(1);                 
                        $this->default_charge($loan,2,$next_due_date);
                    }
                    else if ($loan->default_status == 2 && Carbon::now() > $loan->next_due_date) {
                        $next_due_date = Carbon::parse($loan->next_due_date)->addDays(21); 
                        $this->default_charge($loan,3,$next_due_date);
                    }
                    else if ($loan->default_status == 3 && Carbon::now() > $loan->next_due_date) {
                        $next_due_date = Carbon::parse($loan->first_payment_date)->addMonth(2);  
                        $this->default_charge($loan,4,$next_due_date);
                    }
                    else if ($loan->default_status == 4 && Carbon::now() > $loan->next_due_date) {
                        $next_due_date = Carbon::parse($loan->next_due_date)->addDays(21);                         
                        $this->default_charge($loan,5,$next_due_date);
                    }
                    else if ($loan->default_status == 5 && Carbon::now() > $loan->next_due_date) {//Last Due date setting after this post to overdue
                        $next_due_date = Carbon::parse($loan->first_payment_date)->addMonth(3);  
                        $this->default_charge($loan,6,$next_due_date);
                    }
                    // else if ($loan->default_status == 6 && Carbon::now() > $loan->next_due_date) {
                    //     $next_due_date = Carbon::parse($loan->next_due_date)->addDays(14); 
                    //     $this->default_charge($loan,7,$next_due_date);
                    // }
                    // else if ($loan->default_status == 7 && Carbon::now() > $loan->next_due_date) {
                    //     $next_due_date = Carbon::parse($loan->first_payment_date)->addMonth(4);  
                    //     $this->default_charge($loan,8,$next_due_date);
                    // }
                    else if ($loan->default_status == 6 && Carbon::now() > $loan->next_due_date) {                    
                        $this->default_charge($loan,7,$loan->next_due_date,4);
                    }
                }
            DB::commit();
            dd("Loans updated successfully");
        }
        else{
            dd("All loans upto date");
        }

        

    }

    protected function default_charge($loan,$default_status,$next_due_date,$status=null){
         //adding half interest to the loan
         $interest                  = new Transaction();
         $interest->user_id         = $loan->borrower_id;
         $interest->currency_id     = $loan->currency_id;
         $interest->amount          = ceil_amount(($loan->total_interest/2), $loan->loan_product->ceil_factor);
         $interest->dr_cr           = 'cr';
         $interest->type            = 'Auto_Interest';
         $interest->method          = 'Manual';
         $interest->status          = 2;
         $interest->note            = 'Loan Interest '.'('.($loan->loan_product->interest_rate/2).'%)';
         $interest->loan_id         = $loan->id;
         $interest->ip_address      = request()->ip();
         $interest->save();
         
         //Charge half default fee
         $penalty                  = new Transaction();
         $penalty->user_id         = $loan->borrower_id;
         $penalty->currency_id     = $loan->currency_id;
         $penalty->amount          = ceil_amount(($loan->applied_amount*($loan->loan_product->penalty_fee/100)/2), $loan->loan_product->ceil_factor);
         $penalty->dr_cr           = 'cr';
         $penalty->type            = 'Penalty_Fee';
         $penalty->method          = 'Manual';
         $penalty->status          = 2;
         $penalty->note            = 'Penalty Fee '.'('.($loan->loan_product->penalty_fee/2).'%)';
         $penalty->loan_id         = $loan->id;
         $penalty->ip_address      = request()->ip();
         $penalty->save();
       
         //Update loan balances with new values
         if($default_status == 7){        
            $loan->default_status = $default_status; 
            $status && $loan->status = $status;
            $loan->save();
         }else{
             $loan->late_payment_penalties += ceil_amount(($loan->applied_amount*($loan->loan_product->penalty_fee/100)/2), $loan->loan_product->ceil_factor);
             $loan->total_payable += $interest->amount + $penalty->amount;
             $loan->next_due_date =  $next_due_date;
             $loan->default_status = $default_status;
             $loan->save();
         }
         
    }

}

<?php

namespace App\Utilities;

use App\Models\LoanProduct;
use App\Traits\CalculateInterest;

class LoanCalculator {
    use CalculateInterest;

    public $payable_amount;
    private $apply_amount;
    private $admin_fee;
    private $service_fee;
    private $cash_out;
    private $first_payment_date;
    private $interest_rate;
    private $term;
    private $term_period;    
    private $ceil_factor;

    public function __construct($apply_amount, $first_payment_date, $cash_out,$loan_product_id) {
         
        $this->apply_amount           = $apply_amount;
        $this->cash_out               = $cash_out;
        $this->first_payment_date     = $first_payment_date;

        $loan_product = LoanProduct::find($loan_product_id);  
        $this->admin_fee              = $loan_product->admin_fee;    
        $this->service_fee            = $loan_product->service_fee;     
        $this->interest_rate          = $loan_product->interest_rate;
        $this->term                   = $loan_product->term;
        $this->term_period            = $loan_product->term_period;       
        $this->ceil_factor            = $loan_product->ceil_factor;
        $this->late_payment_penalties = 0;
    }

    public function get_compound_rate() {
        $this->payable_amount   = CalculateInterest::payableAmountCompoundInterest($this->cash_out,$this->admin_fee,$this->interest_rate,$this->ceil_factor);    
        $date                   = $this->first_payment_date;
        $principle_amount       = CalculateInterest::principleAmount($this->apply_amount,$this->term);
        $amount_to_pay          = CalculateInterest::amountToPay($this->cash_out,$this->admin_fee,$this->interest_rate,$this->term,$this->ceil_factor);
        $interest               = CalculateInterest::interest($this->apply_amount,$this->interest_rate);
        $balance                = $this->payable_amount;        

        $data = array();
        for ($i = 0; $i < $this->term; $i++) {
            $balance = $balance - $amount_to_pay;
            $data[]  = array(
                'date'             => $date,
                'amount_to_pay'    => $amount_to_pay,
                //'penalty'          => $penalty,
                'principle_amount' => $principle_amount,
                'interest'         => $interest,
                'balance'          => $balance,
            );

            $date = date("Y-m-d", strtotime($this->term_period, strtotime($date)));
        } 
        return ($data);
    }

    public function get_flat_rate() {
        $this->payable_amount = (($this->interest_rate / 100) * $this->apply_amount) + $this->apply_amount + $this->service_fee; //Added because of BSFinance

        $date             = $this->first_payment_date;
        $principle_amount = $this->apply_amount / $this->term;
        $amount_to_pay    = $principle_amount + (($this->interest_rate / 100) * $principle_amount) + ($this->service_fee/$this->term);
        $interest         = (($this->interest_rate / 100) * $this->apply_amount) / $this->term;
        $balance          = $this->payable_amount;
        $penalty          = (($this->late_payment_penalties / 100) * $this->apply_amount);

        $data = array();
        for ($i = 0; $i < $this->term; $i++) {
            $balance = $balance - $amount_to_pay;
            $data[]  = array(
                'date'             => $date,
                'amount_to_pay'    => $amount_to_pay,
                'penalty'          => $penalty,
                'principle_amount' => $principle_amount,
                'interest'         => $interest,
                'balance'          => $balance,
            );

            $date = date("Y-m-d", strtotime($this->term_period, strtotime($date)));
        }

        return $data;
    }

    public function get_fixed_rate() {
        $this->payable_amount = ((($this->interest_rate / 100) * $this->apply_amount) * $this->term) + $this->apply_amount;
        $date                 = $this->first_payment_date;
        $principle_amount     = $this->apply_amount / $this->term;
        $amount_to_pay        = $principle_amount + (($this->interest_rate / 100) * $this->apply_amount);
        $interest             = (($this->interest_rate / 100) * $this->apply_amount);
        $balance              = $this->payable_amount;
        $penalty              = (($this->late_payment_penalties / 100) * $this->apply_amount);

        $data = array();
        for ($i = 0; $i < $this->term; $i++) {
            $balance = $balance - $amount_to_pay;
            $data[]  = array(
                'date'             => $date,
                'amount_to_pay'    => $amount_to_pay,
                'penalty'          => $penalty,
                'principle_amount' => $principle_amount,
                'interest'         => $interest,
                'balance'          => $balance,
            );

            $date = date("Y-m-d", strtotime($this->term_period, strtotime($date)));
        }

        return $data;
    }

    public function get_mortgage() {
        $interestRate = $this->interest_rate / 100;

        //Calculate the per month interest rate
        $monthlyRate = $interestRate / 12;

        //Calculate the payment
        $payment = $this->apply_amount * ($monthlyRate / (1 - pow(1 + $monthlyRate, -$this->term)));

        $this->payable_amount = $payment * $this->term;

        $date    = $this->first_payment_date;
        $balance = $this->apply_amount;
        $penalty = (($this->late_payment_penalties / 100) * $this->apply_amount);

        $data = array();
        for ($count = 0; $count < $this->term; $count++) {
            $interest         = $balance * $monthlyRate;
            $monthlyPrincipal = $payment - $interest;
            $amount_to_pay    = $interest + $monthlyPrincipal;

            $balance = $balance - $monthlyPrincipal;
            $data[]  = array(
                'date'             => $date,
                'amount_to_pay'    => $amount_to_pay,
                'penalty'          => $penalty,
                'principle_amount' => $monthlyPrincipal,
                'interest'         => $interest,
                'balance'          => $balance,
            );

            $date = date("Y-m-d", strtotime($this->term_period, strtotime($date)));
        }

        return $data;
    }

    public function get_one_time() {
        $this->payable_amount = (($this->interest_rate / 100) * $this->apply_amount) + $this->apply_amount;
        $date                 = $this->first_payment_date;
        $principle_amount     = $this->apply_amount;
        $amount_to_pay        = $principle_amount + (($this->interest_rate / 100) * $principle_amount);
        $interest             = (($this->interest_rate / 100) * $this->apply_amount);
        $balance              = $this->payable_amount;
        $penalty              = (($this->late_payment_penalties / 100) * $this->apply_amount);

        $data    = array();
        $balance = $balance - $amount_to_pay;
        $data[]  = array(
            'date'             => $date,
            'amount_to_pay'    => $amount_to_pay,
            'penalty'          => $penalty,
            'principle_amount' => $principle_amount,
            'interest'         => $interest,
            'balance'          => $balance,
        );

        $date = date("Y-m-d", strtotime($this->term_period, strtotime($date)));

        return $data;
    }

}
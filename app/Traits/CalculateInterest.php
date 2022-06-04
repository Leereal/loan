<?php

namespace App\Traits;

trait CalculateInterest 
{
    /**
    * Create regular or static methods here
    */

    public static function payableAmountCompoundInterest($cash_out,$admin_fee,$interest_rate,$ceil_factor) :float{        
        $payable_amount = ( ceil($cash_out / (1- ($admin_fee/100) )) ) * (1 + $interest_rate/100);
        return self::roundUpToAny($payable_amount,$ceil_factor);
    }

    public static function principleAmount($applied_amount,$term) :float{
        return $applied_amount / $term;
    }    

    public static function amountToPay($cash_out,$admin_fee,$interest_rate,$term,$ceil_factor) :float{
        return self::payableAmountCompoundInterest($cash_out,$admin_fee,$interest_rate,$ceil_factor) / $term;
    }

    public static function interest($applied_amount,$interest_rate) :float{
        return ceil($applied_amount * $interest_rate / 100);
    }
    public static function roundUpToAny($number,$ceil_factor) :float{
        return ceil($number/$ceil_factor) *  $ceil_factor;
    }    
}

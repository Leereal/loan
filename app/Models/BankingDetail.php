<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankingDetail extends Model
{
    use HasFactory, SoftDeletes;
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id')->withDefault(['name' => _lang('Default')]);
    }

    public function withdraw_method() {
        return $this->belongsTo('App\Models\WithdrawMethod', 'withdraw_method_id')->withDefault(['name' => _lang('Default')]);
    }
    

}

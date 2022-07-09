<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmploymentDetail extends Model
{
    use HasFactory, SoftDeletes;
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id')->withDefault(['name' => _lang('Default')]);
    }

    public function employer() {
        return $this->belongsTo('App\Models\Employer', 'employer_id')->withDefault(['name' => _lang('Default')]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherBank extends Model {
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'other_banks';

    public function currency() {
        return $this->belongsTo('App\Models\Currency', 'bank_currency')->withDefault();
    }
}
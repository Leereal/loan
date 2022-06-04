<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banking_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('withdraw_method_id')->unsigned();
            $table->string('name');
            $table->string('branch')->nullable();       
            $table->string('account_type')->nullable();
            $table->string('account_number')->nullable();
            $table->bigInteger('created_by_id')->unsigned(); 
            $table->bigInteger('updated_by_id')->unsigned()->nullable(); 
            $table->ipAddress('ip_address'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banking_details');
    }
}

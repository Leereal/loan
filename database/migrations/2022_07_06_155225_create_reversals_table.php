<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReversalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reversals', function (Blueprint $table) {
            $table->id();           
            $table->string('type', 30);
            $table->text('description')->nullable();
            $table->bigInteger('loan_id')->nullable();
            $table->bigInteger('transaction_id')->nullable();
            $table->bigInteger('income_id')->nullable();
            $table->bigInteger('expense_id')->nullable();
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('reversed_user_id')->nullable();
            $table->bigInteger('branch_id')->nullable();
            $table->ipAddress('ip_address');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reversals');
    }
}

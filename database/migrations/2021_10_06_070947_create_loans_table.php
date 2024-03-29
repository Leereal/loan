<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loan_id', 30)->nullable();
            $table->bigInteger('loan_product_id')->unsigned();
            $table->bigInteger('borrower_id')->unsigned();
            $table->date('first_payment_date');
            $table->date('release_date')->nullable();
            $table->bigInteger('currency_id');
            $table->bigInteger('withdraw_method_id')->unsigned(); 
            $table->decimal('applied_amount', 10, 2);
            $table->decimal('total_payable', 10, 2)->nullable();
            $table->decimal('total_paid', 10, 2)->nullable();
            $table->decimal('late_payment_penalties', 10, 2);
            $table->decimal('cash_out', 10, 2);
            $table->decimal('admin_fee', 10, 2);
            $table->decimal('total_interest', 10, 2);
            $table->decimal('service_fee', 10, 2)->nullable();
            $table->tinyInteger('ceil_factor')->default(1);//round up factor if 1 it removes all decimals and if 5 it rounds up to multiples of 5
            $table->text('attachment')->nullable();
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('status')->default(0); // 0 - Pending, 1-Approved, 2-Completed, 3-Cancelled, 4-Overdue, 5-Internal,6-Bad-Debts
            $table->integer('default_status')->default(0); // 0 - No default, 1-By one period/Half Month,2-By 2 periods/1 Month,etc
            $table->date('next_due_date');
            $table->date('approved_date')->nullable();
            $table->bigInteger('approved_user_id')->nullable();
            $table->bigInteger('created_user_id')->nullable();
            $table->bigInteger('branch_id')->nullable();
            $table->timestamps();
            $table->ipAddress('ip_address');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('loans');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('loan_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('minimum_amount', 10, 2);
            $table->decimal('maximum_amount', 10, 2);
            $table->text('description')->nullable();
            $table->decimal('interest_rate', 10, 2);
            $table->decimal('admin_fee', 10, 2);
            $table->decimal('service_fee', 10, 2)->nullable();
            $table->decimal('penalty_fee', 10, 2); 
            $table->decimal('ceil_factor', 10, 2); 
            $table->string('interest_type');
            $table->integer('term');
            $table->string('term_period', 15);
            $table->tinyInteger('status')->default(1);            
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
        Schema::dropIfExists('loan_products');
    }
}

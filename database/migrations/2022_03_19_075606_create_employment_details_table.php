<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->decimal('salary', 10, 2)->nullable();
            $table->decimal('limit', 10, 2)->nullable();
            $table->string('telephone')->nullable();
            $table->text('address')->nullable();  
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
        Schema::dropIfExists('employment_details');
    }
}

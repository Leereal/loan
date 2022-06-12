<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('file_number')->nullable();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('id_number');
            $table->string('address');
            $table->string('user_type', 20);
            $table->bigInteger('role_id')->nullable();
            $table->bigInteger('branch_id')->nullable();
            $table->integer('status');
            $table->string('profile_picture')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('sms_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('country_code', 10)->nullable();
            $table->rememberToken();
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
    public function down() {
        Schema::dropIfExists('users');
    }
}

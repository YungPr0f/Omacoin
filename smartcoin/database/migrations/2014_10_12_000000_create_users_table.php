<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('surname', 100);
            $table->string('firstname', 100);
            $table->string('email', 100)->unique();
            $table->string('phone_number', 20)->unique();
            $table->string('photo')->default('user.jpg');
            $table->integer('bank_id')->default(1);
            $table->string('account_number', 20)->nullable();
            $table->string('account_name', 200)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

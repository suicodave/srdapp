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
            $table->integer('id')->autoIncrement();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('cpassword');
            $table->string('gender');
            $table->string('mobile_no')->nullable()->nullable();
            $table->string('secquestion',250);
            $table->string('answer');
            $table->string('status');
            $table->integer('saStatus')->comment('This is the user status 0 for inactive and 1 for active')->nullable(false);
            $table->integer('islogin')->comment('The same as status');
            $table->integer('loginattemp')->comment('Indicates the number of login attemp');
            $table->integer('acountlock')->comment('Indicate if more than 3 or 5 times attemp and block the user');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->integer('id',11)->autoIncrement();
            $table->string('employeeid')->nullable();
            $table->string('classid')->nullable();
            $table->string('servicesid')->nullable();
            $table->string('branchcode')->nullable();
            $table->string('bookingnumber',10);
            $table->string('fullName');
            $table->string('mobileNumber');
            $table->string('numbervehicle');
            $table->date('washDate');
            $table->time('washTime');
            $table->mediumText('message');
            $table->string('email');
            $table->string('bookingstatus',120);
            $table->string('paymentMode',120)->nullable();
            $table->string('txnNumber')->nullable();
            $table->timestamp('postingDate')->nullable();
            $table->string('amount')->nullable();
            $table->mediumText('employeeidremarks')->nullable();
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
        Schema::dropIfExists('booking');
    }
}

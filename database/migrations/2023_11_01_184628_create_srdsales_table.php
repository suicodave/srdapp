<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSrdsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srdsales', function (Blueprint $table) {
            $table->integer('salesid')->autoIncrement();
            $table->string('bookingid');
            $table->string('bpid');
            $table->string('status');
            $table->string('salesdate')->nullable();
            $table->string('tnxtype')->nullable();
            $table->string('actiontakenby');
            $table->string('initialamount')->nullable();
            $table->string('amtchange')->nullable();
            $table->string('amountdue')->nullable();
            $table->string('cashier')->nullable();
            $table->string('invoicenumber')->nullable();
            $table->string('ispaid')->nullable();
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
        Schema::dropIfExists('srdsales');
    }
}

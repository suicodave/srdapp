<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingpriorityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookingpriority', function (Blueprint $table) {
            $table->integer('pid')->autoIncrement();
            $table->string('bookingId');
            $table->string('prioritynumber');
            $table->string('dateprocess');
            $table->string('maker');
            $table->string('status');
            $table->string('maxtimeprocess')->nullable();
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
        Schema::dropIfExists('bookingpriority');
    }
}

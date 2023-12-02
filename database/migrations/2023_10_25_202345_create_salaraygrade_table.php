<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaraygradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaraygrade', function (Blueprint $table) {
            $table->integer('sgid')->autoIncrement();
            $table->string('sgcode')->unique();
            $table->string('description')->unique();
            $table->string('period')->unique();
            $table->string('amount');
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
        Schema::dropIfExists('salaraygrade');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFksRegisterVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('register_visits', function (Blueprint $table) {
            $table->unsignedBigInteger('evolutions_id');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('evolutions_id')->references('id')->on('flgo_evolutions');
            $table->foreign('patient_id')->references('id')->on('patients');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

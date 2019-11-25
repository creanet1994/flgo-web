<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlgoEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flgo_evolutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('manejo_flgo1');
            $table->string('manejo_flgo2')->nullable();
            $table->string('manejo_flgo3')->nullable();
            $table->string('manejo_flgo4')->nullable();
            $table->string('procedimiento1');
            $table->string('procedimiento2')->nullable();
            $table->string('procedimiento3')->nullable();
            $table->string('procedimiento4')->nullable();
            $table->string('via_enteral')->nullable();
            $table->string('vfc')->nullable();
            $table->string('cfv')->nullable();
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
        Schema::dropIfExists('flgo_evolutions');
    }
}

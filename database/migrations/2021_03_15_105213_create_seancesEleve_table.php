<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeancesEleveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('seances_eleves', function (Blueprint $table) 
        
        {

            $table->bigIncrements('id');
            $table->string('num_seance');
            $table->boolean('paye');
            $table->string('payement');
            $table->boolean('presence');
            $table->date('date')->default(date("Y-m-d"));
            $table->time('heure')->default(date("H:i:s"));
            $table->unsignedBigInteger('id_seance');
            $table->unsignedBigInteger('id_eleve');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('id_seance')->references('id')->on('seances');
            $table->foreign('id_eleve')->references('id')->on('eleves');

            //
        });        

        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('seances_eleves');
        
        //
    }
}

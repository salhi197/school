<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupes', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            
            $table->time('heure_debut', $precision = 0);
            $table->time('heure_fin', $precision = 0);
            $table->string('pourcentage_prof', $precision = 0);
            $table->string('pourcentage_ecole', $precision = 0);
            $table->string('annee_scolaire');


            $table->unsignedBigInteger('id_classe');
            $table->unsignedBigInteger('id_prof');
            $table->unsignedBigInteger('id_niveau');
            $table->unsignedBigInteger('id_matiere');
            
            $table->timestamps()->useCurrent();

            $table->foreign('id_classe')->references('id')->on('classes');
            $table->foreign('id_prof')->references('id')->on('profs');
            $table->foreign('id_niveau')->references('id')->on('niveaux');
            $table->foreign('id_matiere')->references('id')->on('id_matiere');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupes');
    }
}

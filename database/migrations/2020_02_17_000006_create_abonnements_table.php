<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbonnementsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'abonnements';

    /**
     * Run the migrations.
     * @table abonnements
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('activites_id');
            $table->unsignedBigInteger('abonnes_id');
            $table->dateTime('dateDebut')->nullable();
            $table->dateTime('dateFin')->nullable();
            $table->integer('montant')->nullable();
            $table->dateTime('datePaiement')->nullable();

            $table->index(["activites_id"], 'fk_activites_has_abonnes_activites1_idx');

            $table->index(["abonnes_id"], 'fk_activites_has_abonnes_abonnes1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('activites_id', 'fk_activites_has_abonnes_activites1_idx')
                ->references('id')->on('activites')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('abonnes_id', 'fk_activites_has_abonnes_abonnes1_idx')
                ->references('id')->on('abonnes')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvalutionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'evalutions';

    /**
     * Run the migrations.
     * @table evalutions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('taille', 45)->nullable();
            $table->string('etat_tension', 45)->nullable();
            $table->string('poids', 45)->nullable();
            $table->string('nom', 45)->nullable();
            $table->string('prenom', 45)->nullable();
            $table->string('ddn', 45)->nullable();
            $table->unsignedBigInteger('abonnes_id');

            $table->index(["abonnes_id"], 'fk_evalutions_abonnes1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('abonnes_id', 'fk_evalutions_abonnes1_idx')
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

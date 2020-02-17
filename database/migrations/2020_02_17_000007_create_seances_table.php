<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeancesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'seances';

    /**
     * Run the migrations.
     * @table seances
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('moniteurs_id');
            $table->unsignedBigInteger('activites_id');
            $table->integer('tauxHoaire')->nullable();
            $table->double('montant')->nullable();
            $table->time('duree')->nullable();

            $table->index(["activites_id"], 'fk_moniteurs_has_activites_activites1_idx');

            $table->index(["moniteurs_id"], 'fk_moniteurs_has_activites_moniteurs1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('moniteurs_id', 'fk_moniteurs_has_activites_moniteurs1_idx')
                ->references('id')->on('moniteurs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('activites_id', 'fk_moniteurs_has_activites_activites1_idx')
                ->references('id')->on('activites')
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

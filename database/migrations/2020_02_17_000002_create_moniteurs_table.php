<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoniteursTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'moniteurs';

    /**
     * Run the migrations.
     * @table moniteurs
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('telephone', 25)->nullable();
            $table->unsignedBigInteger('gestionnaires_id');
            $table->string('nom', 45)->nullable();
            $table->string('prenom', 45)->nullable();
            $table->string('adresse', 45)->nullable();

            $table->index(["gestionnaires_id"], 'fk_moniteurs_gestionnaires1_idx');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('gestionnaires_id', 'fk_moniteurs_gestionnaires1_idx')
                ->references('id')->on('gestionnaires')
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

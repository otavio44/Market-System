<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionMeaningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("connection_meaning", function(Blueprint $table){
            $table->increments('id');
            $table->integer("connection_id")->unsigned();
            $table->integer("meaning_id")->unsigned();
            $table->text("meaning_type");
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
        Schema::dropIfExists("connection_meaning");
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactoriedMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factoried_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("type_of_peice_id");
            $table->Integer("quantity");
            $table->unsignedBigInteger("worker_id");

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
        Schema::dropIfExists('factoried_materials');
    }
}

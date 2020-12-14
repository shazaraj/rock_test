<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreFacoriedMaterailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_facoried_materails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("type_of_peice_id")->nullable();
            $table->unsignedBigInteger("quantity")->nullable();
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
        Schema::dropIfExists('store_facoried_materails');
    }
}

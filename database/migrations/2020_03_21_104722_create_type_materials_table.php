<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("type_of_peice_id");
            $table->unsignedBigInteger("raw_material_id");
            $table->unsignedBigInteger("amount");
            $table->unsignedBigInteger("price");
            $table->string("unit")->nullable();
            $table->string("details")->nullable();

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
        Schema::dropIfExists('type_materials');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("type_of_peice_id");
            $table->integer("count");
            $table->unsignedBigInteger("emp_id");

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
        Schema::dropIfExists('production_cards');
    }
}

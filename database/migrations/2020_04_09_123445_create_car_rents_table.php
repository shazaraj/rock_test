<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_rents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("car_id");
            $table->decimal("coast",10,2)->default(0);
            $table->decimal("paid",10,2)->default(0);
            $table->unsignedBigInteger("client_id");

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
        Schema::dropIfExists('car_rents');
    }
}

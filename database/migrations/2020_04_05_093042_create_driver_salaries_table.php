<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("car_id");
            $table->decimal("money_paid",10,2);
            $table->date("date_selected");

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
        Schema::dropIfExists('driver_salaries');
    }
}

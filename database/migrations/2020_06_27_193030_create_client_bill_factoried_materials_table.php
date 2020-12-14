<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientBillFactoriedMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_bill_factoried_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("bill_id");
            $table->unsignedBigInteger("raw_id");
            $table->double("single_price");
            $table->double("amount");
            $table->double("full_price");
            $table->text("notes");
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
        Schema::dropIfExists('client_bill_factoried_materials');
    }
}

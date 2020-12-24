<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImporterInvicesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importer_invoices_details', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('client_id');
            $table->integer('material_id');
            $table->integer('amount');
            $table->integer('price');
            $table->date('date');
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
        Schema::dropIfExists('importer_invoices_details');
    }
}

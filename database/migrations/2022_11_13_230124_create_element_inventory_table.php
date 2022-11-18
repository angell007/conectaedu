<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_inventory', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('inventory_id');
            $table->unsignedInteger('element_id');
            $table->Integer('quantity');
            $table->Integer('missing');
            $table->boolean('alert');
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
        Schema::dropIfExists('element_inventory');
    }
}

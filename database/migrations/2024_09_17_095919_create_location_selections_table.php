<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('location_selections', function (Blueprint $table) {
            $table->id();
            $table->string('district_name');
            $table->string('thana_name');
            $table->string('ward_name');
            $table->string('moholla_name');
            $table->string('holding_id');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('location_selections');
    }
};

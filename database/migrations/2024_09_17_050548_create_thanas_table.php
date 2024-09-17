<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_thanas_table.php
public function up()
{
    Schema::create('thanas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('district_id');
        $table->string('name');
        $table->timestamps();

        $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('thanas');
}

};

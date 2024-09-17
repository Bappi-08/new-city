<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_wards_table.php
public function up()
{
    Schema::create('wards', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('zone_id');
        $table->string('name');
        $table->timestamps();

        $table->foreign('zone_id')->references('id')->on('thanas')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('wards');
}

};

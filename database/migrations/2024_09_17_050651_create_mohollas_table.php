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
        Schema::create('mohollas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ward_id');
            $table->string('name');
            $table->timestamps();
    
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mohollas');
    }
};
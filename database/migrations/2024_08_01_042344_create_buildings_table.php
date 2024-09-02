<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('owner');
            $table->integer('holding');
            $table->text('address');
            $table->integer('flat');
            $table->integer('floor');
           
            $table->foreignId('building_id');
            $table->string('latitude');
            $table->string('longitude');
            $table->enum('status', ['Pending', 'Approved', 'Declined'])->default('Pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};

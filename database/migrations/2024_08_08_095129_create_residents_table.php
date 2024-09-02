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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nid');
            $table->dateTime('date');
            $table->string('profession');
            $table->string('cast');
            $table->string('marital');
            $table->string('language');
            $table->string('blood');
            $table->string('religion');
            $table->string('nationality');
            $table->string('gender');
            $table->integer('age');
            $table->integer('passport');
            $table->foreignId('resident_id');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};

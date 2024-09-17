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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nid');
            $table->string('name');
            $table->string('email');
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
            $table->integer('phone');
            // $table->foreignId('user_id');
            $table->foreignId('apartment_id');
            $table->enum('status', ['Pending', 'Approved', 'Declined'])->default('Pending');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

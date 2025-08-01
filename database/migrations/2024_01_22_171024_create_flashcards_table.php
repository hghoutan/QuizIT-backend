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
        Schema::create('flashcards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('set_id'); // Foreign key to sets table
            $table->string('term');
            $table->text('definition');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('set_id')->references('id')->on('sets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flashcards');
    }
};

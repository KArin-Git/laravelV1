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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // short hand for defining foreign key constraint
            // $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('book_id');
            $table->text('review');
            $table->unsignedTinyInteger('rating');
            $table->timestamps();
            // add foreign key constraint >> allow us to change ref by other column not limited to id
            $table->foreign('book_id')->references('id')
                ->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

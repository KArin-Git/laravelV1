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
        // create tasks table which connected to task model (app/Models/Task.php)
        Schema::create('tasks', function (Blueprint $table) {
            // id() sets up an auto-incrementing UNSIGNED BIGINT (primary key) >> seeing git for Blueprint.php
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->boolean('complete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

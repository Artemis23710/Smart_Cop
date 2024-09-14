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
        Schema::create('investigation_vicims', function (Blueprint $table) {
            $table->id();
            $table->integer('investigation_id');
            $table->string('victim_name')->nullable();
            $table->string('victim_gender')->nullable();
            $table->string('victim_age')->nullable();
            $table->integer('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investigation_vicims');
    }
};

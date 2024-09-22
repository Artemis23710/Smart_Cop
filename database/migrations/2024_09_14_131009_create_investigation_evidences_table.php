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
        Schema::create('investigation_evidences', function (Blueprint $table) {
            $table->id();
            $table->integer('investigation_note_id');
            $table->string('evidence')->nullable();
            $table->string('evidence_title')->nullable();
            $table->string('evidence_desription')->nullable();
            $table->integer('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investigation_evidences');
    }
};

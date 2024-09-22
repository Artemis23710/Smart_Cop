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
        Schema::create('crime_investigation_notes', function (Blueprint $table) {
            $table->id();
            $table->integer('investigation_id');
            $table->string('investigation_title');
            $table->date('day_investigation_note');
            $table->string('related_location')->nullable();
            $table->longText('description')->nullable();
            $table->integer('status'); 
            $table->integer('created_by')->nullable();  
            $table->integer('updated_by')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crime_investigation_notes');
    }
};

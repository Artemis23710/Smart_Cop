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
        Schema::create('crime_investigation_closings', function (Blueprint $table) {
            $table->id();
            $table->integer('investigation_id');
            $table->date('dayofclosing');
            $table->string('reason_closing');
            $table->longText('closing_summary')->nullable();
            $table->integer('status'); 
            $table->integer('approved_status'); 
            $table->integer('created_by')->nullable();  
            $table->integer('updated_by')->nullable(); 
            $table->integer('approved_by')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crime_investigation_closings');
    }
};

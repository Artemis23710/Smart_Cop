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
        Schema::create('operation_closes', function (Blueprint $table) {
            $table->id();
            $table->integer('operation_id'); 
            $table->date('closing_date');
            $table->string('closing_type');
            $table->string('closing_reason');
            $table->longText('closing_description')->nullable();
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
        Schema::dropIfExists('operation_closes');
    }
};

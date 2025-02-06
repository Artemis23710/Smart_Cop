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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('title');
            $table->string('operation_Type');
            $table->date('Start_date');
            $table->date('End_date')->nullable();
            $table->string('operation_budget')->nullable();
            $table->integer('officerincharge')->nullable();
            $table->longText('description')->nullable();
            $table->integer('status'); 
            $table->integer('Complete_status'); 
            $table->integer('approve_status'); 
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
        Schema::dropIfExists('operations');
    }
};

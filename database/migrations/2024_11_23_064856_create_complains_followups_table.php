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
        Schema::create('complains_followups', function (Blueprint $table) {
            $table->id();
            $table->integer('complain_id'); 
            $table->date('dateofcomplainfloowup');
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
        Schema::dropIfExists('complains_followups');
    }
};

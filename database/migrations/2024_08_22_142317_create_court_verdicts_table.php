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
        Schema::create('court_verdicts', function (Blueprint $table) {
            $table->id(); 
            $table->integer('suspect_id'); 
            $table->integer('crimedetails_id'); 
            $table->integer('investigation_id')->nullable();
            $table->date('dateofjudgement');
            $table->string('verdict');
            $table->string('penelty')->nullable();;
            $table->longText('judgment_summary')->nullable();
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
        Schema::dropIfExists('court_verdicts');
    }
};

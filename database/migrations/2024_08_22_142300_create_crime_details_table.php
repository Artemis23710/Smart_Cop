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
        Schema::create('crime_details', function (Blueprint $table) {
            $table->id();
            $table->string('Keywords');
            $table->integer('arrested_crime_category'); 
            $table->integer('arrested_crime'); 
            $table->integer('arrested_station'); 
            $table->integer('suspect_id'); 
            $table->integer('investigation_id')->nullable();
            $table->date('arrested_date');
            $table->string('incident_location');
            $table->string('incident_city');
            $table->date('dateofincident');
            $table->longText('incident_note')->nullable();
            $table->longText('incident_followup')->nullable();
            $table->string('incident_evidance')->nullable();
            $table->integer('status'); 
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
        Schema::dropIfExists('crime_details');
    }
};

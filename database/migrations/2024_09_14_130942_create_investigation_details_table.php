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
        Schema::create('investigation_details', function (Blueprint $table) {
            $table->id();
            $table->string('Keywords');
            $table->string('case_no');
            $table->date('report_date');
            $table->integer('arrested_crime_category'); 
            $table->integer('arrested_crime'); 
            $table->string('title_incident');
            $table->date('incident_date');
            $table->string('incident_location');
            $table->string('incident_area');
            $table->integer('arrested_station'); 
            $table->integer('investigating_officer'); 
            $table->date('assigndate');
            $table->longText('incident_description')->nullable();
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
        Schema::dropIfExists('investigation_details');
    }
};

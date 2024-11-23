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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->integer('station'); 
            $table->string('complain_type')->nullable();
            $table->date('dateofcomplain');
            $table->longText('description')->nullable();
            $table->string('missingperson_id')->nullable();
            $table->string('missingperson_fname')->nullable();
            $table->string('missingperson_mname')->nullable();
            $table->string('missingperson_lname')->nullable();
            $table->string('missingperson_fullname')->nullable();
            $table->string('missingperson_gender')->nullable();
            $table->date('missingperson_dob')->nullable();
            $table->string('missingperson_age')->nullable();
            $table->string('missingperson_nationality')->nullable();
            $table->string('missingperson_lastseen')->nullable();
            $table->string('missingperson_image')->nullable();
            $table->string('poctperson_name');
            $table->string('poctperson_relation')->nullable();
            $table->string('poctperson_idnumber')->nullable();
            $table->string('poctperson_contactno')->nullable();
            $table->string('poctperson_address')->nullable();
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
        Schema::dropIfExists('complains');
    }
};

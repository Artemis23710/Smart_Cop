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
        Schema::create('officers', function (Blueprint $table) {
            $table->id();
            $table->string('Keywords');
            $table->string('idcardno');
            $table->string('officerid');
            $table->string('namewithintial');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('fullname');
            $table->string('gender');
            $table->date('officerdob');
            $table->string('contactno');
            $table->string('officeremail')->nullable();
            $table->string('permentaddress');
            $table->string('officercity');
            $table->string('temporyaddress')->nullable();
            $table->date('joinservicedate');
            $table->date('resignationdate')->nullable();
            $table->integer('stationid');
            $table->integer('rankid');
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
        Schema::dropIfExists('officers');
    }
};

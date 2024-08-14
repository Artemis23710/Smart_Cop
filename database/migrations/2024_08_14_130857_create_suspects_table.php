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
        Schema::create('suspects', function (Blueprint $table) {
            $table->id();
            $table->string('Keywords');
            $table->string('idcardno');
            $table->string('namewithintial');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('fullname');
            $table->string('aliases');
            $table->string('gender');
            $table->date('officerdob');
            $table->integer('age');
            $table->string('nationality');
            $table->string('citizenship');
            $table->string('contactno');
            $table->string('permentaddress');
            $table->string('officercity');
            $table->integer('stationid');
            $table->integer('maincategoryid');
            $table->integer('crimeid');
            $table->date('arresteddate');
            $table->integer('status'); 
            $table->integer('convictedstatus'); 
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
        Schema::dropIfExists('suspects');
    }
};

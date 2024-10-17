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
        Schema::create('residents', function (Blueprint $table) {
           
            $table->id();
            $table->unsignedBigInteger('compte_id');
            $table->string('nom_resident');
            $table->string('prenom_resident');
            $table->string('adresse');
            $table->foreign('compte_id')->references('id')->on('comptes')->onDelete('cascade')->onUpdate('cascade');
           // $table->foreignId('compte_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};

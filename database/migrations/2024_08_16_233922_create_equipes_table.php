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
        Schema::create('equipes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('phone');
            $table->string('adresse');
            $table->foreignId('mairie_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
           // $table->foreign('compte_id')->references('id')->on('comptes')->onDelete('cascade')->onUpdate('cascade');//relation avec le compte
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipes');
    }
};

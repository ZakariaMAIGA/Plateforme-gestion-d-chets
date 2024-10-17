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
        Schema::create('signalements', function (Blueprint $table) {
            $table->id();
            $table->string('type_probleme');
            $table->string('description');
            $table->string('photo');
            //$table->timestamp('date_signalement');
            $table->date('date_signalement');
           // $table->boolean('statut')->default(false);
            $table->enum('statut', ['en_cours', 'en_attente', 'traite'])->default('en_cours');
            $table->foreignId('resident_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('mairie_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signalements');
    }
};

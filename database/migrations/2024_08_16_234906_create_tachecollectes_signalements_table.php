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
        Schema::create('tachecollectes_signalements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signalement_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tache_collecte_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_collecte')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tachecollectes_signalements');
    }
};

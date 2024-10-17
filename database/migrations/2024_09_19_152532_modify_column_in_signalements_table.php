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
        Schema::table('signalements', function (Blueprint $table) {
            $table->enum('statut', ['en_cours', 'en_attente', 'traite'])->default('en_cours')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('signalements', function (Blueprint $table) {
            $table->string('description')->change();
            $table->enum('statut', ['en_attente', 'en_cours', 'traite'])->default('en_attente')->change();
        });
    }
};

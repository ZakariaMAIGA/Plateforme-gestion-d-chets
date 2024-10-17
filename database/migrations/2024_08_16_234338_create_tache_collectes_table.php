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
        Schema::create('tache_collectes', function (Blueprint $table) {
            $table->id();
            $table->date('date_attribution');
            $table->date('date_collecte');
            $table->string('statut')->default('non_attribuee');//par defaut
            $table->foreignId('equipe_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tache_collectes');
    }
};

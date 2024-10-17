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
        Schema::create('comptes', function (Blueprint $table) {
                $table->id();
                //$table->unsignedBigInteger('typecompte_id');//soie on enleve ca
                $table->string('nom_user');
                $table->string('email');
                $table->string('password');
                $table->string('phone');
                $table->string('adresse')->nullable();
               // $table->string('avatar')->nullable(); la colonne de de l'image profil
                $table->foreignId('type_compte_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
               // $table->foreign('typecompte_id')->references('id')->on('typecomptes')->onDelete('cascade')->onUpdate('cascade');
               $table->boolean('is_validated')->default(false);
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       // Schema::dropIfExists('comptes'); commenter pour tester celui d'en bas
        Schema::table('comptes', function (Blueprint $table) { //new ajout
            $table->dropColumn('is_validated');
        });
    }
};

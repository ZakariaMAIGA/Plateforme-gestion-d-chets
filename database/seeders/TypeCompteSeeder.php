<?php

namespace Database\Seeders;

use App\Models\TypeCompte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeCompte::create([
          
            'libelle'=> 'Resident'
        ]);
        TypeCompte::create([
          
            'libelle'=> 'Mairie'
        ]);
        TypeCompte::create([
          
            'libelle'=> 'Entreprise'
        ]);
        TypeCompte::create([
          
            'libelle'=> 'Admin'
        ]);
    }
}

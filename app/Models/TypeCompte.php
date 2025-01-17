<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeCompte extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',   
    ];



    public function comptes():HasMany
    {
        return $this->hasMany(Compte::class);
    }
}


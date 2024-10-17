<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entreprise extends Model
{
    use HasFactory;


    protected $guard;
    protected $fillable = [
        'nom_entreprise', 'service', 'adresse', 'compte_id', 
    ];



    public function compte():BelongsTo
    {
        return $this->belongsTo(Compte::class);
    }



    public function serviceRecyclage(): HasMany
    {
        return $this->hasMany(ServiceRecyclage::class);
    }
}

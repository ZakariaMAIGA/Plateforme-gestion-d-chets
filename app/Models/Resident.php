<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Resident extends Model
{
    use HasFactory, Notifiable;

    protected $guard;

    protected $fillable = [
        'nom_resident', 'prenom_resident', 'adresse', 'compte_id',   
    ];

    public function compte():BelongsTo
    {
        return $this->belongsTo(Compte::class, 'compte_id');
    }


    public function signalements():HasMany
    {
        return $this->hasMany(Signalement::class);
    }

}

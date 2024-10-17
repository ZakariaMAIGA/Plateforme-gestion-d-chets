<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Mairie extends Model
{
    use HasFactory, Notifiable;//ajout de notification
      
    
    protected $guard;
    protected $fillable = [
        'nom_mairie', 'commune', 'region', 'compte_id', 
    ];


    public function compte():BelongsTo
    {
        return $this->belongsTo(Compte::class, 'compte_id');

    }

    public function signalements():HasMany
    {
        return $this->hasMany(Signalement::class);
    }

    
    public function equipe():HasMany
    {
        return $this->hasMany(Equipe::class);
    }

}

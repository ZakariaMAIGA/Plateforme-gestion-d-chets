<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TacheCollecte extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_attribution', 'statut', 'equipe_id',   
    ];

    public function equipe():BelongsTo
    {
        return $this->belongsTo(Equipe::class);
    }


    public  function signalements()
    {
        return $this->belongsToMany(Signalement::class, 'tacheCollectes_signalements')
        ->withPivot('date_collecte', 'heure_collecte');
    }
}

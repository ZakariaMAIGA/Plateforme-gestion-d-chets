<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Signalement extends Model
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'type_probleme', 
        'description', 
        'photo', 
        'date_signalement', 
        'statut',
        'longitude',
        'latitude', 
        'resident_id', 
        'mairie_id',
    ];
    protected $casts = [
        'date_signalement' => 'date',
    ];
     
     

    // Accessor pour formater la date
    // public function getDateSignalementAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d-m-Y');
    // }


    public function resident():BelongsTo
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

    public function mairie():BelongsTo
    {
        return $this->belongsTo(Mairie::class, 'mairie_id');
    }



    public  function tachecollectes()
    {
        return $this->belongsToMany(TacheCollecte::class, 'tachecollectes_signalements') 
        ->withPivot('date_collecte', 'heure_collecte');
    }

}

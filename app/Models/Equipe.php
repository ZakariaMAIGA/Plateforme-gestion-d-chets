<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
 

class Equipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'phone', 'adresse', 'mairie_id',   
    ];

    public function tachecollecte():HasMany
    {
        return $this->hasMany(TacheCollecte::class);
    }



    public function mairie():BelongsTo
    {
        return $this->belongsTo(Mairie::class);
    }
}

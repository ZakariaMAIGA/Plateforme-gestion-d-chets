<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRecyclage extends Model
{
    use HasFactory;
    protected $fillable = [
        'description', 'type_materiau', 'methode_collecte', 'entreprise_id',   
    ];




    public function entreprise(): BelongsTo
    
    {
        return $this->belongsTo(Entreprise::class);
    }
}
 

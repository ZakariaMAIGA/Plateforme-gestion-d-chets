<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    use HasFactory;

    protected $guard;

    protected $fillable = [
        'nom', 'prenom', 'adresse', 'compte_id',   
    ];

    public function compte():BelongsTo
    {
        return $this->belongsTo(Compte::class, 'compte_id');
    }

}

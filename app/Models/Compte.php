<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;//ajout
use Illuminate\Notifications\Notifiable;//ajout
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class Compte extends Authenticatable //ajout
{
//class Compte extends Model commente pour un test
//{
    use HasApiTokens, HasFactory, Notifiable;


    //Les nouveaux ajouts
    //use Notifiable;

    protected $guard='comptes';
   // protected $guard = 'web';
    protected $table = 'comptes';

    protected $fillable = [
        'nom_user', 'email', 'password', 'phone', 'adresse',  'type_compte_id', 'avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    //fin

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];




    public function getAuthPassword()
    {
        return $this->password;
    }




    //relation type_compte et compte
    public function typecompte():BelongsTo
    {
        return $this->belongsTo(TypeCompte::class, 'type_compte_id'); 
    }


    //relation resident et compte
    public function resident():HasOne
    {
        return $this->hasOne(Resident::class, 'compte_id');
    }
     //relation mairie et compte
    public function mairie():HasOne
    {
        return $this->hasOne(Mairie::class);
    }
    //relation entreprise et compte
    public function entreprise():HasOne
    {
        return $this->hasOne(Entreprise::class);
    }
    public function admin():HasOne
    {
        return $this->hasOne(Admin::class, 'compte_id');
    }

    public function equipe()
    {
      return $this->hasOne(Equipe::class, 'compte_id');

    }
//}
}//fin ajout
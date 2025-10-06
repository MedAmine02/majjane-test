<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
    
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        
    ];

   
    public function dossiers(): HasMany
    {
        return $this->hasMany(Dossier::class);
    }

   
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_client',
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'type',
        'raison_sociale',
        'siret',
        
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($client) {
            if (empty($client->numero_client)) {
                $lastClient = self::orderBy('id', 'desc')->first();
                $nextId = $lastClient ? $lastClient->id + 1 : 1;
                $client->numero_client = 'CLI' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
            }
        });
    }

   
    public function dossiers(): HasMany
    {
        return $this->hasMany(Dossier::class);
    }

   
}

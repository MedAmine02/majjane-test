<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dossier extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'titre',
        'description',
        'type_procedure',
        'statut',
        'client_id',
        // 'responsable_id'
        'user_id',
    ];

    

    /**
     * Boot du modèle pour générer la référence automatiquement
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($dossier) {
            $lastDossier = self::orderBy('id', 'desc')->first();
            $nextId = $lastDossier ? $lastDossier->id + 1 : 1;
            $dossier->reference = str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

}

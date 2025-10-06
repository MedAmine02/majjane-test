<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'chemin',
        'type',
        'taille',
        'dossier_id',
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
}

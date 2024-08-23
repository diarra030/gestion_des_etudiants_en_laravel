<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'classe',
        'photo',
    ];

    // Définir la relation many-to-many avec Matiere
    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'etudiant_matiere');
    }
}

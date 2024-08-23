<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;

class MatieresController extends Controller
{
    public function create()
    {
        return view('matieres');
    }

    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
    ]);

    // Vérifier si une matière avec le même nom existe déjà
    $existingMatiere = Matiere::where('nom', $request->nom)->first();
    if ($existingMatiere) {
        return redirect('matieres')->with('error', 'La matière  existe déjà.');
    }

    $matiere = new Matiere();
    $matiere->nom = $request->nom;
    $matiere->save();

    return redirect('matieres')->with('status', 'Matière ajoutée avec succès.');
}

}

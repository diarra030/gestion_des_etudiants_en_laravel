<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Client;
use App\Models\Matiere;
use Illuminate\Support\Facades\Storage; // Importation de la classe Storage

class EtudiantController extends Controller
{
    public function liste_etudiant(){
        $etudiants = Etudiant::all();
        return view('listeetudiant', compact('etudiants'));
    }

    public function ajouter_etudiant(){
        return view('ajouteretudiant');
    }
    

    public function ajouter_etudiant_traitement(Request $request){
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'classe' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Gestion du fichier de la photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }
        
        $etudiant = new Etudiant();
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->classe = $request->classe;
        $etudiant->photo = $photoPath; // Enregistrement du chemin de la photo
        $etudiant->save();

        return redirect('/liste-etudiant')->with('status', 'L\'étudiant a bien été ajouté avec succès');
    }

    public function update_etudiant($id){
        $etudiant = Etudiant::find($id);
        return view('update', compact('etudiant'));
    }

    public function update_etudiant_traitement(Request $request){
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'classe' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $etudiant = Etudiant::find($request->id);
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->classe = $request->classe;
        // Vérifier et gérer la nouvelle photo
    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($etudiant->photo) {
            Storage::disk('public')->delete($etudiant->photo);
        }
        
        // Enregistrer la nouvelle photo et mettre à jour le chemin
        $photoPath = $request->file('photo')->store('photos', 'public');
        $etudiant->photo = $photoPath;
    }

        $etudiant->save();

        return redirect('/liste-etudiant')->with('status', 'L\'étudiant a bien été modifié avec succès');
    }

    public function delete_etudiant($id){
        $etudiant = Etudiant::find($id);
        $etudiant->delete();

        return redirect('/liste-etudiant')->with('status', 'L\'étudiant a bien été suprimé avec succès');
    }

    
    public function show($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $allMatieres = Matiere::all(); // Récupérer toutes les matières
        return view('show', compact('etudiant', 'allMatieres'));
    }

    public function assignMatiere(Request $request, $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $matiereIds = $request->matieres;

        $alreadyAssigned = $etudiant->matieres()->whereIn('matiere_id', $matiereIds)->get();

        if ($alreadyAssigned->isNotEmpty()) {
            $matiereNames = $alreadyAssigned->pluck('nom')->implode(', ');
            return redirect('/etudiant/'.$etudiant->id)->with('error', 'L\'étudiant a déjà la matière suivante :' . $matiereNames);
        }

        $etudiant->matieres()->syncWithoutDetaching($matiereIds);

        return redirect('/etudiant/'.$etudiant->id)->with('status', 'Matières attribuées avec succès.');
    }

    public function removeMatiere($etudiantId, $matiereId)
    {
        $etudiant = Etudiant::findOrFail($etudiantId);
        $etudiant->matieres()->detach($matiereId);

        return redirect('/etudiant/'.$etudiant->id)->with('error', 'Matière supprimée avec succès.');
    }

    public function imprimer_liste_etudiant(){
        $etudiants = Etudiant::orderBy('id')->get(); // Optionnel: récupérer tous les étudiants sans pagination pour l'impression
        return view('imprimerlisteetudiant', compact('etudiants'));
    }

    public function showTotals()
    {
        $totalClients = Client::count();
        $totalEtudiants = Etudiant::count();

        return view('espacemembre', [
            'totalClients' => $totalClients,
            'totalEtudiants' => $totalEtudiants,
        ]);
    }


}
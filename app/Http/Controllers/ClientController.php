<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ClientController extends Controller
{
    public function form_register(){
        return view('register');
    }

    public function form_login(){
        return view('login');
    }

    public function traitement_register(Request $request) {
        // Messages personnalisés
        $messages = [
            'email.email' => 'Veuillez fournir une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'role.required' => 'Le rôle est requis.',
            'mobile.required' => 'Le numéro de mobile est requis.',
            'etat.required' => 'L\'état est requis.',
            'photo_profil.image' => 'La photo de profil doit être une image.',
            'photo_profil.max' => 'La photo de profil ne doit pas dépasser 2 Mo.',
        ];
    
        // Validation des champs du formulaire
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|min:8',
            'nom' => 'required',
            'prenom' => 'required',
            'role' => 'required',
            'mobile' => 'required',
            'etat' => 'required',
            'photo_profil' => 'nullable|image|max:2048',
        ], $messages);
    
        // Vérification des erreurs de validation
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }
    
        // Création du nouvel utilisateur
        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password')); // Hash le mot de passe
        $client->nom = $request->input('nom');
        $client->prenom = $request->input('prenom');
        $client->role = $request->input('role');
        $client->mobile = $request->input('mobile');
        $client->etat = $request->input('etat');
    
        // Gestion de l'upload de la photo de profil
        $photoPath = null;
        if ($request->hasFile('photo_profil')) {
            $photoPath = $request->file('photo_profil')->store('photos', 'public');
        }
        $client->photo_profil = $photoPath;
    
        // Sauvegarde du client avec gestion des erreurs
        try {
            $client->save();
            // Flash message et redirection en cas de succès
            session()->flash('status', 'Votre compte a bien été créé');
            return redirect('/register');
        } catch (\Exception $e) {
            // Flash message et redirection en cas d'échec
            return redirect('/register')
                ->with('error', 'L\'enregistrement a échoué. Veuillez réessayer.')
                ->withInput();
        }

      
    }

    


    public function traitement_login(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:8',
        ]);

        // Préparer les informations de connexion
        $credentials = $request->only('email', 'password');

        // Vérifier les informations d'identification
        if (Auth::guard('client')->attempt($credentials)) {
            // Récupérer le client authentifié
            $client = Auth::guard('client')->user();

            // Vérifier l'état du client
            if ($client->etat == 'bloque') {
                Auth::guard('client')->logout();
                return redirect('/login')->with('error', 'Vous êtes bloqué. Veuillez contacter l\'administrateur.');
            } elseif ($client->etat == 'actif') {
                // Rediriger en fonction du rôle
                if ($client->role == 'admin') {
                    return redirect('/admin');
                } else {
                    return redirect('/espace-membre');
                }
            }
        } else {
            // Message d'erreur en cas d'identifiants incorrects
            return redirect('/login')->with('error', 'Identifiant ou mot de passe incorrect.');
        }
    }
    
    

    public function liste_utilisateur(){
        $clients = Client::all();
        return view('listeutulisateur', compact('clients'));
    }

    public function update_utulisateur($id)
    {
        $client = Client::find($id);
        return view('updateutulisateur', compact('client'));
    }

    public function update_utulisateur_traitement(Request $request, $id)
{
    // Validation des champs du formulaire
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:clients,email,' . $id,
        'password' => 'nullable|min:8',
        'nom' => 'required',
        'prenom' => 'required',
        'role' => 'required',
        'mobile' => 'required',
        'etat' => 'required',
        'photo_profil' => 'nullable|image|max:2048',
    ]);

    // Vérification des erreurs de validation
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Trouver le client à mettre à jour
    $client = Client::find($id);
    if (!$client) {
        return redirect('/liste-utilisateur')->with('error', 'Utilisateur non trouvé');
    }

    // Mise à jour des informations de l'utilisateur
    $client->email = $request->input('email');
    $client->nom = $request->input('nom');
    $client->prenom = $request->input('prenom');
    $client->role = $request->input('role');
    $client->mobile = $request->input('mobile');
    $client->etat = $request->input('etat');

    // Mise à jour du mot de passe uniquement si un nouveau mot de passe est fourni
    if ($request->filled('password')) {
        //$client->password = $request->input('password');
        $client->password = bcrypt($request->input('password'));
    }

    // Gestion de l'upload de la photo de profil
    if ($request->hasFile('photo_profil')) {
        $photoPath = $request->file('photo_profil')->store('photos_profil', 'public');
        $client->photo_profil = $photoPath;
    }

    // Sauvegarde du client avec gestion des erreurs
    try {
        $client->save();
        // Flash message et redirection en cas de succès
        return redirect('/liste-utilisateur')->with('status', 'L\'utilisateur a bien été modifié avec succès');
    } catch (\Exception $e) {
        // Flash message et redirection en cas d'échec
        return redirect('/liste-utilisateur')->with('error', 'La modification a échoué. Veuillez réessayer.');
    }
}

 
public function delete_utilisateur($id)
    {
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            return redirect('/liste-utilisateur')->with('status', 'L\'utilisateur a bien été supprimé avec succès');
        } else {
            return redirect('/liste-utilisateur')->with('status', 'L\'utilisateur n\'a pas été trouvé');
        }
    }

    public function traitement_logout(Request $request)
    {
        Auth::guard('client')->logout();

        // Invalider la session actuelle
        $request->session()->invalidate();

        // Régénérer le token CSRF
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Vous êtes déconnecté. Connectez-vous à nouveau pour accéder.');
    }

    public function showProfil()
    {
        // Récupérer l'utilisateur connecté
        $client = Auth::guard('client')->user();
        
        // Retourner la vue avec les données de l'utilisateur
        return view('profilutilisateur', compact('client'));
    }

    public function updateProfile(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:15',
            'password' => 'nullable|string|min:8',
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Récupérer l'utilisateur connecté
        $client = Auth::guard('client')->user();

        // Mettre à jour les informations de l'utilisateur
        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->email = $request->email;
        $client->mobile = $request->mobile;

        // Si le mot de passe est fourni, le mettre à jour
        if ($request->filled('password')) {
            $client->password = Hash::make($request->password);
        }

        // Si une nouvelle photo de profil est téléchargée, la traiter
        if ($request->hasFile('photo_profil')) {
            // Supprimer l'ancienne photo si elle existe
            if ($client->photo_profil) {
                Storage::delete('public/photos_profil/' . $client->photo_profil);
            }

            // Sauvegarder la nouvelle photo
            $file = $request->file('photo_profil');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photos_profil', $filename);
            $client->photo_profil = 'photos_profil/' . $filename;
        }

        // Sauvegarder les changements
        $client->save();

        return redirect('/profil')->with('status', 'Profil mis à jour avec succès.');
    }


        
}

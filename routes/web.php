<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\MatieresController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',function(){
    return view('home');
});

Route::get('/login',[ClientController::class, 'form_login'])->name('login');
Route::post('/login/traitement',[ClientController::class, 'traitement_login']);


Route::middleware(['client.auth'])->group(function () {

    Route::get('/espace-membre',function(){
        return view('espacemembre');
    });
    Route::get('/espace-membre', [EtudiantController::class, 'showTotals']);


    Route::post('/register/traitement',[ClientController::class, 'traitement_register']);
    Route::get('/register',[ClientController::class, 'form_register']);
  
    Route::get('/liste-utilisateur',[ClientController::class, 'liste_utilisateur']);

    Route::post('/logout',[ClientController::class, 'traitement_logout'])->name('logout');
    Route::get('/profil-utilisateur',[ClientController::class, 'showprofil'])->name('profil-utilisateur');

    Route::get('/matieres', [MatieresController::class, 'create']);
    Route::post('/matieres/traitement', [MatieresController::class, 'store']);

    Route::put('/etudiants/{id}/assign-matiere', [EtudiantController::class, 'assignMatiere'])->name('etudiants.assignMatiere');
    Route::delete('/etudiants/{etudiantId}/matieres/{matiereId}', [EtudiantController::class, 'removeMatiere'])->name('etudiants.removeMatiere');

    Route::get('/clients/{client}/edit', [ClientController::class, 'update_utulisateur'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update_utulisateur_traitement'])->name('clients.update');
    Route::get('/delete-utilisateur/{id}', [ClientController::class, 'delete_utilisateur']);

    Route::get('/ajouter-etudiant',[EtudiantController::class, 'ajouter_etudiant']);
    Route::post('/ajouter/traitement',[EtudiantController::class, 'ajouter_etudiant_traitement']);
    Route::get('/liste-etudiant',[EtudiantController::class, 'liste_etudiant']);

    Route::get('/update-etudiant/{id}',[EtudiantController::class, 'update_etudiant']);
    Route::post('/update/traitement',[EtudiantController::class, 'update_etudiant_traitement']);

    Route::get('/delete-etudiant/{id}',[EtudiantController::class, 'delete_etudiant']);

    Route::get('/etudiant/{id}', [EtudiantController::class, 'show'])->name('etudiant.show');

    Route::get('/profil', [ClientController::class, 'showProfil'])->name('profil');
    Route::post('/update-profile-traitement', [ClientController::class, 'updateProfile'])->name('update-profile-traitement');

    
});

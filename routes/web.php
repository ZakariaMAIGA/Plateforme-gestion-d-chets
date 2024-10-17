<?php

use App\Http\Controllers\Accueil\accueilController;
use App\Http\Controllers\adminProfilController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\EntrepriseAuthController;
use App\Http\Controllers\Auth\MairieAuthController;
use App\Http\Controllers\Auth\ResidentAuthController;
use App\Http\Controllers\homeController ;
use App\Http\Controllers\residentController ;
use App\Http\Controllers\autoriteController;
use App\Http\Controllers\entrepriseController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\regsiterController;
use App\Http\Controllers\authController;
use App\Http\Controllers\Compte\compteController;
use App\Http\Controllers\entrepriseProfilController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\mairieProfilController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\signalementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\profilController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\TacheCollecteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[accueilController::class, 'viewaccueil'])->name("accueil.index");
Route::get('/about',[accueilController::class, 'about']);
Route::get('/contact',[accueilController::class, 'contact']);

Route::get('/accueil',[homeController::class, 'index'])->name("layouts.index");//middleware('auth'); Apres je vais faire une page d'accueil avec cette route '/'
Route::get('/resident',[residentController::class, 'dash_resident'])->name('dashResident')->middleware('auth:resident');
Route::get('/autorite',[autoriteController::class, 'dash_autorite'])->name('dasAutorite')->middleware('auth:mairie');
Route::get('/entreprise',[entrepriseController::class, 'entre_annuaire'])->name('annuaire')->middleware('auth:entreprise');
Route::get('/signal',[signalementController::class, 'signal']);

 

   //Nouvelles routes pour l'auth resident
     
    Route::get('/login', [ResidentAuthController::class, 'showLoginForm'])->name('resident.login');
    Route::post('/login', [ResidentAuthController::class, 'login'])->name('login');
    Route::post('/logout', [ResidentAuthController::class, 'logout'])->name('resident.logout');

    Route::get('/register', [ResidentAuthController::class, 'showRegistrationForm'])->name('resident.register');
    Route::post('/register', [ResidentAuthController::class, 'register']);
    
    //Pour les mairies
    Route::get('/loginMairie', [MairieAuthController::class, 'showLoginForm'])->name('mairie.login');
    Route::post('/loginMairie', [MairieAuthController::class, 'login'])->name('loginMairie');
    Route::post('/logoutMairie', [MairieAuthController::class, 'logout'])->name('mairie.logout');

    Route::get('/registerMairie', [MairieAuthController::class, 'showRegistrationForm'])->name('mairie.register');
    Route::post('/registerMairie', [MairieAuthController::class, 'register']);

    //Pour les entreprise
    Route::get('/loginEntreprise', [EntrepriseAuthController::class, 'showLoginForm'])->name('entreprise.login');
    Route::post('/loginEntreprise', [EntrepriseAuthController::class, 'login'])->name('loginEntreprise');
    Route::post('/logoutEntreprise', [EntrepriseAuthController::class, 'logout'])->name('entreprise.logout');

    Route::get('/registerEntreprise', [EntrepriseAuthController::class, 'showRegistrationForm'])->name('entreprise.register');
    Route::post('/registerEntreprise', [EntrepriseAuthController::class, 'register']);

    //Pour les administrateurs
    Route::get('/loginAdmin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/loginAdmin', [AdminAuthController::class, 'login'])->name('adminlogin');
    //Route::post('/logoutAdmin', [AdminAuthController::class, 'logout'])->name('adminlogout');

    Route::get('/registerAdmin', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/registerAdmin', [AdminAuthController::class, 'register']);
    


      Route::middleware(['auth:admin'])->group(function () {
      Route::get('/comptes', [compteController::class, 'index'])->name('comptes.index');
      Route::get('/create', [compteController::class, 'create'])->name('comptes.create');
      Route::post('/create', [compteController::class, 'store']);
      Route::get('/comptes/edit/{id}', [compteController::class, 'edit'])->name('comptes.edit');
      Route::put('/comptes/update/{id}', [compteController::class, 'update'])->name('comptes.update');
      Route::delete('/comptes/{id}', [compteController::class, 'destroy'])->name('comptes.destroy');
      Route::put('/comptes/{id}/validate', [CompteController::class, 'validateCompte'])->name('comptes.validate');


 });
        //La route de deconnexion pour tous les type de comptes
     Route::post('/logout', [compteController::class, 'logout'])->name('logout');


     //Les routes pour la creation du signalement par les residents
    // Routes pour les résidents
  Route::middleware(['auth:resident'])->group(function () {
  Route::get('/signalements/create', [SignalementController::class, 'create'])->name('signalements.create');
  Route::post('signalements', [SignalementController::class, 'store'])->name('signalements.store');
  Route::get('signalement', [SignalementController::class, 'index'])->name('signalements.index');
  Route::get('/resident/signalements/{signalement}', [SignalementController::class, 'show'])->name('signalements.show');
  Route::get('/signalements/{signalement}/edit', [SignalementController::class, 'edit'])->name('signalements.edit');
  Route::put('/signalements/{signalement}', [SignalementController::class, 'update'])->name('signalements.update');
  Route::delete('/signalements/{signalement}', [SignalementController::class, 'destroy'])->name('signalements.destroy');
});
//La mairie qui gere le signalement
   Route::middleware(['auth:mairie'])->group(function () {
   Route::get('/mairie/signalements', [SignalementController::class, 'indexForMairie'])->name('mairie.signalements.index');
   Route::get('/mairie/signalements/{signalement}', [SignalementController::class, 'showForMairie'])->name('mairie.signalements.show');
   Route::post('/mairie/signalements/{signalement}/change-status', [SignalementController::class, 'changeStatus'])->name('mairie.signalements.changeStatus');
   Route::delete('/mairie/signalements/{signalement}', [SignalementController::class, 'destroyForMairie'])->name('mairie.signalements.destroy');

});

Route::middleware(['auth:mairie'])->group(function () {

Route::get('/equipe/create', [EquipeController::class, 'create']);
Route::post('/equipe', [EquipeController::class, 'store'])->name('equipe.create');
Route::get('/equipes', [EquipeController::class, 'index'])->name('equipe.index');
Route::get('/equipes/{equipe}/edit', [EquipeController::class, 'edit'])->name('equipe.edit');
Route::put('/equipes/{epuipe}',[EquipeController::class, 'update'])->name('equipe.update');
Route::delete('/equipes/{equipe}', [EquipeController::class, 'destroy'])->name('equipe.destroy');

//pour creation des taches
Route::get('/tache/create/{signalementId}', [TacheCollecteController::class, 'create'])->name('tache.create');
Route::post('/tache', [TacheCollecteController::class, 'store'])->name('tache.store');
Route::get('/taches', [TacheCollecteController::class, 'index'])->name('tache.index');
Route::get('taches/{id}/edit', [TacheCollecteController::class, 'edit'])->name('tache.edit');
Route::put('taches/{id}', [TacheCollecteController::class, 'update'])->name('tache.update');
Route::delete('taches/{id}', [TacheCollecteController::class, 'destroy'])->name('tache.destroy');
Route::get('taches/{tache}', [TacheCollecteController::class, 'show'])->name('tache.show');
});
//Notification
Route::patch('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::get('/services',[serviceController::class,'index'])->name('services.index');
Route::get('/service/create',[serviceController::class, 'create']);
Route::post('/service',[serviceController::class, 'store'])->name('service.store');
Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

// routes/web.php

Route::middleware('auth:resident')->group(function () {
   Route::get('/resident/profile', [ProfilController::class, 'showProfile'])->name('resident.profile');
   Route::post('/resident/profile', [ProfilController::class, 'updateProfile'])->name('resident.profile.update');
});
Route::middleware('auth:admin')->group(function () {
   Route::get('/admin/profile', [adminProfilController::class, 'showProfile'])->name('admin.profile');
   Route::post('/admin/profile', [adminProfilController::class, 'updateProfile'])->name('admin.profile.update');
});

Route::middleware('auth:mairie')->group(function () {
   Route::get('/mairie/profile', [mairieProfilController::class, 'showProfile'])->name('mairie.profile');
   Route::post('mairie/profile', [mairieProfilController::class, 'updateProfile'])->name('mairie.profile.update');
});
Route::middleware('auth:entreprise')->group(function () {
   Route::get('/entreprise/profile', [entrepriseProfilController::class, 'showProfile'])->name('entreprise.profile');
   Route::post('entreprise/profile', [entrepriseProfilController::class, 'updateProfile'])->name('entreprise.profile.update');
});

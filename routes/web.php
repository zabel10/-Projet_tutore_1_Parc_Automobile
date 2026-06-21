<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PresentationController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\VehiculeController as AdminVehiculeController;
use App\Http\Controllers\Admin\ConducteurController as AdminConducteurController;
use App\Http\Controllers\Admin\MissionController as AdminMissionController;
use App\Http\Controllers\Admin\MaintenanceController as AdminMaintenanceController;
use App\Http\Controllers\Admin\AlerteController as AdminAlerteController;
use App\Http\Controllers\Admin\CarburantController as AdminCarburantController;
use App\Http\Controllers\Admin\AssuranceController as AdminAssuranceController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\RapportController as AdminRapportController;
use App\Http\Controllers\Admin\UtilisateurController as AdminUtilisateurController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\ParametreController as AdminParametreController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\VehiculeController as ManagerVehiculeController;
use App\Http\Controllers\Manager\ConducteurController as ManagerConducteurController;
use App\Http\Controllers\Manager\MissionController as ManagerMissionController;
use App\Http\Controllers\Manager\MaintenanceController as ManagerMaintenanceController;
use App\Http\Controllers\Manager\CarburantController as ManagerCarburantController;
use App\Http\Controllers\Manager\AssuranceController as ManagerAssuranceController;
use App\Http\Controllers\Manager\AlerteController as ManagerAlerteController;
use App\Http\Controllers\Admin\BonSortieController as AdminBonSortieController;
use App\Http\Controllers\Admin\DemandeController as AdminDemandeController;
use App\Http\Controllers\Driver\AffectationController;
use App\Http\Controllers\Driver\DashboardController;
use App\Http\Controllers\Driver\MissionController;
use App\Http\Controllers\Driver\CarburantController;
use App\Http\Controllers\Driver\MaintenanceController;
use App\Http\Controllers\Driver\NotificationController;
use App\Http\Controllers\Driver\DocumentController;
use App\Http\Controllers\Driver\BonSortieController;
use App\Http\Controllers\Driver\DemandeController;
use App\Http\Controllers\Driver\ProfilController;

/*
|--------------------------------------------------------------------------
| ESPACE PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/presentation', [PresentationController::class, 'index'])->name('presentation');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:10,1')->name('contact.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ESPACE ADMIN UNIFIÉ (ADMIN + GESTIONNAIRE)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,gestionnaire', 'throttle:120,1'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('vehicules', AdminVehiculeController::class);
    Route::resource('conducteurs', AdminConducteurController::class);
    Route::resource('missions', AdminMissionController::class);
    Route::resource('maintenances', AdminMaintenanceController::class);
    Route::resource('alertes', AdminAlerteController::class);
    Route::resource('carburants', AdminCarburantController::class);
    Route::resource('assurances', AdminAssuranceController::class);

    Route::get('reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::get('rapports', [AdminRapportController::class, 'index'])->name('rapports.index');
    Route::get('demandes', [AdminDemandeController::class, 'index'])->name('demandes.index');
    Route::get('demandes/{demande}', [AdminDemandeController::class, 'show'])->name('demandes.show');
    Route::patch('demandes/{demande}', [AdminDemandeController::class, 'update'])->name('demandes.update');
    Route::get('bons-sortie', [AdminBonSortieController::class, 'index'])->name('bons-sortie.index');
    Route::get('bons-sortie/{bonSortie}', [AdminBonSortieController::class, 'show'])->name('bons-sortie.show');
    Route::patch('bons-sortie/{bonSortie}', [AdminBonSortieController::class, 'update'])->name('bons-sortie.update');

    Route::middleware('can:manage_users')->group(function () {
        Route::resource('utilisateurs', AdminUtilisateurController::class);
        Route::get('roles', [AdminRoleController::class, 'index'])->name('roles.index');
    });

    Route::get('parametres', [AdminParametreController::class, 'index'])->name('parametres.index');
    Route::get('profil', [AdminProfilController::class, 'edit'])->name('profil.edit');
    Route::patch('profil', [AdminProfilController::class, 'update'])->name('profil.update');

    Route::fallback(function () {
        if (request()->expectsJson()) {
            return response()->json(['message' => 'Ressource non trouvée.'], 404);
        }
        return view('errors.403');
    });
});

/*
|--------------------------------------------------------------------------
| ESPACE CONDUCTEUR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'ensure.role:driver', 'throttle:120,1'])->prefix('driver')->name('driver.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/vehicule', [DashboardController::class, 'vehicule'])->name('vehicule');
    Route::get('/panne', [DashboardController::class, 'panne'])->name('panne');
    Route::post('/panne', [DashboardController::class, 'panneStore'])->name('panne.store');
    Route::get('/historique', [DashboardController::class, 'historique'])->name('historique');

    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::patch('/profil', [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/missions', [MissionController::class, 'index'])->name('missions.index');
    Route::get('/missions/{mission}', [MissionController::class, 'show'])->name('missions.show');

    Route::get('/affectations', [AffectationController::class, 'index'])->name('affectations.index');
    Route::get('/affectations/{affectation}', [AffectationController::class, 'show'])->name('affectations.show');

    Route::get('/bons-sortie', [BonSortieController::class, 'index'])->name('bons-sortie.index');
    Route::get('/bons-sortie/create', [BonSortieController::class, 'create'])->name('bons-sortie.create');
    Route::post('/bons-sortie', [BonSortieController::class, 'store'])->name('bons-sortie.store');

    Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');
    Route::get('/demandes/create', [DemandeController::class, 'create'])->name('demandes.create');
    Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');

    Route::get('/carburants', [CarburantController::class, 'index'])->name('carburants.index');
    Route::get('/carburants/create', [CarburantController::class, 'create'])->name('carburants.create');
    Route::post('/carburants', [CarburantController::class, 'store'])->name('carburants.store');

    Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');

    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

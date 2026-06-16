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
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\VehiculeController as ManagerVehiculeController;
use App\Http\Controllers\Manager\ConducteurController as ManagerConducteurController;
use App\Http\Controllers\Manager\MissionController as ManagerMissionController;
use App\Http\Controllers\Manager\MaintenanceController as ManagerMaintenanceController;
use App\Http\Controllers\Manager\CarburantController as ManagerCarburantController;
use App\Http\Controllers\Manager\AssuranceController as ManagerAssuranceController;
use App\Http\Controllers\Manager\AlerteController as ManagerAlerteController;
use App\Http\Controllers\Driver\DashboardController as DriverDashboardController;
use App\Http\Controllers\Driver\MissionController as DriverMissionController;
use App\Http\Controllers\Driver\CarburantController as DriverCarburantController;

/*
|--------------------------------------------------------------------------
| ESPACE PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/presentation', [PresentationController::class, 'index'])->name('presentation');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ESPACE ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('vehicules', AdminVehiculeController::class);
    Route::resource('conducteurs', AdminConducteurController::class);
    Route::resource('missions', AdminMissionController::class);
    Route::resource('maintenances', AdminMaintenanceController::class);
    Route::resource('alertes', AdminAlerteController::class);
});

/*
|--------------------------------------------------------------------------
| ESPACE GESTIONNAIRE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:gestionnaire'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('vehicules', ManagerVehiculeController::class);
    Route::resource('conducteurs', ManagerConducteurController::class);
    Route::resource('missions', ManagerMissionController::class);
    Route::resource('maintenances', ManagerMaintenanceController::class);
    Route::resource('carburants', ManagerCarburantController::class);
    Route::resource('assurances', ManagerAssuranceController::class);
    Route::resource('alertes', ManagerAlerteController::class);
});

/*
|--------------------------------------------------------------------------
| ESPACE CONDUCTEUR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:conducteur'])->prefix('driver')->name('driver.')->group(function () {
    Route::get('/dashboard', [DriverDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/missions', [DriverMissionController::class, 'index'])->name('missions.index');
    Route::get('/missions/{mission}', [DriverMissionController::class, 'show'])->name('missions.show');
    
    Route::get('/carburants', [DriverCarburantController::class, 'index'])->name('carburants.index');
    Route::get('/carburants/create', [DriverCarburantController::class, 'create'])->name('carburants.create');
    Route::post('/carburants', [DriverCarburantController::class, 'store'])->name('carburants.store');
});
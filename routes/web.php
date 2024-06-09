<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirestoreController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\UserController;
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




Route::get('/test-firestore', [FirestoreController::class, 'testFirestore']);



Route::get('/home', [LoginController::class, 'home'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
  return redirect()->route('login');
});

Route::get('/villes', [VilleController::class, 'index'])->name('villes.index');
Route::get('/villes/ajouter', [VilleController::class, 'create'])->name('villes.create');
Route::post('/villes', [VilleController::class, 'store'])->name('villes.store');
Route::get('/villes/{id}', [VilleController::class, 'show'])->name('villes.show');
Route::get('/villes/{id}/update', [VilleController::class, 'edit'])->name('villes.edit');
Route::put('/villes/{id}', [VilleController::class, 'update'])->name('villes.update');
Route::delete('/villes/{id}', [VilleController::class, 'destroy'])->name('villes.destroy');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//routes hotels
Route::prefix('villes/{villeId}')->group(function () {
    Route::get('hotels/create', [VilleController::class, 'createHotel'])->name('hotels.create');
    Route::post('hotels', [VilleController::class, 'storeHotel'])->name('hotels.store');
    Route::get('hotels/{hotelId}', [VilleController::class, 'showHotel'])->name('hotels.show');
    Route::get('hotels/{hotelId}/edit', [VilleController::class, 'editHotel'])->name('hotels.edit');
    Route::put('hotels/{hotelId}', [VilleController::class, 'updateHotel'])->name('hotels.update');
    Route::delete('hotels/{hotelId}', [VilleController::class, 'destroyHotel'])->name('hotels.destroy');
});
//routes restaurants

Route::get('/villes/{villeId}/restaurants/create', [VilleController::class, 'createRestaurant'])->name('restaurants.create');
Route::post('/villes/{villeId}/restaurants', [VilleController::class, 'storeRestaurant'])->name('restaurants.store');
Route::get('/villes/{villeId}/restaurants/{restaurantId}/edit', [VilleController::class, 'editRestaurant'])->name('restaurants.edit');
Route::put('/villes/{villeId}/restaurants/{restaurantId}', [VilleController::class, 'updateRestaurant'])->name('restaurants.update');
Route::delete('/villes/{villeId}/restaurants/{restaurantId}', [VilleController::class, 'destroyRestaurant'])->name('restaurants.destroy');
Route::get('/villes/{villeId}/restaurants/{restaurantId}', [VilleController::class, 'showRestaurant'])->name('restaurants.show');

//gestion des lieux
Route::get('villes/{villeId}/lieux/{lieuId}', [VilleController::class, 'showLieu'])->name('villes.lieux.show');
Route::get('villes/{villeId}/lieux/create', [VilleController::class, 'createLieu'])->name('villes.lieux.create');
Route::post('villes/{villeId}/lieux', [VilleController::class, 'storeLieu'])->name('villes.lieux.store');
Route::get('villes/{villeId}/lieux/{lieuId}/edit', [VilleController::class, 'editLieu'])->name('villes.lieux.edit');
Route::put('villes/{villeId}/lieux/{lieuId}', [VilleController::class, 'updateLieu'])->name('villes.lieux.update');
Route::delete('villes/{villeId}/lieux/{lieuId}', [VilleController::class, 'destroyLieu'])->name('villes.lieux.destroy');

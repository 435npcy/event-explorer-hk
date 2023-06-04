<?php

use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/search/{keyword?}', [EventController::class, 'listSearchResult'])->name('events.search');
Route::post('/search', [EventController::class, 'search'])->name('events.search.submit');
Route::get('/events/today', [EventController::class, 'listTodayEvents'])->name('events.today');
Route::get('/categories/{categoryName}', [EventController::class, 'listActiveEventsByCategory'])->name('categories.list');

Route::resource('/events', EventController::class)
    ->only(['index', 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->name('admin.')->middleware(['role:admin'])->group(function () {
    Route::resource('/events', AdminEventController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->middleware(['auth', 'verified']);
    // ->names(['index' => 'events.index']);
});


require __DIR__ . '/auth.php';
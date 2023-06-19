<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNoteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', WelcomeController::class);

Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', DashboardController::class);

  Route::resource('/contacts', ContactController::class);
  Route::delete('/contacts/{contact}/restore', [ContactController::class, 'restore'])
    ->name('contacts.restore')
    ->withTrashed();
  Route::delete('/contacts/{contact}/force-delete', [ContactController::class, 'forceDelete'])
    ->name('contacts.force-delete')
    ->withTrashed();

  Route::resource('/contacts.notes', ContactNoteController::class)->shallow();

  Route::resource('/activities', ActivityController::class)->parameters([
    'activities' => 'active',
  ]);

  Route::resources([
    '/tags' => TagController::class,
    '/tasks' => TaskController::class
  ]);

  Route::resource('/companies', CompanyController::class);

  // Динамический роут с ОПЦИОНАЛЬНЫМ параметром
  Route::get('/companies/{name?}', function ($name = null) {
    if ($name) {
      return "<h1>Company " . $name . " </h1>";
    } else {
      return "<h1>All Companies</h1>";
    }
  })->whereAlphaNumeric('name');
});

// Route::get('/dashboard', DashboardController::class)->middleware(['auth']);

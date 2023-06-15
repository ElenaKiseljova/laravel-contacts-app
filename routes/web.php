<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNoteController;
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

// Динамический роут с ОПЦИОНАЛЬНЫМ параметром
Route::get('/companies/{name?}', function ($name = null) {
  if ($name) {
    return "<h1>Company " . $name . " </h1>";
  } else {
    return "<h1>All Companies</h1>";
  }
})->whereAlphaNumeric('name');

Route::resource('/contacts', ContactController::class);

Route::resource('/companies', CompanyController::class);

// Route::resource('/activities', ActivityController::class)->only([
//   'create', 'store', 'edit',  'update', 'destroy'
// ]);
// Route::resource('/activities', ActivityController::class)->except([
//   'create', 'store', 'edit',  'update', 'destroy'
// ]);
// Route::resource('/activities', ActivityController::class)->names([
//   'index' => 'activities.all',
//   'show' => 'activities.view'
// ]);
Route::resource('/activities', ActivityController::class)->parameters([
  'activities' => 'active',
]);

// Route::resource('/contacts.notes', ContactNoteController::class);
Route::resource('/contacts.notes', ContactNoteController::class)->shallow();

Route::resources([
  '/tags' => TagController::class,
  '/tasks' => TaskController::class
]);

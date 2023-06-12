<?php

use App\Http\Controllers\ContactController;
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
  return view('welcome');
});

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');

// Динамический роут
Route::get('/contacts/{id}', [ContactController::class, 'show'])->whereNumber('id')->name('contacts.show');

// Динамический роут с ОПЦИОНАЛЬНЫМ параметром
Route::get('/companies/{name?}', function ($name = null) {
  if ($name) {
    return "<h1>Company " . $name . " </h1>";
  } else {
    return "<h1>All Companies</h1>";
  }
})->whereAlphaNumeric('name');

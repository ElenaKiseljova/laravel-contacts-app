<?php

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
  $html = "
    <h1>Contact APP</h1>
    <div>
      <a href='" . route('contacts.index') . "'>All Contacts</a>
      <a href='" . route('contacts.create') . "'>Add Contact</a>
      <a href='" . route('contacts.show', 1) . "'>Show contact</a>
    </div>
  ";

  return $html;

  // return view('welcome');
});

// Route::prefix('admin')->name('admin.')->group(function () {
Route::prefix('admin')->group(function () {
  Route::get('/contacts', function () {
    return "<h1>All contacts</h1>";
  })->name('contacts.index');

  Route::get('/contacts/create', function () {
    return "<h1>Add new contact</h1>";
  })->name('contacts.create');

  // Динамический роут
  Route::get('/contacts/{id}', function ($id) {
    return "<h1>Contact " . $id . " </h1>";
    // })->where('id', '[0-9]+');
  })->whereNumber('id')->name('contacts.show');

  // Динамический роут с ОПЦИОНАЛЬНЫМ параметром
  Route::get('/companies/{name?}', function ($name = null) {
    if ($name) {
      return "<h1>Company " . $name . " </h1>";
    } else {
      return "<h1>All Companies</h1>";
    }
    // })->where('name', '[a-zA-Z]+');
    // })->whereAlpha('name');
  })->whereAlphaNumeric('name');
});

Route::fallback(function () {
  return "<h1>Sorry, the page does not exist</h1>";
});

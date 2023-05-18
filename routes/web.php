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
  return view('welcome');
});

Route::get('/contacts', function () {
  return "<h1>All contacts</h1>";
});

Route::get('/contacts/create', function () {
  return "<h1>Add new contact</h1>";
});

// Динамический роут
Route::get('/contacts/{id}', function ($id) {
  return "<h1>Contact " . $id . " </h1>";
  // })->where('id', '[0-9]+');
})->whereNumber('id');

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

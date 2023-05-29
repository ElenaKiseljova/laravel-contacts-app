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

function getContacts()
{
  return [
    1 => ['name' => 'Name 1', 'phone' => '123456789'],
    2 => ['name' => 'Name 1', 'phone' => '123456789'],
    3 => ['name' => 'Name 1', 'phone' => '123456789'],
    4 => ['name' => 'Name 1', 'phone' => '123456789'],
  ];
}

Route::get('/', function () {
  return view('welcome');
});

Route::get('/contacts', function () {
  $contacts = getContacts();

  // return view('contacts.index', ['contacts' => $contacts]);
  return view('contacts.index', compact('contacts'));
})->name('contacts.index');

Route::get('/contacts/create', function () {
  return view('contacts.create');
})->name('contacts.create');

// Динамический роут
Route::get('/contacts/{id}', function ($id) {
  $contacts = getContacts();

  // abort_if(!isset($contacts[$id]), 404);
  abort_unless(isset($contacts[$id]), 404);

  $contact = $contacts[$id];

  return view('contacts.show')->with('contact', $contact); // ->with('companies', $companies);
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

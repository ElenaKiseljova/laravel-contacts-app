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
  $companies = [
    1 => ['name' => 'Company One', 'contacts' => 3],
    2 => ['name' => 'Company Two', 'contacts' => 1],
    3 => ['name' => 'Company Three', 'contacts' => 4]
  ];

  $contacts = []; // getContacts();

  return view('contacts.index', compact('contacts', 'companies'));
})->name('contacts.index');

Route::get('/contacts/create', function () {
  return view('contacts.create');
})->name('contacts.create');

// Динамический роут
Route::get('/contacts/{id}', function ($id) {
  $contacts = getContacts();

  abort_unless(isset($contacts[$id]), 404);

  $contact = $contacts[$id];

  return view('contacts.show')->with('contact', $contact);
})->whereNumber('id')->name('contacts.show');

// Динамический роут с ОПЦИОНАЛЬНЫМ параметром
Route::get('/companies/{name?}', function ($name = null) {
  if ($name) {
    return "<h1>Company " . $name . " </h1>";
  } else {
    return "<h1>All Companies</h1>";
  }
})->whereAlphaNumeric('name');

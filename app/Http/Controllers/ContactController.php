<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function index()
  {
    $companies = [
      1 => ['name' => 'Company One', 'contacts' => 3],
      2 => ['name' => 'Company Two', 'contacts' => 1],
      3 => ['name' => 'Company Three', 'contacts' => 4]
    ];

    $contacts = $this->getContacts();

    return view('contacts.index', compact('contacts', 'companies'));
  }

  public function create()
  {
    return view('contacts.create');
  }

  public function show($id)
  {
    $contacts = $this->getContacts();

    abort_unless(isset($contacts[$id]), 404);

    $contact = $contacts[$id];

    return view('contacts.show')->with('contact', $contact);
  }

  protected function getContacts()
  {
    return [
      1 => ['id' => 1, 'name' => 'Name 1', 'phone' => '123456789'],
      2 => ['id' => 2, 'name' => 'Name 2', 'phone' => '123456789'],
      3 => ['id' => 3, 'name' => 'Name 3', 'phone' => '123456789'],
      4 => ['id' => 4, 'name' => 'Name 4', 'phone' => '123456789'],
    ];
  }
}

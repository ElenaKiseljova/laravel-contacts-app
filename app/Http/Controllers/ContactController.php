<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  // 1, 2
  // protected $company;

  // 3
  public function __construct(protected CompanyRepository $company)
  // 2
  // public function __construct(CompanyRepository $company)
  // 1
  // public function __construct()
  {
    // 2
    $this->company = $company;
    // 1
    // $this->company = new CompanyRepository();
  }

  // 2
  public function index(CompanyRepository $company, Request $request)
  // 1
  // public function index()
  {
    // dd($request->sort_by);

    // $companies = [
    //   1 => ['name' => 'Company One', 'contacts' => 3],
    //   2 => ['name' => 'Company Two', 'contacts' => 1],
    //   3 => ['name' => 'Company Three', 'contacts' => 4]
    // ];

    // 2
    $companies = $company->pluck();
    // 1
    // $companies = $this->company->pluck();

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

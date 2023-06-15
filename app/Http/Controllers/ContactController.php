<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use App\Models\Contact;

class ContactController extends Controller
{
  public function __construct(protected CompanyRepository $company)
  {
    $this->company = $company;
  }

  public function index()
  {
    $companies = $this->company->pluck();

    $contacts = Contact::latest()->where(function ($query) {
      if ($company_id = request()->query('company_id')) {
        $query->where('company_id', $company_id);
      }
    })->paginate(10);

    return view('contacts.index', compact('contacts', 'companies'));
  }

  public function create()
  {
    return view('contacts.create');
  }

  public function show($id)
  {
    $contact = Contact::findOrFail($id);

    return view('contacts.show')->with('contact', $contact);
  }
}

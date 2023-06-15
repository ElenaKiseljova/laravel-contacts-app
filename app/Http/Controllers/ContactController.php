<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use App\Models\Contact;
use Illuminate\Http\Request;

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
    $companies = $this->company->pluck();

    return view('contacts.create', compact('companies'));
  }

  public function store(Request $request)
  {
    dd(
      // request()->path(),
      // request()->is('contacts*'),
      // request()->routeIs('contacts.*'),
      // request()->url(),
      // request()->fullUrl(),
      // request()->method(),
      // request()->isMethod('get'),
      // request()->ip(),
      request()->input(),
      request()->query(),
      request()->all(),
      request()->collect(),
      request()->only('first_name', 'last_name'),
      request()->except('first_name'),
      request()->first_name,
    );
  }

  public function show($id)
  {
    $contact = Contact::findOrFail($id);

    return view('contacts.show')->with('contact', $contact);
  }
}

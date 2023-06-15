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
    $contact = new Contact();
    $companies = $this->company->pluck();

    return view('contacts.create', compact('companies', 'contact'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'first_name' => 'required|string|max:50',
      'last_name' => 'required|string|max:50',
      'email' => 'required|email',
      'phone' => 'nullable',
      'address' => 'nullable',
      'company_id' => 'required|exists:companies,id',
    ]);

    Contact::create($request->input());

    return redirect()->route('contacts.index')->with('message', 'Contact has been added successfully');
  }

  public function show($id)
  {
    $contact = Contact::findOrFail($id);

    return view('contacts.show')->with('contact', $contact);
  }

  public function edit($id)
  {
    $contact = Contact::findOrFail($id);
    $companies = $this->company->pluck();

    return view('contacts.edit', compact('contact', 'companies'));
  }

  public function update(Request $request, $id)
  {
    $contact = Contact::findOrFail($id);

    $request->validate([
      'first_name' => 'required|string|max:50',
      'last_name' => 'required|string|max:50',
      'email' => 'required|email',
      'phone' => 'nullable',
      'address' => 'nullable',
      'company_id' => 'required|exists:companies,id',
    ]);

    $contact->update($request->input());

    return redirect()->route('contacts.index')->with('message', 'Contact has been updated successfully');
  }

  public function destroy($id)
  {
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect()->route('contacts.index')->with('message', 'Contact has been deleted successfully');
  }
}

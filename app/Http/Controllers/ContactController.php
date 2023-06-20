<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Models\Contact;

class ContactController extends Controller
{
  public function userCompanies()
  {
    return Company::forUser(auth()->user())->orderBy('name')->pluck('name', 'id');
  }

  public function index()
  {
    $companies = $this->userCompanies();

    // DB::enableQueryLog();

    // $contacts = auth()->user()->contacts()
    //   ->allowedTrash()
    //   ->allowedSorts(['first_name', 'last_name', 'email'], '-id')
    //   ->allowedFilters('company_id')
    //   ->allowedSerch('first_name', 'last_name', 'email')
    //   ->paginate(10);

    $contacts = Contact::allowedTrash()
      ->allowedSorts(['first_name', 'last_name', 'email'], '-id')
      ->allowedFilters('company_id')
      ->allowedSerch('first_name', 'last_name', 'email')
      ->forUser(auth()->user())
      ->paginate(10);

    // dump(DB::getQueryLog());

    return view('contacts.index', compact('contacts', 'companies'));
  }

  public function create()
  {
    $contact = new Contact();
    $companies = $this->userCompanies();

    return view('contacts.create', compact('companies', 'contact'));
  }

  public function store(ContactRequest $request)
  {
    $request->user()->contacts()->create($request->input());

    return redirect()->route('contacts.index')->with('message', 'Contact has been added successfully');
  }

  public function show(Contact $contact)
  {
    return view('contacts.show')->with('contact', $contact);
  }

  public function edit(Contact $contact)
  {
    $companies = $this->userCompanies();

    return view('contacts.edit', compact('contact', 'companies'));
  }

  public function update(ContactRequest $request, Contact $contact)
  {
    $contact->update($request->input());

    return redirect()->route('contacts.index')->with('message', 'Contact has been updated successfully');
  }

  public function destroy(Contact $contact)
  {
    $contact->delete();

    $redirect = request()->query('redirect');

    return ($redirect ? redirect()->route($redirect) : back())
      ->with('message', 'Contact has been moved to trash')
      ->with('undoRoute', $this->getUndoRoute('contacts.restore', $contact));
  }

  public function restore(Contact $contact)
  {
    $contact->restore();

    return back()
      ->with('message', 'Contact has been restored from trash.')
      ->with('undoRoute', $this->getUndoRoute('contacts.destroy', $contact));
  }

  protected function getUndoRoute($name, $resource)
  {
    return request()->missing('undo') ? route($name, [$resource->id, 'undo' => true]) : null;
  }

  public function forceDelete(Contact $contact)
  {
    $contact->forceDelete();

    return back()
      ->with('message', 'Contact has been removed permanently');
  }
}

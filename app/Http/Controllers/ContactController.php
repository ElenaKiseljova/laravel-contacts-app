<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Repositories\CompanyRepository;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
  public function __construct(protected CompanyRepository $company)
  {
    $this->company = $company;
  }

  public function index()
  {
    $companies = $this->company->pluck();

    // DB::enableQueryLog();

    $contacts = Contact::allowedTrash()
      ->allowedSorts(['first_name', 'last_name', 'email'], '-id')
      ->allowedFilters('company_id')
      ->allowedSerch('first_name', 'last_name', 'email')
      ->paginate(10);

    // dump(DB::getQueryLog());

    return view('contacts.index', compact('contacts', 'companies'));
  }

  public function create()
  {
    $contact = new Contact();
    $companies = $this->company->pluck();

    return view('contacts.create', compact('companies', 'contact'));
  }

  public function store(ContactRequest $request)
  {
    Contact::create($request->input());

    return redirect()->route('contacts.index')->with('message', 'Contact has been added successfully');
  }

  public function show(Contact $contact)
  {
    return view('contacts.show')->with('contact', $contact);
  }

  public function edit(Contact $contact)
  {
    $companies = $this->company->pluck();

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

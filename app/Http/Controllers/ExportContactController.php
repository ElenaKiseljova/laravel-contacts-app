<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ExportContactController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $columns = ['first_name', 'last_name', 'email', 'phone', 'address', 'company'];

    return view('contacts.export', compact('columns'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ExportContactRequest $request)
  {
    $columns = $request->columns;

    $contacts = Contact::forUser($request->user())
      ->with('company')
      ->latest()
      ->get();

    return response()->streamDownload(function () use ($contacts, $columns) {
      $resource = fopen('php://output', 'w');

      fputcsv($resource, $columns);

      $contacts->each(function ($row) use ($columns, $resource) {
        $rowData = [];

        foreach ($columns as $column) {
          if ($column === 'company') {
            $rowData[] = $row->company->name;
          } else {

            $rowData[] = $row->{$column};
          }
        }

        fputcsv($resource, $rowData);
      });

      fclose($resource);
    }, 'contacts' . time() . '.csv', [
      'Content-Type' => 'text/csv'
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}

@extends('layouts.main')

@section('title', 'Contact App | All companies')

@section('content')
  <main class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-title">
              <div class="d-flex align-items-center">
                <h2 class="mb-0">
                  All Companies
                  @if (request()->query('trash'))
                    <small>( In Trash )</small>
                  @endif
                </h2>
                <div class="ml-auto">
                  <a href="{{ route('companies.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add
                    New</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              @include('shared.filter')

              @include('shared.flash')

              <table class="table-striped table-hover table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                      {!! sortable('Name') !!}
                    </th>
                    <th scope="col">
                      <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'first_name']) }}">
                        {!! sortable('Website') !!}
                      </a>
                    </th>
                    <th scope="col">
                      <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'first_name']) }}">
                        {!! sortable('Email') !!}
                      </a>
                    </th>
                    <th scope="col">Contacts</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $showTrashButtons = request()->query('trash') ? true : false;
                  @endphp
                  @forelse ($companies as $index => $company)
                    @include('companies._company', ['contact' => $company, 'index' => $index])
                  @empty
                    @include('shared.empty', [
                        'numCol' => 6,
                        'message' => 'No companies found',
                    ])
                  @endforelse
                </tbody>
              </table>

              {{ $companies->withQueryString()->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

<div class="col-md-3">
  <div class="card">
    <div class="card-header">
      Settings
    </div>
    <div class="list-group list-group-flush">
      <a href="{{ route('user-profile-information.edit') }}"
        class="list-group-item list-group-item-action @if (request()->routeIs('user-profile-information.edit')) active @endif">Profile</span></a>
      <a href="{{ route('user-password.edit') }}"
        class="list-group-item list-group-item-action @if (request()->routeIs('user-password.edit')) active @endif">Password</span></a>
      <a href="{{ route('contacts.import.create') }}" class="list-group-item list-group-item-action">Import
        Contacts</span></a>
      <a href="{{ route('contacts.export.create') }}" class="list-group-item list-group-item-action">Export
        Contacts</span></a>
    </div>
  </div>
</div><!-- /.col-md-3 -->

<tr>
  <th scope="row">{{ $contacts->firstItem() + $index }}</th>
  <td>{{ $contact->first_name }}</td>
  <td>{{ $contact->last_name }}</td>
  <td>a{{ $contact->email }}</td>
  <td>{{ $contact->company->name }}</td>
  <td width="150">
    @if ($showTrashButtons)
      <form class="d-inline" action="{{ route('contacts.restore', $contact->id) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-circle btn-outline-info" title="Restore"><i
            class="fa fa-undo"></i></button>
      </form>
      <form class="d-inline" action="{{ route('contacts.force-delete', $contact->id) }}" method="POST"
        onsubmit="return confirm('Your data will be remowed permanently. Are you sure?')">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete permanently"><i
            class="fa fa-times"></i></button>
      </form>
    @else
      <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-circle btn-outline-info"
        title="Show"><i class="fa fa-eye"></i></a>
      <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-circle btn-outline-secondary"
        title="Edit"><i class="fa fa-edit"></i></a>
      <form class="d-inline" action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete"><i
            class="fa fa-trash"></i></button>
      </form>
    @endif
  </td>
</tr>

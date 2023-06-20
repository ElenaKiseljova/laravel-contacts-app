<form class="d-inline" action="{{ $action }}" method="POST"
  onsubmit="return confirm('Your data will be remowed permanently. Are you sure?')">
  @csrf
  @method('delete')
  <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete permanently"><i
      class="fa fa-times"></i></button>
</form>

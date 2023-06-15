<select class="custom-select" name="company_id" id="company-select" onchange="this.form.submit()">
  <option value="" selected>All Companies</option>

  @foreach ($companies as $id => $name)
    {{-- <option value="{{ $id }}" @if ($id == request('company_id')) selected @endif>{{ $name }}</option> --}}
    <option value="{{ $id }}" @if ($id == request()->query('company_id')) selected @endif>{{ $name }}</option>
  @endforeach
</select>

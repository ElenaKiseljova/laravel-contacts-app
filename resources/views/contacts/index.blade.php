<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Contacts App</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body>
  <h1>All Contacts</h1>
  <div>
    <a href='{{ route('contacts.create') }}'>Add Contact</a>

    @foreach ($contacts as $id => $contact)
      <p>
        {{ $contact['name'] }} | {{ $contact['phone'] }} | <a href='{{ route('contacts.show', $id) }}'>Show</a>
      </p>
    @endforeach
  </div>
</body>

</html>

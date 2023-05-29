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
  <h1>Contact details</h1>
  <div class="">
    <p>Name: {{ $contact['name'] }}</p>
    <p>Phone: {{ $contact['phone'] }}</p>
  </div>
  <div>
    <a href='{{ route('contacts.index') }}'>Back to all contacts</a>
  </div>
</body>

</html>

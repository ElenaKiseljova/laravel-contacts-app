<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>@yield('title', 'Contact App')</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
  <!-- Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>
  @include('layouts._navbar')

  @yield('content')

  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md">
          <strong>Contact App</strong>
          <small class="d-block mb-3">© 2021-2022</small>
        </div>
        <div class="col-6 col-md">
          <h5>Features</h5>
          <ul class="list-unstyled text-small">
            <li><a href="#">Email Marketing</a></li>
            <li><a href="#">Email Template</a></li>
            <li><a href="#">Email Broadcast</a></li>
            <li><a href="#">Autoresponder Email</a></li>
            <li><a href="#">RSS-to-Email</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Resources</h5>
          <ul class="list-unstyled text-small">
            <li><a href="#">Landing page Guide</a></li>
            <li><a href="#">Inbound Marketing Guide</a></li>
            <li><a href="#">Email Marketing Guide</a></li>
            <li><a href="#">Helpdesk Guide</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>About</h5>
          <ul class="list-unstyled text-small">
            <li><a href="#">Team</a></li>
            <li><a href="#">Locations</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Terms</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>

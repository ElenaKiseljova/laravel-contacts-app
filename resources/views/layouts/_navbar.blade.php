    <nav class="navbar navbar-expand-lg navbar-light @if (request()->is('/')) bg-light @endif">
      <div class="container">
        <a class="navbar-brand text-uppercase" href="/">
          <strong>Contact</strong> App
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggler"
          aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar-toggler">
          <ul class="navbar-nav">
            @auth
              <li class="nav-item @if (request()->routeIs('companies*')) active @endif"><a
                  href="{{ route('companies.index') }}" class="nav-link">Companies</a></li>
              <li class="nav-item @if (request()->routeIs('contacts*')) active @endif"><a href="{{ route('contacts.index') }}"
                  class="nav-link">Contacts</a></li>
            @endauth
          </ul>

          <ul class="navbar-nav ml-auto">
            @guest
              <li class="nav-item mr-2"><a href="{{ route('login') }}" class="btn btn-outline-secondary">Login</a></li>
              <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a></li>
            @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('user-profile-information.edit') }}">Profile</a>

                  <form class="d-inline" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item">Logout</button>
                  </form>
                </div>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

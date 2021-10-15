<header id="header">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="navbar-top">
        <div class="text-center">
          <a class="navbar-brand" href="#">
            <img src="main/assets/images/logo.svg" alt="" class=""/>
          </a>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <ul class="navbar-top-left-menu">
            
          </ul>  
          <ul class="navbar-top-right-menu">
            <li class="nav-item">
              <a href="#" class="nav-link"><i class="mdi mdi-magnify"></i></a>
            </li>
            @guest
              <li class="nav-item">
                <a href="{{route('login')}}" class="nav-link">Login</a>
              </li>
              @if (Route::has('register'))
                <li class="nav-item">
                  <a href="{{route('register')}}" class="nav-link">Register</a>
                </li>
              @endif
            @else
              <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link">Home</a>
              </li>
            @endguest
           
          </ul>
        </div>
      </div>
      <div class="navbar-bottom">
        <div class="d-flex justify-content-between align-items-center">
          <button
              class="navbar-toggler"
              type="button"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
          </button>
          <div>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Sekapur Sirih</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('berita')}}">Berita</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Artikel
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="#">Esai</a></li>
                      <li><a class="dropdown-item" href="#">Nyablak</a></li>
                      <li><a class="dropdown-item" href="#">Inspirasi</a></li>
                      <li><a class="dropdown-item" href="#">Review Buku</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Nyastra
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="#">Puisi</a></li>
                      <li><a class="dropdown-item" href="#">Cerpen</a></li>
                      <li><a class="dropdown-item" href="#">Anekdot</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Seloko</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Lokak</a>
                  </li>
                </ul>
              </div>
          </div>
          
          <ul class="social-media">
            <li>
              <a href="#">
                <i class="mdi mdi-facebook"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="mdi mdi-youtube"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="mdi mdi-twitter"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>

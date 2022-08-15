<header>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="/">
       <img src="/{{$config_provider->logo}}" alt="Logo" width="250px" class="" style="opacity: .8"> <b></b>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
           <li class="nav-item ">
            <a class="nav-link text-black {{Request::is('/') ? 'active' : ''}}" href="/"><h6>Beranda</h6></a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-black {{Request::is('komoditi*') ? 'active' : ''}}" href="/komoditi"><h6>Komoditi</h6></a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-black {{Request::is('laporan*') ? 'active' : ''}}" href="/laporan"><h6>Laporan</h6></a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-black {{Request::is('berita*') ? 'active' : ''}}" href="/berita"><h6>Berita</h6></a>
          </li>


          <li class="nav-item">
            <a class="nav-link text-black {{Request::is('contact*') ? 'active' : ''}}" href="/contact"><h6>Kontak</h6></a>
          </li>
          

         
        </ul>

        @auth
        <a href="/admin/dashboard" class="btn btn-success btn-sm mx-2">
          <i class="fas fa-user"></i> Dashboard
        </a>
       
        @else
          <a href="/admin/auth" class="btn btn-success btn-sm">
            <i class="fas fa-sign-in-alt"></i> Login
          </a>
        @endauth

      </div>
    </div>
  </nav>
</header> 
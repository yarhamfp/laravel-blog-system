<div class="site-mobile-menu site-navbar-target">
  <div class="site-mobile-menu-header">
    <div class="site-mobile-menu-close mt-3">
      <span class="icon-close2 js-menu-toggle"></span>
    </div>
  </div>
  <div class="site-mobile-menu-body"></div>
</div>

<div class="header-top">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-lg-6 d-flex">
        <a href="index.html" class="site-logo">
          {{-- <img src="{{url('frontend/images/kikuk.png')}}" style="width: 100px" alt="logo"> --}}
          Bake<span>blog.</span>
        </a>

        <a href="#" class="ml-auto d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
            class="icon-menu h3"></span></a>
      </div>
      <div class="col-12 col-lg-6 ml-auto d-flex">
        <div class="top-social ml-md-auto d-none d-lg-inline-block">
          <a href="#" class="d-inline-block p-3"><span class="icon-phone"></span></a>
          <a href="#" class="d-inline-block p-3"><span class="icon-envelope"></span></a>
          <a href="#" class="d-inline-block p-3"><span class="icon-facebook"></span></a>
          <a href="#" class="d-inline-block p-3"><span class="icon-instagram"></span></a>
        </div>
        <form action="#" class="search-form d-inline-block">
          <div class="d-flex">
            <input type="email" class="form-control" placeholder="Search..." />
            <button type="submit" class="btn btn-secondary">
              <span class="icon-search"></span>
            </button>
          </div>
        </form>
      </div>
      <div class="col-6 d-block d-lg-none text-right"></div>
    </div>
  </div>

  <div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-0 d-lg-block" role="banner">
    <div class="container">
      <div class="d-flex align-items-center">
        <div class="ml-auto">
          <nav class="site-navigation position-relative text-left" role="navigation">
            <ul class="site-menu main-menu js-clone-nav mr-auto d-none pl-0 d-lg-block link">
              <li class="link active">
                <a href="{{route('home')}}" class="nav-link text-left ">Home</a>
              </li>
              <li class="link nav-item dropdown">
                <a class="nav-link dropdown-toggle text-left" href="#" id="navbarDropdown" role="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="link">
                <a href="#" class="nav-link text-left">About</a>
              </li>
              <li class="link">
                <a href="#" class="nav-link text-left">Blog</a>
              </li>
              <li class="link">
                <a href="#" class="nav-link text-left">Contact</a>
              </li>
              <li class="link">
                @guest
                <a href="{{url('login')}}" class="btn blue px-3 nav-link text-left">Login</a>
                @endguest
                @auth
                <form action="{{route('logout')}}" method="POST" class="inline">
                @csrf
                <button type="submit" class="btn blue px-3 nav-link text-left">Logout</button>
                </form>
                @endauth
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
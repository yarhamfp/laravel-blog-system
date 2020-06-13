<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{route('home')}}">{{App\Setting::first()->name}}<span style="color: #6c757d;"><strong>{{App\Setting::first()->subname}}</strong></span> </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link {{Request::route()->getName() == 'home' ? 'active' : ''}}" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('category*') ? 'active' : ''}}" href="{{route('category.show')}}">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#!">Contact</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Blog
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
            <a class="dropdown-item" href="blog-home-1.html">Blog Home 1</a>
            <a class="dropdown-item" href="blog-home-2.html">Blog Home 2</a>
            <a class="dropdown-item" href="blog-post.html">Blog Post</a>
          </div>
        </li>
      </ul>
      <form action="{{route('search')}}" method="GET" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" name="query" value="{{isset($search) ? $search : ''}}" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
      <ul class="navbar-nav ml-4">
        <li class="nav-item">
          @auth
          <form action="{{url('logout')}}" method="POST" class="form-inline">
            @csrf
            <button class="btn btn-secondary" type="submit">
                Logout
            </button>
          </form>
          @endauth
          @guest
          <a href="{{url('login')}}" class="btn btn-secondary my-2 my-sm-0 text-white">Login</a>
          @endguest
        </li>
      </ul>
    </div>
  </div>
</nav>
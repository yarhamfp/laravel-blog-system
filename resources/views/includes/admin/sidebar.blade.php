<nav class="sidenav shadow-right sidenav-light">
  <div class="sidenav-menu">
    @if (Request::is('admin*'))
    <div class="nav accordion" id="accordionSidenav">
        <div class="sidenav-menu-heading">Interface</div>
        <a class="nav-link" href="{{route('home')}}">
            <div class="nav-link-icon">
                <i class="fa fa-globe"></i>
            </div>
            Visit Web
        </a>
        <div class="sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <div class="nav-link-icon">
                    <i data-feather="activity"></i>
                </div>
                Dashboards
            </a>
            <a class="nav-link" href="{{route('admin.post.create')}}">
                <div class="nav-link-icon">
                    <i data-feather="folder-plus"></i>
                </div>
                Create Post
            </a>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                <div class="nav-link-icon">
                    <i class="fa fa-folder-open"></i>
                </div>
                Blogs
                <div class="sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                    </div>
            </a>
            <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link" href="{{route('admin.post.index')}}">Posts  <span class="badge badge-primary ml-2">New!</span></a>
                    <a class="nav-link" href="{{route('admin.comment.index')}}">Comment</a>
                    <a class="nav-link" href="#">Favorit</a>
                </nav>
            </div>
            <a class="nav-link" href="{{route('admin.post.pending')}}">
                <div class="nav-link-icon">
                    <i data-feather="clock"></i>
                </div>
                Posts Pending
            </a>
            <a class="nav-link" href="{{route('admin.tag.index')}}">
                <div class="nav-link-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                Tags
            </a>
            <a class="nav-link" href="{{route('admin.category.index')}}">
                <div class="nav-link-icon">
                    <i data-feather="grid"></i>
                </div>
                Categories
            </a>    
            <a class="nav-link" href="{{route('admin.subcriber.index')}}">
                <div class="nav-link-icon">
                    <i data-feather="youtube"></i>
                </div>
                Subcribers
            </a> 
        <div class="sidenav-menu-heading">Addons</div>
            <a class="nav-link" href="{{route('admin.user.index')}}">
                <div class="nav-link-icon">
                    <i class="fa fa-users"></i>
                </div>
                Users
            </a>
            <a class="nav-link" href="#!">
                <div class="nav-link-icon">
                    <i class="fa fa-wrench"></i>
                </div>
                Settings
            </a>
    </div>
    @endif
    {{-- end sidebar admin --}}
    {{-- sidebar author --}}
    @if (Request::is('author*'))
    <div class="nav accordion" id="accordionSidenav">
        <div class="sidenav-menu-heading">Interface</div>
        <a class="nav-link" href="{{route('home')}}">
            <div class="nav-link-icon">
                <i class="fa fa-globe"></i>
            </div>
            Visit Web
        </a>
        <div class="sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{route('author.dashboard')}}">
                <div class="nav-link-icon">
                    <i data-feather="activity"></i>
                </div>
                Dashboards
            </a>
            <a class="nav-link" href="{{route('author.post.create')}}">
                <div class="nav-link-icon">
                    <i data-feather="folder-plus"></i>
                </div>
                Create Post
            </a>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                <div class="nav-link-icon">
                    <i class="fa fa-folder-open"></i>
                </div>
                Blogs
                <div class="sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                    </div>
            </a>
            <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <a class="nav-link" href="{{route('author.post.index')}}">Posts  <span class="badge badge-primary ml-2">New!</span></a>
                    <a class="nav-link" href="{{route('author.comment.index')}}">Comment</a>
                    <a class="nav-link" href="#">Favorit</a>
                </nav>
            </div>
            <a class="nav-link" href="{{route('author.post.pending')}}">
                <div class="nav-link-icon">
                    <i data-feather="clock"></i>
                </div>
                Posts Pending
            </a> 
            <a class="nav-link" href="{{route('author.category.index')}}">
                <div class="nav-link-icon">
                    <i class="fas fa-bell"></i>
                </div>
                Categories
            </a>     
            
    </div>
    @endif
  </div>
  <div class="sidenav-footer">
      <div class="sidenav-footer-content">
          <div class="sidenav-footer-subtitle">Logged in as:</div>
          <div class="sidenav-footer-title">{{Auth::user()->name}}</div>
      </div>
  </div>
</nav>
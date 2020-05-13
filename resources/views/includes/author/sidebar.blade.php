<nav class="sidenav shadow-right sidenav-light">
  <div class="sidenav-menu">
      <div class="nav accordion" id="accordionSidenav">
          <div class="sidenav-menu-heading">Interface</div>
          <a class="nav-link" href="{{route('home')}}">
              <div class="nav-link-icon">
                  <i class="fa fa-globe"></i>
              </div>
              Visit Web
          </a>
          <div class="sidenav-menu-heading">Core</div>
              <a class="nav-link" href="#">
                  <div class="nav-link-icon">
                      <i data-feather="activity"></i>
                  </div>
                  Dashboards
              </a>
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                  <div class="nav-link-icon">
                      <i class="fa fa-folder-open"></i>
                  </div>
                  Data Siswa
                  <div class="sidenav-collapse-arrow">
                      <i class="fas fa-angle-down"></i>
                      </div>
              </a>
              <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
                  <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                      <a class="nav-link" href="#">Pendaftar  <span class="badge badge-primary ml-2">New!</span></a>
                      <a class="nav-link" href="#">Validasi Berkas</a>
                      <a class="nav-link" href="#">Berkas Diterima</a>
                      <a class="nav-link" href="#">Berkas Ditolak</a>
                      <a class="nav-link" href="#">Diterima</a>
                      <a class="nav-link" href="#">Ditolak</a>
                      <a class="nav-link" href="#">Siswa Perjurusan</a>
                  </nav>
              </div>
              <a class="nav-link" href="#">
                  <div class="nav-link-icon">
                      <i class="fas fa-graduation-cap"></i>
                  </div>
                  Jurusan
              </a>
              <a class="nav-link" href="#">
                  <div class="nav-link-icon">
                      <i class="fas fa-bell"></i>
                  </div>
                  Exstrakulikuler
              </a>    
      </div>
  </div>
  <div class="sidenav-footer">
      <div class="sidenav-footer-content">
          <div class="sidenav-footer-subtitle">Logged in as:</div>
          <div class="sidenav-footer-title">{{Auth::user()->name}}</div>
      </div>
  </div>
</nav>
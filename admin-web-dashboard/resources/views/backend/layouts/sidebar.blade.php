<!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="{{ url('admin/dashboard')}}" class="nav-link">Dashboard</a></li>
            <li class="nav-item d-none d-md-block"><a href="{{ url('admin/resources')}}" class="nav-link">Resources</a></li>
            <li class="nav-item d-none d-md-block"><a href="{{ url('admin/incident')}}" class="nav-link">Incident</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
             <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img
                    src="{{ url('public/backend/dist/assets/img/avatar5.png')}}"
                    class="user-image rounded-circle shadow me-2"
                    alt="User Image"
                    width="32"
                    height="32"
                />
                <span class="d-none d-md-inline">Lolo Adan</span>
             </a>

              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="{{ url('public/backend/dist/assets/img/avatar5.png')}}"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    Lolo Adan - Web Dev and Mobile Dev
                    <small>Member since Nov. 2023</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-4 text-center"><a href="#">Followers</a></div>
                    <div class="col-4 text-center"><a href="#">Sales</a></div>
                    <div class="col-4 text-center"><a href="#">Friends</a></div>
                  </div>
                  <!--end::Row-->
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                  <a href="{{ url('login')}}" class="btn btn-default btn-flat float-end">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->

      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ url('public/backend/dist/assets/img/AdminLTELogo.png')}}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">ADMIN</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false"
            >
                <li class="nav-item menu-open mb-4"> {{-- Increased mb-2 to mb-4 for more space --}}
                    <a href="{{ url('admin/dashboard')}}" class="nav-link py-3 {{-- Added py-3 to enlarge --}}
                    @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                            {{-- <i class="nav-arrow bi bi-chevron-right"></i> --}}
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open mb-4"> {{-- Increased mb-2 to mb-4 for more space --}}
                    <a href="{{ url('admin/resources')}}" class="nav-link py-3 {{-- Added py-3 to enlarge --}}
                    @if(Request::segment(2) == 'resources') active @endif">
                        <i class="bi bi-journal-text"></i>
                        <p>
                            Resources
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open mb-4"> {{-- Increased mb-2 to mb-4 for more space --}}
                    <a href="{{ url('admin/incident')}}" class="nav-link py-3 {{-- Added py-3 to enlarge --}}
                    @if(Request::segment(2) == 'incident') active @endif">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <p>
                            Incidents
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open mb-4"> {{-- Increased mb-2 to mb-4 for more space --}}
                    <a href="{{ url('logout')}}" class="nav-link py-3 {{-- Added py-3 to enlarge --}}
                    @if(Request::segment(2) == 'incidents') active @endif">
                        <i class="bi bi-box-arrow-right"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
     </div>

        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->

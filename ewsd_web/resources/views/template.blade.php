<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Solution_X EWSD</title>

  <!-- <link href="{{ asset('css/app.css')}}" rel="stylesheet"> -->
  <link href="{{ asset('css/sb-admin-2.css')}}" rel="stylesheet">
  <link href="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css')}}" rel="stylesheet">

  @yield('style')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
          <i class="fas fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Collage</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->

      @if(Auth::user()->role_id==1)

       <li class="nav-item active">
          <a class="nav-link" href="{{route('admin.home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li> 

        <li class="nav-item active">
          <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
        </li> 

        <li class="nav-item active">
          <a class="nav-link" href="{{route('user_roles.index')}}">
           <i class="fas fa-user-secret"></i>
            <span>User Roles</span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="{{route('faculty.index')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Faculty</span></a>
        </li>
    
        <li class="nav-item active">
          <a class="nav-link" href="{{route('academic-years.index')}}">
            <i class="fa fa-graduation-cap"></i>
            <span>Academic Years</span></a>
        </li>
      @endif

      @if(Auth::user()->role_id==4)
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('student.dashboard') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('student.faculty') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Faculties</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('student.magazine-issues') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Magazine Issues</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('contribution.student.all') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Contributions</span>
          </a>
        </li>
      @endif

           @if(Auth::user()->role_id==3)
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('coordinator.dashboard') }}">
                  <i class="fas fa-fw fa-users"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('coordinator.faculty.index') }}">
                  <i class="fas fa-fw fa-users"></i>
                  <span>Faculties</span>
                </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('coordinator.magazine-issues.index') }}">
                  <i class="fas fa-fw fa-users"></i>
                  <span>Magazine Issues</span>
                </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('coordinator.contributions.index') }}">
                  <i class="fas fa-fw fa-users"></i>
                  <span>Contributions</span>
                </a>
            </li>
            @endif

            @if(Gate::allows('isMarketingManager'))
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('manager.dashboard') }}">
                  <i class="fas fa-fw fa-users"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('manager.faculty.index') }}">
                  <i class="fas fa-fw fa-users"></i>
                  <span>Faculties</span>
                </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('manager.magazine-issues.index') }}">
                  <i class="fas fa-fw fa-users"></i>
                  <span>Magazine Issues</span>
                </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('manager.contributions.index') }}">
                  <i class="fas fa-fw fa-users"></i>
                  <span>Contributions</span>
                </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('manager.selected-contributions.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Selected Contributions</span>
              </a>
          </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('manager.report.contribute') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Reports</span>
              </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('manager.report.exception') }}">
              <i class="fas fa-fw fa-users"></i>
              <span>Reports without comments</span>
            </a>
        </li>
           @endif
        @if (Gate::allows('isGuest'))
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('guest.magazine-issues.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Magazine Issues</span>
          </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('guest.selected-contributions.index') }}">
          <i class="fas fa-fw fa-users"></i>
          <span>Selected Contributions</span>
        </a>
    </li> 
        @endif
 
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

        

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
        
                <img class="img rounded-circle" src="{{ Auth::user()->getImageURL() }}" width="40px" height="40px">

              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                {{-- <a class="dropdown-item" href="{{ route('users.show',Auth::user()->id)}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a> --}}
                {{-- <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


        @yield('content')
         <!--  Page Content -->
        


        </div>



  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
        </div>
      </div>
    </div>
  </div>

   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

  <script src="{{ asset('js/app.js')}}"></script>
  <script src="{{ asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>
  <script src="{{ asset('js/table-resize-collapse.js')}}"></script>
  @yield('script')


  
</body>

</html>


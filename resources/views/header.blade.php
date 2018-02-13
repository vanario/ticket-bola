<header class="main-header">
  <!-- Logo -->
  <a href="../../index2.html" class="logo">
    <!-- logo for regular state and mobile devices -->
    <!-- <span class="logo-lg">WNB</span> -->
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              {{-- <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image"> --}}
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{-- {{ Auth::user()->name }} --}}
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
                        
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
      </ul>
    </div>
  </nav>
</header>

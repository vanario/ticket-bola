<header class="main-header" >
  <!-- Logo -->
  <a {{-- href="../../index2.html" --}} class="logo">
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg" style="font-family: Roboto|bi; font-style: italic; font-size: 28px;" >Tix PAD</span>
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
          <!-- User Account Menu -->
        <a href="{{ route('logout') }}" style="background-color: transparent; border: 0px; margin-right: 20px;" class="btn btn-default" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ url('auth/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}</form>
                    <!-- Control Sidebar Toggle Button -->
    </div>
  </nav>
</header>

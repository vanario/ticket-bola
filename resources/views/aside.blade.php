<aside class="main-sidebar" id="main-menu">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <div class="user-panel">
            <div class="image text-center">
                {{-- <img src="{{ asset('img/logo.png') }}" class="img-circle" alt="User Image"> --}}
            </div>
            {{-- <input type="hidden" value="{{ Auth::user()->type->division->name }}" id="division-name"> --}}

        </div>

      <!-- search form (Optional) -->
     {{--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> --}}
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">

            <li><a href="{{ url('auth/home') }}"><i class="fa fa-tv" style="color:white"></i>Dashboard</a></li>  
            <li><a href=""><i class="fa fa-shopping-cart" style="color:white"></i>Pemesanan Tiket </a></li>  
            <li><a href=""><i class="glyphicon glyphicon-check" style="color:white; margin-right:9px"></i>Confirm Pemesanan Tiket </a></li>  
            <li><a href=""><i class="fa fa-file-text-o" style="color:white"></i>Laporan Penjualan Tiket </a></li>  
            <li><a href=""><i class="glyphicon glyphicon-qrcode" style="color:white; margin-right:9px"></i>Validation Barcode Tiket </a></li>
              
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database" style="color:white"></i> <span>Data Master</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">                 
                    <li><a href="{{ url('stadion/') }}"><i class="fa fa-circle-o"></i>Stadion</a></li>
                    <li><a href="{{ url('tribun/index') }}"><i class="fa fa-circle-o"></i>Tribun </a></li>  
                    <li><a href="{{ url('club/') }}"><i class="fa fa-circle-o"></i>Club </a></li>  
                    <li><a href="{{ url('jadwal/') }}"><i class="fa fa-circle-o"></i>Jadwal </a></li>  
                    <li><a href="{{ url('mitra/') }}"><i class="fa fa-circle-o"></i>Mitra </a></li>  
                </ul>
            </li>

            <li><a href="{{ url('register/index') }}"><i class="fa fa-address-card-o" style="color:white"></i>Register </a></li>
            <li><a href="{{-- {{ url('register/index') }} --}}"><i class="fa fa-newspaper-o" style="color:white"></i>News</a></li>
            <li><a href="{{-- {{ url('register/index') }} --}}"><i class="fa fa-shopping-bag" style="color:white"></i>Mercendais</a></li>
        </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

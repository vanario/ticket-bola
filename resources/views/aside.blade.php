<aside class="main-sidebar" id="main-menu">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <div class="user-panel">
            <div class="image text-center">
                {{-- <img src="{{ asset('img/logo.png') }}" class="img-circle" alt="User Image"> --}}
            </div>
            {{-- <input type="hidden" value="{{ Auth::user()->type->division->name }}" id="division-name"> --}}

            <h4 class="text-center font-green">Tiket Bola</h4>
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

        <li class="header"></li>

            <li><a href="{{-- {{ url('wali-nilai/print') }} --}}"><i class="fa fa-circle-o"></i>Pemesanan Tiket </a></li>  
            <li><a href="{{-- {{ url('wali-nilai/print') }} --}}"><i class="fa fa-circle-o"></i>Confirm Pemesanan Tiket </a></li>  
            <li><a href="{{-- {{ url('wali-nilai/print') }} --}}"><i class="fa fa-circle-o"></i>Laporan Penjualan Tiket </a></li>  
            <li><a href="{{-- {{ url('wali-nilai/print') }} --}}"><i class="fa fa-circle-o"></i>Print Tiket </a></li>  
            <li><a href="{{-- {{ url('wali-nilai/print') }} --}}"><i class="fa fa-circle-o"></i>Validation Barcode Tiket </a></li>
              
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span>Data Master</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">                 
                    <li><a href="{{ url('stadion/') }}"><i class="fa fa-circle-o"></i>Stadion</a></li>
                    <li><a href="{{ url('tribun/index') }}"><i class="fa fa-circle-o"></i>Tribun </a></li>  
                    <li><a href="{{ url('club/') }}"><i class="fa fa-circle-o"></i>Club </a></li>  
                    <li><a href="{{ url('jadwal/') }}"><i class="fa fa-circle-o"></i>Jadwal </a></li>  
                    <li><a href="{{-- {{ url('wali-nilai/print') }} --}}"><i class="fa fa-circle-o"></i>Member </a></li>  
                </ul>
            </li>
        </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

<aside class="main-sidebar" id="main-menu">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">

            <li><a href="{{ url('home/') }}"><i class="fa fa-tv" style="color:white"></i>Dashboard</a></li>  
            <li><a href=""><i class="fa fa-file-text-o" style="color:white"></i>Laporan Penjualan Tiket </a></li>  
            {{-- <li><a href=""><i class="fa fa-shopping-cart" style="color:white"></i>Pemesanan Tiket </a></li>  
            <li><a href=""><i class="glyphicon glyphicon-check" style="color:white; margin-right:9px"></i>Confirm Pemesanan Tiket </a></li>  
            <li><a href=""><i class="glyphicon glyphicon-qrcode" style="color:white; margin-right:9px"></i>Validation Barcode Tiket </a></li> --}}
              
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

            <li><a href="{{ url('pertandingan') }}"><i class="fa fa-file-text-o" style="color:white"></i>Entry Pertandingan</a></li>

            <li><a href="{{ url('biaya') }}"><i class="fa fa-file-text-o" style="color:white"></i>Entry Biaya</a></li>

            <li><a href="{{ url('master-biaya') }}"><i class="fa fa-file-text-o" style="color:white"></i>Master Biaya</a></li>

            <li><a href="{{ url('register/index') }}"><i class="fa fa-address-card-o" style="color:white"></i>Member</a></li>

            <li><a href="{{ url('news/') }}"><i class="fa fa-newspaper-o" style="color:white"></i>News</a></li>

            <li><a href="{{ url('merchandise') }}"><i class="fa fa-shopping-bag" style="color:white"></i>Mercendais</a></li>


            <li><a href="{{ url('report') }}"><i class="fa fa-newspaper-o" style="color:white"></i>Report</a></li>

            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-user" style="color:white"></i> <span>Management User</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">                 
                    <li><a href="{{ url('previledge/index') }}"><i class="fa fa-circle-o"></i>Hak Akses user</a></li>
                    <li><a href="{{ url('member/index') }}"><i class="fa fa-circle-o" style="color:white; margin-right: 10px;"></i>Register</a></li>
                </ul>
            </li>

        </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

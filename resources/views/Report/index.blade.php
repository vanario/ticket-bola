@extends('template')

@section('title', 'List Report')
@section('content')

<div class="content-list">
    <div class="row">        
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h4><a href="{{ url('report/club') }}">Tiket Per Club</a></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>150</h3>

                     <p>Total Membership</p>
                </div>
                <div class="icon">
                     <i class="ion ion-person"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>40 Ribu</h3>

                    <p>Penjualan Tiket Membership</p>
                 </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                     <h3>30 Ribu</h3>

                     <p style="font-size: 14px">Penjualan Tiket Non Membership</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweet::alert')
@endsection



@extends('template')

@section('title', 'List Club')
@section('content')
    <!-- Main content -->
    <section class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i>{{ $club['name'] }}
                    <small class="pull-right"></small>
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Total Tiket : {{ $sumCurrent["tot_tiket"] }}</b><br>
                <b>Total Nominal : {{ $sumCurrent["tot_nominal"] }}</b>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Jadwal</th>
                            <th>Tanggal</th>
                            <th>Total Nominal</th>
                            <th>Total Tiket</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($listCurrent > 0)
                        @foreach($listCurrent as $key => $value)
                            <tr>
                                <td>{{ $value['jadwal'] }}</td>
                                <td>{{ $value['tanggal'] }}</td>
                                <td>{{ $value['tot_nominal'] }}</td>
                                <td>{{ $value['tot_tiket'] }}</td>
                            </tr>
                        @endforeach
                    @else
                        <div class="alert alert-warning alert-dismissible">
                            <h5><i class="icon fa fa-warning"></i> Data tidak tersedia</h5>
                        </div>                      
                    @endif
                    </tbody>
                </table>
            </div>            
        </div>
@include('sweet::alert')
@endsection



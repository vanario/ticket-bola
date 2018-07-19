@extends('template')

@section('title', 'List Biaya')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <div class="col-md-1">
                    <i class="fa fa-link" style="color:black; margin-top:8px; font-size:24px;"></i>
                </div>
                <div class="col-md-5">
                    <h4 style="font-size:24px;">Transaksi</h4>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a data-toggle="modal" data-target="#add"  class="btn btn-success"style="margin-bottom:30px;">Tambah</a>
                </div>
            </div>
            <div class="box-list">
                <div class="row" style="margin-top: 20px;">
                    <form method="POST" action="{{ url('biaya/') }}" enctype="multipart/form-data">
                       {{ csrf_field() }}
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select  name="schedule_code" class="form-control" required>
                                    <option value=""> Filter Berdasarkan Jadwal</option>
                                    @foreach($list_jadwal as $val)
                                    <option value="{{$val['gtcode']}}">{{$val['namehome']}} VS {{$val['nameaway']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <input type="submit" value="Filter" class="btn btn-success" >
                        </div>
                    </form>
                </div>
                <table class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data != null)
                        @foreach($data as $val)
                        <tr>
                            <td>{{ $val['transaction_date'] or "-"}}</td>
                            <td>
                                <a data-toggle="modal" data-target="#show"><span class="fa fa-eye" style="color:green"></span></a>
                                <a href="{{action('Biaya\BiayaController@destroy',[$val['gttop'],$val['gtcode']])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="7">Tidak ada data ditemukan !!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <ul class="pagination">
                    <li><a href="{{action('Biaya\BiayaController@page', 1 )}}" rel="prev">&laquo;</a></li>
                    @for ($i = 1; $i <= $total_page; $i++)
                        @if( $i+1 <= 15)
                        <li><a href="{{action('DataMaster\MitraController@page', $i )}}" id="paging">{{$i}}</a></li>
                        @endif
                    @endfor
                    <li><a href="{{action('DataMaster\MitraController@page', $total_page )}}" rel="next">&raquo;</a></li>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-lg">
                    <form method="POST" action="{{ route('biaya.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Biaya</h4>
                        </div>
                        <div class="modal-body">
                            <div class=form-group>
                              <label for="">Tanggal Transaksi</label>
                              <input type="text" name="date" id="date"  class="form-control input-sm" required />
                            </div>
                            <div class=form-group>
                              <label for="">Pertandingan</label>
                              <select name="gttop" class="form-control input-sm" required>
                                  <option value="">Pertandingan</option>
                                  @foreach($list_jadwal as $value)
                                  <option value="{{$value['gtcode']}}">{{$value['namehome']}} VS {{$value['nameaway']}}</option>
                                  @endforeach
                              </select>
                            </div>
                            <div class="panel-group" id="accordion">
                              <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Transaksi</a>
                                    </h4>
                                  </div>
                                  <div id="collapse1" class="panel-collapse collapse">
                                  <?php $no = 0;?>
                                  @if($listdatabiaya != null)
                                  @foreach($listdatabiaya as $val)
                                  <?php $no++ ;?>
                                    <table  id="wrapper{{$no}}" class="table table-striped">
                                      <tr>
                                        <th>
                                          <label for="">Nama Transaksi</label>
                                          <input type="text" name="akunname[]" id="akunname[]" value="{{$val['akunname']}}" class="form-control input-sm" required>
                                        </th>
                                        <th>
                                          <div class="form-group">
                                          <label for="">Tipe Transaksi</label>
                                          <input type="text" name="akuntype[]" id="akuntype[]" value="{{$val['akuntype']}}" class="form-control input-sm" required>
                                          </div>
                                        </th>
                                        <th>
                                          <div class="form-group">
                                          <label for="">Nominal</label>

                                          <input type="text" name="nominal[]" id="nominal[]"  class="form-control input-sm" required>
                                          </div>
                                        </th>
                                        <th>
                                          <a href="javascript:void(0);" class="btn btn-red" style="margin-top: 23px;" title="Hapus field">Hapus</a>
                                        </th>
                                      </tr>
                                    </table>
                                    <script type="text/javascript">
                                      $(document).ready(function(){
                                          $("#wrapper{{$no}}").on('click', '.btn-red', function(e){ //Once remove button is clicked
                                              e.preventDefault();
                                              $("#wrapper{{$no}}").remove(); //Remove field html
                                          });
                                      });
                                    </script>
                                  @endforeach
                                  @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div>
                                 <input type="submit" value="Simpan" class="btn btn-success" >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if($data != null)
        @foreach($data as $val)
        <div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tanggal Transaksi</label>
                            <input type="text" name="date" id="date"  value="{{ $val['transaction_date'] or "-" }}" class="form-control input-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Pertandingan</label>
                            <select name="gttop" class="form-control input-sm" required>
                                <option value="">Pertandingan</option>
                                @foreach($list_jadwal as $value)
                                <option value="{{$value['gtcode']}}"{{old( '',$value['gtcode'])==$val[ 'gttop']? 'selected': ''}}>{{$value['namehome']}} VS {{$value['nameaway']}}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach($val['biaya'] as $value)
                        <div class="form-group">
                            <table>
                                <tr>
                                    <td  style="padding-left:0px;">
                                        <label for="">Nama Transaksi</label>
                                        <input type="text" value="{{ $value['akunname'] }}" class="form-control input-sm" required>
                                        <label for="">Tipe Transaksi</label>
                                        <input type="text" value="{{ $value['akuntype'] }}" class="form-control input-sm" required>
                                        <label for="">Nominal</label>
                                        <input type="text" value="{{ $value['nominal'] }}" class="form-control input-sm" required>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif

@include('sweet::alert')
@endsection

@section('script')
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>

<script type="text/javascript">

$(function() {

    init_datepicker();

function init_datepicker() {
        $('#date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };
});

</script>
@endsection

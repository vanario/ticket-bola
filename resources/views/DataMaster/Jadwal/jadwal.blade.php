@extends('template')

@section('title', 'List Jadwal')

@section('content')
<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <div class="col-md-1">
                    <i class="fa fa-link" style="color:black; margin-top:8px;font-size:24px;"></i>
                </div>
                <div class="col-md-5">
                    <h4 style="font-size:24px;">Jadwal</h4>
                </div>
                <div class="col-md-6" style="margin-top:-15px; text-align: right;">
                    <a data-toggle="modal" data-target="#add" class="btn btn-green" style="margin-bottom:30px;">Tambah</a>
                </div>

            </div>
            <table class="table table-striped " style="width: 100%; ">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Pukul</th>
                        <th>Event</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($data as $val)
                    <tr>
                        <td>{{ $val['namehome']." vs " .$val['nameaway'] }}</td>
                        <td>{{ $val['date'] or "- "}}</td>
                        <td>{{ $val['jam'] or "- "}}</td>
                        <td>{{ $val['event'] or "- "}}</td>
                        <td>
                            <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil" style="color: green"></span></a>
                            <a href="{{action( 'DataMaster\JadwalController@destroy',[$val['gttop'],$val[ 'gtcode']])}} " id="hapus " ><i class="fa fa-trash "></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $data->appends(Input::except('page'))->render() !!}
        </div>
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('jadwal.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Jadwal</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group">
                                  @foreach($data as $val)
                                    @if ($val['gttop'] == null)
                                      <div class="col-md-6">
                                        <label for="">Jadwal</label>
                                        <select name="gttopstadion" class="form-control input-sm" required>
                                          <option value="">Club</option>
                                            @foreach($list_club as $gtcode => $name)
                                            <option value="{{$gtcode}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                    @else
                                        <input type="hidden" name="gttopstadion" value={{$val["gttop"]}} class="form-control input-sm" required>
                                    @endif
                                  @endforeach
                                    <div class="col-md-6">
                                      <label for="">Nama Home</label>
                                        <input type="text" name="namehome" id="namehome" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Nama Away</label>
                                        <input type="text" name="nameaway" id="nameaway" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Tanggal</label>
                                        <input type="text" name="date" id="date" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Jam</label>
                                        <input type="text" name="jam" id="jam" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Kota</label>
                                        <input type="text" name="kota" id="kota" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Stadion</label>
                                        <input type="text" name="stadion" id="stadion" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Event</label>
                                        <select name="event" class="form-control" id="event" required>
                                            <option value="">Pilih Event</option>
                                            <option value="internal">Internal</option>
                                            <option value="eksternal">Eksternal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 20px;">
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
                                      @if($listDataTribun != null)
                                      @foreach($listDataTribun as $val)
                                      <?php $no++ ;?>
                                        <table  id="wrapper{{$no}}" class="table table-striped">
                                          <tr>
                                            <th>
                                              <input type="hidden" name="gttop[]" id="gttop[]" value="{{$val['gttop']}}" class="form-control input-sm" required>
                                            </th>
                                            <th>
                                              <div class="form-group">
                                              <input type="hidden" name="gtcode[]" id="gtcode[]" value="{{$val['gtcode']}}" class="form-control input-sm" required>
                                              </div>
                                            </th>
                                            <th>
                                              <div class="form-group">
                                              <label for="">Harga</label>
                                              <input type="text" name="harga[]" id="harga[]"  class="form-control input-sm" required>
                                              </div>
                                            </th>
                                            <th>
                                              <div class="form-group">
                                              <label for="">Jumlah</label>
                                              <input type="text" name="jumlah[]" id="jumlah[]"  class="form-control input-sm" required>
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
                        </div>
                        <div class="modal-footer">
                          <div>
                            <input type="submit" value="Simpan" class="btn btn-green">
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($data as $val)
        <div class="modal fade" id="edit{{ $val['gtcode'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('jadwal.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Jadwal</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group">
                                    @foreach($data as $val)
                                      @if ($val['gttop'] == null)
                                        <div class="col-md-6">
                                          <label for="">Jadwal</label>
                                          <select name="gttopstadion" class="form-control input-sm" required>
                                            <option value="">Club</option>
                                            @foreach($list_club as $gtcode => $name)
                                            <option value="{{$gtcode}}"{{old('',$gtcode)==$val['gttop']? 'selected': ''}}>{{$name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      @else
                                          <input type="hidden" name="gttopstadion" value={{$val["gttop"]}} class="form-control input-sm" required>
                                      @endif
                                    @endforeach
                                    <input type="hidden" name="gtcode" id="gtcode" value="{{ $val['gtcode'] }}" class="form-control input-sm" required>
                                    <div class="col-md-6">
                                        <label for="">Nama Home</label>
                                        <input type="text" name="namehome" id="namehome" value="{{ $val['namehome'] }}" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Nama Away</label>
                                        <input type="text" name="nameaway" id="nameaway" value="{{ $val['nameaway'] }}" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Tanggal</label>
                                        <input type="text" name="date" id="date" value="{{ $val['date'] }}" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Jam</label>
                                        <input type="text" name="jam" id="jam" value="{{ $val['jam'] }}" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Kota</label>
                                        <input type="text" name="kota" value="{{ $val['kota'] }}"  id="kota" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Stadion</label>
                                        <input type="text" name="stadion" value="{{ $val['stadion'] }}" id="stadion" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Event</label>
                                        <select name="event" class="form-control" id="event" required>
                                            <option value="">Pilih Event</option>
                                            <option value="internal"{{old('',"internal")==$val['event']? 'selected': ''}}>Internal</option>
                                            <option value="eksternal"{{old('',"eksternal")==$val['event']? 'selected': ''}}>Eksternal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 20px;">
                              <div class="panel-group" id="accordion2">
                                <div class="panel-group" id="accordion2">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#collapse2">Transaksi</a>
                                      </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                      <?php $no = 0;?>
                                      @if($val['tribun'] != null)
                                      @foreach($val['tribun'] as $value)
                                      <?php $no++ ;?>
                                        <table  id="wrapper{{$no}}" class="table table-striped">
                                          <tr>
                                            <th>
                                              <input type="hidden" name="gttop[]" id="gttop[]" value="{{$val['gttop']}}" class="form-control input-sm" required>
                                            </th>
                                            <th>
                                              <div class="form-group">
                                              <input type="hidden" name="gtcode[]" id="gtcode[]" value="{{$val['gtcode']}}" class="form-control input-sm" required>
                                              </div>
                                            </th>
                                            <th>
                                              <div class="form-group">
                                              <label for="">Harga</label>
                                              <input type="text" value="{{ $value['price'] }}" name="harga[]" id="harga[]"  class="form-control input-sm" required>
                                              </div>
                                            </th>
                                            <th>
                                              <div class="form-group">
                                              <label for="">Jumlah</label>
                                              <input type="text" value="{{ $value['quota'] }} "name="jumlah[]" id="jumlah[]"  class="form-control input-sm" required>
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
                        </div>
                        <div class="modal-footer">
                          <div>
                            <input type="submit" value="Simpan" class="btn btn-green">
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
</div>
@include('sweet::alert')
@endsection

@section('script')
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script type="text/javascript">

    $(function() {

        init_datepicker();
        init_timepicker();

        function init_datepicker() {
            $('#date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        };

        function init_timepicker() {
            $('#jam').timepicker({
                format: 'H:i:s',
                autoclose: true
            });
        };
    });
</script>
@endsection

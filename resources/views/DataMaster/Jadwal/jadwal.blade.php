@extends('template')

@section('title', 'List Jadwal')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <a data-toggle="modal" data-target="#add" class="btn btn-green" font-16" style="margin-bottom:20px;">Tambah</a>


                    <table class="table table-striped" style="width: 100%;">

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
                                <td>{{ $val['date'] or "-"}}</td>
                                <td>{{ $val['jam'] or "-"}}</td>
                                <td>{{ $val['event'] or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil" style="color:green"></span></a>
                                    <a href="{{action('DataMaster\JadwalController@destroy',$val['gtcode'])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                    <a data-toggle="modal" data-target="#addtribun{{$val['gtcode']}}" {{-- href="{{action('DataMaster\JadwalController@index',$val['gtcode'])}}" --}} class="fa fa-plus" font-16" style="margin-bottom:20px;"></a>
                                </td>                                

                            </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                    {!! $data->appends(Input::except('page'))->render() !!}
            </div>
        </div>
        @foreach ($data as $value)
            <div id="addtribun{{$value['gtcode']}}" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('jadwal.storetrib')}}" >
                        {{ csrf_field() }}

                            <div class="modal-header">
                                <h4>Tambah Tribun
                                </h4>
                            </div>
                            <div class="modal-body">

                                
                                <table class="table table-striped" style="width: 100%;">
                                   <thead>
                                        <tr>
                                            <th>Jumlah</th>
                                            <th>Tribun</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($value['value'] as $result)
                                            <tr>
                                                <td>{{ $result['qty'] or "-"}}</td>
                                                <td>{{ $result['tribun'] or "-"}}</td>
                                                <td>{{ $result['price'] or "-"}}</td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#edittrib{{$result['gtcodetrib']}}"><span class="fa fa-pencil" style="color:green"></span></a>      
                                                    <a href="{{action('DataMaster\JadwalController@destroytrib',[$value['gtcode'],$result['gtcodetrib']])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $data->appends(Input::except('page'))->render() !!}
                                
                                <input type="hidden" name="gtcode" id="gtcode" value="{{ $value['gtcode'] }}" class="form-control input-sm" required>
                                <div class="form-group">                                
                                    <div class="col-md-6">
                                        <label for="">Kode Tribun</label>
                                        <input type="text" name="gtcodetrib" id="gtcodetrib" class="form-control input-sm" required>
                                    </div>                  
                                    <div class="col-md-6">
                                        <label for="">Tribun</label>
                                        <select name="tribun" class="form-control" id="tribun" required>
                                            <option value="">Pilih Tribun</option>
                                            <option value="vip">VIP</option>
                                            <option value="vip 1">VIP 1</option>
                                            <option value="vip 2">VIP 2</option>
                                            <option value="tribun timur">Tribun Timur</option>
                                            <option value="tribun utara">Tribun Utara</option>
                                            <option value="tribun selatan">Tribun Selatan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Warna</label>
                                        <input type="text" name="color" id="color" class="form-control input-sm" required>
                                    </div>                  
                                </div>
                            <div class="modal-footer">
                                <div class="col-md-12">
                                     <input type="submit" value="Simpan" class="btn btn-green" >
                                </div>
                            </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($data as $val)
            @foreach ($val['value'] as $result)
            <div class="modal fade" id="edittrib{{$result['gtcodetrib']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('jadwal.updatetrib')}}" >
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">
                            <div class="modal-header">
                                <h4>Edit Jadwal
                                </h4>
                            </div>
                            <input type="hidden" name="gtcode" id="gtcode" value="{{ $val['gtcode'] }}" class="form-control input-sm" required>
                            <div class="modal-body">       
                                <div class="form-group">                                
                                    <div class="col-md-6">
                                        <label for="">Kode Tribun</label>
                                        <input type="text"  value="{{ $result['gtcodetrib'] }}" name="gtcodetrib" id="gtcodetrib" class="form-control input-sm" required>
                                    </div> 
                                    <div class="col-md-6">
                                        <label for="">Tribun</label>
                                        <select name="tribun" class="form-control" id="tribun" required>
                                            <option value="">Pilih Tribun</option>
                                            <option value="vip"{{old('',"vip")==$result['tribun']? 'selected': ''}}>VIP</option>
                                            <option value="vip 1"{{old('',"vip 1")==$result['tribun']? 'selected': ''}}>VIP 1</option>
                                            <option value="vip 2"{{old('',"vip 2")==$result['tribun']? 'selected': ''}}>VIP 2</option>
                                            <option value="tribun timur" {{old('',"tribun timur")==$result['tribun']? 'selected': ''}}>Tribun Timur</option>
                                            <option value="tribun utara"{{old('',"tribun utara")==$result['tribun']? 'selected': ''}}>Tribun Utara</option>
                                            <option value="tribun selatan"{{old('',"tribun selatan")==$result['tribun']? 'selected': ''}}>Tribun Selatan</option>
                                        </select>
                                    </div>                   
                                    {{-- <div class="col-md-6">
                                        <label for="">Harga</label>
                                        <input type="text" value="{{ $result['price'] }}" price" id="price" class="form-control input-sm" required>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <label for="">Jumlah</label>
                                        <input type="text" value="{{ $result['qty'] or "-" }}" name="qty" id="qty" class="form-control input-sm" required>
                                    </div>                  
                                </div>                   
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12">
                                     <input type="submit" value="Simpan" class="btn btn-green" >
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div> 
            @endforeach
        @endforeach

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('jadwal.store') }}"  enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Jadwal</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Club</label>
                                    <select  name="gttopstadion" class="form-control" required>
                                        <option value="">Club</option>
                                        @foreach($list_club as $gtcode => $name)
                                        <option value="{{$gtcode}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Kode</label>
                                    <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                                </div>
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
                                    <input type="text" name="event" id="event" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <label for="">Gambar Depan</label>
                                        <input type="file" id="gambardepan" name="gambardepan" class="validate" multiple required>
                                        <div class="input-field col s6">                          
                                            <img src="" id="image-previewdepan" style="max-width:200px;max-height:200px;" />
                                        </div>                                    
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Gambar Tengah</label>
                                        <input type="file" id="gambartengah" name="gambartengah" class="validate" multiple required>
                                        <div class="input-field col s6">                          
                                            <img src="" id="image-previewtengah" style="max-width:200px;max-height:200px;" />
                                        </div>                                    
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Gambar Belakang</label>
                                        <input type="file" id="gambarbelakang" name="gambarbelakang" class="validate" multiple required>
                                        <div class="input-field col s6">                          
                                            <img src="" id="image-previewbelakang" style="max-width:200px;max-height:200px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                 <input type="submit" value="Simpan" class="btn btn-green" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>

        @foreach ($data as $val)
        <div class="modal fade" id="edit{{$val['gtcode']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('jadwal.update')}}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Jadwal
                            </h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Club</label>
                                    <select  name="gttopstadion" class="form-control" required>
                                        <option value="">Club</option>
                                        @foreach($list_club as $gtcode => $name)
                                        <option value="{{$gtcode}}" {{old('',$gtcode)==$val['gttop']? 'selected': ''}}>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Kode</label>
                                    <input type="text" value="{{ $val['gtcode'] or "-"}}" name="gtcode" id="gtcode" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" value="{{ $val['name'] or "-"}}" id="name" class="form-control input-sm" required>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Nama 1</label>
                                    <input type="text" name="name1" value="{{ $val['name1'] or "-"}}" id="name1" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-6">
                                    <label for="">Date</label>
                                    <input type="text" name="date1" value="{{ $val['date'] or "-"}}" id="date1" class="form-control input-sm" required>
                                </div>                                                        
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-6">
                                    <label for="">Jam</label>
                                    <input type="text" name="jam1" value="{{ $val['jam'] or "-"}}" id="jam1" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-6">
                                    <label for="">Kota</label>
                                    <input type="text"  value="{{ $val['desc'] or "-"}}" name="desc" id="desc" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-6">
                                    <label for="">Alamat</label>
                                    <input type="text" value="{{ $val['subdesc'] or "-"}}" name="subdesc" id="subdesc" class="form-control input-sm" required>
                                </div>
                            </div>                               
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                 <input type="submit" value="Simpan" class="btn btn-green" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>  
    </section>
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
        init_datepicker1();
        init_timepicker1();
            
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

        function init_datepicker1() {
            $('#date1').datepicker({
             format: 'yyyy-mm-dd',
             autoclose: true
           });
        };

        function init_timepicker1() {
            $('#jam1').timepicker({
             format: 'H:i:s',
             autoclose: true
           });
        };
   
    });

    function readURLdepan(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();           

            reader.onload = function (e) {
                $('#image-previewdepan').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#gambardepan").change(function(){
        readURLdepan(this);
    });

    function readURLtengah(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();           

            reader.onload = function (e) {
                $('#image-previewtengah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#gambartengah").change(function(){
        readURLtengah(this);
    });

    function readURLbelakang(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();           

            reader.onload = function (e) {
                $('#image-previewbelakang').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#gambarbelakang").change(function(){
        readURLbelakang(this);
    });

</script>

@endsection


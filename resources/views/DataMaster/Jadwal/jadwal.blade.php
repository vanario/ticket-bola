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
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $val)
                            <tr>
                                <td>{{ $val['name']." vs " .$val['name1'] }}</td>
                                <td>{{ $val['date'] or "-"}}</td>
                                <td>{{ $val['jam'] or "-"}}</td>
                                <td>{{ $val['desc'] or "-"}}</td>
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
                        <form method="POST" action="{{ route('jadwal.update')}}" >
                        {{ csrf_field() }}

                        <input name="_method" type="hidden" value="PATCH">
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
                                                    <a data-toggle="modal" data-target="#edit{{$result['gtcodetrib']}}"><span class="fa fa-pencil" style="color:green"></span></a>      
                                                    <a href="{{action('DataMaster\JadwalController@destroy',$result['gtcodetrib'])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $data->appends(Input::except('page'))->render() !!}
                                
                                <div class="form-group">                                
                                    <div class="col-md-6">
                                        <label for="">Kode Tribun</label>
                                        <input type="text" name="gtcodetrib" id="gtcodetrib" class="form-control input-sm" required>
                                    </div>                  
                                    <div class="col-md-6">
                                        <label for="">Deskripsi</label>
                                        <input type="text" name="desc" id="desc" class="form-control input-sm" required>
                                    </div>                  
                                    <div class="col-md-6">
                                        <label for="">Tribun</label>
                                        <input type="text" name="tribun" id="tribun" class="form-control input-sm" required>
                                    </div>                    
                                    <div class="col-md-6">
                                        <label for="">Harga</label>
                                        <input type="text" name="price" id="price" class="form-control input-sm" required>
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
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Kode</label>
                                    <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control input-sm" required>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Nama 1</label>
                                    <input type="text" name="name1" id="name1" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-6">

                                    <label for="">Tanggal</label>
                                    <input type="text" name="date" id="date" class="form-control input-sm" required>
                                </div>                                                        
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-6">
                                    <label for="">Jam</label>
                                    <input type="text" name="jam" id="jam" class="form-control input-sm" required>
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
                                        <option value="{{$gtcode}}">{{$name}}</option>
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
                                    <input type="text" name="date" value="{{ $val['date'] or "-"}}" id="date" class="form-control input-sm" required>
                                </div>                                                        
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-6">
                                    <label for="">Jam</label>
                                    <input type="text" name="jam" value="{{ $val['jam'] or "-"}}" id="jam" class="form-control input-sm" required>
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
            
        function init_datepicker() {
            $('#date').datepicker({
             format: 'yyyy-m-d',
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


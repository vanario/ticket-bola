@extends('template')

@section('title', 'List User')

@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">


                <a data-toggle="modal" data-target="#add" class="btn btn-green " font-16" style="margin-bottom:30px;">Tambah</a>


                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>

                                <th>Email</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $val)
                            <tr>
                                <td>{{ $val['userid'] or "-"}}</td>
                                <td>{{ $val['username'] or "-"}}</td>
                                <td>{{ $val['telp'] or "-"}}</td>
                                <td>{{ $val['jenis_kelamin'] or "-"}}</td>
                                <td>{{ $val['tgl_lahir'] or "-"}}</td>
                                <td>{{ $val['alamat'] or "-"}}</td>
                                <td>{{ $val['status'] or "-"}}</td>
                                <td>
                                    {{-- <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil"></span></a>  --}}     
                                    <a style="margin-top:-0px;" href="{{action('Register\RegisterController@approve',$val['gtcode'])}}" id="hapus" class="btn btn-green" >Aprrove</a>

                                </td>
                            </tr>
                            @endforeach
                                
                        </tbody>
                    </table>

                   {{--  @for ($i = 1; $i <= $total; $i++)
                        <ul class="pagination">
                            <li><a href="{{action('DataMaster\MitraController@page', $i )}}" id="paging">{{$i}}</a></li>
                        </ul> 
                    @endfor --}}

            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah User</h4>
                        </div>
                        <div class="modal-body"> 
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Kode</label>
                                    <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" name="userid" id="userid" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="username" id="username" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Password</label>
                                    <input type="text" name="pass" id="pass" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Telepon</label>
                                    <input type="text" name="telp" id="telp" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Jenis Kelamin</label>
                                    <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Alamat</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">ID Kartu</label>
                                    <input type="text" name="idcard" id="idcard" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Status</label>
                                    <input type="text" name="status" id="status" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Tipe User</label>
                                    <input type="text" name="typeuser" id="typeuser" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Club</label>
                                <select  name="clubcode" class="form-control" required>
                                    <option value="">Club</option>
                                    @foreach($list_club as $gtcode => $name)
                                    <option value="{{$gtcode}}">{{$name}}</option>
                                    @endforeach
                                </select>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('register.update')}}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit User</h4>
                        </div>
                        <div class="modal-body"> 
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Kode</label>
                                    <input type="text" name="gtcode"  value="{{ $val['gtcode'] }}" id="gtcode" class="form-control input-sm" readonly>
                                </div>
                            </div>     
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" name="user_id" value="{{$val['userid']}}" id="user_id" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="user" value="{{$val['username']}}" id="user" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Password</label>
                                    <input type="hidden" name="pass" value="{{$val['pass'] or "-"}}" id="pass" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Telepon</label>
                                    <input type="text" name="telp" value="{{$val['telp']}}" id="telp" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Jenis Kelamin</label>
                                    <input type="text" name="jenis_kelamin" value="{{$val['jenis_kelamin']}}" id="jenis_kelamin" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="text" name="tgl_lahir1" id="tgl_lahir1" value="{{$val['tgl_lahir'] or "-"}}" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Alamat</label>
                                    <input type="text" name="alamat" value="{{$val['alamat']}}" id="alamat" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">ID Kartu</label>
                                    <input type="text" name="idcard" value="{{$val['idcard'] or "-"}}" id="idcard" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Status</label>
                                    <input type="text" name="status" value="{{$val['status'] or "-"}}" id="status" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Tipe User</label>
                                    <input type="text" name="typeuser" value="{{$val['typeuser'] or "-"}}" id="typeuser" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Club</label>
                                <select  name="clubcode" class="form-control" required>
                                    <option value="">Club</option>
                                    @foreach($list_club as $gtcode => $name)
                                    <option value="{{$gtcode}}">{{$name}}</option>
                                    @endforeach
                                </select>
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

<script type="text/javascript">

    $(function() {

        init_datepicker();
        init_datepicker1();
            
        function init_datepicker() {
            $('#tgl_lahir').datepicker({
             format: 'yyyy-m-d',
             autoclose: true
           });
        };

        function init_datepicker1() {
            $('#tgl_lahir1').datepicker({
             format: 'yyyy-m-d',
             autoclose: true
           });
        };
   
    });

</script>

@endsection


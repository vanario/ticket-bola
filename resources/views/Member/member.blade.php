@extends('template')

@section('title', 'List User')

@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                 <div class="col-md-1">
                    <i class="fa fa-link" style="color:black; margin-top:8px;font-size:24px;"></i>
                </div>
                <div class="col-md-5">
                    <h4 style="font-size:24px;">Registrasi</h4>                    
                </div>
                <div class="col-sm-6" style="margin-top:-15px; text-align: right;">
                    <a data-toggle="modal" data-target="#add"  class="btn btn-green" style="margin-bottom:30px;">Tambah</a>
                </div>
            </div>
            <table class="table table-striped" style="width: 100%;">

                    <thead>
                        <tr>

                            <th>Email</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
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
                            <td>
                                <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span style="color:green;" class="fa fa-pencil"></span></a>
                            </td>
                        </tr>
                        @endforeach
                            
                    </tbody>
            </table>
            <ul class="pagination">
                <li><a href="{{action('Member\MemberController@page', 1 )}}" rel="prev">&laquo;</a></li> 
                @for ($i = 1; $i <= $total_page; $i++)
                    @if( $i+1 <= 15)                            
                    <li><a href="{{action('Member\MemberController@page', $i )}}" id="paging">{{$i}}</a></li>
                    @endif
                @endfor
                <li><a href="{{action('Member\MemberController@page', $total_page )}}" rel="next">&raquo;</a></li>
            </ul> 

            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('member.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Member</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Kode</label>
                                    <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="userid" id="userid" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" name="username" id="username" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Password</label>
                                    <input type="text" name="pass" id="pass" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Telepon</label>
                                    <input type="text" name="telp" id="telp" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Alamat</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tanggal lahir</label>
                                    <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">ID Card</label>
                                    <input type="text" name="idcard" id="idcard" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tipe User</label>
                                    <select name="typeuser" class="form-control" id="typeuser" required>
                                        <option value="">Pilih Tipe User</option>
                                        <option value="superadmin">Super Admin</option>
                                        <option value="basic">Basic</option>
                                        <option value="management">Management</option>
                                        <option value="advance">Advance</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <div class="form-group">
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

        @foreach($data as $val)
        <div class="modal fade" id="edit{{$val['gtcode']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('member.update')}}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Member</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Kode</label>
                                    <input type="text" value="{{ $val['gtcode'] }}" name="gtcode" id="gtcode" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nama</label>
                                    <input type="text" value="{{ $val['userid'] }}" name="userid" id="userid" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" value="{{ $val['username'] }}" name="username" id="username" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Telepon</label>
                                    <input type="text" value="{{ $val['telp'] }}" name="telp" id="telp" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Alamat</label>
                                    <input type="text" value="{{ $val['alamat'] }}" name="alamat" id="alamat" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki"{{old('',"Laki-laki")==$val['jenis_kelamin']? 'selected': ''}}>Laki-laki</option>
                                        <option value="Perempuan"{{old('',"Perempuan")==$val['jenis_kelamin']? 'selected': ''}}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tanggal lahir</label>
                                    <input type="text" value="{{ $val['tgl_lahir'] }}" name="tgl_lahir1" id="tgl_lahir1" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">ID Card</label>
                                    <input type="text" name="idcard" id="idcard" value="{{ $val['idcard'] }}" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tipe User</label>
                                    <select name="typeuser" class="form-control" id="typeuser" required>
                                        <option value="">Pilih Tipe User</option>
                                        <option value="superadmin" {{old('',"superadmin")==$val['typeuser']? 'selected': ''}}>Super Admin</option>
                                        <option value="basic"{{old('',"basic")==$val['typeuser']? 'selected': ''}}>Basic</option>
                                        <option value="management"{{old('',"management")==$val['typeuser']? 'selected': ''}}>Management</option>
                                        <option value="advance"{{old('',"advance")==$val['typeuser']? 'selected': ''}}>Advance</option>
                                        <option value="user"{{old('',"users")==$val['typeuser']? 'selected': ''}}>User</option>
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="">Club</label>
                                        <select  name="clubcode" class="form-control" required>
                                            <option value="">Club</option>
                                            @foreach($list_club as $gtcode => $name)
                                            <option value="{{$gtcode}}"{{old('',$gtcode)==$val['clubcode']? 'selected': ''}}>{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  --}}                      
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                <input type="submit"  value="Simpan" class="btn btn-green" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>  
        @endforeach
        </div>
    </section>
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
             format: 'yyyy-mm-dd',
             autoclose: true
           });
        };

        function init_datepicker1() {
            $('#tgl_lahir1').datepicker({
             format: 'yyyy-mm-dd',
             autoclose: true
           });
        };
   
    });

</script>

@endsection


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
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil"></span></a>      
                                    {{-- <a href="{{action('RegisterController@destroy',$val['gtcode'])}}" id="hapus" ><i class="fa fa-trash"></i></a> --}}
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
                                    <label for="">Email</label>
                                    <input type="text" name="user_id" id="user_id" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="user" id="user" class="form-control input-sm" required>
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
                                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control input-sm" required>
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
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Club</label>
                                    <input type="text" name="clubcode" id="clubcode" class="form-control input-sm" required>
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
                                    <label for="">Email</label>
                                    <input type="text" name="user_id" value="{{$val['user_id']}}" id="user_id" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="user" value="{{$val['user']}}" id="user" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Password</label>
                                    <input type="text" name="pass" value="{{$val['pass']}}" id="pass" class="form-control input-sm" required>
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
                                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" value="{{$val['tanggal_lahir']}}" class="form-control input-sm" required>
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
                                    <input type="text" name="idcard" value="{{$val['idcard']}}" id="idcard" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Status</label>
                                    <input type="text" name="status" value="{{$val['status']}}" id="status" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Tipe User</label>
                                    <input type="text" name="typeuser" value="{{$val['typeuser']}}" id="typeuser" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Club</label>
                                    <input type="text" name="clubcode" value="{{$val['clubcode']}}" id="clubcode" class="form-control input-sm" required>
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




@extends('template')

@section('title', 'Register User')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = $data->firstItem();?>
                            @if($data->count())  
                            @foreach($data as $val)  
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $val->name or "-" }}</td>
                                <td>{{ $val->email or "-"}}</td>
                                @if($val->level == 1 )
                                <td>{{'Tata Usaha'}}</td>
                                @endif
                                @if($val->level == 2 )
                                <td>{{'Wali Kelas'}}</td>
                                @endif
                                @if($val->level == 3 )
                                <td>{{'Guru'}}</td>
                                @endif
                                @if($val->level == 4 )
                                <td>{{'Siswa'}}</td>
                                @endif
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val->id}}"><span class="fa fa-pencil"></span></a>      
                                    <a href="{{action('RegisterUserController@destroy',$val->id)}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">No Records found !!</td>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                {{$data->render()}}
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">{{ csrf_field() }}
                        
                        <div class="modal-header">
                            <h4>Tambah User</h4>
                        </div>
                        <div class="modal-body">                                       
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="">Nama</label>
                                <input id="name" type="name" placeholder="Name" class="form-control" name="name" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="">Email</label>
                                <input id="email" type="email" placeholder="email" class="form-control" name="email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <select name="level" id="level" class="form-control" data-placeholder="Select a State" required>
                                    <option value="">Pilih Akses User</option>
                                    <option value="1">Tata Usaha</option>
                                    <option value="2">Wali kelas</option>
                                    <option value="3">Guru</option>
                                    <option value="4">Siswa</option>
                                </select>
                            </div>                

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="">Password</label>
                                <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                             <div class="form-group">
                                <input id="password-confirm" placeholder="Confirm-password" type="password" class="form-control" name="password_confirmation" required>
                            </div>               
                        </div>
                        <div class="modal-footer">
                            <div>
                                 <input type="submit" value="Simpan" class="btn btn-subscribe" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>      

        @foreach($data as $val)
        <div class="modal fade" id="edit{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('register.update',$val->id) }}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit User</h4>
                        </div>
                        <div class="modal-body">                                        
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="">Nama</label>
                                <input id="name" type="name" placeholder="Name" class="form-control" name="name" value="{{$val->name}}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="">Email</label>
                                <input id="email" type="email" placeholder="email" class="form-control" name="email" value="{{$val->email}}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <select name="level" id="level" class="form-control" data-placeholder="Select a State" required>
                                    <option value="">Pilih Akses User</option>
                                    <option value="1">Tata Usaha</option>
                                    <option value="2">Wali kelas</option>
                                    <option value="3">Guru</option>
                                    <option value="4">Siswa</option>
                                </select>
                            </div>             
                        </div>
                        <div class="modal-footer">
                            <div>
                                <input type="submit"  value="Simpan" class="btn btn-subscribe" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>  
        @endforeach
    </section>
</div>

@endsection

@section('script')
@include('sweet::alert')
@endsection



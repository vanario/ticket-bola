@extends('template')

@section('title', 'List Tribun')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <div class="row">
                    <div class="col-sm-4">
                        <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <select  name="gttop" class="form-control" required>
                                <option value=""> Filter Berdasarkan Stadion</option>
                                @foreach($list_stadion as $gtcode => $name)
                                <option value="{{$gtcode}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <a href="{{ route('tribun/') }}" class="btn bg-purple " font-16" style="margin-bottom:30px;">Filter</a>
                    </div>
                </div>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>Tribun</th>
                                <th>Kapasitas</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>{{ $data['tribun'] or "-"}}</td>
                                <td>{{ $data['kapasitas'] or "-"}}</td>
                                <td>{{ $data['description'] or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$data['gttop']}}"><span class="fa fa-pencil"></span></a>      
                                    <a href="{{action('DataMaster\TribunController@destroy',$data['gtcode'])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                                
                        </tbody>
                    </table>
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('tribun.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Layout Tribun</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tribun</label>
                                <input type="text" name="tribun" id="tribun" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Stadion</label>
                                <select  name="gttop" class="form-control" required>
                                    <option value="">Stadion</option>
                                    @foreach($list_stadion as $gtcode => $name)
                                    <option value="{{$gtcode}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kapasitas</label>
                                <input type="text" name="kapasitas" id="kapasitas" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="description" id="description" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Layout</label>
                                <input type="text" name="layout[]" id="layout[]" multiple="multiple" class="form-control input-sm" required>
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

        <div class="modal fade" id="edit{{$data['gttop']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('tribun.update')}}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Layout Tribun</h4>
                        </div>
                        <div class="modal-body">         
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" name="gtcode" value="{{$data['gtcode']}}" id="gtcode" class="form-control input-sm" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Stadion</label>
                                <select  name="shift" class="form-control" required>
                                    <option value="">Stadion</option>
                                    @foreach($list_stadion as $gtcode => $name)
                                    <option value="{{$gtcode}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tribun</label>
                                <input type="text" name="tribun" value="{{$data['tribun']}}" id="tribun" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Kapasitas</label>
                                <input type="text" name="kapasitas" value="{{$data['kapasitas']}}" id="kapasitas" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="deskripsi" value="{{$data['description']}}" id="deskripsi" class="form-control input-sm" required>
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
    </section>
</div>
@include('sweet::alert')
@endsection

@section('script')
    <script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
@endsection



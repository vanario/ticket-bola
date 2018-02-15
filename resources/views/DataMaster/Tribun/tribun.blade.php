@extends('template')

@section('title', 'List Tribun')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>Tribun</th>
                                <th>Kapasitas</th>
                                <th>Deskripsi</th>
                                <th>Layout</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $val)  
                            <tr>
                                <td>{{ $val['name'] or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil"></span></a>      
                                    <a href="{{action('DataMaster\TribunController@destroy',$val['gtcode'])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                                
                        </tbody>
                    </table>
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('stadion.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Stadion</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <label for="">Code</label>
                                <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tribun</label>
                                <input type="text" name="tribun" id="tribun" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Kapasitas</label>
                                <input type="text" name="kapasitas" id="kapasitas" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Layout</label>
                                <input type="text" name="layout" id="layout" class="form-control input-sm" required>
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
        <div class="modal fade" id="edit{{$val['gtcode']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('stadion.update')}}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Kelas</h4>
                        </div>
                        <div class="modal-body">         
                            <div class="form-group">
                                <label for="">Code</label>
                                <input type="text" name="gtcode" value="{{$val['gtcode']}}" id="gtcode" class="form-control input-sm" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Tribun</label>
                                <input type="text" name="tribun" value="{{$val['tribun']}}" id="tribun" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Kapasitas</label>
                                <input type="text" name="kapasitas" value="{{$val['kapasitas']}}" id="kapasitas" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="deskripsi" value="{{$val['deskripsi']}}" id="deskripsi" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Layout</label>
                                <input type="text" name="layout" id="layout" value="{{$val['layout']}}" class="form-control input-sm" required>
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
@include('sweet::alert')
@endsection




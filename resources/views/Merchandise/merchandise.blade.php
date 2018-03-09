@extends('template')

@section('title', 'List Merchandise')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <a data-toggle="modal" data-target="#add" class="btn btn-green" font-16" style="margin-bottom:30px;">Tambah</a>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th style="width:15%";>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $val)
                            <tr>
                                <td>{{ $val['name'] or "-"}}</td>
                                <td>{{ $val['desc'] or "-"}}</td>
                                <td>{{ $val['price'] or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil" style="color: green"></span></a>      
                                    <a href="{{action('DataMaster\MerchandiseController@destroy',$val['gtcode'])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                                
                        </tbody>
                    </table>
                    {!! $data->appends(Input::except('page'))->render() !!}
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('merchandise.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Merchandise</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="title" id="title" class="form-control input-sm" required>
                            </div>
                             <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="desc" id="desc" class="form-control input-sm" required>
                            </div>
                             <div class="form-group">
                                <label for="">Harga</label>
                                <input type="text" name="price" id="price" class="form-control input-sm" required>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <div>
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
                    <form method="POST" action="{{ route('merchandise.update')}}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Club</h4>
                        </div>
                        <div class="modal-body">         
                            <div class="form-group">
                                <label for="">Code</label>
                                <input type="text" name="gtcode" value="{{$val['gtcode']}}" id="gtcode" class="form-control input-sm" readonly>
                            </div>
                             <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="title" value="{{$val['title']}}" id="title" class="form-control input-sm" required>
                            </div>
                             <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="desc" id="desc" value="{{$val['desc']}}"class="form-control input-sm" required>
                            </div>
                             <div class="form-group">
                                <label for="">Harga</label>
                                <input type="text" name="price" id="price" value="{{$val['price']}}"class="form-control input-sm" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <input type="submit"  value="Simpan" class="btn btn-green" >
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
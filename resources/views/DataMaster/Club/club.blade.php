@extends('template')

@section('title', 'List Club')
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
                                <th style="width:15%";>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $val)
                            <tr>
                                <td>{{ $val['name'] or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil" style="color: green"></span></a>      
                                    <a href="{{action('DataMaster\ClubController@destroy',$val['gtcode'])}}" id="hapus" ><i class="fa fa-trash"></i></a>
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
                    <form method="POST" action="{{ route('club.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Club</h4>
                        </div>
                        <div class="modal-body">  
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="name" id="name" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tags</label>
                                <input type="text" name="tags" id="tags" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Logo</label>
                                <input type="file" id="inputimage" name="gambar" class="validate" multiple required>
                                <div class="input-field col s6">                          
                                    <img src="" id="image-preview" style="max-width:200px;max-height:200px;" />
                                </div>                                    
                            </div>                     
                            <div class="form-group">
                                <label for="">Background</label>
                                <input type="file" id="inputimage1" name="gambar1" class="validate" multiple required>
                                <div class="input-field col s6">                          
                                    <img src="" id="image-preview1" style="max-width:300px;max-height:200px;" />
                                </div>
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
                    <form method="POST" action="{{ route('club.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Club</h4>
                        </div>
                        <div class="modal-body">         
                            <div class="form-group">
                                <input type="hidden" name="gtcode" value="{{$val['gtcode'] or "-"}}" id="gtcode" class="form-control input-sm" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{$val['name'] or "-"}}" id="name" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tags</label>
                                <input type="text" name="tags" value="{{$val['tags'] or "-"}}" id="tags" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Logo </label>
                                <input type="file" id="inputimage" name="gambar" class="validate" multiple >
                                <input type="hidden" value="{{ $val['imglg'] }}" name="gambar_" class="validate" multiple >
                                <div class="input-field col s6">                          
                                    <img src="data:image/jpeg/png;base64,{{ $val['imglg'] }}" id="image-preview" style="max-width:200px;max-height:200px;" />
                                </div>                                    
                            </div>                     
                            <div class="form-group">
                                <label for="">Background</label>
                                <input type="file" id="inputimage1" name="gambar1" class="validate" multiple >
                                <input type="hidden" value="{{ $val['imgbg1'] }}" name="gambar1_" class="validate" multiple >
                                <div class="input-field col s6">                          
                                    <img src="data:image/jpeg/png;base64,{{ $val['imgbg1'] }}" id="image-preview1" style="max-width:300px;max-height:200px;" />
                                </div>
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

@section('script')
<script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();           

            reader.onload = function (e) {
                $('#image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputimage").change(function(){
        readURL(this);
    });

    function readURL1(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();           

            reader.onload = function (e) {
                $('#image-preview1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputimage1").change(function(){
        readURL1(this);
    });

</script>
@endsection



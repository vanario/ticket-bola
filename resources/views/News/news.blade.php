@extends('template')

@section('title', 'List Berita')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <div class="col-md-1">
                    <i class="fa fa-newspaper-o" style="color:black; margin-top:8px;font-size:24px;"></i>
                </div>
                <div class="col-md-5">
                    <h4 style="font-size:24px;">Berita</h4>                    
                </div>
                <div class="col-md-6" style="margin-top:-15px; text-align: right;">
                    <a data-toggle="modal" data-target="#add" class="btn btn-green" font-16" style="margin-bottom:30px;">Tambah</a>                    
                </div>
            </div>
            {{-- <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th style="width:15%";>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $val)
                    <tr>
                        <td>{{ $val['title'] or "-"}}</td>
                        <td>{{ $val['date'] or "-"}}</td>
                        <td>{{ $val['desc'] or "-"}}</td>
                        <td>
                            <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil" style="color: green"></span></a>      
                            <a href="{{action('News\NewsController@destroy',$val['gtcode'])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                        
                </tbody>
            </table>
 --}}
                <div class="col-md-12">
                    @foreach ($data as $val)
                    <div class="responsive">
                      <div class="gallery">
                          <img src="data:image/jpeg/png;base64,{{ $val['img'] or "-" }}" width="150" height="150">
                      </div>
                        <div class="desc" style="font-size: 15px;">{{ $val['title'] }}</div>
                        <div class="desc" style="font-size: 20px;">{{ $val['date'] }}</div>
                        <div class="desc" style="text-align: right; padding-right:20px; ">
                            <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}" class="btn btn-green" font-16" style="margin-bottom:5px;">Edit</a>
                        </div>
                    </div>
                    @endforeach
                </div>            
        </div>
        {!! $data->appends(Input::except('page'))->render() !!}
    </section>
</div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
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
                                <label for="">Judul</label>
                                <input type="text" name="title" id="title" class="form-control input-sm" required>
                            </div>
                             <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="desc" id="desc" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="text" name="date" id="date" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Berita</label>
                                <textarea name="berita" id="berita" class="form-control input-sm" required></textarea> 
                            </div>                            
                            <div class="form-group">
                                <label for="">Gambar</label>
                                <input type="file" id="inputimage" name="gambar" class="validate" multiple required>
                                <div class="input-field col s6">                          
                                    <img src="" id="image-preview" style="max-width:200px;max-height:200px;" />
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
                    <form method="POST" action="{{ route('news.update')}}" >
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
                                <label for="">Judul</label>
                                <input type="text" name="title" value="{{$val['title']}}" id="title" class="form-control input-sm" required>
                            </div>
                             <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="desc" id="desc" value="{{$val['desc']}}"class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="text" name="date" id="date" value="{{$val['date']}}" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Berita</label>
                                <textarea name="berita" id="berita"  class="form-control input-sm" required> {{$val['berita']}}</textarea> 
                            </div>
                            <div class="form-group">
                                <label for="">Gambar</label>
                                <input type="file" id="inputimage1" name="gambar1" class="validate" multiple required>
                                <input type="hidden" name="gambar_" value="{{$val['img']}}" class="validate" multiple required>
                                <div class="input-field col s6">                          
                                    <img src="" id="image-preview1" style="max-width:200px;max-height:200px;" />
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
    @endforeach
    
@include('sweet::alert')
@endsection

@section('script')
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
    $(function() {

        init_datepicker();
        readURL();
            
        function init_datepicker() {
            $('#date').datepicker({
             format: 'yyyy-m-d',
             autoclose: true
           });
        };
    });

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
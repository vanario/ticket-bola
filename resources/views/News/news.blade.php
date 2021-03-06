@extends('template')

@section('title', 'List Berita')
@section('content')

<div class="row">
    <section class="content">
        <div class="standings">
            <div class="content-list">
                <div class="box-list">
                    <div class="col-md-1">
                        <i class="fa fa-newspaper-o" style="color:black; margin-top:8px;font-size:24px;"></i>
                    </div>
                    <div class="col-md-5">
                        <h4 style="font-size:24px;">Berita</h4>
                    </div>
                    <div class="col-md-6" style="margin-top:-15px; text-align: right;">
                        <a data-toggle="modal" data-target="#add" class="btn btn-green" style="margin-bottom:30px;">Tambah</a>
                    </div>
                </div>
                <table class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Gambar Tumbnail</th>
                            <th>Media</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th style="width:15%";>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $val)
                        <tr>
                            @foreach ($val['media'] as $value)
                              <td>
                                <span class="images-club">
                                  {{ $value['path']}}
                                  {{-- <img src="{{ $value['path']}}" class="img-fluid" alt=""> --}}
                               </span>
                             </td>
                            @endforeach
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
            </div>
            {!! $data->appends(Input::except('page'))->render() !!}
        </div>
    </section>
</div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Berita</h4>
                        </div>
                        <div class="modal-body">
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
                                <textarea name="berita"  id="editor1" class="form-control input-sm" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">reference</label>
                                <input type="text" name="reference" id="reference" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Gambar Tumbnail</label>
                                <input type="file" id="inputimage" name="gambar" class="validate">
                                <div class="input-field col s6">
                                    <img src="" id="image-preview" style="max-width:200px;max-height:200px;" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Gambar atau Video</label>
                                <input type="file" id="inputmedia" name="media" class="validate">
                                <div class="input-field col s6">
                                    <img src="" id="media-preview" style="max-width:200px;max-height:200px;" />
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('news.update')}}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Berita</h4>
                        </div>
                        <div class="modal-body">
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
                                <textarea name="berita"  id="editor1"  class="form-control input-sm" required> {{$val['news']}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Gambar</label>
                                <input type="file" id="inputimage1" name="gambar1" class="validate" multiple required>
                                {{-- <input type="hidden" name="gambar_" value="{{$val['img']}}" class="validate" multiple required> --}}
                                <div class="input-field col s6">
                                    {{-- <img src="{{ $val['img']}}" id="image-preview1" style="max-width:200px;max-height:200px;" /> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Gambar atau Video</label>
                                <input type="file" id="inputmeida1" name="media1" class="validate" multiple required>
                                {{-- <input type="hidden" name="gambar_" value="{{$val['img']}}" class="validate" multiple required> --}}
                                <div class="input-field col s6">
                                    {{-- <img src="{{ $val['img']}}" id="media-preview1" style="max-width:200px;max-height:200px;" /> --}}
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

    $(function () {
      CKEDITOR.replace('editor1')
    })

    $(function() {

        init_datepicker();
        readURL();
        readURL1();
        readURL2();
        readURL3();

        function init_datepicker() {
            $('#date').datepicker({
             format: 'yyyy-m-d',
             autoclose: true
           });
        };
    });

    function readURL(input){
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

    function readURL1(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e){
                $('#image-preview1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputimage1").change(function(){
        readURL1(this);
    });

    function readUR2L(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#media-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputmedia").change(function(){
        readURL2(this);
    });

    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#media-preview1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputmedia1").change(function(){
        readURL3(this);
    });


</script>
@endsection

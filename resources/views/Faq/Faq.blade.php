@extends('template')

@section('title', 'List FAQ')
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
                        <h4 style="font-size:24px;">FAQ</h4>
                    </div>
                    <div class="col-md-6" style="margin-top:-15px; text-align: right;">
                        <a data-toggle="modal" data-target="#add" class="btn btn-green" style="margin-bottom:30px;">Tambah</a>
                    </div>
                </div>
                <table class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kontent</th>
                            <th style="width:15%";>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $val)
                        <tr>
                            <td>
                                <span class="images-club">
                                  <img src="{{ $val['img']}}" class="img-fluid" alt="">
                                </span>
                            </td>
                            <td>{{ $val['title'] or "-"}}</td>
                            <td>{{ $val['konten'] or "-"}}</td>
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
                            <h4>Tambah FAQ</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Judul</label>
                                <input type="text" name="title" id="title" class="form-control input-sm" required>
                            </div>
                             <div class="form-group">
                                <label for="">Konten</label>
                                <input type="text" name="konten" id="editor1" class="form-control input-sm" required>
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
                    <h4>Edit FAQ</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" name="title=" id="title=" value="{{$val['title']}}" class="form-control input-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="">Konten</label>
                        <textarea name="konten"  id="editor1"  class="form-control input-sm" required> {{$val['konten']}}</textarea>
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

<script src="{{ asset('adminlte/bower_components/bootstrap-judulpicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">

    $(function () {
      CKEDITOR.replace('editor1')
    })

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
</script>
@endsection

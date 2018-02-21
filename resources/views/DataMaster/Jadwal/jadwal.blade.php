@extends('template')

@section('title', 'List Club')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Pukul</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $val)
                            <tr>
                                <td>{{ $val['name'] or "-"}}</td>
                                <td>{{ $val['date'] or "-"}}</td>
                                <td>{{ $val['jam'] or "-"}}</td>
                                <td>{{ $val['price'] or "-"}}</td>
                                <td>{{ $val['desc'] or "-"}}</td>
                                <td>{{ $val['gtcode'] or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil"></span></a>      
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('club.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Stadion</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="">Club</label>
                                    <select  name="gttopstadion" class="form-control" required>
                                        <option value="">Club</option>
                                        @foreach($list_club as $gtcode => $name)
                                        <option value="{{$gtcode}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="">Kode</label>
                                    <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control input-sm" required>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="">Nama 1</label>
                                    <input type="text" name="name1" id="name1" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-4">
                                    <label for="">Date</label>
                                    <input type="text" name="date" id="date" class="form-control input-sm" required>
                                </div>                                                        
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-4">
                                    <label for="">Jam</label>
                                    <input type="text" name="jam" id="jam" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-4">
                                    <label for="">Deskripsi</label>
                                    <input type="text" name="desc" id="desc" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-4">
                                    <label for="">Kode Tribun</label>
                                    <input type="text" name="gtcodetrib" id="gtcodetrib" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-4">
                                    <label for="">Tribun</label>
                                    <input type="text" name="tribun" id="tribun" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <div class="col-md-4">
                                    <label for="">Harga</label>
                                    <input type="text" name="price" id="price" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">                                
                                <label for="">Gambar </label>
                                    <div class="col-md-4">                          
                                        <input type="file" id="inputimage" name="gambar" class="validate">
                                    </div>

                                    <div class="col-md-4">                          
                                        <img src="" id="image-preview" style="max-width:200px;max-height:200px;" />
                                    </div>
                                <label for="">Gambar 1</label>
                                    <div class="col-md-4">                          
                                        <input type="file" id="inputimage1" name="gambar1" class="validate">
                                    </div>

                                    <div class="col-md-4">                          
                                        <img src="" id="image-preview1" style="max-width:200px;max-height:200px;" />
                                    </div>
                            </div>                     
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                 <input type="submit" value="Simpan" class="btn btn-subscribe" >
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
                    <form method="POST" action="{{ route('club.update')}}" >
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
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{$val['name']}}" id="name" class="form-control input-sm" required>
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
    
</script>

<script type="text/javascript">

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();           

            reader.onload = function (e) {
                $('#image-preview1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputimage1").change(function(){
        readURL(this);
    });
    
</script>


@endsection



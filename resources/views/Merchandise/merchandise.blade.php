@extends('template')

@section('title', 'List Merchandise')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <div class="col-md-1">
                    <i class="fa fa-shopping-bag" style="color:black; margin-top:8px;font-size:24px;"></i>
                </div>
                <div class="col-md-5">
                    <h4 style="margin-left:-20px; font-size:24px;">Merchandise</h4>                    
                </div>
                <div class="col-md-6" style="margin-top:-15px; padding-left: 30%;">
                    <a data-toggle="modal" data-target="#add" class="btn btn-green" font-16" style="margin-bottom:30px;">Tambah</a>                    
                </div>
            </div>

                <div class="col-md-12">
                    @foreach ($data as $val)
                    <div class="responsive">
                      <div class="gallery">
                        <a target="_blank" href="img_lights.jpg">
                          <img src="data:image/jpeg/png;base64,{{ $val['img'] or "-" }}" width="150" height="150">
                        </a>
                      </div>
                        <div class="desc">Harga :{{ $val['price'] }}</div>
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
@endsection
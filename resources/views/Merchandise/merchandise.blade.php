@extends('template')

@section('title', 'List Merchandise')
@section('content')

<div class="row">
    <section class="content">
        <div class="standings">
            <div class="content-list">
                <div class="box-list">
                    <div class="col-md-1">
                        <i class="fa fa-shopping-bag" style="color:black; margin-top:8px;font-size:24px;"></i>
                    </div>
                    <div class="col-md-5">
                        <h4 style="font-size:24px;">Merchandise</h4>                    
                    </div>
                    <div class="col-md-6" style="text-align: right;">
                        <a data-toggle="modal" data-target="#add" class="btn btn-success" font-16">Tambah</a>                    
                    </div>
                </div>
                    <table class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th style="width:15%";>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $val)
                        <tr>
                            <td>{{ $val['title'] or "-"}}</td>
                            <td>
                                <span class="images-club">
                                  <img src="{{ $val['img']}}" class="img-fluid" alt="">
                                </span>
                            </td>
                            <td>{{ $val['price'] or "-"}}</td>
                            <td>{{ $val['desc'] or "-"}}</td>
                            <td>
                                <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil" style="color: green"></span></a>      
                                <a href="{{action('Merchandise\MerchandiseController@destroy',$val['gtcode'])}}" id="hapus" ><i class="fa fa-trash"></i></a>
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
                    <form method="POST" action="{{ route('merchandise.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Merchandise</h4>
                        </div>
                        <div class="modal-body"> 
                            <div class="form-group">      
                                <div class="col-md-6">
                                    <label for="">Nama</label>
                                    <input type="text" name="title" id="title" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Kategori</label>
                                    <select name="category" class="form-control" id="category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Baju">Baju</option>              
                                        <option value="Celana">Celana</option>             
                                        <option value="Syal">Syal</option>             
                                        <option value="Aksesoris">Aksesoris</option>             
                                    </select>
                                </div>
                                 <div class="col-md-6">
                                    <label for="">Deskripsi</label>
                                    <input type="text" name="desc" id="desc" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Harga</label>
                                    <input type="text" name="price" id="price" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Lokasi</label>
                                    <input type="text" name="location" id="location" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">AsaL</label>
                                    <input type="text" name="origin" id="origin" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Tersedia">Tersedia</option>              
                                        <option value="Habis">Habis</option>             
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Deskripsi Produk</label>
                                    <textarea name="mdesc" id="mdesc" class="form-control input-sm" required></textarea>
                                </div>
                                <div class="col-md-12" style="">
                                    <label for="">Kontak</label>
                                     <input type="text" name="kontak[]" id="kontak[]" class="form-control input-sm" required>
                                     <a href="javascript:void(0);" class="btn btn-green" title="Add field">Tambah Kontak</a>
                                </div>
                                <div class="col-md-12" style="margin-top: 10px;">
                                    <div class="field_wrapper">
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: 15px; ">
                                    <label for="">Gambar</label>
                                    <input type="file" id="inputimage" name="gambar" class="validate" multiple required>
                                    <div class="input-field col s6">                          
                                        <img src="" id="image-preview" style="max-width:200px;max-height:200px;" />
                                    </div>                                    
                                </div>
                            </div>   
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                 <input type="submit" value="Simpan" class="btn btn-success" >
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
                    <form method="POST" action="{{ route('merchandise.update')}}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Club</h4>
                        </div>
                        <div class="modal-body">         
                            <input type="hidden" name="gtcode" value="{{$val['gtcode']}}" id="gtcode" class="form-control input-sm" required>
                            <div class="col-md-6">
                                <label for="">Nama</label>
                                <input type="text" name="title" value="{{$val['title']}}" id="title" class="form-control input-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Kategori</label>
                                <select name="category" class="form-control" id="category" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Baju"{{old('',"Baju")==$val['category'] ? 'selected': ''}}>Baju</option>              
                                    <option value="Celana"{{old('',"Celana")==$val['category']? 'selected': ''}}>Celana</option>             
                                    <option value="Syal"{{old('',"Syal")==$val['category']? 'selected': ''}}>Syal</option>             
                                    <option value="Aksesoris"{{old('',"Aksesoris")==$val['category']? 'selected': ''}}>Aksesoris</option>             
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Deskripsi</label>
                                <input type="text" name="desc" id="desc" value="{{$val['desc']}}" class="form-control input-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Harga</label>
                                <input type="text" name="price" id="price" value="{{$val['price']}}" class="form-control input-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Lokasi</label>
                                <input type="text" name="location" value="{{$val['location']}}" id="location" class="form-control input-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Asal</label>
                                <input type="text" name="origin" value="{{$val['origin']}}" id="origin" class="form-control input-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Tersedia"{{old('','Tersedia')==$val['status'] ? 'selected': ''}}>Tersedia</option>              
                                    <option value="Habis"{{old('','Habis')==$val['status'] ? 'selected': ''}}>Habis</option>             
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="">Deskripsi Produk</label>
                                <textarea name="mdesc" id="mdesc" class="form-control input-sm" required>{{$val['merchdesc']}}</textarea>
                            </div>
                            <div class="col-md-12" style="">
                                <div>
                                     <label for="">Kontak</label>
                                </div>
                                @if($val['cp'] != null)
                                    @foreach ($val['cp'][0] as $value)
                                    <div>
                                        <input type="text" value="{{ $value }}" name="kontak[]" id="kontak[]" class="form-control input-sm" required>
                                    </div>
                                    @endforeach
                                @endif
                                 <a href="javascript:void(0);" class="btn btn-green" title="Add field">Tambah Kontak</a>
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <div class="field_wrapper">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Gambar</label>
                                <input type="hidden" id="gambar_" value="{{$val['img']}}" name="gambar_" class="validate">
                                <input type="file" id="inputimage" name="gambar" class="validate">
                                <div class="input-field col s6">                          
                                    <img src="{{$val['img']}}" id="image-preview" style="max-width:200px;max-height:200px;" />
                                </div>                                    
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                <input type="submit"  value="Simpan" class="btn btn-success" >
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

    $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.btn-green'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><tr><td><label for="">Kontak</label><input type="text" name="kontak[]" id="kontak[]" class="form-control input-sm" required></td><td><a href="javascript:void(0);" class="btn btn-red" title="Hapus field">Hapus</a></td></tr></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.btn-red', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

</script>
@endsection
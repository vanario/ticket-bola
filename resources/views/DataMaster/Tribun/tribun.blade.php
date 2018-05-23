@extends('template')

@section('title', 'List Tribun')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <div class="col-md-1">
                    <i class="fa fa-link" style="color:black; margin-top:8px;font-size:24px;"></i>
                </div>
                <div class="col-md-5">
                    <h4 style="font-size:24px;">Tribun</h4>                    
                </div>
                <div class="col-md-6" style="margin-top:-15px; text-align: right;">
                    <a data-toggle="modal" data-target="#add" class="btn btn-green" font-16" style="margin-bottom:30px;">Tambah</a>                    
                </div>
            </div>
            <div class="box-list">
                <div class="row">
                  <form method="POST" action="{{ url('tribun/index') }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                    <div class="col-sm-3" style="margin-top: 20px;">
                      <div class="form-group">
                        <select  name="gttop" class="form-control" required>
                          <option value=""> Filter Berdasarkan Stadion</option>
                          @foreach($list_stadion as $gtcode => $name)
                          <option value="{{$gtcode}}">{{$name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-7">
                      <input type="submit" value="Filter" class="btn btn-green" >
                    </div>
                  </form>   
                </div>
                <table class="table table-striped" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>Tribun</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $val)
                    <tr>
                      <td>{{ $val['tribun'] or "-"}}</td>
                      <td>
                          <a href="{{action( 'DataMaster\TribunController@edittribun',[$val['gttop'],$val[ 'gtcode']])}} "><i class=" fa fa-pencil " style="color:green "></i></a> 
                          <a href="{{action( 'DataMaster\TribunController@destroy',$val[ 'gtcode'])}} " id="hapus "><i class="fa fa-trash "></i></a> 
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form method="POST" action="{{ route('tribun.store')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                  <h4>Tambah Tribun</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="form-group">
                      <div class="col-sm-6">
                        <label for="">Stadion</label>
                          <select  name="gttop" class="form-control" required>
                              <option value="">Pilih Stadion</option>
                              @foreach($list_stadion as $gtcode => $name)
                              <option value="{{$gtcode}}">{{$name}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-md-6">
                        <label for="">Tribun</label>
                        <select name="tribun" class="form-control" id="tribun" required>
                            <option value="">Pilih Tribun</option>
                            <option value="vip">VIP</option>
                            <option value="vip 1">VIP 1</option>
                            <option value="vip 2">VIP 2</option>
                            <option value="tribun timur">Tribun Timur</option>
                            <option value="tribun utara">Tribun Utara</option>
                            <option value="tribun selatan">Tribun Selatan</option>
                        </select>
                      </div>                      
                      <div class="col-md-12" style="margin-top: 20px;">
                        <div class="panel-group" id="accordion">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Tribun Depan</a>
                              </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="form-group">
                                  <div class="col-md-4">
                                    <label>Harga</label>
                                    <input type="text" name="pricedepan" id="pricedepan" class="form-control input-sm" placeholder="Harga" required>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Jumlah</label>
                                    <input type="text" name="qtydepan" id="qtydepan" class="form-control input-sm" placeholder="Jumlah" required>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Layout</label>
                                    <select name="layout_depan" class="form-control" id="layout_depan" required>
                                        <option value="">Pilih layout</option>
                                        <option value="true">Ada</option>              
                                        <option value="false">Tidak Ada</option>             
                                    </select>
                                  </div>
                                  <div class="col-md-6" style="margin-top: 25px;">
                                    <label for="">Gambar Tribun Depan</label>
                                    <input type="file" id="gambardepan" name="gambardepan" class="validate" multiple required>
                                    <div class="input-field col s6">
                                        <img src="" id="image-previewdepan" style="max-width:200px;max-height:200px;" />
                                    </div>
                                  </div>
                                  <div class="col-md-8">   
                                    <a style="margin-top: 25px;" href="javascript:void(0);" class="btn btn-green" id="depan" title="Add field">Tambah Kursi</a>
                                  </div>
                                  <div class="col-md-12" style="margin-top: 10px;">
                                    <div class="field_wrapper" id="wrapper_depan">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Tribun Tengah</a>
                              </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="form-group">
                                  <div class="col-md-4">
                                    <label>Harga</label>
                                    <input type="text" name="pricetengah" id="pricetengah" class="form-control input-sm" placeholder="Harga" required>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Jumlah</label>
                                    <input type="text" name="qtytengah" id="qtytengah" class="form-control input-sm" placeholder="Jumlah" required>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Layout</label>
                                    <select name="layout_tengah" class="form-control" id="layout_tengah" required>
                                      <option value="">Pilih layout</option>
                                      <option value="true">Ada</option>              
                                      <option value="false">Tidak Ada</option>             
                                    </select>
                                  </div>
                                  <div class="col-md-6" style="margin-top: 25px;">
                                    <label for="">Gambar Tribun Tengah</label>
                                    <input type="file" id="gambartengah" name="gambartengah" class="validate" multiple required>
                                    <div class="input-field col s6">
                                        <img src="" id="image-previewtengah" style="max-width:200px;max-height:200px;" />
                                    </div>
                                  </div>
                                  <div class="col-md-8">   
                                     <a style="margin-top: 25px;" href="javascript:void(0);" class="btn btn-green" id="tengah" title="Add field">Tambah Kursi</a>
                                  </div>
                                  <div class="col-md-12" style="margin-top: 10px;">
                                      <div class="field_wrapper" id="wrapper_tengah">
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Tribun Belakang</a>
                              </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                              <div class="panel-body">
                                <div class="form-group">
                                  <div class="col-md-4">
                                    <label>Harga</label>
                                    <input type="text" name="pricebelakang" id="pricebelakang" class="form-control input-sm" placeholder="Harga" required>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Jumlah</label>
                                    <input type="text" name="qtybelakang" id="qtybelakang" class="form-control input-sm" placeholder="Jumlah" required>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Layout</label>
                                    <select name="layout_belakang" class="form-control" id="layout_belakang" required>
                                      <option value="">Pilih layout</option>
                                      <option value="true">Ada</option>              
                                      <option value="false">Tidak Ada</option>             
                                    </select>
                                  </div>
                                  <div class="col-md-6" style="margin-top: 25px;">
                                    <label for="">Gambar Tribun Belakang</label>
                                    <input type="file" id="gambarbelakang" name="gambarbelakang" class="validate" multiple required>
                                    <div class="input-field col s6">
                                        <img src="" id="image-previewbelakang" style="max-width:200px;max-height:200px;" />
                                    </div>
                                  </div>
                                  <div class="col-md-8">   
                                    <a style="margin-top: 25px;" href="javascript:void(0);" class="btn btn-green" id="belakang" title="Add field">Tambah Kursi</a>
                                  </div>
                                  <div class="col-md-12" style="margin-top: 10px;">
                                    <div class="field_wrapper" id="wrapper_belakang">
                                    </div>
                                  </div>  
                                </div>                                           
                              </div>
                            </div>
                          </div>
                        </div> 
                      </div> 
                    </div>                                     
                  </div>
                </div>
                <div class="modal-footer">
                  <div>
                    <input type="submit" value="Simpan" class="btn btn-green">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>   
    </section>
</div>
@endsection

@section('script')
@include('sweet::alert')
<script src="{{ asset('adminlte/bower_components/bootstrap-typeahead.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/jquery.mockjax.js') }}"></script> 

<script type="text/javascript">

$(function() {
    wraper_depan();
    wraper_tengah();
    wraper_belakang();

    function wraper_depan(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('#depan'); //Add button selector
        var wrapper = $('#wrapper_depan'); //Input field wrapper
        var fieldHTML = '<div><label for="">Prefix</label><input type="text" name="prefix_depan[]" id="prefix_depan" class="form-control input-sm" required><label for="">Nomor Pertama</label><input type="text" name="nomor_pertama_depan[]" id="nomor_pertama_depan" class="form-control input-sm" required><label for="">Nomor Terakhir</label><input type="text" name="nomor_terakhir_depan[]" id="nomor_terakhir_depan" class="form-control input-sm" required><a href="javascript:void(0);" class="btn btn-red" style ="margin-bottom:15px;"title="Hapus kursi">Hapus</a></div>'; //New input field html 
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
    };

    function wraper_tengah(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('#tengah'); //Add button selector
        var wrapper = $('#wrapper_tengah'); //Input field wrapper
        var fieldHTML = '<div><label for="">Prefix</label><input type="text" name="prefix_tengah[]" id="prefix_tengah" class="form-control input-sm" required><label for="">Nomor Pertama</label><input type="text" name="nomor_pertama_tengah[]" id="nomor_pertama_tengah" class="form-control input-sm" required><label for="">Nomor Terakhir</label><input type="text" name="nomor_terakhir_tengah[]" id="nomor_terakhir_tengah" class="form-control input-sm" required><a href="javascript:void(0);" class="btn btn-red" style ="margin-bottom:15px;"title="Hapus kursi">Hapus</a></div>'; //New input field html 
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
    };

    function wraper_belakang(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('#belakang'); //Add button selector
        var wrapper = $('#wrapper_belakang'); //Input field wrapper
        var fieldHTML = '<div><label for="">Prefix</label><input type="text" name="prefix_belakang[]" id="prefix_belakang" class="form-control input-sm" required><label for="">Nomor Pertama</label><input type="text" name="nomor_pertama_belakang[]" id="nomor_pertama_belakang" class="form-control input-sm" required><label for="">Nomor Terakhir</label><input type="text" name="nomor_terakhir_belakang[]" id="nomor_terakhir_belakang" class="form-control input-sm" required><a href="javascript:void(0);" class="btn btn-red" style ="margin-bottom:15px;"title="Hapus kursi">Hapus</a></div>'; //New input field html 
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
    };
});
function readURLdepan(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image-previewdepan').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#gambardepan").change(function() {
    readURLdepan(this);
});

function readURLtengah(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image-previewtengah').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#gambartengah").change(function() {
    readURLtengah(this);
});

function readURLbelakang(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image-previewbelakang').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#gambarbelakang").change(function() {
    readURLbelakang(this);
});
</script>

@endsection


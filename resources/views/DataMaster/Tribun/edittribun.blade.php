@extends('template')

@section('title', 'Create Tribun')

@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <form method="POST" action="{{ route('tribun.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="modal-header">
                      <h4>Edit Tribun</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="form-group">
                          <div class="col-sm-6">
                            <label for="">Stadion</label>
                              <select  name="gttop" class="form-control" required>
                                  <option value="">Pilih Stadion</option>
                                  @foreach($list_stadion as $gtcode => $name)
                                  <option value="{{$gtcode}}"{{old('',$gtcode)==$val['gttop']? 'selected': ''}}>{{$name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-md-6">
                            <label for="">Tribun</label>
                            <input type="text"  name="tribun" id="tribun" value="{{ $val['tribun'] }}" class="form-control input-sm" readonly>
                          </div>
                          <div class="col-md-12" style="margin-top: 20px;">
                            <div class="panel-group" id="accordion">
                              <div class="panel panel-default">
                                <div class="panel-heading">
                                  <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Tribun Depan</a>
                                  </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <div class="col-md-6">
                                        <label>Layout</label>
                                        <select name="layout_depan" class="form-control" id="layout_depan" required>
                                            <option value="">Pilih layout</option>
                                            <option value="true"{{old('',true)==$val['postribun'][0]['layout']? 'selected': ''}}>Ada</option>
                                            <option value="false"{{old('',false)==$val['postribun'][0]['layout']? 'selected': ''}}>Tidak Ada</option>
                                        </select>
                                      </div>
                                      @if($val['postribun'][0]['layout'] == true)
                                        @foreach($val['postribun'][0]['kursi'] as $value)
                                        <div class="col-md-12" style="margin-top :25px;">
                                            <label>Kursi</label>
                                            <label for="">Prefix</label>
                                            <input type="text" name="prefix_depan[]" value="{{ $value['prefix'] }}" id="prefix_depan" class="form-control input-sm" required>
                                            <label for="">Nomor Pertama</label>
                                            <input type="text" name="nomor_pertama_depan[]" value="{{ $value['first_number'] }}" id="nomor_pertama_depan" class="form-control input-sm" required><label for="">Nomor Terakhir</label>
                                            <input type="text" name="nomor_terakhir_depan[]" value="{{ $value['last_number'] }}" id="nomor_terakhir_depan" class="form-control input-sm" required>
                                        </div>
                                        @endforeach
                                      @endif
                                      <div class="col-md-12">
                                        <a style="margin-top: 25px;" href="javascript:void(0);" class="btn btn-green" id="depan" title="Add field">Tambah Kursi</a>
                                      </div>
                                      <div class="col-md-12" style="margin-top: 10px;">
                                        <div class="field_wrapper" id="wrapper_depan">
                                        </div>
                                      </div>
                                      <div class="col-md-6" style="margin-top: 25px;">
                                        <label for="">Gambar Tribun Depan</label>
                                        <input type="hidden" value="{{ $val['postribun'][0]['image'] or "-" }}" name="gambar_depan" class="validate">
                                        <input type="file" value="{{ $val['postribun'][0]['image'] or "-" }}" id="gambardepan" name="gambardepan" class="validate">
                                        <div class="input-field col s6">
                                          <img src="{{ $val['postribun'][0]['image'] or "-" }}" id="image-previewdepan" style="max-width:200px;max-height:200px;" />
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
                                      <div class="col-md-6">
                                        <label>Layout</label>
                                        <select name="layout_tengah" class="form-control" id="layout_tengah" required>
                                          <option value="">Pilih layout</option>
                                          <option value="true"{{old('',true)==$val['postribun'][1]['layout']? 'selected': ''}}>Ada</option>
                                          <option value="false"{{old('',false)==$val['postribun'][1]['layout']? 'selected': ''}}>Tidak Ada</option>
                                        </select>
                                      </div>
                                      @if($val['postribun'][1]['layout'] == true)
                                        @foreach($val['postribun'][1]['kursi'] as $value)
                                        <div class="col-md-12" style="margin-top :25px;">
                                            <label>Kursi</label>
                                            <label for="">Prefix</label>
                                            <input type="text" name="prefix_tengah[]" value="{{ $value['prefix'] }}" id="prefix_tengah" class="form-control input-sm" required>
                                            <label for="">Nomor Pertama</label>
                                            <input type="text" name="nomor_pertama_tengah[]" value="{{ $value['first_number'] }}" id="nomor_pertama_tengah" class="form-control input-sm" required><label for="">Nomor Terakhir</label>
                                            <input type="text" name="nomor_terakhir_tengah[]" value="{{ $value['last_number'] }}" id="nomor_terakhir_tengah" class="form-control input-sm" required>
                                        </div>
                                        @endforeach
                                      @endif
                                      <div class="col-md-12">
                                         <a style="margin-top: 25px;" href="javascript:void(0);" class="btn btn-green" id="tengah" title="Add field">Tambah Kursi</a>
                                      </div>
                                      <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="field_wrapper" id="wrapper_tengah">
                                          </div>
                                      </div>
                                      <div class="col-md-6" style="margin-top: 25px;">
                                        <label for="">Gambar Tribun Tengah</label>
                                        <input type="hidden" value="{{ $val['postribun'][1]['image'] or "-" }}" name="gambar_tengah" class="validate">
                                        <input type="file" id="gambartengah" name="gambartengah" class="validate">
                                        <div class="input-field col s6">
                                          <img src="{{ $val['postribun'][1]['image'] or "-" }}" id="image-previewtengah" style="max-width:200px;max-height:200px;" />
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
                                      <div class="col-md-6">
                                        <label>Layout</label>
                                        <select name="layout_belakang" class="form-control" id="layout_belakang" required>
                                          <option value="">Pilih layout</option>
                                           <option value="true"{{old('',true)==$val['postribun'][2]['layout']? 'selected': ''}}>Ada</option>
                                          <option value="false"{{old('',false)==$val['postribun'][2]['layout']? 'selected': ''}}>Tidak Ada</option>
                                        </select>
                                      </div>
                                      @if($val['postribun'][2]['layout'] == true)
                                        @foreach($val['postribun'][2]['kursi'] as $value)
                                        <div class="col-md-12" style="margin-top :25px;">
                                            <label>Kursi</label>
                                            <label for="">Prefix</label>
                                            <input type="text" name="prefix_belakang[]" value="{{ $value['prefix'] }}" id="prefix_belakang" class="form-control input-sm" required>
                                            <label for="">Nomor Pertama</label>
                                            <input type="text" name="nomor_pertama_belakang[]" value="{{ $value['first_number'] }}" id="nomor_pertama_belakang" class="form-control input-sm" required><label for="">Nomor Terakhir</label>
                                            <input type="text" name="nomor_terakhir_belakang[]" value="{{ $value['last_number'] }}" id="nomor_terakhir_belakang" class="form-control input-sm" required>
                                        </div>
                                        @endforeach
                                      @endif
                                      <div class="col-md-12">
                                        <a style="margin-top: 25px;" href="javascript:void(0);" class="btn btn-green" id="belakang" title="Add field">Tambah Kursi</a>
                                      </div>
                                      <div class="col-md-12" style="margin-top: 10px;">
                                        <div class="field_wrapper" id="wrapper_belakang">
                                        </div>
                                      </div>
                                      <div class="col-md-6" style="margin-top: 25px;">
                                        <label for="">Gambar Tribun belakang</label>
                                        <input type="hidden" value="{{ $val['postribun'][2]['image'] or "-" }}" name="gambar_belakang" class="validate">
                                        <input type="file" id="gambarbelakang" name="gambarbelakang" class="validate">
                                        <div class="input-field col s6">
                                          <img src="{{ $val['postribun'][2]['image'] or "-" }}" id="image-previewbelakang" style="max-width:200px;max-height:200px;" />
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

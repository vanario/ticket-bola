@extends('template') 

@section('title', 'Create Jadwal') 

@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <div class="row">
                    <form method="POST" action="{{ route('jadwal.update')}}">
                        <input name="_method" type="hidden" value="PATCH"> {{ csrf_field() }}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Club</label>
                                    <select name="gttopstadion" class="form-control input-sm" required>
                                        <option value="">Club</option>
                                        @foreach($list_club as $gtcode => $name)
                                        <option value="{{$gtcode}}" {{old( '',$gtcode)==$data[ 'gttop']? 'selected': ''}}>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" value="{{ $data['gtcode'] }}" name="gtcode" id="gtcode" class="form-control input-sm" required>
                                <div class="col-md-6">
                                    <label for="">Nama Home</label>
                                    <input type="text" value="{{ $data['namehome'] }}" name="namehome" id="namehome" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nama Away</label>
                                    <input type="text" value="{{ $data['nameaway'] }}" name="nameaway" id="nameaway" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tanggal</label>
                                    <input type="text" value="{{ $data['date'] }}" name="date" id="date" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Jam</label>
                                    <input type="text" value="{{ $data['jam'] }}" name="jam" id="jam" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Kota</label>
                                    <input type="text" value="{{ $data['kota'] }}" name="kota" id="kota" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Stadion</label>
                                    <input type="text" value="{{ $data['stadion'] }}" name="stadion" id="stadion" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Event</label>
                                    <input type="text" value="{{ $data['event'] }}" name="event" id="event" class="form-control input-sm" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3">                               
                                    <input type="submit"  value="Update" name="update" class="btn btn-green" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                <a data-toggle="modal" data-target="#add" class="btn btn-green" font-16" style="margin-bottom:30px;">Tambah tribun</a>
                                    <table class="table table-striped " style="width: 100%; ">
                                        <thead>
                                            <tr>
                                                <th>Tribun</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($data['postribun'] != null)
                                        @foreach ($data['postribun'] as $value) 
                                            <tr>
                                                <td>{{ $value['tribun'] or "-"}}</td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#edit{{$value['gtcode']}}"><span class="fa fa-pencil" style="color: green"></span></a> 
                                                    <a href="{{action( 'DataMaster\JadwalController@destroytrib',$value[ 'gtcode'])}} " id="hapus "><i class="fa fa-trash "></i></a> 
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td>
                                                    <i class="icon fa fa-warning"></i> Data Tribun Tidak tersedia
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                    </form>
                </div>

                <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <form method="POST" action="{{ route('jadwal.storetrib')}}" enctype="multipart/form-data">
                            <div class="modal-content">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h4>Tambah Tribun</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="gtcodetrib" value="{{ $data['gtcode'] }}" id="gtcodetrib" class="form-control input-sm" required>
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
                                    <div class="form-group">
                                        <div class="col-md-12" style="margin-top: 15px; ">
                                            <label for="">Tribun Depan</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Harga</label>
                                            <input type="text" name="pricedepan" id="pricedepan" class="form-control input-sm" placeholder="Harga" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Jumlah</label>
                                            <input type="text" name="qtydepan" id="qtydepan" class="form-control input-sm" placeholder="Jumlah" required>
                                        </div>
                                        <div class="col-md-6" style="margin-top: 25px;">
                                            <label for="">Gambar Tribun Depan</label>
                                            <input type="file" id="gambardepan" name="gambardepan" class="validate" multiple required>
                                            <div class="input-field col s6">
                                                <img src="" id="image-previewdepan" style="max-width:200px;max-height:200px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12" style="margin-top: 15px; ">
                                            <label for="">Tribun Tengah</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Harga</label>
                                            <input type="text" name="pricetengah" id="pricetengah" class="form-control input-sm" placeholder="Harga" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Jumlah</label>
                                            <input type="text" name="qtytengah" id="qtytengah" class="form-control input-sm" placeholder="Jumlah" required>
                                        </div>
                                        <div class="col-md-6" style="margin-top: 25px;">
                                            <label for="">Gambar Tribun Tengah</label>
                                            <input type="file" id="gambartengah" name="gambartengah" class="validate" multiple required>
                                            <div class="input-field col s6">
                                                <img src="" id="image-previewtengah" style="max-width:200px;max-height:200px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12" style="margin-top: 15px; ">
                                            <label for="">Tribun Belakang</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Harga</label>
                                            <input type="text" name="pricebelakang" id="pricebelakang" class="form-control input-sm" placeholder="Harga" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Jumlah</label>
                                            <input type="text" name="qtybelakang" id="qtybelakang" class="form-control input-sm" placeholder="Jumlah" required>
                                        </div>
                                        <div class="col-md-6" style="margin-top: 25px;">
                                            <label for="">Gambar Tribun Belakang</label>
                                            <input type="file" id="gambarbelakang" name="gambarbelakang" class="validate" multiple required>
                                            <div class="input-field col s6">
                                                <img src="" id="image-previewbelakang" style="max-width:200px;max-height:200px;" />
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                    <div class="form-group">
                                        <div class="col-sm-12">                               
                                            <input type="submit"  value="Simpan" class="btn btn-green" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if($data['postribun'] != null) 
                    @foreach ($data['postribun'] as $val)
                        <div class="modal fade" id="edit{{$val['gtcode']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('jadwal.updatetrib')}}">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="PATCH">
                                        <div class="modal-header">
                                            <h4>Edit Stadion</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                {{-- @if($gtcodetrib != "")
                                                <input type="hidden" name="gtcodetrib" value="{{ $gtcodetrib }}" id="gtcodetrib" class="form-control input-sm" required> @endif --}}
                                                <input type="hidden" name="tribun" value="{{ $val['tribun']}}" id="gtcodetrib" class="form-control input-sm" required> 
                                                        <div class="col-md-12" style="margin-top: 15px; ">
                                                    <label for="">Tribun Depan</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Harga</label>
                                                    <input type="text" value="{{ $val['postribun'][0]['price'] }}" name="pricedepan" id="pricedepan" class="form-control input-sm" placeholder="Harga" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Jumlah</label>
                                                    <input type="text" value="{{ $val['postribun'][0]['qty'] }}" name="qtydepan" id="qtydepan" class="form-control input-sm" placeholder="Jumlah" required>
                                                </div>
                                                <div class="col-md-6" style="margin-top: 25px;">
                                                    <label for="">Gambar Tribun Depan</label>
                                                    <input type="file" id="gambardepan" name="gambardepan" class="validate">
                                                    <div class="input-field col s6">
                                                        <img src="{{ $val['postribun'][0]['image'] }}" id="image-previewdepan" style="max-width:200px;max-height:200px;" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12" style="margin-top: 15px; ">
                                                    <label for="">Tribun Tengah</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Harga</label>
                                                    <input type="text" value="{{ $val['postribun'][1]['price'] }}" name="pricetengah" id="pricetengah" class="form-control input-sm" placeholder="Harga" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Jumlah</label>
                                                    <input type="text" value="{{ $val['postribun'][1]['qty'] }}" name="qtytengah" id="qtytengah" class="form-control input-sm" placeholder="Jumlah" required>
                                                </div>
                                                <div class="col-md-6" style="margin-top: 25px;">
                                                    <label for="">Gambar Tribun Tengah</label>
                                                    <input type="file" valid="gambartengah" name="gambartengah" class="validate">
                                                    <div class="input-field col s6">
                                                        <img src="{{ $val['postribun'][1]['image'] }}" id="image-previewtengah" style="max-width:200px;max-height:200px;" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12" style="margin-top: 15px; ">
                                                    <label for="">Tribun Belakang</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Harga</label>
                                                    <input type="text" value="{{ $val['postribun'][2]['price'] }}" name="pricebelakang" id="pricebelakang" class="form-control input-sm" placeholder="Harga" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Jumlah</label>
                                                    <input type="text" value="{{ $val['postribun'][2]['qty'] }}" name="qtybelakang" id="qtybelakang" class="form-control input-sm" placeholder="Jumlah" required>
                                                </div>
                                                <div class="col-md-6" style="margin-top: 25px;">
                                                    <label for="">Gambar Tribun Belakang</label>
                                                    <input type="file" id="gambarbelakang" name="gambarbelakang" class="validate">
                                                    <div class="input-field col s6">
                                                        <img src="{{ $val['postribun'][2]['image'] }}" id="image-previewbelakang" style="max-width:200px;max-height:200px;" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="form-group">
                                                <div class="col-sm-12">                               
                                                    <input type="submit"  value="Simpan" class="btn btn-green" >
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                @endforeach 
                @endif
            </div>
        </div>
    </section>
</div>
@include('sweet::alert') 
@endsection 

@section('script')
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script type="text/javascript">
$(function() {

    init_datepicker();
    init_timepicker();


    function init_datepicker() {
        $('#date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };

    function init_timepicker() {
        $('#jam').timepicker({
            format: 'H:i:s',
            autoclose: true
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
@extends('template') 

@section('title', 'Create Tribun') 

@section('content') 

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
            <form method="POST" action="{{ route('jadwal.updatetrib')}}">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PATCH">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="tribun" value="{{ $val['tribun']}}" id="gtcodetrib" class="form-control input-sm" required> 
                        <div class="col-md-12" style="margin-top: 15px; ">
                            <label for="">Tribun Depan</label>
                        </div>
                        <div class="col-md-4">
                            <label for="">Harga</label>
                            <input type="text" value="{{ $val['postribun'][0]['price'] or "-" }}" name="pricedepan" id="pricedepan" class="form-control input-sm" placeholder="Harga" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Jumlah</label>
                            <input type="text" value="{{ $val['postribun'][2]['layout'] or "-"}}" name="qtydepan" id="qtydepan" class="form-control input-sm" placeholder="Jumlah" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">layout</label>
                            <select name="layout_depan" class="form-control" id="layout_depan" required>
                                <option value="">Pilih layout</option>
                                <option value="true"{{old('',"true")==$val['postribun'][0]['layout'] or "-" ? 'selected': ''}}>Ada</option>              
                                <option value="false"{{old('',"false")==$val['postribun'][0]['layout'] ? 'selected': ''}}>Tidak Ada</option>             
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-top: 25px;">
                            <label for="">Gambar Tribun Depan</label>
                            <input type="file" id="gambardepan" name="gambardepan" class="validate">
                            <div class="input-field col s6">
                                <img src="{{ $val['postribun'][0]['image'] or "-" }}" id="image-previewdepan" style="max-width:200px;max-height:200px;" />
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
                    <div class="form-group">
                        <div class="col-md-12" style="margin-top: 15px; ">
                            <label for="">Tribun Tengah</label>
                        </div>
                        <div class="col-md-4">
                            <label for="">Harga</label>
                            <input type="text" value="{{ $val['postribun'][1]['price'] or "-"}}" name="pricetengah" id="pricetengah" class="form-control input-sm" placeholder="Harga" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Jumlah</label>
                            <input type="text" value="{{ $val['postribun'][1]['qty'] or "-"}}" name="qtytengah" id="qtytengah" class="form-control input-sm" placeholder="Jumlah" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">layout</label>
                             <select name="layout_depan" class="form-control" id="layout_depan" required>
                                <option value="">Pilih layout</option>
                                <option value="true"{{old('',"true")==$val['postribun'][1]['layout'] or "-" ? 'selected': ''}}>Ada</option>              
                                <option value="false"{{old('',"false")==$val['postribun'][1]['layout'] ? 'selected': ''}}>Tidak Ada</option>             
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-top: 25px;">
                            <label for="">Gambar Tribun Tengah</label>
                            <input type="file" valid="gambartengah" name="gambartengah" class="validate">
                            <div class="input-field col s6">
                                <img src="{{ $val['postribun'][1]['image'] or "-"}}" id="image-previewtengah" style="max-width:200px;max-height:200px;" />
                            </div>
                        </div>
                       {{--  @if( $val['postribun'][1]['kursi'] != "")
                        <div class="col-md-4">
                            <label for="">Jumlah</label>
                            <input type="text" value="{{ $val['postribun'][1]['qty'] or "-"}}" name="qtytengah" id="qtytengah" class="form-control input-sm" placeholder="Jumlah" required>
                        </div>
                        @endif --}}
                        <div class="col-md-8">   
                             <a style="margin-top: 25px;" href="javascript:void(0);" class="btn btn-green" id="tengah" title="Add field">Tambah Kursi</a>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;">
                            <div class="field_wrapper" id="wrapper_tengah">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12" style="margin-top: 15px; ">
                            <label for="">Tribun Belakang</label>
                        </div>
                        <div class="col-md-4">
                            <label for="">Harga</label>
                            <input type="text" value="{{ $val['postribun'][2]['price'] or "-" }}" name="pricebelakang" id="pricebelakang" class="form-control input-sm" placeholder="Harga" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Jumlah</label>
                            <input type="text" value="{{ $val['postribun'][2]['qty'] or "-" }}" name="qtybelakang" id="qtybelakang" class="form-control input-sm" placeholder="Jumlah" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">layout</label>
                             <select name="layout_depan" class="form-control" id="layout_depan" required>
                                <option value="">Pilih layout</option>
                                <option value="true"{{old('',"true")==$val['postribun'][2]['layout'] or "-" ? 'selected': ''}}>Ada</option>              
                                <option value="false"{{old('',"false")==$val['postribun'][2]['layout'] ? 'selected': ''}}>Tidak Ada</option>             
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-top: 25px;">
                            <label for="">Gambar Tribun Belakang</label>
                            <input type="file" id="gambarbelakang" name="gambarbelakang" class="validate">
                            <div class="input-field col s6">
                                <img src="{{ $val['postribun'][2]['image'] or "-"}}" id="image-previewbelakang" style="max-width:200px;max-height:200px;" />
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
    </section>
</div>

@endsection
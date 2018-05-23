@extends('template')

@section('title', 'List Biaya')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <div class="col-md-1">
                    <i class="fa fa-link" style="color:black; margin-top:8px;font-size:24px;"></i>
                </div>
                <div class="col-md-5">
                    <h4 style="font-size:24px;">Transaksi</h4>                    
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a data-toggle="modal" data-target="#add"  class="btn btn-success" font-16" style="margin-bottom:30px;">Tambah</a>
                </div>

            </div>
            <div class="box-list">
                <div class="row" style="margin-top: 20px;">
                    <form method="POST" action="{{ url('biaya/') }}" enctype="multipart/form-data">
                       {{ csrf_field() }}
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select  name="schedule_code" class="form-control" required>
                                    <option value=""> Filter Berdasarkan Jadwal</option>
                                    @foreach($list_jadwal as $gtcode => $name)
                                    <option value="{{$gtcode}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <input type="submit" value="Filter" class="btn btn-success" >
                        </div>
                    </form>
                </div>

                <table class="table table-striped" style="width: 100%;">

                    <thead>
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($data != null) 
                        @foreach($data as $val)  
                        <tr>
                            <td>{{ $val['transaction_date'] or "-"}}</td>
                            <td>
                                <a data-toggle="modal" data-target="#view{{$val['gtcode']}}"><span class="fa fa-eye" style="color:green"></span></a>      
                                <a href="{{action('Biaya\BiayaController@destroy',[$val['gttop'],$val['gtcode']])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="7">Tidak ada data ditemukan !!</td>
                            </tr>                                   
                        @endif
                            
                    </tbody>
                </table>
                <ul class="pagination">
                    <li><a href="{{action('Biaya\BiayaController@page', 1 )}}" rel="prev">&laquo;</a></li> 
                    @for ($i = 1; $i <= $total_page; $i++)
                        @if( $i+1 <= 15)                            
                        <li><a href="{{action('DataMaster\MitraController@page', $i )}}" id="paging">{{$i}}</a></li>
                        @endif
                    @endfor
                    <li><a href="{{action('DataMaster\MitraController@page', $total_page )}}" rel="next">&raquo;</a></li>
                </ul> 
            </div>
        </div>
          
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('biaya.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Biaya</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <label for="">Tanggal Transaksi</label>
                                <input type="text" name="date" id="date" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Pertandingan</label>
                                <select name="gttop" class="form-control input-sm" required>
                                    <option value="">Pertandingan</option>
                                    @foreach($list_jadwal as $gtcode => $name)
                                    <option value="{{$gtcode}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="field_wrapper">
                                    <table>
                                        <tr>
                                            <td  style="padding-left:0px;">               
                                                <label for="">Nama Akun</label>
                                                <select name="akun_name[]" class="form-control input-sm" required>
                                                    <option value="">Akun</option>
                                                    @foreach($list_biaya as $gtcode => $name)
                                                    <option value="{{$gtcode}}">{{$name}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="">Nominal</label>
                                                <input type="text" name="nominal[]" id="nominal" class="form-control input-sm" required>
                                                 <a href="javascript:void(0);" class="btn btn-green" title="Add field">Tambah field</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div>
                                 <input type="submit" value="Simpan" class="btn btn-success" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>

        @if($data != null) 
        @foreach($data as $val)
        <div class="modal fade" id="view{{$val['gtcode']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">       
                        <div class="form-group">
                            <label for="">Tanggal Transaksi</label>
                            <input type="text" name="date" id="date"  value="{{ $val['transaction_date'] or "-" }}" class="form-control input-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Pertandingan</label>
                            <select name="gttop" class="form-control input-sm" required>
                                <option value="">Pertandingan</option>
                                @foreach($list_jadwal as $gtcode => $name)
                                <option value="{{$gtcode}}"{{old( '',$gtcode)==$val[ 'gttop']? 'selected': ''}}>{{$name}}</option>
                                @endforeach
                            </select>                           
                        </div>
                        @foreach($val['biaya'] as $value)
                        <div class="form-group">
                            <div class="field_wrapper">
                                <table>
                                    <tr>
                                        <td  style="padding-left:0px;">               
                                            <label for="">Nama Akun</label>
                                            <select name="akun_name[]" class="form-control input-sm" required>
                                                <option value="">Akun</option>
                                                @foreach($list_biaya as $gtcode => $name)
                                                <option value="{{$gtcode}}"{{old( '',$gtcode)==$value[ 'gtcode']? 'selected': ''}}>{{$name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="">Nominal</label>
                                            <input type="text" value="{{ $value['nominal'] }}" class="form-control input-sm" required>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @endforeach 
                    </div>                       
                </div>
            </div>
        </div>
        @endforeach 
        @endif 
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

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.btn-green'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><tr><td><label for="">Nama Akun</label><select name="akun_name[]" class="form-control input-sm" required><option value="">Akun</option>@foreach($list_biaya as $gtcode => $name)<option value="{{$gtcode}}">{{$name}}</option>@endforeach</select><label for="">Nominal</label><input type="text" name="nominal[]" id="nominal" class="form-control input-sm" required></td><td><a href="javascript:void(0);" class="btn btn-red" title="Hapus field">Hapus</a></td></tr></div>'; //New input field html 
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

function init_datepicker() {
        $('#date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };
});

</script>
@endsection




@extends('template')

@section('title', 'List Pertandingan')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <a data-toggle="modal" data-target="#add" class="btn btn-green" font-16" style="margin-bottom:30px;">Tambah</a>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>Skor</th>
                                <th>Home</th>
                                <th>Away</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- @foreach($data as $val)  
                            <tr>
                                <td>{{ $val['tanggal'] or "-"}}</td>
                                <td>{{ $val['jadwal_pertandingan'] or "-"}}</td>
                                <td>{{ $val['tipe_biaya'] or "-"}}</td>
                                <td>{{ $val['nominal'] or "-"}}</td>
                                <td>{{ $val['keterangan'] or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil" style="color:green"></span></a>      
                                    <a href="{{action('Biaya\BiayaController@destroy',$val['gtcode'])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach --}}
                                
                        </tbody>
                    </table>
                    {{-- <ul class="pagination">
                        <li><a href="{{action('Biaya\BiayaController@page', 1 )}}" rel="prev">&laquo;</a></li> 
                        @for ($i = 1; $i <= $total_page; $i++)
                            @if( $i+1 <= 15)                            
                            <li><a href="{{action('DataMaster\MitraController@page', $i )}}" id="paging">{{$i}}</a></li>
                            @endif
                        @endfor
                        <li><a href="{{action('DataMaster\MitraController@page', $total_page )}}" rel="next">&raquo;</a></li>
                    </ul> --}} 
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('pertandingan.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Pertandingan</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Skor</label>
                                <input type="text" name="skor" id="skor" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Home</label>
                                <input type="text" name="Home" id="Home" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Away</label>
                                <input type="text" name="away" id="away" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control input-sm" required>
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

        @foreach($data as $val)
        <div class="modal fade" id="edit{{$val['gtcode']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('biaya.update')}}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Pertandingan</h4>
                        </div>
                        <div class="modal-body">         
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Skor</label>
                                <input type="text" name="skor" id="skor" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Home</label>
                                <input type="text" name="Home" id="Home" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Away</label>
                                <input type="text" name="away" id="away" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control input-sm" required>
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
    </section>
</div>
@include('sweet::alert')
@endsection




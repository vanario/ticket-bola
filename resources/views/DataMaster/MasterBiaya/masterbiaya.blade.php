@extends('template')

@section('title', 'List Master Biaya')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <a data-toggle="modal" data-target="#add" class="btn btn-green" font-16" style="margin-bottom:30px;">Tambah</a>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>Nama Biaya</th>
                                <th>Type Biaya</th>
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
                    <form method="POST" action="{{ route('biaya.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Biaya</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Biaya</label>
                                <input type="text" name="nama_biaya" id="nama_biaya" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tipe Biaya</label>
                                <input type="text" name="tipe_biaya" id="tipe_biaya" class="form-control input-sm" required>
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
                            <h4>Edit Biaya</h4>
                        </div>
                        <div class="modal-body">         
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" name="gtcode" id="gtcode" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Biaya</label>
                                <input type="text" name="nama_biaya" id="nama_biaya" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tipe Biaya</label>
                                <input type="text" name="tipe_biaya" id="tipe_biaya" class="form-control input-sm" required>
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




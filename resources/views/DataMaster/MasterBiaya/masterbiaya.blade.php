@extends('template')

@section('title', 'List Master Biaya')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <div class="col-md-1">
                    <i class="fa fa-link" style="color:black; margin-top:8px;font-size:24px;"></i>
                </div>
                <div class="col-md-5">
                    <h4 style="font-size:24px;">Master Biaya</h4>
                </div>
                <div class="col-md-6" style="margin-top:-15px; text-align: right;">
                    <a data-toggle="modal" data-target="#add" class="btn btn-green" style="margin-bottom:30px;">Tambah</a>                    
                </div>
            </div>
                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>Nama Biaya</th>
                                <th>Type Biaya</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($data != null)
                            @foreach($data as $val)
                            <tr>
                                <td>{{ $val['akunname'] or "-"}}</td>
                                <td>{{ $val['akuntype'] or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil" style="color:green"></span></a>
                                    <a href="{{action('DataMaster\MasterBiayaController@destroy',$val['gtcode'])}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="7">Data Kosong !!</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                    <ul class="pagination">
                        <li><a href="{{action('DataMaster\MasterBiayaController@page', 1 )}}" rel="prev">&laquo;</a></li>
                        @for ($i = 1; $i <= $total_page; $i++)
                            @if( $i+1 <= 15)
                            <li><a href="{{action('DataMaster\MasterBiayaController@page', $i )}}" id="paging">{{$i}}</a></li>
                            @endif
                        @endfor
                        <li><a href="{{action('DataMaster\MasterBiayaController@page', $total_page )}}" rel="next">&raquo;</a></li>
                    </ul>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('master-biaya.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Biaya</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama Akun</label>
                                <input type="text" name="akunname" id="akunname" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tipe Biaya</label>
                                <input type="text" name="akuntype" id="akuntype" class="form-control input-sm" required>
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
        @if($data != null)
        @foreach($data as $val)
            <div class="modal fade" id="edit{{$val['gtcode']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('master-biaya.update')}}" >
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">
                            <div class="modal-header">
                                <h4>Edit Biaya</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="gtcode" value="{{$val['gtcode']}}" id="gtcode" class="form-control input-sm" required>
                                <div class="form-group">
                                    <label for="">Nama Biaya</label>
                                    <input type="text" name="akunname" value="{{$val['akunname']}}" id="nama_biaya" class="form-control input-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tipe Biaya</label>
                                    <input type="text" name="akuntype" value="{{$val['akuntype']}}" id="tipe_biaya" class="form-control input-sm" required>
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
        @endif
    </section>
</div>
@include('sweet::alert')
@endsection

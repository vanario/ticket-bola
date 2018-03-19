@extends('template')

@section('title', 'List User')

@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">


                <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>

                                <th>Email</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $val)
                            <tr>
                                <td>{{ $val['userid'] or "-"}}</td>
                                <td>{{ $val['username'] or "-"}}</td>
                                <td>{{ $val['telp'] or "-"}}</td>
                                <td>{{ $val['jenis_kelamin'] or "-"}}</td>
                                <td>{{ $val['tgl_lahir'] or "-"}}</td>
                                <td>{{ $val['alamat'] or "-"}}</td>
                                <td>{{ $val['status'] or "-"}}</td>
                                <td>
                                    {{-- <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil"></span></a>  --}}     
                                    <a style="margin-top:-0px;" href="{{action('Register\RegisterController@approve',$val['gtcode'])}}" id="hapus" class="btn btn-green" >Aprrove</a>

                                </td>
                            </tr>
                            @endforeach
                                
                        </tbody>
                </table>

                   {{--  @for ($i = 1; $i <= $total; $i++)
                        <ul class="pagination">
                            <li><a href="{{action('DataMaster\MitraController@page', $i )}}" id="paging">{{$i}}</a></li>
                        </ul> 
                    @endfor --}}

            </div>
        </div>
    </section>
</div>
@include('sweet::alert')
@endsection

@section('script')

<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">

    $(function() {

        init_datepicker();
        init_datepicker1();
            
        function init_datepicker() {
            $('#tgl_lahir').datepicker({
             format: 'yyyy-m-d',
             autoclose: true
           });
        };

        function init_datepicker1() {
            $('#tgl_lahir1').datepicker({
             format: 'yyyy-m-d',
             autoclose: true
           });
        };
   
    });

</script>

@endsection


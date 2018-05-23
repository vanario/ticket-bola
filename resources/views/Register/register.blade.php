@extends('template')

@section('title', 'List User')

@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <div class="col-md-1">
                    <i class="fa fa-link" style="color:black; margin-top:8px;font-size:24px;"></i>
                </div>
                <div class="col-md-5">
                    <h4 style="font-size:24px;">Member</h4>                    
                </div>
            </div>
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
                                <a style="margin-top:-0px;" href="{{action('Register\RegisterController@approve',$val['gtcode'])}}" id="hapus" class="btn btn-green" >Aprrove</a>

                            </td>
                        </tr>
                        @endforeach
                            
                    </tbody>
            </table>
            <ul class="pagination">
                <li><a href="{{action('Register\RegisterController@page', 1 )}}" rel="prev">&laquo;</a></li> 
                @for ($i = 1; $i <= $total_page; $i++)
                    @if( $i+1 <= 15)                            
                    <li><a href="{{action('Register\RegisterController@page', $i )}}" id="paging">{{$i}}</a></li>
                    @endif
                @endfor
                <li><a href="{{action('Register\RegisterController@page', $total_page )}}" rel="next">&raquo;</a></li>
            </ul> 
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


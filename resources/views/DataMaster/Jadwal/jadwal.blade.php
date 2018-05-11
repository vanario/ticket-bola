@extends('template') 

@section('title', 'List Jadwal') 

@section('content')
<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <a href="{{action('DataMaster\JadwalController@createjadwal')}}" class="btn btn-green" font-16 " style="margin-bottom:20px; ">Tambah</a>

                    <table class="table table-striped " style="width: 100%; ">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Pukul</th>
                                <th>Event</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($data as $val)
                            <tr>
                                <td>{{ $val['namehome']." vs " .$val['nameaway'] }}</td>
                                <td>{{ $val['date'] or "- "}}</td>
                                <td>{{ $val['jam'] or "- "}}</td>
                                <td>{{ $val['event'] or "- "}}</td>
                                <td>
                                    <a href="{{action( 'DataMaster\JadwalController@edit',[$val['gttop'],$val[ 'gtcode']])}} "><i class=" fa fa-pencil " style="color:green "></i></a>
                                    <a href="{{action( 'DataMaster\JadwalController@destroy',[$val['gttop'],$val[ 'gtcode']])}} " id="hapus " ><i class="fa fa-trash "></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>                        
                    </table>
                    {!! $data->appends(Input::except('page'))->render() !!}                    
            </div>
        </div>
</div>
@include('sweet::alert')
@endsection
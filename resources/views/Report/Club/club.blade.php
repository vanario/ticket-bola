@extends('template')

@section('title', 'List Club')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <table class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th style="width:15%";>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $val)
                        <tr>
                            <td>{{ $val['name'] or "-"}}</td>
                            <td>
                                <a data-toggle="modal" data-target="#edit{{$val['gtcode']}}"><span class="fa fa-pencil" style="color: green"></span></a> 
                            </td>
                        </tr>
                        @endforeach
                            
                    </tbody>
                </table>
                {!! $data->appends(Input::except('page'))->render() !!}
            </div>
        </div>
    </section>
</div>
@include('sweet::alert')
@endsection



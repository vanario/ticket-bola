@extends('template')

@section('title', 'List Tribun')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <div class="row">
                    <div class="col-sm-2">
                        <a data-toggle="modal" data-target="#add" class="btn btn-green" font-16" style="margin-bottom:30px;">Tambah</a>
                    </div>
                    <form method="POST" action="{{ url('tribun/index') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}

                        <div class="col-sm-3" style="margin-top: 20px;">
                            <div class="form-group">
                                <select  name="gttopstadion" class="form-control" required>
                                    <option value=""> Filter Berdasarkan Stadion</option>
                                    @foreach($list_stadion as $gtcode => $name)
                                    <option value="{{$gtcode}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            <input type="submit" value="Filter" class="btn btn-green" >
                        </div>
                    </form>
                </div>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>Tribun</th>
                                <th>Kapasitas</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>{{ $data['tribun'] or "-"}}</td>
                                <td>{{ $data['kapasitas'] or "-"}}</td>
                                <td>{{ $data['description'] or "-"}}</td>
                            </tr>
                                
                        </tbody>
                    </table>
                    {{-- {!! $data->appends(Input::except('page'))->render() !!} --}}
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('tribun.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Layout Tribun</h4>
                        </div>
                        <div class="modal-body">       
                            <div class="form-group">
                                <label for="">Tribun</label>
                                <input type="text" name="tribun" id="tribun" class="form-control" data-provide="typeahead" required>
                                <input type="text" name="tribun" id="gtcode" class="form-control input-sm" required>
                            </div>                                     
                            <div class="form-group">
                                <label for="">Stadion</label>
                                <select  name="gttop" class="form-control" required>
                                    <option value="">Stadion</option>
                                    @foreach($list_stadion as $gtcode => $name)
                                    <option value="{{$gtcode}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kapasitas</label>
                                <input type="text" name="kapasitas" id="kapasitas" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="description" id="description" class="form-control input-sm" required>
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

        <div class="modal fade" id="edit{{$data['gttop']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('tribun.update')}}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Layout Tribun</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Stadion</label>
                                <select  name="shift" class="form-control" required>
                                    <option value="">Stadion</option>
                                    @foreach($list_stadion as $gtcode => $name)
                                    <option value="{{$gtcode}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tribun</label>
                                <input type="text" name="tribun" value="{{$data['tribun']}}" id="tribun" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Kapasitas</label>
                                <input type="text" name="kapasitas" value="{{$data['kapasitas']}}" id="kapasitas" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="deskripsi" value="{{$data['description']}}" id="deskripsi" class="form-control input-sm" required>
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
    </section>
</div>
@endsection

@section('script')
@include('sweet::alert')
<script src="{{ asset('adminlte/bower_components/bootstrap-typeahead.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/jquery.mockjax.js') }}"></script> 

<script type="text/javascript">
    $(function() {
        function displayResult(item) {            
            $("#tribun").val(item.value);
        }
        var colors = ["red", "blue", "green", "yellow", "brown", "black"];
        $('#gtcode').typeahead({source: colors});

</script>

{{-- <script type="text/javascript">
    $(function() {
        function displayResult(item) {            
            $("#tribun").val(item.value);
        }
        var colors = ["red", "blue", "green", "yellow", "brown", "black"];
        $('#gtcode').typeahead({
            source: [
                { id: 1 , name: 'Vvip' },
                { id: 2 , name: 'vip1' },
                { id: 3 , name: 'vip2' },
                { id: 4 , name: 'timur' },
                { id: 5 , name: 'utara' },
                { id: 6 , name: 'selatan' },
            ],
            onSelect: displayResult
        });
    });

</script> --}}

@endsection


@extends('layouts.app')

@section('content')
@include('sweet::alert')

<div class="container">
    <div class="row">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#f0f0f0">
                <div class="modal-header" style="color:MediumSeaGreen;">
                    <div class="col-md-6">
                        <h4>TiX Pad</h4>
                    </div>
                    {{-- <div class="col-md-6">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#Login" aria-controls="Login" role="tab" data-toggle="tab">Login</a></li>
                            <li role="presentation"><a href="#Registration" aria-controls="Registration" role="tab" data-toggle="tab">Registration</a></li>
                        </ul><!-- end: header nav tabs-->
                    </div> --}}
                </div>
                <h3 style="text-align: center; ">Welcome TixPad</h3> 
                <div class="modal-body" style="margin-top: 40px; background-color:#f0f0f0">
                    <form class="form-horizontal" method="POST" action="{{ url('auth/index') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-4 control-label">   
                                <i class="fa fa-user" style="font-size:18px; color: MediumSeaGreen;" ></i>
                            </div>
                            <div class="col-md-6">
                                <input type="text" style="background-color:#f0f0f0;" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-4 control-label">   
                                <i class="fa fa-lock" style="font-size:18px; color:MediumSeaGreen;" ></i>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="password" style="background-color:#f0f0f0;" type="password" placeholder="Password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>  
                        </div>                       
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-green">
                                    Login
                                </button>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

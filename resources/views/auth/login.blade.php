@extends('layouts.app')

@section('content')
@include('sweet::alert')

<div class="container">
    <div class="page-login">
        <div class="row">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="color:MediumSeaGreen;">
                        <div class="col-md-6">
                            <h4>TiX Pad</h4>
                        </div>
                    </div>
                    <h3 style="text-align: center; ">Welcome TixPad</h3> 
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{ url('auth/index') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="text"  id="email" class ="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="text" id="password" class ="form-control" type="password" placeholder="Password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div> 
                             <div class="form-group">
                                  <label>
                                    <input type="checkbox" value="remember-me"> Ingat saya
                                  </label>
                            </div>                      
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-success btn-block">
                                    Login
                                </button>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

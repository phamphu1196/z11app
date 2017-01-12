@extends('layouts.app')
@section('style')
    <style type="text/css">
        .well {
            margin-top: 80px;
        }
    </style>
@endsection
@section('navbar')
  @include('includes.navbar')
@endsection
@section('content')
<div class="container">
    <div class="col-xs-4 col-xs-offset-4 form-login well">
        <img class="img-circle logo" src="http://icons.veryicon.com/ico/System/Plump/Document%20write.ico" style="width: 20%;height: 20%;"></img>

        <form action="{{ url('login') }}" method="POST" role="form" id="login-form">
            <legend class="text-center">Sign in</legend>
            {{ csrf_field() }}
            @if (Session::has("register_success"))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Well done!</strong> {{ Session::get("register_success") }} <br>
                    </div>          
            @endif
            @if($errors->has('username'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ $errors->first('username') }} <br>
                    </div>                  
                
            @endif
            <div class="form-group">
                <label for="username">Email</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <input type="text" class="form-control" id="email" placeholder="email" name="email">
                </div>
            </div>
            {{-- End of Username Input --}}
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="" name="remember">
                    Remenber Me
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 20px;padding-bottom: 10px" id="login">
            <i class="fa fa-spinner fa-spin fa-fw" style="display: none"></i>   Login</button>
        </form>

        <div class="forget col-xs-6 left" style="padding-top: 20px;">
            <a href="{{ url('/register') }}" title="Forget Password">Register</a>
        </div>
        <div class="forget col-xs-6 right" style="padding-top: 20px;">
            <a href="{{ url('/forget') }}" title="Forget Password">Forget Password?</a>
        </div>      
    </div>
</div>
@endsection
@section('script')
    {{-- <script src="{{ asset('public/js/additional-methods.min.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src=" {{ asset('/js/loginvalidate.js') }}"></script>

@stop
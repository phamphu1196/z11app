@extends('layouts.app')
@section('title')
	chinh sua thong tin
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/sidebar.css') }}">
    <style type="text/css">
        .content-body {
        	margin-top: 40px;
        	/*background: #fafafa;*/
        }
        .nav-stacked {
        	background: #ffffff;
        }
        .well {
        	background: #ffffff;
        }
        .edituserid {
            margin-top: 80px;
        }
        .img-circle {
            border-radius: 50%;
        }
    </style>
@endsection
@section('navbar')
  @include('includes.navbar')
@endsection
@section('content')
    <div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <div class="panel panel-primary edituserid">
             <div class="panel-heading">Chinh sua thong tin</div>
                <div class="panel-body">
                    <div class="formedit">
                <form action="{{ url('edituser') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="col-xs-3 col-xs-offset-1 img_user">
                        <figure><img class="img-circle" id="logo-img" onclick="document.getElementById('avatar').click();" src="{{ asset('image/gx4.jpg') }}" alt=""/></figure>
                        <input type="file" style="display: none" onchange="addNewLogo(this)" id="avatar" name="avatar" accept="image/*">
                        <div class="old_username"><h4><a href=""><span class="glyphicon glyphicon-user"></span>{{ session('name') }}</a></h4></div>
                    </div>
                    <div class="col-xs-6 col-xs-offset-1">
                        <label for="">Name:</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon-user"></i>
                            <input type="text" name="name" id="name" value=""><br>
                        </div>
                        <button type="submit" name="savedb" id="savedb" class="btn btn-large btn-block btn-info">EditProfile</button>
                        {{-- <input class="glyphicon glyphicon-pencil" type="submit" name="savedb" id="savedb" value="Edit Profile"> --}}
                    </div>
                </form>
            </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>
<link rel="stylesheet" href="{{ asset('/css/style_updateuser.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('public/css/hover.css') }}"> --}}
<script src="{{ asset('/js/changimage.js') }}" type="text/javascript"></script>
@endsection
@section('script')
    
@stop
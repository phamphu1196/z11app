@extends('layouts.app')

@section('title')
	Profile
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/sidebar.css') }}">
    <style type="text/css">
        .content-body {
        	margin-top: 40px;
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
        #logo-img {
            border: 2px solid #95a5a6;
        }
        img {
            cursor: pointer;
        }
        .panel-body {
            min-height: 300px;
            padding: 50px 20px;
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
                <!-- Panel -->
                <div class="panel panel-primary edituserid">

                    <div class="panel-heading">Chỉnh sửa thông tin</div>

                    <div class="panel-body">
                        <div class="formedit">
                            <form action="{{ url('edituser') }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                
                                <!-- Profile picture -->
                                <div class="col-xs-4">
                                    <?php
                                        $src = (session('image')) ? session('image') : "{{ asset('image/user-avatar.png') }}";
                                    ?>
                                    <figure><img class="img-responsive" id="logo-img" onclick="document.getElementById('avatar').click();" src="{{ $src }}" alt=""/></figure>
                                    <input type="file" style="display: none" onchange="addNewLogo(this)" id="avatar" name="image" accept="image/*">
                                    <h4 style="text-align: center; color: blue">Chọn ảnh</h4>
                                </div>

                                <!-- User information -->
                                <div class="col-xs-8">
                                    @if (session('status'))
                                        <div class="alert alert-success">{{ session('status') }}</div>
                                    @endif

                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input class="form-control" name="name" id="name" value="{{ session('name') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" readonly="" name="email" value="{{ session('email') }}" />
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success" name="savedb" id="savedb">Sửa thông tin</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- End Panel -->
            </div>
        </div>  
    </div>  
@endsection

@section('script')
    <script src="{{ asset('/js/changimage.js') }}" type="text/javascript"></script>
@stop

@extends('layouts.app')

@section('title')
    Folders
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/sidebar-category.css') }}">
    <style type="text/css">
        .content-body {
          margin-top: 60px;
          /*background: #fafafa;*/
        }
        .nav-stacked {
          background: #ffffff;
        }
        .well {
          background: #ffffff;
        }
        .content {
            margin-top: 80px;
            background: #ffffff;
            margin-left: 50px;
            margin-right: 50px;
        }
        .abc {
            width: 100%;
        }
        .panel {
            margin-top: 30px;
        }
        .panel-pricing {
            -moz-transition: all .3s ease;
            -o-transition: all .3s ease;
            -webkit-transition: all .3s ease;
        }
        .panel-pricing:hover {
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.2);
        }
        .panel-pricing .panel-heading {
            padding: 20px 10px;
        }
        .panel-pricing .panel-heading .fa {
            margin-top: 10px;
            font-size: 58px;
        }
        .panel-pricing .list-group-item {
            color: #777777;
            border-bottom: 1px solid rgba(250, 250, 250, 0.5);
        }
        .panel-pricing .list-group-item:last-child {
            border-bottom-right-radius: 0px;
            border-bottom-left-radius: 0px;
        }
        .panel-pricing .list-group-item:first-child {
            border-top-right-radius: 0px;
            border-top-left-radius: 0px;
        }
        .panel-pricing .panel-body {
            background-color: #f0f0f0;
            font-size: 20px;
            color: #777777;
            padding: 20px;
            margin: 0px;
        }
        .dropdown-menu:hover {
            box-shadow: 4px 4px 4px #888888;
            background-color: #B1EEE3;
        }
        .clearnfix {
            clear: both;
        }
        .button-add button {
            float: right;
            width: 10%;
        }
        .modal-body {
            width: 80%;
            margin-left: 50px;
        }
        .links {
            float: left;
            width: 90%;
        }
        .url-pkg {
            display: none;
        }
        #coin-value {
            color: red;
            font-style: italic;
            font-weight: bold;
            font-size: 16px;
        }

        #modal-coin-id , .modal-content{
            width: 70%;
            margin-top: 90px;
            margin-left: 150px;
        }
        .modal-header {
            background: blue;
        }
        .modal-body {
            width: 90%;
            margin-left: 10px;
        }
    </style>
@endsection

@section('navbar')
    @include('includes.navbar')
@endsection

@section('sidebar-total-top')
    @include('includes.sidebar-top')
    <?php 
        if(session('language')){
            $session = session('language'); 
        }
        else{
            $session = 0;
        }
    ?>
    <li class="nav-head"><a href="{{ url('/') }}">Danh sách package</a></li> 

    @foreach($folder['package'] as $package)
        <li><a href="{{ url('/') }}">{{ $package['translate_name_text'][$session]['text_value'] }}</a></li>
    @endforeach
@endsection

@section('content-sidebar-total-top')
    @include('includes.sidebar-middle')

    <!-- Breadcrumb -->
    <div class="links">
        <ol class="breadcrumb">
            <?php
                $category = $folder['category'];
                $cur_url = 'folder/'.changeTitle($folder['translate_name_text'][$session]['text_value'].' '.$folder['folder_id']);
            ?>
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item">{{ $folder['translate_name_text'][$session]['text_value'] }}</li>
        </ol>
    </div>
    <div class="button-add">
        <button type="button" class="btn btn-success" data-toggle="modal" href='#modal-id'>Add</button>
    </div>
    <div class="clearnfix"></div>

    <!-- Notification -->
    @if (session('failedNoti'))
        <div class="alert alert-danger">
            {{ session('failedNoti') }}
        </div>
    @endif

    <!-- Show main content -->
    @foreach($folder['package'] as $package)
        <?php
            $folder_id = $package['package_id'];
            $text_value = changeTitle($package['translate_name_text'][$session]['text_value'].' '.$folder_id);
        ?>
        <a class="pkg-coin" href="#">
            <div class="url-pkg">
                <input type="hidden" class="coin" value="{{ $package['package_cost'] }}">
                <input type="hidden" class="pkg-link" value="{{ url('/package/'.$text_value) }}">
            </div>
            <div class="col-md-3 text-center">
                <div class="panel panel-warning panel-pricing">
                    <img src="{{ asset('image/package-icon.jpg') }}" style="width: 100%;" alt="">
                    <h3>{{ $package['translate_name_text'][$session]['text_value'] }}</h3>
                    <h4 style="color: green">Cost: {{ $package['package_cost'] }}</h4>
                </div>
            </div>
        </a>     
    @endforeach
@endsection

@section('end-sidebar-total-top')
     @include('includes.sidebar-buttom')
@endsection

@section('content')
    <!-- Modal buy package -->    
    <div class="modal fade" id="modal-coin-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Xác nhận</h4>
                </div>
                
                <form action="{{ url('confirm-purchase') }}" method="POST" role="form">
                    <div class="modal-body">                      
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="url" id="url" value="">
                        <input type="hidden" name="coin" id="coin" value="">
                        <input type="hidden" name="cur_url" value="{{ $cur_url }}">
                        <p>Bạn có muốn mua gói này với giá <span id="coin-value" name="coin-value"></span> coin không?</p>                        
                        {{-- <a id="url" href="#" type="submit" class="btn btn-primary">Mua</a> --}}    
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Mua</button>
                    </div>
                </form>               
            </div>
        </div>
    </div> 

    <!-- Modal Add -->
    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Package</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('addpackage') }}" method="POST" role="form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="folder_id" value="{{ $folder['folder_id'] }}">
                        <input type="hidden" name="name_text" value="{{ changeTitle($folder['translate_name_text'][$session]['text_value'].' '.$folder['folder_id']) }}">

                        <div class="form-group">
                            <label for="">Tên</label>
                            <input type="text" class="form-control" id="text_value" name="text_value" placeholder="Tên package">
                        </div> 
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <input type="text" class="form-control" id="describe_value" name="describe_value" placeholder="Mô tả">
                        </div> 
                        <div class="form-group">
                            <label for="">Giá</label>
                            <input type="text" class="form-control" id="package_cost" name="package_cost" placeholder="Giá">
                        </div>     
                        <button type="submit" id="add_package" name="add_package" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar-total-buttom')
    @include('includes.sidebar-category-buttom')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.pkg-coin').click(function(event) {
                // alert(1);
                var coin = $(this).children('.url-pkg').children('.coin').val();
                var redirect = $(this).children('.url-pkg').children('.pkg-link').val();
                // alert(redirect);
                if(parseInt(coin) > 0){
                    $('#modal-coin-id').modal('show');
                    $("#modal-coin-id #coin-value").html(coin);
                    $("#modal-coin-id #url").attr('value', redirect);
                    $("#modal-coin-id #coin").attr('value', coin);
                }
            });
        });
    </script>
@stop 

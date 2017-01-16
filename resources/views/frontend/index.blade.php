@extends('layouts.app')

@section('title')
	Z11 App
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
            width: 10%;
            float: right;
        }
        .modal-body {
            width: 80%;
            margin-left: 50px;
        }
        .nav li.nav-head {
            background: #3498db;
            color: white;
            font-size: 18px;
            padding: 10px;
        }
        .nav li.nav-items div ul li a {
            padding-left: 50px; 
            color: #e74c3c;
        }
        .links {
            width: 90%;
            float: left;
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

    <li class="nav-head"><i class="fa fa-bars fa-fw" disabled></i>Chuyên mục</li>
    <?php $i = 1; ?>
    @foreach($categories as $category)
        <?php $href = "collapse".$i++; ?>
        <li class="nav-items">
            <a data-toggle="collapse" data-parent="#accordion" href="#{{$href}}"><i class="fa fa-list-alt fa-fw"></i>{{ $category['category_code'] }}</a>
            <div id="{{$href}}" class="panel-collapse collapse">
                <ul class="nav nav-stacked">
                @foreach ($category['folder'] as $folder)
                    <?php
                        $folder_id = $folder['folder_id'];
                        $category_code = changeTitle($category['category_code']);
                        $text_value = changeTitle($folder['translate_name_text'][$session]['text_value']);
                    ?>
                    <li><a href="{{ url($category_code.'/'.$folder_id.'/'.$text_value) }}">{{ $folder['translate_name_text'][$session]['text_value'] }}</a></li>
                @endforeach
                </ul>
            </div>
        </li>
    @endforeach
@endsection

@section('content-sidebar-total-top')

  @include('includes.sidebar-middle')

    <div class="links">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        </ol>
    </div>
    <div class="button-add">
        <button type="button" class="btn btn-success" data-toggle="modal" href='#modal-id'>Add Folder</button>
    </div>
    <div class="clearnfix"></div>
    <hr>

    @foreach($folders as $folder)
        <?php 
            $folder_id = $folder['folder_id'];
            $category_code = changeTitle($folder['category']['category_code']);
            $translate_name_text = changeTitle($folder['translate_name_text'][$session]['text_value']);
        ?>
        <a href="{{ url('/'.$category_code.'/'.$folder_id.'/'.$translate_name_text) }}">
            <div class="col-md-3 text-center">
                <div class="panel panel-warning panel-pricing">
                <img src="{{ asset('image/gx2.jpg') }}" style="width: 100%;" alt="">
                <h3>{{$folder['translate_name_text'][$session]['text_value']}}</h3>
                </div>
            </div>
        </a>
    @endforeach
@endsection

@section('end-sidebar-total-top')
    @include('includes.sidebar-buttom')
@endsection

@section('content')
    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Thêm thư mục</h4>
                </div>

                <div class="modal-body">
                    <form action="{{ url('addfolder') }}" method="POST" role="form">
                        <input type="hidden" name="language" id="language" class="form-control" value="en" required="required" title="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="">Chọn chủ đề</label>
                            <select name="category_id" id="category_id" class="form-control" required="required">
                                @foreach($categories as $category)
                                    <option value="{{ $category['category_id'] }}">{{ $category['category_code'] }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="">Tên</label>
                            <input type="text" class="form-control" id="text_value" name="text_value" placeholder="Ten thu muc">
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <input type="text" class="form-control" id="describe_value" name="describe_value" placeholder="Mieu ta thu muc">
                        </div>   
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="Authorization" name="Authorization" value="Bearer {\{{session('token')}}\}" placeholder="Mieu ta thu muc">
                        </div> 
                        <button type="submit" id="add_folder" name="add_folder" class="btn btn-primary">Add Folder</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- <div class="row text-center">
        <div class="col-xs-12">
            {{ $categories->links() }}
        </div>
    </div> --}}
@endsection

@section('script')  
@stop
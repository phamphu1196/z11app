@extends('layouts.app')
@section('title')
	tai lieu ca nhan
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/sidebar-timeline.css') }}">
    <style type="text/css">
        .content {
        	margin-top: 80px;

        	background: #ffffff;
        }
        .nav-stacked {
        	background: #ffffff;
        }
        .well {
        	background: #ffffff;
        }
        .text-center {
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
        .image{
            {
            background-image: url(image/gx1.jpg);
            background-repeat: no-repeat;
            background-position: 10px 25px;
            background-size:100%;

        }
    </style>
@endsection
@section('navbar')
  @include('includes.navbar')
@endsection
@section('sidebar-total-top')
    <div class="container">
        <div class="row">
         @include('includes.sidebar-user-top')
@endsection

@section('content-sidebar-total-top')
    <div class="col-md-9 content">
                <!-- item -->
                <div class="col-md-3 text-center">
                    <div class="panel panel-warning panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3>question 1</h3>
                        </div>
                        <div class="panel-body text-center">
                        {{-- <img src="{{ asset('image/gx1.jpg') }}" alt=""> --}}
                            <p>de bai</p>
                        </div>
                        <ul class="list-group text-center">

                        </ul>
                        <div class="panel-footer">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="panel panel-warning panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3>question 2</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p>de bai</p>
                        </div>
                        <ul class="list-group text-center">

                        </ul>
                        <div class="panel-footer">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="panel panel-warning panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3>question 2</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p>de bai</p>
                        </div>
                        <ul class="list-group text-center">

                        </ul>
                        <div class="panel-footer">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="panel panel-warning panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3>question 2</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p>de bai</p>
                        </div>
                        <ul class="list-group text-center">

                        </ul>
                        <div class="panel-footer">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="panel panel-warning panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3>question 2</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p>de bai</p>
                        </div>
                        <ul class="list-group text-center">

                        </ul>
                        <div class="panel-footer">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('end-sidebar-total-top')        
            
            </div>
        </div>
    </div>
     
@endsection

@section('script')
    
@stop
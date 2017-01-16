{{-- @extends('layouts.app')
@section('title')
  {{ $category['category_code'] }}
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
        /*.button-add button {
          margin-top: 10px;
        }*/
        .links {
          float: left;
          width: 90%;
        }
    </style>
@endsection
@section('navbar')
  @include('includes.navbar')
@endsection
@section('sidebar-total-top')
<?php 
  if(session('language')){
    $session = session('language'); 
  }
  else{
    $session = 0;
  }
  ?>
  @include('includes.sidebar-top')
  <li class="nav-head"><i class="fa fa-bars fa-fw" disabled></i>Chuyên mục</li>
    <?php $i = 1; ?>
    @foreach($categories as $category)
        <?php $href = "collapse".$i++; ?>
        <li class="nav-items">
            <a data-toggle="collapse" data-parent="#accordion" href="#{{$href}}"><i class="fa fa-list-alt fa-fw"></i>{{ $category['category_code'] }}</a>
            <div id="{{$href}}" class="panel-collapse collapse">
                <ul class="nav nav-stacked">
                @foreach ($folders as $folder)
                  @if ($folder['category']['category_id'] == $category['category_id'])
                    <li><a href="{{ url($category['category_code'].'/'.$folder['translate_name_text'][$session]['text_value']) }}">{{ $folder['translate_name_text'][$session]['text_value'] }}</a></li>
                  @endif
                @endforeach
                </ul>
            </div>
        </li>
  <li class="nav-head"><a href="{{ url($category['category_code'].'/'.$folder['translate_name_text'][$session]['text_value']) }}">Chuyen muc: {{ $folder['translate_name_text'][$session]['text_value'] }}</a></li> 

                @foreach($packages as $package)
                    <li><a href="{{ url($category['category_code'].'/'.$folder['translate_name_text'][$session]['text_value'].'/'.$package['translate_name_text'][$session]['text_value']) }}">{{ $package['translate_name_text'][$session]['text_value'] }}</a></li>
                @endforeach
@endsection

@section('content-sidebar-total-top')
  @include('includes.sidebar-middle')
    <div class="links">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url($category['category_code'].'/'.$folder['translate_name_text'][$session]['text_value']) }}">{{ $folder['translate_name_text'][$session]['text_value'] }}</a></li>
      </ol>
    </div>
      <div class="button-add">
        <button type="button" class="btn btn-success" data-toggle="modal" href='#modal-id'>Add Folder</button>
     </div>
     <div class="clearnfix"></div>
        @foreach($packages as $package)
        <a href="{{ url($category['category_code'].'/'.$folder['translate_name_text'][$session]['text_value'].'/'.$package['translate_name_text'][$session]['text_value']) }}">
            <div class="col-md-3 text-center">
                <div class="panel panel-warning panel-pricing">
                        <img src="{{ asset('image/gx3.jpg') }}" style="width: 100%;" alt="">
                        <h3>{{$package['translate_name_text'][$session]['text_value']}}</h3>
                    <div class="panel-body text-center">
                      
                    </div>
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
             <h4 class="modal-title">Them Thu Muc</h4>
           </div>
           <div class="modal-body">
             <form action="{{ url('addfolder') }}" method="POST" role="form">
             
               <div class="form-group">
                 <label for="">Ten thu muc:</label>
                 <input type="text" class="form-control" id="name_folder" name="name_folder" placeholder="Ten thu muc">
               </div>      
               <button type="submit" id="add_folder" name="add_folder" class="btn btn-primary">Add Folder</button>
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

@stop --}}
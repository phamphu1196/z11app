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
          float: right;
        }
        .modal-body {
          width: 80%;
          margin-left: 50px;
        }
    </style>
@endsection
@section('navbar')
  @include('includes.navbar')
@endsection
@section('sidebar-total-top')
  @include('includes.sidebar-top')
  <li class="active"><a href="{{ url('/') }}"><i class="fa fa-bars fa-fw"></i>Chuyen muc</a></li>
    @foreach($categories as $category)
        <li><a href="{{ url('/'.$category['category_code']) }}"><i class="fa fa-list-alt fa-fw"></i>{{ $category['category_code'] }}</a></li>
    @endforeach
@endsection
@section('content-sidebar-total-top')
  @include('includes.sidebar-middle')
    <div class="button-add">
        <button type="button" class="btn btn-success" data-toggle="modal" href='#modal-id'>Add Folder</button>
     </div>
     <div class="clearnfix"></div>
     <hr>
      @foreach($categories as $category)
            @foreach($category['folder'] as $folder)
                 <a href="{{ url('/folder/'.$folder['folder_id']) }}">
            <div class="col-md-3 text-center">
                <div class="panel panel-warning panel-pricing">
                        <img src="{{ asset('image/gx2.jpg') }}" style="width: 100%;" alt="">
                        <h3>{{$folder['item_code']}}</h3>
                    <div class="panel-body text-center">
                    
                    </div>
                    <ul class="list-group text-center">

                    </ul>
                </div>
            </div>
        </a>
        @endforeach
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
             <input type="hidden" name="language" id="language" class="form-control" value="en" required="required" title="">
             <div class="form-group">
                 <label for="">Chon category:</label>
                 <select name="category_id" id="category_id" class="form-control" required="required">
                  @foreach($categories as $category)
                      <option value="{{ $category['category_id'] }}">{{ $category['category_code'] }}</option>
                  @endforeach
                 </select>
               </div> 
               <div class="form-group">
                 <label for="">Ten thu muc:</label>
                 <input type="text" class="form-control" id="text_value" name="text_value" placeholder="Ten thu muc">
               </div>
               <div class="form-group">
                 <label for="">Mieu ta thu muc:</label>
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
@endsection
@section('script')
    
@stop
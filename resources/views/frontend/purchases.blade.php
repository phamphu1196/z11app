@extends('layouts.app')
@section('title')
	Purchases
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
        }
        .modal-body {
          width: 80%;
          margin-left: 50px;
        }
        /*.button-add button {
          margin-top: 10px;
        }*/
        .panel-success {
          margin-top: 10%;
        }
        .choose {
          border: 1px solid blue;
          margin-top: 2px;
          margin-left: 2px;
        }
        .abc {
          margin-left: 60px;
        }
        #step-2 {
          width: 80%;
          margin-left: 75px;
        }
        body{ margin-top:20px; }
    </style>
@endsection
@section('navbar')
  @include('includes.navbar')
@endsection
@section('content')     
    <div class="col-xs-8 col-xs-offset-2">
      <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Purchases</h3>
      </div>
      <div class="panel-body">
          <div class="row form-group">
                <div class="col-xs-12">
                    <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                        <li class="active"><a href="#step-1">
                            <h4 class="list-group-item-heading">Step 1</h4>
                            <p class="list-group-item-text">Chon thong tin</p>
                        </a></li>
                        <li class="disabled"><a href="#step-2">
                            <h4 class="list-group-item-heading">Step 2</h4>
                            <p class="list-group-item-text">Thanh toan</p>
                        </a></li>
                        <li class="disabled"><a href="#step-3">
                            <h4 class="list-group-item-heading">Step 3</h4>
                            <p class="list-group-item-text">Ket qua</p>
                        </a></li>
                    </ul>
                </div>
          </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-12 well setup-content text-center" id="step-1">
                        <div class="row abc">
                          <div class="col-xs-3 choose">
                            <div class="radio">
                              <label>
                                <input type="radio" name="card" id="card-zing" value="" checked="checked">
                                The Zing
                              </label>
                            </div>
                          </div>
                          <div class="col-xs-3 choose">
                            <div class="radio">
                              <label>
                                <input type="radio" name="card" id="card-atm-banking" value="">
                                ATM/Banking
                              </label>
                            </div>
                          </div>
                          <div class="col-xs-3 choose">
                            <div class="radio">
                              <label>
                                <input type="radio" name="card" id="card-visa-master-jcb" value="">
                                Visa/Master/JCB
                              </label>
                            </div>
                          </div>
                          <div class="col-xs-3 choose">
                            <div class="radio">
                              <label>
                                <input type="radio" name="card" id="card-phone" value="">
                                The dien thoai
                              </label>
                            </div>
                          </div>
                        </div>
                        <br><br>
                        <button id="activate-step-2" class="btn btn-primary btn-lg">Tiep tuc</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-12 well setup-content text-center" id="step-2">
                      <div class="form-group">
                      <label for="">Nhap seri:</label>
                        <input type="text" name="" id="input" class="form-control" value="" required="required" placeholder="****************">
                      </div>
                      <div class="form-group">
                      <label for="">Nhap Ma bao mat:</label>
                        <input type="text" name="" id="input" class="form-control" value="" required="required" placeholder="****************">
                      </div>
                        <button id="activate-step-3" class="btn btn-primary btn-lg">Nap</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-12 well setup-content text-center" id="step-3">
                        <h1 class="text-center"> STEP 3</h1>
                    </div>
                </div>
            </div>
      </div>
    </div>
    </div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
    
    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });
    
    $('ul.setup-panel li.active a').trigger('click');
    
    // DEMO ONLY //
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $(this).remove();
        $('ul.setup-panel li:eq(1)').addClass('active');
        $('ul.setup-panel li:eq(1)').show();
        
        $('ul.setup-panel li:eq(0)').removeClass('active');
    });
    
    $('#activate-step-3').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
       $(this).remove();
       $('ul.setup-panel li:eq(2)').addClass('active');
       $('ul.setup-panel li:eq(2)').show();
       $('ul.setup-panel li:eq(1)').removeClass('active');
    }); 
});


  </script>
@stop
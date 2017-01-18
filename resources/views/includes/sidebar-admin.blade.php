<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-toggle"></span>
      </button>
      <a class="navbar-brand" href="#">Dashboard</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> Admin <span class="caret"></span></a>
          <ul id="g-account-menu" class="dropdown-menu" role="menu">
            <li><a href="#">My Profile</a></li>
          </ul>
        </li>
        <li><a href="{{ url('logout') }}"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
      </ul>
    </div>
  </div><!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container">
<div class="row">
    <div class="col-md-3">
      <!-- Left column -->
      <a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"><strong>Pages</strong></span></a>  
      
      <hr>
      
      <ul class="list-unstyled">
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">
          <h5>Settings<i class="glyphicon glyphicon-chevron-down"></i></h5>
          </a>
            <ul class="list-unstyled collapse in" id="userMenu">
                <li class="active"> <a href="{{ url('admin/dashboard') }}"><i class="glyphicon glyphicon-home"></i>Dashboard</a></li>
                <li><a href="{{ url('admin/manager-member') }}"><i class="glyphicon glyphicon-envelope"></i> Manager Member <span class="badge badge-info">{{ count($members)}}</span></a></li>
                <li><a href="{{ url('admin/categories') }}"><i class="glyphicon glyphicon-cog"></i> Manager Category</a></li>
                <li><a href="{{ url('admin/folders') }}"><i class="glyphicon glyphicon-comment"></i> Manager Forder</a></li>
                <li><a href="{{ url('admin/packages') }}"><i class="glyphicon glyphicon-user"></i> Manager package</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-flag"></i> Manager Chapter</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-exclamation-sign"></i> Manager Group Question</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-off"></i> Manager Question</a></li>
            </ul>
        </li>
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2">
          <h5>Reports <i class="glyphicon glyphicon-chevron-right"></i></h5>
          </a>
        
            <ul class="list-unstyled collapse" id="menu2">
                <li><a href="#">Information & Stats</a>
                </li>
                <li><a href="#">Views</a>
                </li>
                <li><a href="#">Requests</a>
                </li>
                <li><a href="#">Timetable</a>
                </li>
                <li><a href="#">Alerts</a>
                </li>
            </ul>
        </li>
        <li class="nav-header">
        <a href="#" data-toggle="collapse" data-target="#menu3">
          <h5>Social Media <i class="glyphicon glyphicon-chevron-right"></i></h5>
          </a>
        
            <ul class="list-unstyled collapse" id="menu3">
                <li><a href="#"><i class="glyphicon glyphicon-circle"></i> Facebook</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-circle"></i> Twitter</a></li>
            </ul>
        </li>
      </ul>
  	</div><!-- /col-3 -->
    <div class="col-md-9">
      	
      <!-- column 2 -->	
      <ul class="list-inline pull-right">
         <li><a href="#"><i class="glyphicon glyphicon-cog"></i></a></li>
         <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-comment"></i><span class="count">3</span></a><ul class="dropdown-menu" role="menu"><li><a href="#">1. Is there a way..</a></li><li><a href="#">2. Hello, admin. I would..</a></li><li><a href="#"><strong>All messages</strong></a></li></ul></li>
         <li><a href="#"><i class="glyphicon glyphicon-user"></i></a></li>
         <li><a title="Add Widget" data-toggle="modal" href="#addWidgetModal"><span class="glyphicon glyphicon-plus-sign"></span> Add Widget</a></li>
      </ul>
      <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>  
      
      	<hr>
      
		<!--/row-->
<!-- /.modal -->



  
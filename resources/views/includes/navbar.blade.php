<nav class="navbar navbar-findcond navbar-fixed-top">
    <div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">Z11 App</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav navbar-right">

				@if(Session::has('token'))
					<li class="lgg">
						<select name="language" id="language" class="form-control" required="required">
							<option value="vi">VN</option>
							<option value="en" selected>EN</option>
						</select>
					</li>
					<form class="navbar-form navbar-right search-form" role="search">
						<input type="text" class="form-control" placeholder="Search" />
					</form>
					<li class="active"><a href="{{ url('purchases') }}" target="_blank">Nap tien<span class="sr-only">(current)</span></a></li>
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ session('name') }}<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('timeline') }}">Tai lieu ca nhan</a></li>
							<li><a href="{{ url('edituser') }}">Chinh sua thong tin</a></li>
							<li><a href="{{ url('/admin/dashboard') }}">Admin</a></li>
							<li><a href="{{ url('logout') }}"> <i class="fa fa-sign-out"></i>Đăng xuất</a></li>
						</ul>
					</li>
				@else
					<li><a href="{{ url('login') }}"><span class="glyphicon glyphicon-log-in"></span>    Đăng nhập</a></li>
                    <li><a href="{{ url('register') }}"> <span class="glyphicon glyphicon-user"></span>    Đăng ký</a></li>    
				@endif
				
			</ul>
			
		</div>
	</div>
</nav>
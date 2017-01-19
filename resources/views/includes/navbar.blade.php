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

				@if(!Session::has('token'))
					<li><a href="{{ url('login') }}"><span class="glyphicon glyphicon-log-in"></span>    Đăng nhập</a></li>
                    <li><a href="{{ url('register') }}"> <span class="glyphicon glyphicon-user"></span>    Đăng ký</a></li>
					
				@else
					<li>
						<form class="navbar-form navbar-right search-form" role="search">
							<div class="wrapper">
							  <div class="icon-search-container" data-ic-class="search-trigger">
							    <span class="fa fa-search"></span>
							    <input type="text" class="search-input" data-ic-class="search-input"/>
							    {{-- <span class="fa fa-times-circle" data-ic-class="search-clear"></span> --}}
							  </div>
							</div>
						</form>
					</li>
					
					
					<li class="active"><a href="{{ url('purchases') }}" target="_blank">Nạp tiền<span class="sr-only">(current)</span></a></li>
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ session('name') }}<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('timeline') }}">Tài liệu cá nhân</a></li>
							<li><a href="{{ url('edituser') }}">Chỉnh sửa thông tin</a></li>
							<li><a href="{{ url('/admin/dashboard') }}">Quản trị</a></li>
							<li><a href="{{ url('logout') }}"> <i class="fa fa-sign-out"></i>Đăng xuất</a></li>
						</ul>
					</li>    
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">language<span class="caret" id="language" name="language"></span></a>
						<ul class="dropdown-menu" role="menu">
							<?php $i = 0; ?>
							@foreach($languages as $language)
								<li><a class="lang" href="#" hreflang="{{ $i }}">{{ $language['description'] }}</a></li>
							<?php $i++; ?>
							@endforeach
						</ul>
						
					</li>
				@endif
					
			</ul>
			
		</div>
	</div>
</nav>

<style>
	nav.navbar-findcond { background: #3498db}
	nav.navbar-findcond a { color: #fff; }
	nav.navbar-findcond ul.navbar-nav a { color: #fff; border-style: none; }
	nav.navbar-findcond ul.navbar-nav a:hover,
	nav.navbar-findcond ul.navbar-nav a:visited,
	nav.navbar-findcond ul.navbar-nav a:focus,
	nav.navbar-findcond ul.navbar-nav a:active { background-color: #337ab7  }
	.navbar-brand { padding-top: 12px }
	.search-form {
	  box-sizing: border-box;
	}

	.wrapper {
	  text-align: center;
	  
	}
	.icon-search-container {
	  display: inline-block;
	  border: 2px solid #fff;
	  border-radius: 50px;
	  height: 30px;
	  width: 50px;
	  position: relative;
	  transition: width 0.2s ease-out;
	  backface-visibility: hidden;
	}
	.icon-search-container.active {
	  width: 285px;
	}
	.icon-search-container.active .fa-times-circle {
	  opacity: 1;
	}
	.icon-search-container.active .search-input {
	  width: 200px;
	}
	.icon-search-container .fa-search {
	  color: #fff;
	  font-size: 18px;
	  position: absolute;
	  top: 4px;
	  left: 8px;
	  cursor: pointer;
	}
	.icon-search-container .fa-times-circle {
	  opacity: 0;
	  color: #fff;
	  font-size: 14px;
	  position: absolute;
	  top: 5px;
	  right: 8px;
	  transition: opacity 0.2s ease-out;
	  cursor: pointer;
	}
	.icon-search-container .search-input {
	  position: absolute;
	  cursor: default;
	  left: 45px;
	  top: 0px;
	  width: 0;
	  padding: 5px;
	  border: none;
	  outline: none;
	  font-size: 18px;
	  line-height: 20px;
	  background-color: rgba(255, 255, 255, 0);
	  color: #fff;
	  transition: width 0.2s ease-out;
	}


	
</style>

<script>
	$(document).ready(function(){
  
	  var $searchTrigger = $('[data-ic-class="search-trigger"]'),
	      $searchInput = $('[data-ic-class="search-input"]'),
	      $searchClear = $('[data-ic-class="search-clear"]');
	  
	  $searchTrigger.click(function(){
	    
	    var $this = $('[data-ic-class="search-trigger"]');
	    $this.addClass('active');
	    $searchInput.focus();
	    
	  });
	  
	  $searchInput.blur(function(){
	    
	    if($searchInput.val().length > 0){
	      
	      return false;
	      
	    } else {
	      
	      $searchTrigger.removeClass('active');
	      
	    }
	    
	  });
	  
	  $searchClear.click(function(){
	    $searchInput.val('');
	  });
	  
	  $searchInput.focus(function(){
	    $searchTrigger.addClass('active');
	  });
	  
	});
</script>

@extends('layouts.app')
@section('title')
	DashBoard
@endsection
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/sidebar-admin.css') }}">
    <script src="{{ asset('/js/sidebar-admin.js') }}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    
    <style type="text/css">
        .pull-left {
        	float: right;
        }
        .modal-content {
        	width: 90%;
        }
        
        #delete-category .modal-content {
        	margin-top: 20%;
        	width: 50%;
        	margin-left: 30%;
        }
        .delete-header {
        	background: red;
        }
        .edit-header {
        	background: #0FD5C9;
        }

        .user_name_culum {
        	width: 40%;
        }
        .edit_culum , .delete_culum, .view_culum{
        	width: 30%;
        }
        .type_user_culum {
        	width: 20%;
        }
        .user_email_culum {
        	width: 60%;
        }
        .add-category-button button {
        	float: right;
        }
        .add-header {
        	background: blue;
        }
        .bd {
        	margin-left: 30px;
        }
        .user-left {
        	float: left;
        	width: 70%;
        }
        .user-left div{
        	padding: 10px;
        }
        .user-right {
        	float: left;
        	width: 30%;
        }
        .clearnfix {
        	clear: both;
        }
		.user-right  img {
			width: 80%;
		}
		.edit-header {
			background: #199E80;
		}
		.form-group {
			width: 90%;
			margin-left: 20px;
		}
		.user_id_culum {
			width: 15%;
		}

    </style>
@endsection
@section('sidebar-total-top')
    @include('includes.sidebar-admin')
@endsection

@section('content-sidebar-total-top')
	<div class="row">
		<div class="col-xs-12">
			<div class="add-category-button">
				<button type="button" class="btn btn-primary" data-toggle="modal" href='#add-member'><span class="	glyphicon glyphicon-plus">Add</span></button>
			</div>
		</div>
		<div class="content-category">
			<?php
				$i =1; 
			?>
			<table class="table table-hover" id="data-members" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="user_id_culum">STT -sort-</th>
						<th class="user_name_culum">User Name -sort-</th>
						<th class="user_email_culum">User Email -sort-</th>
						<th class="type_user_culum">Type User -sort-</th>
						<th class="view_culum">View</th>
						<th class="delete_culum">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($members as $user)
					<tr class="member">
						<td class="user_id_culum">{{$i}}</td>
						<td class="user_name_culum">{{ $user['profile']['name'] }}</td>
						<td class="user_email_culum">{{ $user['email'] }}</td>
						<td class="type_user_culum">{{ $user['type_user']['name_role'] }}</td>
						<td class="view_culum">
							<a class="view" name="view" data-toggle="modal" href='#view-member'><span class="glyphicon glyphicon-open">View</span></a>
						</td>
						<td class="delete_culum">
							<a class="delete" name="delete" data-toggle="modal" href='#delete-user'><span class="glyphicon glyphicon-trash">Delete</span></a>
						</td>
					</tr>
					<?php 
						$i++;
					?>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section('end-sidebar-total-top')
	@include('includes.sidebar-admin-buttom')
@endsection
@section('content')
<div class="modal fade" id="view-member">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header view-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title view-title"></h4>
			</div>
			<div class="modal-body bd">
				<div class="user-left">
					<div><strong>Name: </strong><span id="NAME"></span></div>
					<div><strong>Email: </strong><span id="EMAIL"></span></div>
					<div><strong>Gender: </strong><span id="GENDER"></span></div>
					<div><strong>Type user: </strong><span id="TYPE_USER"></span></div>
					<div><strong>Deadline: </strong><span id="DEADLINE"></span></div>
					<div><strong>Expired: </strong><span id="EXPIRED"></span></div>
				</div>
				<div class="user-right">
					<label for="img">Avatar:</label><br>
					<img src="" alt="loi hinh" id="IMAGE">
				</div>
				
			</div>
			<div class="clearnfix"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add-member">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header add-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add</h4>
				</div>
				{{-- <form action="{{ url('admin/category/add') }}" method="POST" role="form"> --}}
				<form action="{{ url('admin/member-mod/add') }}" method="POST" role="form" name="register" id="register-form">
		            <div id="errors">
		                @if (count($errors) > 0)
		                <div class="alert alert-danger" role="alert">
		                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                    @foreach ($errors->all() as $error)
		                        {{-- <span class="sr-only">Error:</span> --}}
		                        <li>{{$error}}</li>
		                    @endforeach
		                </div>
		                @endif
		            </div>
		            {{ csrf_field() }}
		            <div class="form-group">
		                <label for="username">Name</label>
		                <div class="input-group">
		                    <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
		                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" required="true"
		                    value="{{ old('name') }}">
		                </div>
		            </div>

		            <div class="form-group">
		                <label for="username">Email</label>
		                <div class="input-group">
		                    <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
		                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required="true" value="{{ old('email') }}">
		                </div>
		            </div>
		            {{-- End of Email --}}
		            <div class="form-group">
						<label>Gioi tinh</label><br>
		                
		                  <label class="radio-inline"><input type="radio" name="sex" value="Nam" checked="true">Nam</label>
		                  <label class="radio-inline"><input type="radio" name="sex" value="Nu" >Nu</label>
		            </div>
		            
		            <div class="form-group">
		                <label for="username">Password</label>
		                <div class="input-group">
		                    <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
		                    <input type="password" class="form-control" id="password" name="password" required="true" placeholder="Password">
		                </div>
		            </div>
		            {{-- End of Password --}}
					<div class="form-group">
		                <label for="username">Coin</label>
		                <div class="input-group">
		                    <div class="input-group-addon"><span class="glyphicon glyphicon-usd"></i></div>
		                    <input type="text" class="form-control" id="coin" name="coin" required="true" placeholder="Nhap coin">
		                </div>
		            </div>             

		            <div class="form-group">
		                <label for="username">Deadline</label>
		                <div class="input-group">
		                    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></i></div>
		                    <input type="date" class="form-control" id="deadline" name="deadline" required="true" placeholder="Ngay het han">
		                </div>
		            </div>              
		            {{-- End of Confirm Psssword --}}
		            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 20px;padding-bottom: 10px">Register</button>
		        </form>
					
				</div>

			</div>
		</div>
	</div>
	<div class="modal fade" id="delete-user">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header delete-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Delete</h4>
				</div>
				<form action="{{ url('admin/user/delete') }}" method="POST" role="form">
					<input type="hidden" name="_method" value="DELETE">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="modal-body">
					<div class="form-group">
					<input type="hidden" name="delete-user-id" id="delete-user-id" class="form-control" value="" required="required" pattern="" title="">
						Ban co chac muon delete <strong class="USER_NAME"></strong> khong
					</div>
					
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Delete Category</button>
					</div>
				</form>
				
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/js/validate.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
    		var table = $('#data-members').DataTable();
 
		    // Apply the search
		    table.columns().every( function () {
		        var that = this;
		    } );
    		$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			$('.view').click(function(event) {
				/* Act on the event */
				// alert(1);
				var user_id = $(this).parents('.member').children('.user_id_culum').text();
				var url_ = '/z11app/public/admin/users/'+user_id;
				$.get(url_, function(data) {
					$('.view-title').text(data['profile']['name']);
					$('#NAME').text(data['profile']['name']);
					$('#EMAIL').text(data['email']);
					$('#GENDER').text(data['profile']['gender']);
					if(data['type_user']) {
						$('#TYPE_USER').text(data['type_user']['name_role']);
						$('#DEADLINE').text(data['type_user']['deadline']);
						$('#EXPIRED').text(data['type_user']['expired']);
					}
					else{
						$('#TYPE_USER').text('');
						$('#DEADLINE').text('');
						$('#EXPIRED').text('');
					}
					$('#IMAGE').attr('src', data['profile']['image']);
				});
			});
    		$('.delete').click(function(event) {
    			/* Act on the event */
    			event.preventDefault();
    			var user_id = $(this).parents('.member').children('.user_id_culum').text();
				var url_ = '/z11app/public/admin/users/'+user_id;
	    		$.get(url_, function(data) {
	    			$('.USER_NAME').text(data['profile']['name']);
	    			$('#delete-user-id').val(data['id']);
	    		});
    		});
    		
    	});
    </script>
@stop
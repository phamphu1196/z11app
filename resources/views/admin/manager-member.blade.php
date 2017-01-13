@extends('layouts.app')
@section('title')
	DashBoard
@endsection
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/sidebar-admin.css') }}">
    <script src="{{ asset('/js/sidebar-admin.js') }}" type="text/javascript"></script>
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
        	width: 40%;
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
    </style>
@endsection
@section('sidebar-total-top')
    @include('includes.sidebar-admin')
@endsection

@section('content-sidebar-total-top')
	<div class="row">
		<div class="col-xs-12">
			<div class="add-category-button">
				<button type="button" class="btn btn-primary" data-toggle="modal" href='#add-category'><span class="	glyphicon glyphicon-plus">Add</span></button>
			</div>
		</div>
		<div class="content-category">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="user_id_culum">User ID</th>
						<th class="user_name_culum">User Name</th>
						<th class="user_email_culum">User Email</th>
						<th class="type_user_culum">Type User</th>
						<th class="view_culum">View</th>
						<th class="edit_culum">Edit</th>
						<th class="delete_culum">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr class="member">
						<td class="user_id_culum">{{$user['id']}}</td>
						<td class="user_name_culum">{{ $user['profile']['name'] }}</td>
						<td class="user_email_culum">{{ $user['email'] }}</td>
						<td class="type_user_culum">{{ $user['type_user']['name_role'] }}</td>
						<td class="view_culum">
							<a class="view" name="view" data-toggle="modal" href='#view-category'><span class="glyphicon glyphicon-open">View</span></a>
						</td>
						<td class="edit_culum">
							<a class="edit" name="edit" data-toggle="modal" href='#edit-category'><span class="glyphicon glyphicon-edit">Edit</span></a>
						</td>
						<td class="delete_culum">
							<a class="delete" name="delete" data-toggle="modal" href='#delete-user'><span class="glyphicon glyphicon-trash">Delete</span></a>
						</td>
					</tr>
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
<div class="modal fade" id="view-category">
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

<div class="modal fade" id="add-category">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header add-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add</h4>
				</div>
				<form action="{{ url('admin/category/add') }}" method="POST" role="form">
				<div class="modal-body">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="categ_id" id="categ_id" value="">
					<div class="form-group">
						<label for="">Category Code:</label>
						<input type="text" class="form-control" id="categor_code" name="categor_code" placeholder="Nhap .......">
					</div>
					<div class="form-group">
						<label for="">Image:</label>
						<input type="file" class="form-control" id="imag" name="imag" placeholder="Nhap ......." accept="image/x-png,image/gif,image/jpeg">
					</div>
					<div class="form-group">
						<label for="">Category translate:</label>
						<input type="text" class="form-control" id="text_valu" name="text_valu" placeholder="Nhap .......">
					</div>
					<div class="form-group">
						<label for="">Category description:</label>
						<input type="text" class="form-control" id="describe_valu" name="describe_valu" placeholder="Nhap .......">
					</div>
					
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-category">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header edit-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit</h4>
				</div>
				<form action="{{ url('admin/category/edit') }}" method="POST" role="form">
				<div class="modal-body">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="catego_id" id="catego_id" value="">
					<div class="form-group">
						<label for="">Category Code:</label>
						<input type="text" class="form-control" id="category_code" name="category_code" placeholder="Nhap .......">
					</div>
					<div class="form-group">
						<label for="">Image:</label>
						<input type="file" class="form-control" id="image" name="image" placeholder="Nhap ......." accept="image/x-png,image/gif,image/jpeg">
					</div>
					<div class="form-group">
						<label for="">Category translate:</label>
						<input type="text" class="form-control" id="text_value" name="text_value" placeholder="Nhap .......">
					</div>
					<div class="form-group">
						<label for="">Category description:</label>
						<input type="text" class="form-control" id="describe_value" name="describe_value" placeholder="Nhap .......">
					</div>
					
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Edit</button>
					</div>
				</form>
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
					<div class="modal-body">
					<div class="form-group">
						Ban co chac muon delete <strong class="USER_NAME"></strong> khong
					</div>
					
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-danger">Delete Category</button>
					</div>
				</form>
				
			</div>
		</div>
	</div>
@endsection
@section('script')
    <script type="text/javascript">
    	$(document).ready(function() {
    		$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			$('.view').click(function(event) {
				/* Act on the event */
				var user_id = $(this).parents('.member').children('.user_id_culum').text();
				var url_ = '/z11app/public/admin/users/'+user_id;
				$.get(url_, function(data) {
					$('.view-title').text(data['profile']['name']);
					$('#NAME').text(data['profile']['name']);
					$('#EMAIL').text(data['email']);
					$('#GENDER').text(data['profile']['gender']);
					$('#TYPE_USER').text(data['type_user']['name_role']);
					$('#DEADLINE').text(data['type_user']['deadline']);
					$('#EXPIRED').text(data['type_user']['expired']);
					$('#IMAGE').attr('src', data['profile']['image']);
				});
			});
    		$('.delete').click(function(event) {
    			/* Act on the event */
    			event.preventDefault();
    			var user_id = $(this).parents('.member').children('.user_id_culum').text();
    			alert(user_id);
				var url_ = '/z11app/public/admin/users/'+user_id;
	    		$.get(url_, function(data) {
	    			$('.USER_NAME').text(data['profile']['name'];
	    		});
    		});
    		$('.edit').click(function(event) {
    			/* Act on the event */
    			event.preventDefault();
    			var category_id = $(this).parents('.cate').children('.category_id').val();
    			var url = '/z11app/public/admin/category/'+category_id;
    			$.get(url, function(data) {
	    			$('#catego_id').val(data['category_id']);
	    			$('#category_code').val(data['category_code']);
	    			// $('#image').val(data['image']);
	    		});
    		});
    		
    	});
    </script>
@stop
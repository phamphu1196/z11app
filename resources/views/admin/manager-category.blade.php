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

        .stt {
        	width: 30%;
        }
        .edit_culum , .delete_culum, .add_culum{
        	width: 40%;
        }
        .cate_culum {
        	width: 60%;
        }
        .add-category-button button {
        	float: right;
        }
        .add-header {
        	background: blue;
        }
        .category_id_culum{
        	display: none;
        }
    </style>
@endsection
@section('sidebar-total-top')
    @include('includes.sidebar-admin')
@endsection

@section('content-sidebar-total-top')
<?php 
	$i = 1;
?>
	<div class="row">
		<div class="col-xs-12">
			<div class="add-category-button">
				<button type="button" class="btn btn-primary" data-toggle="modal" href='#add-category'><span class="	glyphicon glyphicon-plus">Add</span></button>
			</div>
		</div>
		
			@if (session('noti'))
				<div class="alert alert-success">
					{{ session('noti') }}
				</div>
			@endif
		
		<div class="content-category">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="stt">STT</th>
						<th class="category_id_culum"></th>
						<th class="cate_culum">Category Name</th>
						<th class="edit_culum">Edit</th>
						<th class="delete_culum">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
					<tr class="all-cate-culum">
						<td class="stt">{{ $i }}</td>
						<td class="category_id_culum">{{ $category['category_id'] }}</td>
						<td class="cate_culum">
							{{ '{' }}
							@foreach($category['translate_name_text'] as $translate_name_text)
								{{ $translate_name_text['language_code']}} => {{ $translate_name_text['text_value'] }} ,
							@endforeach
							{{ '}' }}
						</td>
						<td class="edit_culum">
							<a class="edit" name="edit" data-toggle="modal" href='#edit-category'><span class="glyphicon glyphicon-pencil">Edit</span></a>
						</td>
						<td class="delete_culum">
							<a class="delete" name="delete" data-toggle="modal" href='#delete-category'><span class="glyphicon glyphicon-trash">Delete</span></a>
						</td>
					</tr>
					<?php $i++; ?>
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
<div class="modal fade" id="add-category">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header add-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add</h4>
				</div>
				<form action="{{ url('admin/category/add') }}" method="POST" role="form">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="modal-body">
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
						<button type="submit" class="btn btn-primary">Add</button>
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
							<input type="text" class="form-control" id="describ_value" name="describ_value" placeholder="Nhap .......">
						</div>
					
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="delete-category">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header delete-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Delete</h4>
				</div>
				<form action="{{ url('admin/category/delete') }}" method="POST" role="form">
					<input type="hidden" name="_method" value="DELETE">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="cat_id" id="cat_id" class="form-control" value="" required="required" pattern="" title="">
						Ban co chac muon delete <strong class="cate_code"></strong> khong
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
    <script type="text/javascript">
    	$(document).ready(function() {
    		$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
    		$('.delete').click(function(event) {
    			/* Act on the event */
    			event.preventDefault();
    			var category_id = $(this).parents('.all-cate-culum').children('.category_id_culum').text();
    			// alert(category_id);
    			var url = '/z11app/public/admin/category/'+category_id;
    			$('#cat_id').val(category_id);
	    		$.get(url, function(data) {
	    			$('.cate_code').text(data['translate_name_text'][0]['text_value'])
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
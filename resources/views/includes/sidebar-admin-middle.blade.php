<div class="row">        
            <!-- center left-->	
         	<div class="col-md-8">
          <div class="row">
          @foreach($categories as $category)
            <div class="col-lg-6 col-md-6 cate">
            <input type="hidden" class="category_id" value="{{$category['category_id']}}">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">26</div>
                            <div>{{ $category['translate_name_text'][0]['text_value'] }}</div>
                        </div>
                    </div>
                </div>
                  <div class="panel-footer">
                      <div class="pull-left">
                        <a class="edit" name="edit" data-toggle="modal" href='#edit-category'><span class="glyphicon glyphicon-pencil">Edit</span></a>
                        <a class="delete" name="delete" data-toggle="modal" href='#delete-category'><span class="glyphicon glyphicon-trash">Delete</span></a>
                      </div>
                      <a href=""><span class="pull-right">View Details<i class="fa fa-arrow-circle-right"></i></span></a>
                      <div class="clearfix"></div>
                  </div>
            </div>
            </div>
          @endforeach
          </div>
          	</div><!--/col-->
        	<div class="col-md-4">
              
              	<div class="panel panel-default">
                	<div class="panel-heading">
                      	<div class="panel-title">
                  		<i class="glyphicon glyphicon-wrench pull-right"></i>
                      	<h4>Add Category</h4>
                      	</div>
                	</div>
                	<div class="panel-body">

                      <form class="form form-vertical">
                       
                        <div class="control-group">
                          <label>Category:</label>
                          <div class="controls">
                           <select name="category_code" id="category_code" class="form-control" required="required">
                            @foreach($categories as $category)
                             <option value="">{{ $category['translate_name_text'][0]['text_value'] }}</option>
                             @endforeach
                           </select>
                          </div>
                        </div>      
                        
                        <div class="control-group">
                          <label>Image:</label>
                          <div class="controls">
                          	<input type="file" name="image" id="image" class="form-control" value="" required="required" pattern="" title="" accept="image/x-png,image/gif,image/jpeg">
                          </div>
                        </div> 
                             
                        <div class="control-group">
                          <label>Name Folder:</label>
                          <div class="controls">
                             <input type="text" name="text_value" id="text_value" class="form-control" value="" required="required" pattern="" title="">
                          </div>
                        </div>    
                        
                        <div class="control-group">
                          	<label>Description:</label>
                            <div class="controls">
                              <input type="text" name="describe_value" id="describe_value" class="form-control" value="" required="required" pattern="" title="">
                            </div>
                        	<div class="controls">
                          <br>
                        	<button type="submit" class="btn btn-primary">
                              Add Category
                            </button>
                        	</div>
                        </div>   
                        
                      </form>
                
                
                  </div><!--/panel content-->
                </div><!--/panel-->
              
			</div><!--/col-span-6-->
     
      </div>
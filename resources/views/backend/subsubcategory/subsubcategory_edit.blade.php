@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">

          <!-------------------------------------------------Add subSubCategory ----------------------------------------------- -->
          <div class="col-12">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Edit Sub Sub Category</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       
       <form method="post" action="{{ route('subsubcategory.update') }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $subsubcategories->id }}">
					  <div class="row">
						<div class="col-12">                        
                                <div class="form-group">
								<h5>Select Category<span class="text-danger">:</span></h5>								
								<div class="controls">
									<select id="category_id" name="category_id" class="form-control">
										<option value="" selected="" disabled="" >Select Category</option>
                                        @foreach($categories as $category)
										<option value="{{ $category->id }}" {{ $category->id == $subsubcategories->category_id ? 'selected' : '' }} >{{ $category->category_name_en }}</option>	
                                        @endforeach									
									</select>
                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror                            
                                </div>
							    </div>	

                                <div class="form-group">
								<h5>Select Sub Category<span class="text-danger">:</span></h5>								
								<div class="controls">
									<select id="subcategory_id" name="subcategory_id" class="form-control">
										<option value="" selected="" disabled="" >Select Sub Category</option>
                                        @foreach($subcategories as $subsub)
										<option value="{{ $subsub->id }}" {{ $subsub->id == $subsubcategories->subcategory_id ? 'selected' : '' }} >{{ $subsub->subcategory_name_en }}</option>	
                                        @endforeach
                                        								
									</select>
                                    @error('subcategory_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror                            
                                </div>
							    </div>	

                                <div class="form-group">
								<h5>Sub Sub Category English <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="subsubcategory_name_en" name="subsubcategory_name_en" class="form-control" value="{{ $subsubcategories->subsubcategory_name_en }}">
                                    @error('subsubcategory_name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
							    </div>
                                <div class="form-group">
								<h5>Sub Sub Category Hindi <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="subsubcategory_name_hin" name="subsubcategory_name_hin" class="form-control" value="{{ $subsubcategories->subsubcategory_name_hin }}">
                                    @error('subsubcategory_name_hin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
							    </div>                                
                                
						<div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
						</div>
					</form>
      
   </div>
   <!-- /.box-body -->
 </div>
         
</div>

			
			<!-- /.col -->
		  </div>

          <!-------------------------------------------------End Add subSubCategory ----------------------------------------------- -->
		  
</div><!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>   

      <!-- <script type="text/javascript">
          $(document).ready(function(){
              $('select[name="category_id"]').on('change', function(){
                  var category_id = $(this).val();
                  if(category_id){
                      $.ajax({
                          url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
                          type:"GET",
                          dataType:"json",
                          success:function(data){
                              var d = $('select[name="subcategory_id"]').empty();
                              $.each(data, function(key, value){
                                  $('select[name="subcategory_id"]').append(
                                      '<option value="'+ value.id +'">' + value.subcategory_name_en +'</option>'
                                      );                                      
                              });
                          },
                      });
                  }else{
                      alert('danger');
                  }
              });
          });
      </script> -->

@endsection
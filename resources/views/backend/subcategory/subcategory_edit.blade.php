@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">

          <!-------------------------------------------------Add SubCategory ----------------------------------------------- -->
          <div class="col-12">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Edit Sub Category</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       
       <form method="post" action="{{ route('subcategory.update') }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $subcategory->id }}">
					  <div class="row">
						<div class="col-12">                        
                                <div class="form-group">
								<h5>Sub Category English <span class="text-danger">:</span></h5>								
								<div class="controls">
									<select id="category_id" name="category_id" class="form-control">
										<option value="" selected="" disabled="" >Select Category</option>
                                        @foreach($categories as $category)
										<option value="{{ $category->id }}" 
                                        {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name_en }}</option>	
                                        @endforeach									
									</select>
                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror                            
                                </div>
							    </div>	

                                <div class="form-group">
								<h5>Sub Category English <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="subcategory_name_en" name="subcategory_name_en" class="form-control" value="{{ $subcategory->subcategory_name_en }}">
                                    @error('subcategory_name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
							    </div>
                                <div class="form-group">
								<h5>Sub Category Hindi <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="subcategory_name_hin" name="subcategory_name_hin" class="form-control"  value="{{ $subcategory->subcategory_name_hin }}">
                                    @error('subcategory_name_hin')
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

          <!-------------------------------------------------End Add SubCategory ----------------------------------------------- -->
		  
</div><!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>   

@endsection
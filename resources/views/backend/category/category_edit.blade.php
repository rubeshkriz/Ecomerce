@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">

          <!-------------------------------------------------Add Category ----------------------------------------------- -->
          <div class="col-12">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Add Category</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       
       <form method="post" action="{{ route('category.update', $category->id) }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $category->id }}">
					  <div class="row">
						<div class="col-12">
                        <div class="form-group">
								<h5>Category English <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="category_name_en" name="category_name_en" class="form-control" value="{{ $category->category_name_en }}">
                                        @error('category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                </div>
							    </div>	

                                <div class="form-group">
								<h5>Category Hindi <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="category_name_hin" name="category_name_hin" class="form-control" value="{{ $category->category_name_hin }}">
                                    @error('category_name_hin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
							    </div>

                                <div class="form-group">
								<h5>Category icon <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="category_icon" name="category_icon" class="form-control" value="{{ $category->category_icon }}">
                                    @error('category_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
							    </div>
                                
						<div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Create">
						</div>
					</form>
      
   </div>
   <!-- /.box-body -->
 </div>
         
</div>

			
			<!-- /.col -->
		  </div>

          <!-------------------------------------------------End Add Category ----------------------------------------------- -->
		  
</div><!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>   

@endsection
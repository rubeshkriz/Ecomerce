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
     <h3 class="box-title">Add Division</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       
       <form method="post" action="{{ route('division.update') }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $divisions->id }}">
					  <div class="row">
						<div class="col-12">
                        <div class="form-group">
								<h5>Division Name <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="division_name" name="division_name" class="form-control" value="{{ $divisions->division_name }}">
                                        @error('division_name')
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
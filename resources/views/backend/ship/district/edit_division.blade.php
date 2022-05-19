@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">

          <!-------------------------------------------------Add Category ----------------------------------------------- -->
          <div class="col-4">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Edit District</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       
       <form method="post" action="{{ route('district.update',$district->id) }}" >
                    @csrf
					  <div class="row">
						<div class="col-12">

                        <div class="form-group">
								<h5>Select Division <span class="text-danger">:</span></h5>								
								<div class="controls">
									<select id="division_id" name="division_id" class="form-control">
										<option value="" selected="" disabled="" >Select Category</option>
                                        @foreach($division as $div)
										<option value="{{ $div->id }}" {{ $div->id == $district->division_id ? 'selected' : '' }}>{{ $div->division_name }}</option>	
                                        @endforeach									
									</select>
                                    @error('division_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror                            
                                </div>
							    </div>	

                        <div class="form-group">
								<h5>District Name <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="district_name" name="district_name" class="form-control" value="{{ $district->district_name }}">
                                        @error('district_name')
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

          <!-------------------------------------------------End Add Category ----------------------------------------------- -->
		  
</div><!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>   

@endsection
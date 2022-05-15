@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row"> 

 <!-------------------------------------------------Edit Slider ----------------------------------------------- -->
          <div class="col-12">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Edit Slider</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       
       <form method="post" action="{{ route('slider.update') }}" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="id" value="{{$sliders->id}}">
                    <input type="hidden" name="old_image" value="{{$sliders->slider_img}}">
					  <div class="row">
						<div class="col-12">
                        <div class="form-group">
                        <h5>Slider Title <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="title" name="title" class="form-control" value="{{ $sliders->title }}">
                                </div>
							    </div>	
                                <div class="form-group">
								<h5>Slider Description <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="description" name="description" class="form-control" value="{{ $sliders->description }}">                                    
                                </div>
							    </div>
                                <div class="form-group">
								<h5>Slider Image <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="file" name="slider_img" class="form-control">
                                    @error('slider_img')
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

          <!-------------------------------------------------End Edit SLider ----------------------------------------------- -->
		  
</div><!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>

@endsection
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
     <h3 class="box-title">Edit Coupon</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       
       <form method="post" action="{{ route('coupon.update', $coupons->id) }}" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $coupons->id }}">
					  <div class="row">
						<div class="col-12">
                        <div class="form-group">
								<h5>Coupon Name <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="coupon_name" name="coupon_name" class="form-control" value="{{ $coupons->coupon_name	 }}">
                                        @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                </div>
							    </div>	

                                <div class="form-group">
								<h5>Coupon Discount(%) <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="coupon_discount" name="coupon_discount" class="form-control" value="{{ $coupons->coupon_discount	 }}">
                                    @error('coupon_discount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
							    </div>

                                <div class="form-group">
								<h5>Coupon Valdity Date <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="date" id="coupon_valdity" name="coupon_valdity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $coupons->coupon_valdity	 }}">
                                    @error('coupon_valdity')
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
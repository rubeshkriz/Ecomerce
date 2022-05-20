@extends('frontend.main_master')
@section('content')

@section('title')
My Checkout
@endsection


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">



	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

				<!-- guest-login -->			
				<div class="col-md-6 col-sm-6 already-registered-login">
					<h4 class="checkout-subtitle"><b>Shipping Address	</b></h4>
					<form class="register-form" role="form">
						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Shipping Name</b><span>*</span></label>
					    <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Full Name" value="{{ Auth::user()->name }}" required="">
					  </div>

						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Shipping Email</b><span>*</span></label>
					    <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Email" value="{{ Auth::user()->email }}" required="">
					  </div>

						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Phone</b><span>*</span></label>
					    <input type="number" name="shipping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Phone" value="{{ Auth::user()->phone }}" required="">
					  </div>

						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"><b>Post Code</b><span>*</span></label>
					    <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="PostCode" required="">
					  </div>

					
				</div>	
				<!-- guest-login -->

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">

				
				<div class="col-md-12">
                                        <div class="form-group">
								            <h5><b>Division Select</b> <span class="text-danger">*</span></h5>
								            <div class="controls">
                                            <select name="division_id" id="select" required="" class="form-control">
                                                <option value="" selected="" disabled="" >Select Division</option>
                                                @foreach($divisions as $item)
                                                <option value="{{ $item->id }}">{{ $item->division_name }}</option>
                                                @endforeach                                                
                                            </select>
                                            @error('division_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
								            </div>
							            </div>
                                    

                                        <div class="form-group">
								            <h5><b>District Select</b> <span class="text-danger">*</span></h5>
								            <div class="controls">
                                            <select name="district_id" id="select" required="" class="form-control">
                                                <option value="" selected="" disabled="" >Select District</option>
                                                @foreach($divisions as $item)
                                                <option value="{{ $item->id }}">{{ $item->division_name }}</option>
                                                @endforeach                                                
                                            </select>
                                            @error('district_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
								            </div>
							            </div>

                                        <div class="form-group">
								            <h5><b>State Select</b> <span class="text-danger">*</span></h5>
								            <div class="controls">
                                            <select name="state_id" id="select" required="" class="form-control">
                                                <option value="" selected="" disabled="" >Select State</option>
                                                @foreach($divisions as $item)
                                                <option value="{{ $item->id }}">{{ $item->division_name }}</option>
                                                @endforeach                                                
                                            </select>
                                            @error('state_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
								            </div>
							            </div>

										<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Notes<span>*</span></label>
						<textarea class="form-control" name="notes" cols="30" rows="5" placeholder="Notes"></textarea>
					  </div>


                                    

					  <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
					</form>
				</div>	

				</div>			
			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!-- End checkout-step-01  -->
					    
					  	
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
		    </div>
		    <div class="">
				<ul class="nav nav-checkout-progress list-unstyled">
                    @foreach($carts as $item)
					<li>
                    <strong>Image: </strong>
                    <img src="{{ asset($item->options->image) }}" style="height:50px; width:50px;">
                    <strong>Qty: </strong>
                    ( {{ $item->qty }} )
                    <strong>Color: </strong>
                    {{ $item->options->color }}
                    <strong>size: </strong>
                    {{ $item->options->size }}
                    </li>					<hr>
                    @endforeach
                    <li>
                        @if(Session::has('coupon'))
                    <strong>SubTotal: </strong> ${{ $cartTotal }} <hr>
                    <strong>Coupon Name: </strong> ${{ session()->get('coupon')['coupon_name'] }} ({{ session()->get('coupon')['coupon_discount'] }}  %) <hr>
                    <strong>Coupon Discount: </strong>${{ session()->get('coupon')['discount_amount'] }}<hr>
                    <strong>Grand Total: </strong>$ {{ session()->get('coupon')['total_amount'] }}<hr>
                        @else
                    <strong>SubTotal: </strong> ${{ $cartTotal }} <hr>
                    <strong>GrandTotal: </strong> ${{ $cartTotal }} <hr>
                        @endif

                    </li>
				</ul>		
			</div>
		</div>
	</div>
</div> 
<!-- checkout-progress-sidebar -->				</div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->

        @include('frontend.body.brand')
</div><!-- /.body-content -->

@endsection

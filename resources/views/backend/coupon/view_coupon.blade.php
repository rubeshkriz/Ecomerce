@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
<div class="col-8">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Coupon List</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">
         <table id="example1" class="table table-bordered table-striped">
           <thead>
               <tr>
                    <th>Coupon Name</th>
                   <th>Coupon Discount</th>
                   <th>Valdity</th>
                   <th>Status</th>
                   <th>Action</th>                   
               </tr>
           </thead>
           <tbody>
               @foreach($coupons as $item)
               <tr>
                    <td>{{ $item->coupon_name }}</td>
                   <td>{{ $item->coupon_discount }} %</td>
                   <td>{{ Carbon\Carbon::parse($item->coupon_valdity)->format('D, d F Y') }}</td>

<td>
@if($item->coupon_valdity >= Carbon\Carbon::now()->format('Y-m-d'))
                     <span class="badge badge-pill badge-success"> Valid </span>
                   @else
                     <span class="badge badge-pill badge-danger"> In Valid </span>
                   @endif   
</td> 

                   <td style="width:20%;">
                       <a href="{{ route('category.edit', $item->id) }}" class="btn btn-info btn-sm" title="Edit Data">
                           <i class="fa fa-pencil"></i>
                       </a>
                       <a href="{{ route('category.delete', $item->id) }}" id="delete" class="btn btn-danger btn-sm" title="Delete Data">
                       <i class="fa fa-trash"></i>
                       </a>
                   </td>                   
               </tr>   
               @endforeach            
           </tbody>
           
         </table>
       </div>
   </div>
   <!-- /.box-body -->
 </div>
         
</div>

			
			<!-- /.col -->
		  



          <!-------------------------------------------------Add Category ----------------------------------------------- -->
          <div class="col-4">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Add Coupon</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       
       <form method="post" action="{{ route('coupon.store') }}" >
                    @csrf
					  <div class="row">
						<div class="col-12">
                        <div class="form-group">
								<h5>Coupon Name <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="coupon_name" name="coupon_name" class="form-control">
                                        @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                </div>
							    </div>	

                                <div class="form-group">
								<h5>Coupon Discount(%) <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="coupon_discount" name="coupon_discount" class="form-control">
                                    @error('coupon_discount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
							    </div>

                                <div class="form-group">
								<h5>Coupon Valdity Date <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="date" id="coupon_valdity" name="coupon_valdity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
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
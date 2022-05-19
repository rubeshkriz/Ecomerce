@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
<div class="col-8">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">State List</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">
         <table id="example1" class="table table-bordered table-striped">
           <thead>
               <tr>
                    <th>Division Name</th>                  
                    <th>District Name</th>                  
                    <th>State Name</th>                  
                    <th>Action</th>                  
               </tr>
           </thead>
           <tbody>
               @foreach($state as $item)
               <tr>
                    <td>{{ $item->division_id }}</td>
                    <td>{{ $item->district_id }}</td>
                    <td>{{ $item->state_name}}</td>
                   <td style="width:20%;">
                       <a href="{{ route('district.edit', $item->id) }}" class="btn btn-info btn-sm" title="Edit Data">
                           <i class="fa fa-pencil"></i>
                       </a>
                       <a href="{{ route('district.delete', $item->id) }}" id="delete" class="btn btn-danger btn-sm" title="Delete Data">
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
		  



          <!-------------------------------------------------Add State ----------------------------------------------- -->
          <div class="col-4">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Add State</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       
       <form method="post" action="{{ route('district.store') }}" >
                    @csrf
					  <div class="row">
						<div class="col-12">

                        <div class="form-group">
								<h5>Select Division <span class="text-danger">:</span></h5>								
								<div class="controls">
									<select id="division_id" name="division_id" class="form-control">
										<option value="" selected="" disabled="" >Select Category</option>
                                        @foreach($division as $div)
										<option value="{{ $div->id }}">{{ $div->division_name }}</option>	
                                        @endforeach									
									</select>
                                    @error('division_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror                            
                                </div>
							    </div>	

                        <div class="form-group">
								<h5>Select District <span class="text-danger">:</span></h5>								
								<div class="controls">
									<select id="district_id" name="district_id" class="form-control">
										<option value="" selected="" disabled="" >Select Category</option>
                                        @foreach($district as $div)
										<option value="{{ $div->id }}">{{ $div->district_name }}</option>	
                                        @endforeach									
									</select>
                                    @error('district_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror                            
                                </div>
							    </div>	

                        <div class="form-group">
								<h5>State Name <span class="text-danger">:</span></h5>
								<div class="controls">
									<input type="text" id="state_name" name="state_name" class="form-control">
                                        @error('state_name')
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
@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
<div class="col-12">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Publish All Reviews</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">
         <table id="example1" class="table table-bordered table-striped">
           <thead>
               <tr>
                    <th>Summary</th>
                   <th>Comment</th>
                   <th>User</th>
                   <th>Product</th>
                   <th>Status</th>
                   <th>Action</th>                   
               </tr>
           </thead>
           <tbody>
               @foreach($review as $item)
               <tr>
                    <td>{{ $item->summary }}</td>
                   <td>{{ $item->comment }}</td>
                   <td>{{ $item->user->name }}</td>
                   <td>{{ $item->product->product_name_en }}</td>
                   <td>
                       @if($item->status == 0)
                       <span class="badge badge-pill badge-primary">Pending</span></td>
                       @elseif($item->status == 1)
                       <span class="badge badge-pill badge-success">Publish</span></td>
                       @endif



                   <td style="width:20%;">
                   <a href="{{  route('delete.review',$item->id)}}" id="delete" class="btn btn-danger">Delete</a>
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

</div><!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>   

@endsection
@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		

		<!-- Main content -->
		<section class="content">
<div class="row">
			  

		  



          <!-------------------------------------------------Add Search ----------------------------------------------- -->
    <div class="col-4">

        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Search By Date</h3>
        </div>
        <!-- /.box-header -->
            <div class="box-body">
            
            <form method="post" action="{{ route('search-by-date') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h5>Select Date <span class="text-danger">:</span></h5>
                                        <div class="controls">
                                            <input type="date" id="date" name="date" class="form-control">
                                                @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                        </div>
                                    </div>	

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                                    </div>
                                </div>
                            </div>
            </form>
            
            </div>
        <!-- /.box-body -->
                
                
        </div>			
                <!-- /.col -->

    </div>

    <!-- //////////////////////////////////Search By Month //////////////////////// -->

    <div class="col-4">

        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Search By Month</h3>
        </div>
        <!-- /.box-header -->
            <div class="box-body">
            
            <form method="post" action="{{ route('search-by-month') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h5>Select Month <span class="text-danger">:</span></h5>
                                        <div class="controls">
                                            <select name="month" class="form-control">
                                                <option label="Choose One"></option>
                                                <option label="January">January</option>
                                                <option label="February">February</option>
                                                <option label="March">March</option>
                                                <option label="April">April</option>
                                                <option label="May">May</option>
                                                <option label="June">June</option>
                                                <option label="July">July</option>
                                                <option label="August">August</option>
                                                <option label="September">January</option>
                                                <option label="October">October</option>
                                                <option label="November">November</option>
                                                <option label="December">December</option>
                                            </select>
                                                @error('month')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                        </div>
                                    </div>	
                                    <div class="form-group">
                                        <h5>Select Year <span class="text-danger">:</span></h5>
                                        <div class="controls">
                                            <select name="year_name" class="form-control">
                                                <option label="Choose One"></option>
                                                <option label="2020">2020</option>
                                                <option label="2021">2021</option>
                                                <option label="2022">2022</option>
                                                <option label="2023">2023</option>
                                                <option label="2024">2024</option>
                                                <option label="2025">2025</option>
                                                <option label="2026">2026</option>                                          
                                            </select>
                                                @error('year_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                        </div>
                                    </div>	

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                                    </div>
                                </div>
                            </div>
            </form>
            
            </div>
        <!-- /.box-body -->
                
                
        </div>			
                <!-- /.col -->

    </div>

    <div class="col-4">

<div class="box">
<div class="box-header with-border">
    <h3 class="box-title">Select year</h3>
</div>
<!-- /.box-header -->
    <div class="box-body">
    
    <form method="post" action="{{ route('search-by-year') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                        <div class="form-group">
                                        <h5>Select Year <span class="text-danger">:</span></h5>
                                        <div class="controls">
                                            <select name="year" class="form-control">
                                                <option label="Choose One"></option>
                                                <option label="2020">2020</option>
                                                <option label="2021">2021</option>
                                                <option label="2022">2022</option>
                                                <option label="2023">2023</option>
                                                <option label="2024">2024</option>
                                                <option label="2025">2025</option>
                                                <option label="2026">2026</option>                                          
                                            </select>
                                                @error('year')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                        </div>
                                    </div>		

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                            </div>
                        </div>
                    </div>
    </form>
    
    </div>
<!-- /.box-body -->
        
        
</div>			
        <!-- /.col -->

</div>
          <!-------------------------------------------------End Add Search ----------------------------------------------- -->


          
		  

</div><!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>   

@endsection
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">

<meta name="csrf-token" content="{{ csrf_token() }}">   <!-- //For AJAX request -->

<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<!-- Toaster CDN -->
<link rel="stylesheet" type="text/css" href="https:cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>
<body class="cnt-home">

<!-- Header Start -->
@include('frontend.body.header')
<!-- Header End -->

@yield('content')
<!-- /#top-banner-and-menu --> 

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script> 
<script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
        toastr.info(" {{ Session::get('message') }} ");
        break;
        
        case 'success':
        toastr.success(" {{ Session::get('message') }} ");
        break;

        case 'warning':
        toastr.warning(" {{ Session::get('message') }} ");
        break;

        case 'error':
        toastr.error(" {{ Session::get('message') }} ");
        break;
    }
    @endif
  </script>


<!-- Add to Cart Product Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span></strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <img src="" id="pimage" class="card-img-top" alt="..." style="height:200px; width:200px;">        
          </div>
          </div>
          <div class="col-md-4">
          <ul class="list-group">
            <li class="list-group-item">Product Price: <strong class="text-danger">$<span id="pprice"></span></strong>
            <del id="oldprice">$</del>
          </li>
            <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
            <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
            <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
            <li class="list-group-item">Stock: 
              <span class="badge bage-pill badge-success" id="available" style="background: green; color:white;"></span>
              <span class="badge bage-pill badge-danger" id="stockout" style="background: red; color:white;"></span>
            </li>
          </ul>
          </div>
          <div class="col-md-4">
          <div class="form-group" id="colorArea">
            <label for="color">Choose Color:</label>
            <select class="form-control" id="color" name="color">

            </select>
          </div>
          <div class="form-group" id="sizeArea">
            <label for="size">Choose Size:</label>
            <select class="form-control" id="size" name="size">

            </select>
          </div>
          <div class="form-group">
            <label for="qty">Quantity:</label>
            <input type="number" class="form-control" id="qty" value="1" min="1">
          </div>

          <input type="hidden" id="product_id" >

          <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add To Cart</button>
          </div>
        </div>
      </div><!--  //end modal body -->

      <script>
        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')       ///Referece of top Meta Tag
          }
        })

        //Start product view with Modal
        function productview(id){
          $.ajax({
            type: 'GET',
            url: '/product/view/modal/'+id,                                 ///Route "Ajax req for product Details Geting"
            dataType:'json',
            success:function(data){
              // console.log(data);
              $('#pname').text(data.product.product_name_en);               ///Data Fix by ID
              $('#price').text(data.product.selling_price);
              $('#pcode').text(data.product.product_code);
              $('#pcategory').text(data.product.category.category_name_en); ///How To Use Relation Ship With Table
              $('#pbrand').text(data.product.brand.brand_name_en);

              $('#pimage').attr('src','/'+data.product.product_thambnail);  ///HoW to use IMAGE

              $('#product_id').val(id);                                     ///Hidden Input Acess
              $('#qty').val(1);                                     

              //product price
              if(data.product.discount_price == null){                      ///Conditioned Data Fixing
                $('#pprice').text('');
                $('#oldprice').text('');
                $('#pprice').text(data.product.selling_price);
              }else{
                $('#pprice').text(data.product.discount_price);
                $('#oldprice').text(data.product.selling_price);
              }

              //stock
              if(data.product.product_qty > 0){
                $('#available').text('')
                $('#stockout').text('')
                $('#available').text('available')
              }else{
                $('#available').text('')
                $('#stockout').text('')
                $('#stockout').text('stockout')
              }

              //color
              $('select[name="color"]').empty();                              ///Name Attribute Accessing, And make "Empty" old Array of Datas
              $.each(data.color,function(key,value){                          ///Lopp the Arrayb Of Datas  
                $('select[name="color"]').append('<option value=" '+value+' ">'+value+'</option>')
              });
              if(data.color == ""){
                  $('#colorArea').hide();                                       ///Jquery Animation Condition
                }else{
                  $('#colorArea').show();
                }

              //size
              $('select[name="size"]').empty();
              $.each(data.size,function(key,value){              
                $('select[name="size"]').append('<option value=" '+value+' ">'+value+'</option>')
                if(data.size == ""){
                  $('#sizeArea').hide();
                }else{
                  $('#sizeArea').show();
                }
                
              });
            }
          })
        }

        //////////////////////end product view modal

            //start add to cart product

            function addToCart(){
              var product_name = $('#pname').text();
              var id = $('#product_id').val();
              var color = $('#color option:selected').text();
              var size = $('#size option:selected').text();
              var quantity = $('#qty').val();

              $.ajax({
                type: "post",
                dataType: "json",
                data:{
                  color:color, size:size, quantity:quantity, product_name:product_name
                },
                url: "/cart/data/store/"+id,
                success:function(data){
                  miniCart()
                  $('#closeModal').click();
                  // console.log(data);

                  //Start Message => LIKE TOASTER "SWEET ALERT"
                  const Toast = Swal.mixin({
                                            toast:true,
                                            position: 'top-end',
                                            icon: 'success',
                                            showConfirmButton: false,
                                            timer: 3000
                                          })
                                      if($.isEmptyObject(data.error)){
                                        Toast.fire({
                                          type: 'success',
                                          title: data.success
                                        })
                                      }else{
                                        Toast.fire({
                                          type: 'Error',
                                          title: data.error
                                        })
                                      }
                  //End Message 
                }
              })

            }


            //End add to cart product
      </script>

      <script type="text/javascript">

        function miniCart(){
          $.ajax({
            type: 'GET',
            url: '/product/mini/cart',
            dataType:'json',
            success:function(response){

              $('span[id="cartSubTotal"]').text(response.cartTotal);
              $("#cartQty").text(response.cartQty);

              var miniCart = ""

              $.each(response.carts, function(key,value){
                  miniCart += `<div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                      <div class="price">$ ${value.price} * ${value.qty} psc</div>
                    </div>
                    <div class="col-xs-1 action"> <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>`
              
              });
              $('#miniCart').html(miniCart);

            }
          })
        }

        miniCart();

        /////Mini Cart Remove Start

        function miniCartRemove(rowId){
          $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/'+rowId,
            dataType: 'json',
            success:function(data){
              miniCart();

              ///start Message
              const Toast = Swal.mixin({
                                        toast:true,
                                        position: 'top-end',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 3000
                                      })
                                  if($.isEmptyObject(data.error)){
                                    Toast.fire({
                                      type: 'success',
                                      title: data.success
                                    })
                                  }else{
                                    Toast.fire({
                                      type: 'Error',
                                      title: data.error
                                    })
                                  } 
              ///End Message

            }
          })
        }



        /////Mini Cart Remove END

      </script>

      <!-- //////////         Start Wishlist         //////////// -->
      <script type="text/javascript">
        function addToWishList(product_id){
          $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-wishlist/"+product_id,

            success:function(data){
                           ///start Message
                           const Toast = Swal.mixin({
                                        toast:true,
                                        position: 'top-end',                                        
                                        showConfirmButton: false,
                                        timer: 3000
                                      })
                                  if($.isEmptyObject(data.error)){
                                    Toast.fire({
                                      type: 'success',
                                      icon: 'success',
                                      title: data.success
                                    })
                                  }else{
                                    Toast.fire({
                                      type: 'error',
                                      icon: 'error',
                                      title: data.error
                                    })
                                  } 
              ///End Message

            }
          })
        }
      </script>
      <!-- //////////         End Wishlist         //////////// -->

      <!-- //////////   Start  Load  Wishlist page ////////////////// -->
      
      <script type="text/javascript">
         function wishlist(){
          $.ajax({
            type: 'GET',
            url: '/get-wishlist-product',
            dataType:'json',
            success:function(response){

              var rows = ""

              $.each(response, function(key,value){
                  rows += `<tr>
					<td class="col-md-2"><img src="/${value.product.product_thambnail}" alt="imga"></td>
					<td class="col-md-7">
						<div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
						<div class="rating">
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star rate"></i>
							<i class="fa fa-star non-rate"></i>
							<span class="review">( 06 Reviews )</span>
						</div>
						<div class="price">
            ${value.product.discount_price == null ? `$ ${value.product.selling_price}` : `$ ${value.product.discount_price} <span>$ ${value.product.selling_price}</span>` }
							
						</div>
					</td>
					<td class="col-md-2">
          <button data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productview(this.id)" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i>Add To Cart</button>
					</td>
					<td class="col-md-1 close-btn">
						<a href="#" class=""><i class="fa fa-times"></i></a>
					</td>
				</tr>`
              
              });
              $('#wishlist').html(rows);

            }
          })
        }

        wishlist();
      </script>


      <!-- //////////   End  Load  Wishlist page ////////////////// -->


    </div>
  </div>
</div>
<!-- End Add to Cart Product Modal -->

  
</body>
</html>

          $(function(){
            $(document).on('click', '#delete',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
title: 'Are you sure?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = link;
  Swal.fire(
    'Deleted!',
    'Your file has been deleted.',
    'success'
  )
}
});

            });
        });

        ////      CONFIRM          ///
          $(function(){
            $(document).on('click', '#confirm',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
title: 'Are you sure to confirm?',
text: "Once Confirm, Youll Be not able To Pending!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Confirm it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = link;
  Swal.fire(
    'Confirm!',
    'Confirm Changes!',
    'success'
  )
}
});

            });
        });


        ////      Processing          ///
          $(function(){
            $(document).on('click', '#processing',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
title: 'Are you sure to processing?',
text: "Once processing, Youll Be not able To Confirmed!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Processing it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = link;
  Swal.fire(
    'Processing!',
    'Processing Changes!',
    'success'
  )
}
});

            });
        });


        ////      picked          ///
          $(function(){
            $(document).on('click', '#picked',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
title: 'Are you sure to picked?',
text: "Once picked, Youll Be not able To Confirmed!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, picked it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = link;
  Swal.fire(
    'picked!',
    'picked Changes!',
    'success'
  )
}
});

            });
        });


        ////      shipped          ///
          $(function(){
            $(document).on('click', '#shipped',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
title: 'Are you sure to shipped?',
text: "Once shipped, Youll Be not able To Confirmed!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, shipped it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = link;
  Swal.fire(
    'shipped!',
    'shipped Changes!',
    'success'
  )
}
});

            });
        });


        ////      delivered          ///
          $(function(){
            $(document).on('click', '#delivered',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
title: 'Are you sure to delivered?',
text: "Once delivered, Youll Be not able To Confirmed!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delivered it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = link;
  Swal.fire(
    'delivered!',
    'delivered Changes!',
    'success'
  )
}
});

            });
        });
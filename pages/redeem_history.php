 
<style>
div.dataTables_wrapper .dataTables_length {
    float: right;
    margin-right: 10px;
}
</style>

<div class="container-fluid py-2"> 
      <div class="row mt-4">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header py-2 border-bottom">
              <div class="d-flex align-items-center justify-content-between"> 
                  <h6 class = "mb-0">Redeem History</h6>
                  <div class = "mb-0">
					<button class = "mb-0 btn-sm btn btn-danger f-6" onclick= "reset_redeem();">Reset</button>
				  </div>
              </div>
            </div>
            <div class="card-body px-0 pt-2">
              <div class="pe-4 ps-4 pb-4">
			  
			  <div class = "mt-1 mb-4"> 
				 
				 <div class="w-100 form-floating mb-1 border rounded-3">
					<!-- IP Address input with pattern validation -->
					<input type="text" class="form-control ps-2 text-center fw-bold fs-5" id="reportrange">
					<label for="reportrange">Date Range:</label>
				  </div> 
							  
			  </div>
					
              <table class="table table-hover table-dark responsive nowrap" width="100%" id = "myTable">
                  <thead class = 'thead-dark'>
                    <tr> 
					  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">#</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Points</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Reward Time</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">User</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Remaining Points</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Date Redeem</th> 
                    </tr>
                  </thead>
                  <tbody id = 'tablex'>
                     
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div> 
<script>

   
    var cdpTableInit;
    $(document).ready(function()
    {   
    });
     
    function getallsales(df, dt)
    {
		Swal.fire({
			title: 'Loading...',
			text: 'Please wait while we process your request.',
			allowOutsideClick: false, // Prevent closing by clicking outside
			didOpen: () => {
				Swal.showLoading(); // Show the loading spinner
			}
		});
	
      $.post("../router/router.php", {'request': 'redeem_history', df: df, dt:dt}, function(data)
      {   
        if(cdpTableInit) {
          $("#tablex").html("")
          cdpTableInit.destroy();
		}   
		
        $("#tablex").html(data);
		cdpTableInit = $('#myTable').DataTable({
			responsive: true,
			pageLength: 10,               // Default number of rows per page
			searching: true,              // Enable searching
			order: [[0, 'asc']],          // Default sort by the first column
			dom: '<"top"lBf>t<"bottom"ip>', // Custom DOM layout
			buttons: ['csv', 'excel'],    // Buttons for CSV and Excel export
			columnDefs: [
				{ targets: [0], orderable: false }  // Disable sorting for the first column
			],
			lengthMenu: [
				[10, 25, 50, -1],         // Available options: 10, 25, 50, and All
				['10 rows', '25 rows', '50 rows', 'Show All'] // Custom text for each option
			]
		});




		Swal.close();

      });
    }


$(function() {

  var start = moment().subtract(0, 'days');
  var end = moment();

  function cb(start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      var df = start.format('Y-M-D');
      var dt = end.format('Y-M-D');
      getallsales(df, dt); 
  }

  $('#reportrange').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
  }, cb);

  cb(start, end);

});



function reset_redeem() {  
    Swal.fire({
        title: 'Delete all records?',
        text: "Are you sure?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Reset!'
    }).then((result) => {
        if (result.isConfirmed) { 
              
            $.post("../router/router.php", { request: "reset_data",table: 'redeem_history' }, function(data) {
                if (data > 0) {
                    Swal.fire({
                        title: 'Successfully deleted!',
                        text: "Reset Sales",
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) { 
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire('Error!', 'Failed to reset sales.', 'error');
                }
            });
        }
    });
}

  </script>
<style>
div.dataTables_wrapper .dataTables_length {
    float: right;
    margin-right: 10px;
}
</style>

<div class="container-fluid py-2">


		<div class="d-flex justify-content-end mb-3">
			<div class="form-floating">
				<select class="form-select coinslot_list bg-light border ps-4"
						id="coinslot_x"
						name="coinslot_x">
				</select>
				<label for="coinslot_x">Select Coinslot:</label>
			</div>
		</div> 
	   
      <div class="row g-2">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Today's Sales</p>
                <h4 class="mb-0" id="today_sale">0</h4>
              </div>
            </div>  
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2">  </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Weekly Sales</p>
                <h4 class="mb-0" id = "weekly_sale">0</h4>
              </div>
            </div>  
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2">  </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-danger shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Monthly Sales</p>
                <h4 class="mb-0" id = "monthly_sale">0</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2">  </div>
          </div>
        </div> 
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-warning shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Yearly Sales</p>
                <h4 class="mb-0" id = "yearly_sale">0</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2">  </div>
          </div>
        </div> 
      </div> 

	  
      <div class="row mt-xl-3 mt-sm-0">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
          <div class="card">
		    
			<div class="card-header py-2 border-bottom">
              <div class="d-flex align-items-center justify-content-between"> 
                  <h6 class = "mb-0">Sales History</h6>
                  <div class = "mb-0">
					<button class = "mb-0 btn-sm btn btn-danger f-6" onclick= "reset_sales();">Reset</button>
				  </div>
              </div>
            </div>
			
			<div class="card-body px-0 pt-2"> 
				<div class="pe-4 ps-4 pb-1">
				  
					<div class = "row g-2 mt-1 mb-4"> 
				 
						<div class = "col-xl-2 col-md-2  col-sm-12">
							<div class="w-100 form-floating">
							  <select class="border ps-4 form-select" id="report_type" name = "report_type"  aria-label="Floating label select example">
							   <option value="" selected> -- Select Report Type --</option> 
							   <option value="total_sales">Total sales</option> 
							   <option value="daily">Daily sales</option> 
							   <option value="monthly">Monthly sales</option> 
							   <option value="all_guest">All guest Inserted credit</option> 
							   <option value="all_members">All members Inserted credit</option>  
							   <option value="per_members">Total Sales per member</option>  
							   <option value="per_pc">Total Sales per PC</option> 
							   <option value="interval">Sales Interval Report (1hr)</option> 
							   <option value="top_up_guest">Guest Top Up</option> 
							   <option value="top_up_members">Members Top Up</option> 
							   <option value="voucher_report">Voucher Report</option> 
							   <option value="loginreport">Login/Logout</option> 
							   <option value="transferTime">Transfer Time</option> 
							  </select>
							  <label for="report_type">Report Type:</label>
							</div>
						</div>
						
						<div class = "col-xl-2 col-md-2  col-sm-12" id = "coinslot_item">
							<div class="w-100 form-floating">
							  <select class="border ps-4 form-select coinslot_list" id="coinslot_list" name = "coinslot_list"  aria-label="Floating label select example">
							   
							  </select>
							  <label for="coinslot_list">Select Coinslot:</label>
							</div>
						</div>
						
						<div class = "col-xl-2 col-md-2  col-sm-12">
							<div class="w-100 form-floating">
							  <select class="border ps-4 form-select" id="filter_by" name = "filter_by"  aria-label="Floating label select example">
							   
							  </select>
							  <label for="filter_by">Filter by:</label>
							</div>
						</div>
						
						<div class = "col-xl-2 col-md-2  col-sm-12">
							<div class="w-100 form-floating mb-1 border rounded-3"> 
								<input type="text" class="form-control ps-2 text-center fw-bold fs-5" name = "df" id="df">
								<label for="df">Date From:</label>
							</div> 
						</div> 
						
						<div class = "col-xl-2 col-md-2  col-sm-12">
							<div class="w-100 form-floating mb-1 border rounded-3"> 
								<input type="text" class="form-control ps-2 text-center fw-bold fs-5" name = "dt" id="dt">
								<label for="dt">Date To:</label>
							</div> 
						</div> 
						
						<div class = "col-xl-2 col-md-2 mb-1  col-sm-12"> 
							<button type="button" class="w-100 h-100 mb-0 btn btn-success float-end" onclick = "genrep()">Generate</button>  
						</div> 
									  
					</div>
			  
					<div id = "unified_table"></div>
				</div> 
			</div> 
          </div>
        </div> 
      </div>
    </div> 
<script>

	
var members_list;
var client_pc_list;
 
$(document).ready(function()
{  
  salesx('ALL');
  getCoinslot();
  get_client_list();
});

function salesx(type)
{
  $.post("../router/router.php", {'request': 'salesx', df:'NOW', dt: 'NOW', type : type}, function(data)
  { 
	var json = JSON.parse(data);
	$("#today_sale").html(" &#8369;" + " " + json['today_sales']);  
	$("#weekly_sale").html(" &#8369;" + " " + json['weekly_sales']); 
	$("#monthly_sale").html(" &#8369;" + " " + json['monthly_sale']); 
	$("#yearly_sale").html(" &#8369;" + " " + json['yearly_sale']); 
  });
} 
  
function genrep()
{
	var df = $("#df").val() + " 00:00:00";
	var dt = $("#dt").val() + " 23:59:59";
	var filter_by = $("#filter_by").val(); 
	var report_type = $("#report_type").val(); 
	var coinslot = $("#coinslot_list").val(); 
	
	if(report_type == "")
	{
		 Swal.fire({
			title: 'Please select report type', 
			icon: 'warning',
		})
		return;
	}
	
	Swal.fire({
		title: 'Loading...',
		text: 'Please wait while we process your request.',
		allowOutsideClick: false, // Prevent closing by clicking outside
		didOpen: () => {
			Swal.showLoading(); // Show the loading spinner
		}
	});
		
	$.post("../router/router.php", {'request': 'genrep', df: df, dt:dt, filter_by: filter_by, report_type: report_type, coinslot:coinslot}, function(data)
	{           
		$("#unified_table").html(data);
		$('#myTable').DataTable({
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
  
  
function reset_sales() { 
    Swal.fire({
        title: 'Are you sure?',
        text: "Reset Sales!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Reset!'
    }).then((result) => {
        if (result.isConfirmed) { 
              
            $.post("../router/router.php", { request: "reset_data", table: 'insert_logs' }, function(data) {
                if (data > 0) {
                    Swal.fire({
                        title: 'Reset Sales success!',
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

$(document).on('change', '#selectAll', function() {
    const isChecked = $(this).is(':checked');
    $('#myTable tbody input[type="checkbox"]').prop('checked', isChecked);
});

 
$(function() {
  $('input[name="df"]').daterangepicker({
	singleDatePicker: true,
	showDropdowns: true,
	minYear: 2024,
	maxYear: parseInt(moment().format('YYYY'),10),
	locale: {
	  format: 'YYYY-MM-DD'  // Set the desired date format here
	}
  });
});


$(function() {
  $('input[name="dt"]').daterangepicker({
	singleDatePicker: true,
	showDropdowns: true,
	minYear: 2024,
	maxYear: parseInt(moment().format('YYYY'),10),
	locale: {
	  format: 'YYYY-MM-DD'  // Set the desired date format here
	}
  });
});


function get_client_list()
{
	$.post("../router/router.php", { request: "get_filter_list"}, function(data) { 
		var json = JSON.parse(data);
		members_list = json['members_list'];
		client_pc_list = json['client_pc_list'];
		
		$("#filter_by").html(client_pc_list);
	});
}

function getCoinslot()
{ 
	$.post("../router/router.php", { request: "getCoinslot"}, function(data) { 
		var json = JSON.parse(data); 
		var list = json['coinslot_list']; 
		$(".coinslot_list").html(list);
	});
}


document.getElementById('report_type').addEventListener('change', function () {
  var localIpInput = document.getElementById('filter_by'); 
  if (this.value.indexOf("member") !== -1 || this.value == "loginreport" || this.value == "transferTime") { 
	$("#filter_by").html(members_list);
  } else { 
	$("#filter_by").html(client_pc_list); 
  } 

	const hideSet = new Set([
		"top_up_guest",
		"top_up_members",
		"voucher_report",
		"loginreport",
		"transferTime"
	]);

	$('#coinslot_item').toggleClass('d-none', hideSet.has(this.value));

});

document.getElementById('coinslot_x').addEventListener('change', function () {  
	salesx(this.value);
});



function deletex(rowid, table)
{
	$.post("../router/router.php", { request: "delete_single_sales", rowid: rowid, table: table}, function(data) { 
		if(data > 0)
		{
			genrep();
		}
	});
}

</script>
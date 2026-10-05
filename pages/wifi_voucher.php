<style>
div.dataTables_wrapper .dataTables_length {
    float: right;
    margin-right: 10px;
}
</style>

<div class="container-fluid py-4"> 
     <!-- Manage Time Modal -->  
    <div class="modal fade" id="voucher_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content"> 
            <form class="needs-validation" novalidate id = "myFormx">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Generate Voucher</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">  
			
				<div class="form-floating mb-1 border rounded-3">
					<input type="text" class="form-control ps-2 text-center fw-bold fs-5" name = "total_voucher" id="total_voucher" onkeypress= "num_only(event)" value = '10'>
					<label for="total_voucher">Total Voucher:</label>
					<div class="invalid-feedback text-center mb-0">
					  Please Input Total Voucher
					</div>
				</div> 
				
                <div class="form-floating mb-1 border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="price"  onkeypress= "num_only(event)" required> 
                    <label for="price">Price:</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Price
                    </div>
                </div> 
                <div class="form-floating mb-1 border rounded-3"> 
					<input type="number" class="form-control px-2 text-center fw-bold fs-4" id="mins"  onkeypress= "num_only(event)" value = '0' required> 
					<label for="mins">Minutes:</label>
					<div class="invalid-feedback text-center mb-0">
					  Please Input Minutes
					</div>
				</div> 
				 <div class="form-floating mb-1 border rounded-3"> 
					<input type="number" class="form-control px-2 text-center fw-bold fs-4" id="hours"  onkeypress= "num_only(event)" value = '0' required> 
					<label for="hours">Hours:</label>
					<div class="invalid-feedback text-center mb-0">
					  Please Input Hours
					</div>
				</div> 
				<div class="form-floating mb-1 border rounded-3">
					<input type="number" class="form-control px-2 text-center fw-bold fs-4" id="days"  onkeypress= "num_only(event)" value = '0' required> 
					<label for="days">Days:</label>
					<div class="invalid-feedback text-center mb-0">
					  Please Input Days
					</div>
				</div> 
				<div class="form-floating mb-1 border rounded-3">
					<input type="text" class="form-control px-2 text-center fw-bold fs-4" id="prefix" value = 'FTECH'> 
					<label for="prefix">Voucher Prefix:</label>
					<div class="invalid-feedback text-center mb-0">
					  Please Input Voucher Prefix
					</div>
				</div> 
				
				<div class="form-check p-0 ">
					<input type="checkbox" class="checkbox" id="ena_exp">
					<label class="form-check-label small-label mb-0" for="ena_exp">Enable Voucher Expiration</label>
				</div>
				<div class="form-floating  border rounded-3">
					<input type="text" class="form-control ps-2 text-center fw-bold fs-5" name = "exp" value = '' id="exp" disabled required>
					<label for="exp">Voucher Expiration:</label>
					<div class="invalid-feedback text-center mb-0">
					  Please Input Voucher Expiration
					</div>
				</div> 
				 
            </div>
            <div class="modal-footer ">
                <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal" onclick = "clear_form();">Close</button>
                <button type="submit" class="mb-0 btn btn-primary-x" >Generate</button>
            </div> 
            </form>
        </div>
        </div>
    </div>


     
  

    <div class="mb-4">
        <div class="mt-0 mb-4">
          <div class="card">
            <div class="card-header pt-2 pb-0 border-bottom">
			   
				<div class="d-flex align-items-center justify-content-between"> 
					<h6>WiFi Voucher</h6> 
					<div class = "mb-1">  
						<button type="button" class="mb-0 btn-sm btn btn-danger f-6 d-flex align-items-center justify-content-center" onclick = "cleaner();">
						  Clean
						</button>
					</div>
				</div>
			  
            </div> 
            <div class="card-body px-0 pb-2">
			
				<div class = "mt-0 mb-3 px-3">  
					<div class = "row g-1"> 
						<div class = "col-xl-6 col-md-6 d-flex gap-1 col-sm-12">
							<button type="button" class="mb-0 btn-lg btn btn-info f-6 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#voucher_modal">Generate</button>
							<!--button type="button" class="mb-0 btn-lg btn btn-success f-6 d-flex align-items-center justify-content-center" onclick="window.print();">Print & Preview</button--> 
						</div>  
						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating float-end">
								<select class="ps-4 form-select" id="filter_by" name = "filter_by"  aria-label="Floating label select example"> 
								   <option value = 'ALL'>ALL</option>
								   <option value = 'USED'>USED</option>
								   <option value = 'UNUSED'>UNUSED</option>
								</select>
								<label for="filter_by">Filter by:</label>
							</div>  
						</div> 
					</div>
							  
				</div>
				
              <div class="p-3 pt-0 d-flex justify-content-center flex-column gap-1 align-items-center  w-100"> 
                 <table class="table table-hover table-dark   responsive nowrap" width="100%" id = "myTable">
                  <thead class = 'thead-dark'>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Voucher Code</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Price</th>  
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Voucher Expiration</th>  
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Generate Time</th>  
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Voucher Prefix</th>  
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Delete</th> 
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

<style>
    #myTable_wrapper{
        width: 100% !important;
    } 
</style>

<script>
 
    var table; 
    $(document).ready(function(){  
		Swal.fire({
			title: 'Loading...',
			text: 'Please wait while we process your request.',
			allowOutsideClick: false, // Prevent closing by clicking outside
			didOpen: () => {
				Swal.showLoading(); // Show the loading spinner
			}
		});
        get_voucher(true); 
		(function () {
			'use strict' 
			var forms = document.querySelectorAll('.needs-validation') 
			Array.prototype.slice.call(forms)
				.forEach(function (form) {
				form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
					event.preventDefault()
					event.stopPropagation()
					} 
					else { 
						event.preventDefault();
						generate();
					}
					form.classList.add('was-validated')
				}, false)
			})
		})()
		
    });
	
	$(function() {
		$('input[name="exp"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 2024,
			maxYear: parseInt(moment().format('YYYY'),10),
			locale: {
			  format: 'YYYY-MM-DD'  // Set the desired date format here
			},
			startDate: moment().add(30, 'days')
		});
		$('input[name="exp"]').val('');
	});
  
    function get_voucher(is_true = false)
    {
		$.post("../router/router.php", {'request': 'wifi_get_voucher'}, function(data)
		{
			if(table) {
			  $("#tablex").html("")
			  table.destroy();
			}   
			$("#tablex").html(data); 
			table = $('#myTable').DataTable( {
				responsive: true,
				pageLength: 10,               // Default number of rows per page
				searching: true,              // Enable searching
				order: [[0, 'asc']],          // Default sort by the first column
				dom: '<"top"lBf>t<"bottom"ip>', // Custom DOM layout
				buttons: ['csv', 'excel'],    // Buttons for CSV and Excel export
				columnDefs: [
					{ targets: [0], orderable: true }  // Disable sorting for the first column
				],
				lengthMenu: [
					[10, 25, 50, -1],         // Available options: 10, 25, 50, and All
					['10 rows', '25 rows', '50 rows', 'Show All'] // Custom text for each option
				]
			} ); 
			if(is_true == true)
			{ 
				Swal.close();
			}
		});
    }
	
	function num_only(event) { 
        var charCode = (typeof event.which === "number") ? event.which : event.keyCode;
        var inputValue = event.target.value;
        
        if (charCode === 8) {
            return;
        }

        if ((charCode >= 48 && charCode <= 57) || charCode === 46) {
            if (charCode === 46) {
                if (inputValue.indexOf('.') !== -1) {
                    event.preventDefault();
                }
            }
        } else {
            event.preventDefault();
        }
    }
	
	function clear_form()
    { 
        $('#myFormx')[0].reset(); 
    }
	
	$('#ena_exp').change(function() {
		if ($(this).prop('checked')) { 
			var futureDate = moment().add(10, 'days').format('YYYY-MM-DD');
 
			$('input[name="exp"]').val(futureDate);
			$('#exp').prop('disabled', false);   
		} else {
			$('input[name="exp"]').val('');  
			$('#exp').prop('disabled', true);  
		}
	});
	 
	
	function generateRandomString(length) {
		const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		let result = '';
		for (let i = 0; i < length; i++) {
			result += chars.charAt(Math.floor(Math.random() * chars.length));
		}
		return result;
	}
 
	function generateVoucherCode() { 
		const timestamp = Date.now();  
		const hexTimestamp = timestamp.toString(32).toUpperCase();   
		const randomString = generateRandomString(3); 
		const voucherCode = $('#prefix').val() + "-" + randomString + hexTimestamp; 
		return voucherCode;
	}
 
	function generateUniqueVoucherCodes(count) {
		const generatedCodes = new Set();   
		const voucherCodes = [];  
		while (voucherCodes.length < count) {
			const newCode = generateVoucherCode(); 
			if (!generatedCodes.has(newCode)) {
				generatedCodes.add(newCode);
				voucherCodes.push(newCode);
			}
		} 
		return voucherCodes;
	}
 
	function generate() { 
		Swal.fire({
			title: 'Loading...',
			text: 'Please wait while we process your request.',
			allowOutsideClick: false, // Prevent closing by clicking outside
			didOpen: () => {
				Swal.showLoading(); // Show the loading spinner
			}
		});
		const voucherCount = parseInt($('#total_voucher').val(), 10);   
		const voucherCodes = generateUniqueVoucherCodes(voucherCount);   
		
		var hours    = Number($("#hours").val());
		var mins     = Number($("#mins").val());
		var days     = Number($("#days").val()); 
		var time_sec = convertToSeconds(days, hours, mins) ; 
		
		$.post("../router/router.php", {'request': 'wifi_saveVoucherCodes', prefix:$('#prefix').val(),price: $('#price').val(),time_sec: time_sec,expiration: ($('#exp').val() != '') ? $('#exp').val() : '',voucherCodes: voucherCodes }, function(data)
		{ 
			if(data > 0)
			{
				get_voucher();  
				Swal.close();
				$('#voucher_modal').modal('hide');
			}
		}); 
	
	};
	
	function convertToSeconds(days, hours, minutes) { 
		var totalSeconds = (days * 86400) + (hours * 3600) + (minutes * 60);
		return totalSeconds;
	}
	
	$('#filter_by').on('change', function () { 
		var filterValue = $(this).val();   
		if (filterValue === "ALL") { 
			table.column(0).search("").draw();   
		} else { 
			var regex = '\\b' + filterValue + '\\b';    
			table.column(0).search(regex, true, false).draw();
		}
	});
	
	function delete_voucher(rowid)
	{ 
		$.post("../router/router.php", {'request': 'wifi_delete_voucher', rowid: rowid }, function(data)
		{ 
			if(data > 0)
			{
				toast();
				get_voucher();  
			}
		}); 
	}
	
	function cleaner()
	{
		Swal.fire({
		  title: "Do you want to clean voucher code?",
		  icon: "warning",
		  showDenyButton: true,
		  showCancelButton: true,
		  confirmButtonText: "Delete All Unused",
		  denyButtonText: `Delete All Used`
		}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) { 
			delete_voucher_where('UNUSED');
		  } else if (result.isDenied) {
			delete_voucher_where('USED');
		  }
		});
	}
	 
	function toast()
	{
		const Toast = Swal.mixin({
		  toast: true,
		  position: "top-end",
		  showConfirmButton: false,
		  timer: 2000,
		  timerProgressBar: true,
		  didOpen: (toast) => {
			toast.onmouseenter = Swal.stopTimer;
			toast.onmouseleave = Swal.resumeTimer;
		  }
		});
		Toast.fire({
		  icon: "success",
		  title: "Successfully Deleted"
		});
	}
	
	function delete_voucher_where(filter)
	{  
		$.post("../router/router.php", {'request': 'wifi_delete_voucher_where', filter: filter }, function(data)
		{ 
			if(data > 0)
			{
				toast()
				get_voucher();  
			}
		}); 
	}
	
 
</script>
 
<div class="container-fluid py-2"> 
	<div class="mt-0 mb-4">
	  <div class="card">
		<div class="card-header pt-2 pb-0 border-bottom">
		   	<div class="d-flex align-items-center justify-content-between"> 
		   		<h6>Activation</h6>  
			</div>
		</div> 
		<div class="card-body px-4 pb-4">
		
			<div class="alert alert-danger alert-dismissible text-white d-none" role="alert" id = "alert">
				<span class="text-sm"><i class="fa-solid fa-circle-question fs-4"></i> <span class = "text-sm" id = "license_status"></span></span>
				<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
		  
			<div class="pb-2 d-flex justify-content-center flex-column gap-1 align-items-center"> 
				<div class="w-100  form-floating mb-1 border rounded-3"> 
					<input type="text" class="form-control ps-2 text-center fw-bold fs-6"  id="license_key">
					<label for="license_key">Enter License Key</label>
				</div> 
			</div>  
			<div class="mt-0  float-end">
				<button type="button" class="mb-0 mt-0 btn btn-info " id = "licensebtn" onclick = "verify_license();">Activate</button> 
			</div> 

		</div> 
	  </div>
	</div>  
	 
	<div class="mt-0 mb-4">
		<div class="card">  
			<div class="card-header pt-2 pb-0 border-bottom">
				<div class="d-flex align-items-center justify-content-between"> 
					<h6>Machine Information</h6> 
					<div class = "mb-1">
						<button class="mb-0 btn-sm btn btn-warning f-6" onclick="verify('main');">
							<i class="fas fa-check"></i> Verify
						</button>
					</div>
				</div>
			</div> 
			
			<div class="card-body px-4 pb-4">   
				<div class="pb-2 w-100 d-flex justify-content-center flex-column gap-1 align-items-center"> 
					<div class="w-100  form-floating mb-1 border rounded-3 mt-0"> 
						<input type="text" class="form-control ps-2 text-center fw-bold fs-6"  id="machine_id" readonly> 
						<label for="machine_id">Machine ID</label>
					</div> 
				</div>   
				<div class="pb-2 d-flex justify-content-center flex-column gap-1 align-items-center"> 
					<div class="w-100  form-floating mb-1 border rounded-3"> 
						<input type="text" class="form-control ps-2 text-center fw-bold fs-6"  id="activation_key" disabled>
						<label for="activation_key">Activation Key</label>
					</div> 
				</div>   
			</div> 
		</div>
	</div>  

	<div class="mt-0 mb-4">
		<div class="card">
			<div class="card-header pt-2 pb-0 border-bottom">
				<div class="d-flex align-items-center justify-content-between"> 
					<h6>Subscription Information</h6> 
					<div class = "mb-1">
						<button class="mb-0 btn-sm btn btn-warning f-6" onclick="verify('subs');">
							<i class="fas fa-check"></i> Verify
						</button>
					</div>
				</div>
				
			</div> 
			<div class="card-body px-4 pb-4">   
				<div class="pb-2 w-100 d-flex justify-content-center flex-column gap-1 align-items-center"> 
					<div class="w-100  form-floating mb-1 border rounded-3 mt-0"> 
						<input type="text" class="form-control ps-2 text-center fw-bold fs-6"  id="subs_expiry" readonly> 
						<label for="subs_expiry">Subscription Expiry</label>
					</div> 
				</div>   
				<div class="pb-2 d-flex justify-content-center flex-column gap-1 align-items-center"> 
					<div class="w-100  form-floating mb-1 border rounded-3"> 
						<input type="text" class="form-control ps-2 text-center fw-bold fs-6"  id="subs_stat" readonly>
						<label for="subs_stat">Subscription Status</label>
					</div> 
				</div>   
			</div> 
		</div>
	</div>  
	
</div>


<script>
  
var serial;
$(document).ready(function()
{   
  getSerial();
  get_machine_info();
});

function getSerial()
{
  $.post("../router/router.php", {'request': 'getSerial'}, function(data)
  { 
	var json = JSON.parse(data);  
	serial = json[0]['serial'] ;
	$("#serialNum").val(serial);   
  });
} 
 
function get_machine_info()
{
  $.post("../router/router.php", {'request': 'get_machine_info'}, function(data)
  { 
	var json = JSON.parse(data); 
	$("#machine_id").val(json[0]['machine_id']);  
	$("#serialNum").val(json[0]['serial']);  
	$("#activation_key").val(json[0]['license_key']);  

	
	$("#subs_expiry").val((json[0]['subscription_expiry'] == "") ? "0000-00-00" : json[0]['subscription_expiry']);   
	$("#subs_stat").val(json[0]['subscription_status']);  

	if(json[0]['subscription_status'] != "ACTIVE")
	{ 
		$("#subs_stat").addClass('text-danger');  
	}else
	{
		$("#subs_stat").addClass('text-success');  
	}
		
	if(json[0]['license_status'] == "activated")
	{
		$("#alert").removeClass("alert-danger");
		
		if(json[0]['is_free_trial'] == "YES")
		{
			$("#alert").addClass("alert-warning");
			$("#license_status").text("Free Trial is valid until " + json[0]['free_trial_exp']);
		}
		else
		{ 
			$("#alert").addClass("alert-success");
			$("#license_status").text("Congratulations!, Your machine is now activated.");
			$('#license_key').prop("disabled", true);
			$('#licensebtn').prop("disabled", true);
		}
	} 
	else
	{
		$("#license_status").text("License Expired! Please activate your machine now"); 
	}
	$("#alert").removeClass("d-none");
	
  });
} 



function verify_license()
{
	var license_key = $('#license_key').val();
	var serialNum   = serial;
	
	if(license_key.trim() == "")
	{
		Swal.fire({
		  title: "Invalid License Key",
		  text: "Please fillout license key",
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
		
	$.post("../router/api.php", {'request':'activate_licensed',licenseKey: license_key,machineID:serialNum}, function(response)
	{   
		var data =  JSON.parse(response); 
		if(data.status == "success")
		{
			$.post("../router/router.php", {'request': 'verify_license', license_key: license_key}, function(data)
			{    
				var response = JSON.parse(data);
				if(response.status == "success")
				{
					Swal.fire({
					  title: "Licensed Activated",
					  html: "Congratulations!<br>Your Machine is now Activated",
					  icon: "success", 
					}).then((result) => {
					  if (result.isConfirmed) { 
						location.reload();
					  }
					})
				}
				else
				{
					Swal.fire({
					  title: "Licensed Activated",
					  html: "Please reboot your Device To take effect license",
					  icon: "success", 
					}).then((result) => {
					  if (result.isConfirmed) { 
						location.reload();
					  }
					})
				}
			}); 
		}
		else
		{
			Swal.fire({
			  title: data.status,
			  text: data.msg,
			  icon: data.status, 
			}) 
		}
	}); 
}

function copy() {  
   var copyTextarea = document.querySelector('#machine_id');
	copyTextarea.select();
	try {
		var successful = document.execCommand('copy');
		var msg = successful ? 'successful' : 'unsuccessful'; 
		const Toast = Swal.mixin({
		  toast: true,
		  position: "top-end",
		  showConfirmButton: false,
		  timer: 1000,
		  timerProgressBar: true,
		  didOpen: (toast) => {
			toast.onmouseenter = Swal.stopTimer;
			toast.onmouseleave = Swal.resumeTimer;
		  }
		});
		Toast.fire({
		  icon: "success",
		  title: "Copied Success"
		});

	} catch (err) {
		alert('Oops, unable to copy');
	}        
}


function verify(type) {
    Swal.fire({
        title: 'Verifying License...',
        text: 'Please wait while we check your license key.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.post("../router/router.php", { 'request': 'verify' }, function(response) {
        Swal.close(); 

        // Check the msg field

		if(type == 'main')
		{
			if (response.msg === "activated") {
				Swal.fire({
					icon: 'success',
					title: 'License Activated',
					html: `
						<p><strong>License ID:</strong> ${response.license_id}</p>
					`
				}).then((result) => {
					if (result.isConfirmed) { 
						location.reload();
					}
				}); 
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Verification Failed',
					text: 'Your license could not be verified. Please try again.'
				}).then((result) => {
					if (result.isConfirmed) { 
						location.reload();
					}
				});
			}
		}
		else
		{
			if (response.subscription_status === "ACTIVE") {
				Swal.fire({
					icon: 'success',
					title: response.subscription_status,
					html: `
						<p class = 'mb-1'><strong>Subscription Status:</strong> <span class = 'text-success'>${response.subscription_status}</span></p>
						<p><strong>Subscription Expiry:</strong> ${response.subscription_expiry}</p>
					`
				}).then((result) => {
					if (result.isConfirmed) { 
						location.reload();
					}
				}); 
			} else {
				Swal.fire({
					icon: 'error',
					title: response.subscription_status,
					html: `
						<p class = 'mb-1'><strong>Subscription Status:</strong> <span class = 'text-warning'>${response.subscription_status}</span></p>
						<p><strong>Subscription Expiry:</strong> ${response.subscription_expiry}</p>
					`
				}).then((result) => {
					if (result.isConfirmed) { 
						location.reload();
					}
				});
			}
		}
        
    }, 'json');
}

</script>
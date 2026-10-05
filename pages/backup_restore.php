 
<div class="container-fluid py-2"> 
	<div class="mt-0 mb-4">
	  <div class="card">
		<div class="card-header pt-2 pb-0 border-bottom">
		
			<div class=" d-flex align-items-center justify-content-between"> 
				<h6>Back Up</h6> 
				<div class = "mb-2">
					<button class = "mb-0 btn-sm btn btn-info f-6" onclick= "save_autobakuop();">Save Auto Backup</button>
				</div>
			</div>
		</div> 
		<div class="card-body px-4 pb-4">
		
			<div class="alert alert-danger alert-dismissible text-white d-none" role="alert" id = "alert">
				<span class="text-sm"><i class="fa-solid fa-circle-question fs-4"></i> <span class = "text-sm" id = "license_status"></span></span>
				<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
		   
			<div class="pb-2   gap-1 align-items-center">   
				<label class="fw-bold mt-3">Select Back Up</label>
				<div class="d-flex flex-column mt-1 mb-0">
					<div class="form-check ">
						<input type="checkbox" class="checkbox" id="user">
						<label class="form-check-label small-label ms-2" for="user">Members Data</label>
					</div>  
					<div class="form-check ">
						<input type="checkbox" class="checkbox" id="settings">
						<label class="form-check-label small-label ms-2" for="settings">Settings</label>
					</div>  
					<div class="form-check ">
						<input type="checkbox" class="checkbox" id="insert_logs">
						<label class="form-check-label small-label ms-2" for="insert_logs">Sales</label>
					</div>  
					<div class="form-check ">
						<input type="checkbox" class="checkbox" id="voucher_list">
						<label class="form-check-label small-label ms-2" for="voucher_list">Voucher</label>
					</div> 
					<div class="form-check ">
						<input type="checkbox" class="checkbox" id="telegram">
						<label class="form-check-label small-label ms-2" for="telegram">Telegram Config</label>
					</div> 
					<div class="form-check ">
						<input type="checkbox" class="checkbox" id="rates">
						<label class="form-check-label small-label ms-2" for="rates">Timer Rates</label>
					</div> 
					<div class="form-check ">
						<input type="checkbox" class="checkbox" id="points_rates">
						<label class="form-check-label small-label ms-2" for="points_rates">Redeem Rates</label>
					</div> 
					<div class="form-check ">
						<input type="checkbox" class="checkbox" id="loginRules">
						<label class="form-check-label small-label ms-2" for="loginRules">Anti-Abuse Login Rules</label>
					</div> 
					<div class="form-check ">
						<input type="checkbox" class="checkbox" id="clientpc">
						<label class="form-check-label small-label ms-2" for="clientpc">clientpc</label>
					</div>  
					<div class="form-check ">
						<input type="checkbox" class="checkbox" id="whitelist_app">
						<label class="form-check-label small-label ms-2" for="whitelist_app">Whitelist App</label>
					</div>  
				</div> 
				
			</div>  
			<div class="mt-0  float-end">
				<button type="button" class="mb-0 mt-0 btn btn-info " onclick = "backup();">Back Up Now</button> 
			</div> 

		</div> 
	  </div>
	</div>  
	 
	<div class="mt-0 mb-4">
	  <div class="card">
		<div class="card-header pt-2 pb-0 border-bottom">
		   <h6>Restore</h6> 
		</div> 
		<div class="card-body px-4 pb-4" >  
		
			<form class="needs-validation restore_form" novalidate id = "form_background"> 
				<div class="form-floating mb-1 border rounded-3">
					<input type="file" class="form-control px-2 text-center fw-bold fs-5" id="file" name = "file" accept=".sql"  required> 
					<label for="name">File Name</label>
					<div class="invalid-feedback text-center mb-0">
					Please select file
					</div>
				</div> 
				
				<button type="submit" class="mb-0 mmt-1 btn btn-primary-x float-end" >Restore</button>
			</form>
		</div> 
	  </div>
	</div>


	<div class="mt-0 mb-4">
		<div class="card">
			<div class="card-header pt-0 pb-0 border-bottom">
				<h6 class = "mt-2">Auto Backup Instructions</h6> 
			</div> 
			<div class="card-body px-4 pb-4">
				<div class=" mt-1 "> 
					<h6>Follow this instruction:</h6>
					<div class = "ms-5">
						<p class = "mt-0 mb-1"><strong>1. Select backup item</strong></p>
						<p class = "mt-0 mb-1"><strong>2. Click 'Save Auto Backup'</strong></p>
						<p class = "mt-0 mb-1"><strong>2. Go To <a href = "https://crontab.guru/" target="_blank">https://crontab.guru/</a>. This is for assigning schedule</strong></p> 
						
						<div class="container mt-2">
							<h5 class="text-center mb-4">📌 Common Crontab Schedules</h5>
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="table-dark">
										<tr>
											<th>Schedule</th>
											<th>Crontab Expression</th>
											<th>Example</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Every minute</td>
											<td><code>* * * * *</code></td>
											<td>Runs every minute</td>
										</tr>
										<tr>
											<td>Every 5 minutes</td>
											<td><code>*/5 * * * *</code></td>
											<td>Runs every 5 minutes</td>
										</tr>
										<tr>
											<td>Every 10 minutes</td>
											<td><code>*/10 * * * *</code></td>
											<td>Runs every 10 minutes</td>
										</tr>
										<tr>
											<td>Every 30 minutes</td>
											<td><code>*/30 * * * *</code></td>
											<td>Runs every 30 minutes</td>
										</tr>
										<tr>
											<td>Every hour</td>
											<td><code>0 * * * *</code></td>
											<td>Runs at the start of every hour</td>
										</tr>
										<tr>
											<td>Every 2 hours</td>
											<td><code>0 */2 * * *</code></td>
											<td>Runs every 2 hours</td>
										</tr>
										<tr>
											<td>Daily at midnight</td>
											<td><code>0 0 * * *</code></td>
											<td>Runs every day at midnight</td>
										</tr>
										<tr>
											<td>Daily at 3 AM</td>
											<td><code>0 3 * * *</code></td>
											<td>Runs every day at 3 AM</td>
										</tr>
										<tr>
											<td>Every Monday at 6 AM</td>
											<td><code>0 6 * * 1</code></td>
											<td>Runs every Monday at 6 AM</td>
										</tr>
										<tr>
											<td>Every first day of the month at 12 AM</td>
											<td><code>0 0 1 * *</code></td>
											<td>Runs on the 1st of every month at midnight</td>
										</tr>
										<tr>
											<td>Every Sunday at 5 PM</td>
											<td><code>0 17 * * 0</code></td>
											<td>Runs every Sunday at 5 PM</td>
										</tr>
										<tr>
											<td>Every weekday at 9 AM</td>
											<td><code>0 9 * * 1-5</code></td>
											<td>Runs Monday to Friday at 9 AM</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						
						<p class = "mt-0 mb-1"><strong>3. Go To Cron Jobs tab</strong></p> 
						<p class = "mt-0 mb-1"><strong>4. Add this Command: * * * * * curl -s http://YOUR_OPI_IP_ADDRESS/admin/router/api.php?request=autobackup > /dev/null 2>&1</strong></p> 
						<p class = "mt-0 mb-1"><strong>5. Change the " * * * * * " based on the schedule you want to set</strong></p> 
						
						
					<h6>Note: I don't recommend running a schedule every minute to avoid high CPU usage on your Pi board.</h6>
					</div> 
 				
				</div> 
			</div> 
		</div>
	</div>   	
	
</div>


<script>
   
$(document).ready(function(){ 
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
                    event.preventDefault()
					var clickedButton = event.submitter || event.target.querySelector(':focus'); // Identify clicked button
					if (form.classList.contains('restore_form')) {
						restore(); 
					} 
                }
                form.classList.add('was-validated')
            }, false)
            })
        })() 
		getdefaultbackup();
    });
 
 
	function restore()
	{ 
		var formData = new FormData($("#form_background")[0]);
		formData.append("request", "restore"); 
		$.ajax({
			url: '../router/router.php',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response){  
				alert(response);
				location.reload();
			},
			error: function(xhr, status, error){
				// Handle errors
				console.error(xhr.responseText);
			}
		});
	
	}
	
	function backup() {
		let checkboxes = document.querySelectorAll('.checkbox:checked'); // Get only checked checkboxes

		if (checkboxes.length === 0) {
			alert("Please select at least one item to back up.");
			return;
		}

		// Extract IDs of checked checkboxes and join them with '|'
		let selectedItems = Array.from(checkboxes).map(checkbox => checkbox.id).join('|');
 
		 window.location.href = "../router/router.php?request=backup_multiple&param=" + encodeURIComponent(selectedItems);
 
	
	}
	
	
	
	function save_autobakuop()
	{
		let checkboxes = document.querySelectorAll('.checkbox:checked'); // Get only checked checkboxes

		if (checkboxes.length === 0) {
			alert("Please select at least one item to back up.");
			return;
		}
 
		let selectedItems = Array.from(checkboxes).map(checkbox => checkbox.id).join('|');
 
 
		$.post("../router/router.php", {request: "save_autobakuop",param:selectedItems}, function(data){
			if(data > 0)
			{
				Swal.fire({
				  title: "Auto backup",
				  text: "Auto backup save success",
				  icon: 'success', 
				}) 
			} 
			else
			{
				Swal.fire({
				  title: "Auto backup",
				  text: "No Changes have been made!",
				  icon: 'warning', 
				}) 
			}
		});
	}
	
	function getdefaultbackup()
	{
		$.post("../router/router.php", {request: "getdefaultbackup"}, function(data){  
			let response = JSON.parse(data); 
			let checkedIds = response[0].list.split("|"); 
			$.each(checkedIds, function (index, id) {
				$("#" + id).prop("checked", true);
			});
		});
	}
</script>
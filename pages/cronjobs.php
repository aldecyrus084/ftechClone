 
<div class="container-fluid py-2"> 
	<div class="mt-0 mb-4">
	  <div class="card">
		<div class="card-header pt-2 pb-0 border-bottom">
		   <h6>Add New Cron Job</h6> 
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
					<input type="text" class="form-control ps-2 text-center fw-bold fs-6" id="cron">
					<label for="license_key">Enter Cron Job (Example: * * * * * /sbin/shutdown -h now)</label>
				</div> 
			</div>  
			<div class="mt-0  float-end">
				<button type="button" class="mb-0 mt-0 btn btn-info " id = "licensebtn" onclick = "addCron();">Add</button> 
			</div> 

		</div> 
	  </div>
	</div>  
	 
	<div class="mt-0 mb-4">
	  <div class="card">
		<div class="card-header pt-2 pb-0 border-bottom">
		   <h6>Existing Cron Jobs</h6> 
		</div> 
		<div class="card-body px-4 pb-4" >  
			<ul class="list-group" id = 'cronlist'> 
			</ul>
		</div> 
	  </div>
	</div>   
	 
	<div class="mt-0 mb-4">
	  <div class="card">
		<div class="card-header pt-2 pb-0 border-bottom">
		   <h6>Available Commands</h6> 
		</div> 
		<span class = "mx-4 pt-3 text-sm text-danger" >Note: Replace (* * * * *) with your desired cron timing.  </span>
		<div class="card-body px-4 pt-1 pb-4" >  
			<ul class="list-group">  
				<div class = "mb-2">
					<span class = "text-sm" >Shutdown Pi Board: </span>
					<li class="rounded list-group-item d-flex justify-content-between align-items-center">
					   * * * * * /sbin/shutdown -h now
					</li> 
				</div>
				
				<div class = "mb-2">
					<span class = "text-sm" >Reboot Pi Board: </span>
					<li class="rounded list-group-item d-flex justify-content-between align-items-center">
					   * * * * * /sbin/reboot
					</li> 
				</div>
				
				<div class = "mb-2">
					<span class = "text-sm" >Telegram Send GetSales: </span>
					<li class="rounded list-group-item d-flex justify-content-between align-items-center">
					   * * * * * curl -s http://YOUR_OPI_IP_ADDRESS/admin/router/api.php?request=getsales > /dev/null 2>&1
					</li> 
				</div>
				
				<div class = "mb-2">
					<span class = "text-sm" >Telegram Autobackup: </span>
					<li class="rounded list-group-item d-flex justify-content-between align-items-center">
					   * * * * * curl -s http://YOUR_OPI_IP_ADDRESS/admin/router/api.php?request=autobackup > /dev/null 2>&1
					</li> 
				</div>
				
				<div class = "mb-2">
					<span class = "text-sm" >Clear Guest Time: </span>
					<li class="rounded list-group-item d-flex justify-content-between align-items-center">
					   * * * * * curl -s http://YOUR OPI IP/admin/router/api.php?request=clear_guest_time > /dev/null 2>&1
					</li> 
				</div> 
			</ul>
		</div> 
	  </div>
	</div> 
	
	<div class="mt-0 mb-4">
	  <div class="card"> 
		<div class="card-body px-4 pb-4" >  
			 
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
			 
		</div> 
	  </div>
	</div>   
	
</div>


<script>
   
$(document).ready(function()
{    
	getAllCrons();
});

function addCron()
{
  $.post("../router/router.php", {'request': 'addCron', cron: $('#cron').val()}, function(data)
  { 
	if(data == "Cron job added successfully!")
	{
		Swal.fire({
			title: "Add Cron Jobs Success",
			html: data,
			icon: 'success', 
		}).then((result) => {
		  if (result.isConfirmed) { 
			location.reload();
		  }
		})
	}
	else 
	{
		Swal.fire({
			title: "Unable to add cron jobs",
			html: data,
			icon: 'info', 
		}) 
	}
	
  });
} 

function getAllCrons()
{  
	$.post("../router/router.php", {'request': 'getAllCrons'}, function(data)
	{  
		$('#cronlist').html(data); 
	});
}
  
  
function removeCron(cron)
{
	Swal.fire({
	  title: 'Are you sure?',
	  text: "Remove this ('"+cron+"') cron job?",
	  icon: 'question',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes!'
	  }).then((result) => {
		if (result.isConfirmed) { 
		
			Swal.fire({
				title: 'Loading...',
				text: 'Please wait while we process your request.',
				allowOutsideClick: false, // Prevent closing by clicking outside
				didOpen: () => {
					Swal.showLoading(); // Show the loading spinner
				}
			});

			$.post("../router/router.php", {'request': 'removeCron', cron: cron}, function(data)
			{
				if(data > 0)
				{
					Swal.fire({
					  title: "Success",
					  text: "Remove Success",
					  icon: 'success', 
					}).then((result) => {
					  if (result.isConfirmed) { 
						location.reload();
					  }
					})
				} 
				else
				{
					Swal.fire({
						title: "Unable to remove cron jobs",
						html: "Unable to remove cron jobs",
						icon: 'info', 
					}) 
				}
			});
		} 
	}) 
} 

</script>
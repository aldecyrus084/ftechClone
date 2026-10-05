 
<div class="container-fluid py-2 "> 
	<div class="mt-0 mb-4">
		<div class="card">
			<div class="card-header pt-2 pb-0 border-bottom">
				<h6>CLI COMMAND</h6> 
			</div> 
			<div class="card-body px-4 pb-4">
				<div class="d-flex justify-content-center flex-column gap-1 align-items-center "> 
					<div class="w-100 form-floating mb-1 border rounded-3 p-3 text-light"> 
						<h3 class="text-center">Linux Command Executor</h3>
						<div class="border p-3 bg-dark text-success rounded overflow-auto" id="terminalOutput" style="height: 300px;"></div>
						<div class="input-group mt-2">
							<input id="commandInput" class="form-control bg-dark text-success border-secondary ps-1" placeholder="Enter command..." style = "height:41px;">  
							 
						</div>
					</div> 
				</div>   
			</div> 
		</div>
	</div>   
	
	<!--div class="mt-0 mb-4">
		<div class="card">
			<div class="card-header pt-2 pb-0 border-bottom">
				<h6>Note</h6> 
			</div> 
			<div class="card-body px-4 pb-4">
				<div class=" mt-1 "> 
					<h6>Install the Following command:</h6>
					<div class = "ms-5">
						<p class = "mt-0 mb-1"><strong>1. sudo apt install php-curl</strong></p>
						<p class = "mt-0 mb-1"><strong>2. sudo pip3 install aiohttp</strong></p>
					</div> 

					<h6 class = "mt-2">Just copy each of the following commands one by one and enter them into the command field.</h6>					
				</div> 
			</div> 
		</div>
	</div-->   
</div>


<script>
   
 
 
	$("#commandInput").keypress(function(event) {
		if (event.which === 13 && !event.shiftKey) {
			event.preventDefault();
			executeCommand();
		}
	});
			
   function executeCommand() {
		let command = $("#commandInput").val();
		if(command.trim() == "")
		{
			Swal.fire({
				title: "No Command",
				html: "Please enter your cli command",
				icon: 'info', 
			})  
			return;
		}
		
		$("#terminalOutput").append(`<div>$ ${command}</div>`);
		$("#commandInput").val("");

		
		Swal.fire({
			title: 'Loading...',
			text: 'Please wait while we process your request.',
			allowOutsideClick: false, // Prevent closing by clicking outside
			didOpen: () => {
				Swal.showLoading(); // Show the loading spinner
			}
		});
				
		$.post("../router/router.php", {'request': 'cli_cmd', command: command }, function(data) {
			 
			var datax = JSON.parse(data);
			$("#terminalOutput").append(`<div class='text-success'>${datax.output}</div>`);
			$("#terminalOutput").scrollTop($("#terminalOutput")[0].scrollHeight);
			swal.close();
		});
	}
		

</script>
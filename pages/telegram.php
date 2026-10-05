 
<div class="container-fluid py-2"> 
	
	<div class="mt-0 mb-4">
	  <div class="card">
		<div class="card-header pt-2 pb-0 border-bottom">
		   <h6>How to Create a Telegram Bot</h6> 
		</div> 
		<div class="card-body pb-4">  
			<div class=" mt-2 "> 
					<h6>Step 1: Create a Bot using BotFather</h6>
					<div class = "ms-5">
						<p class = "mt-0 mb-1">1. Open Telegram and search for <strong>BotFather</strong>.</p>
						<p class = "mt-0 mb-1">2. Start a chat and type <code>/newbot</code>.</p>
						<p class = "mt-0 mb-1">3. Follow the instructions to set a bot name and username.</p>
						<p class = "mt-0 mb-1">4. BotFather will give you a <strong>Bot Token</strong>. Save this to the telegram bot config.</p> 
					</div> 
					
					<h6>Step 2: Get Your Chat ID</h6>
					<div class = "ms-5">
						<p class = "mt-0 mb-1">1. Open Telegram and search for <strong>@userinfobot</strong>.</p>
						<p class = "mt-0 mb-1">2. Start a chat with @userinfobot.</p>
						<p class = "mt-0 mb-1">3. It will return your chat ID. Save this ID to the telegram bot config.</p>  
					</div> 
					<h6>Step 3: Save BOT Token & Chat ID </h6>
					<div class = "ms-5">
						<p class = "mt-0 mb-1">1. Input your BOT TOKEN</p>
						<p class = "mt-0 mb-1">2. Input your Chat ID</p>
						<p class = "mt-0 mb-1">3. Then Save</p>  
					</div> 
			</div> 
		</div> 
	  </div>
	</div>  
	
	<div class="mt-0 mb-4">
	  <div class="card">
		<div class="card-header pt-2 pb-0 border-bottom">
		   <h6>Telegram Bot Config</h6> 
		</div> 
		<div class="card-body px-4 pb-4">
		 
			<h6 class = "text-muted">Note: Reboot your device after save</h6>
			
			<div class="form-check form-switch d-flex align-items-center w-100 pe-3 me-3 justify-content-center mb-4 mt-1">
			  <input class="form-check-input mt-0 fs-2" type="checkbox" id = "enable_tele">
			  <p class="text-xs text-secondary font-weight-bold mb-0 ms-2">Enable Insert Coin Notification</p>
			</div>   
			<div class="pb-2 d-flex justify-content-center flex-column gap-1 align-items-center"> 
				<div class="w-100  form-floating mb-1 border rounded-3"> 
					<input type="text" class="form-control ps-2 text-center fw-bold fs-6 class_tele"  id="token">
					<label for="license_key">Enter Your Bot Token</label>
				</div> 
				<div class="w-100  form-floating mb-1 border rounded-3"> 
					<input type="text" class="form-control ps-2 text-center fw-bold fs-6 class_tele"  id="chat_id">
					<label for="license_key">Enter Your Chat ID</label>
				</div> 
			</div>  
			<div class="mt-0  float-end">
				<button type="button" class="mb-0 mt-0 btn btn-info class_tele" id = "licensebtn" onclick = "save_config();">Save</button> 
			</div> 

		</div> 
	  </div>
	</div>  
	 
	
</div>


<script>
   
$(document).ready(function()
{    
	getTeleConfig();
});

function getTeleConfig()
{
	$.post("../router/router.php", {'request': 'getTeleConfig'}, function(data)
	{  
		var json = JSON.parse(data);  
		$("#token").val(json[0]['bot_token']);   
		$("#chat_id").val(json[0]['chat_id']); 
		var ena = json[0]['is_enable'];  
		
		if(ena == 'N')
		{
			$("#enable_tele").prop('checked', false);
			$(".class_tele").prop('disabled', true);
		}
		else
		{ 
			$("#enable_tele").prop('checked', true);
			$(".class_tele").prop('disabled', false);
		}
	});
}

function save_config()
{
	var token = $("#token").val().trim();   
	var chat_id = $("#chat_id").val().trim(); 

	if(token.trim() == "")
	{
		Swal.fire({
			title: "Fill all Fields",
			html: "Please input Bot Token First!",
			icon: 'warning', 
		}) 
		return;
	}
	if(chat_id.trim() == "")
	{	
		Swal.fire({
			title: "Fill all Fields",
			html: "Please input Chat ID First!",
			icon: 'warning', 
		})  
		return;
	}
	$.post("../router/router.php", {'request': 'tele_config', token: token,chat_id:chat_id }, function(data)
	{  
		if(data > 0)
		{
			Swal.fire({
				title: "Success",
				html: "Save Success",
				icon: 'success', 
			})  
		}
		else
		{
			Swal.fire({
				title: "No Changes have been made",
				html: "Please check your bot token or chat id",
				icon: 'info', 
			})  
		}
	});
} 

$("#enable_tele").change(function(){ 
	$.post("../router/router.php", {'request': "enable_tele",state: this.checked},function(data)
	{ 
	
	});

	if(this.checked == true)
	{
	  $(".class_tele").prop('disabled', false);
	}
	else
	{
	  $(".class_tele").prop('disabled', true);
	}
})

 

</script>
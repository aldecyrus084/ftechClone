<div class="container-fluid py-2">
    <div class="mb-4">
        <div class="mt-0 mb-4">
          <div class="card">
            <div class="card-header pt-2 pb-0 border-bottom">
               <h6>Remote Info</h6> 
            </div> 
            <div class="card-body px-0 pb-4">
              <div class="px-4 pb-2 d-flex justify-content-center flex-column gap-1 align-items-center"> 
                 <div class="w-100  form-floating mb-1 border rounded-3"> 
					<input type="text" class="form-control ps-2 text-center fw-bold fs-6"  id="network_id">
					<label for="rem_time">Network ID</label>
				  </div> 
              </div> 
				<div class = "px-4">
					<h5>Info</h5>
					<div class = "px-4"> 
						<p class = "text-sm mb-0 text-capitalize">Node Id: <span class = "fw-bold" id = "node_id"></span> </p> 
						<p class = "text-sm mb-0 text-capitalize">Status: <span class = "fw-bold" id ="status"></span> </p>  
					</div>
				</div>
                <div class="px-4 mt-0  float-end">
                    <button type="button" class="mb-0 mt-0 btn btn-danger " onclick = "forget()" id = "forget_btn" disabled>Forget</button>
                    <button type="button" class="mb-0 mt-0 btn btn-success" onclick = "join()" id = "join_btn">Join</button>
                </div> 

            </div> 
          </div>
        </div> 
    </div> 
</div>


<script>

	$(document).ready(function(data)
	{
		zerotier_info();
	});
	
    function zerotier_info()
    { 
        $.post("../router/router.php", {'request': "zerotier_info"},function(data)
        {
			var json = JSON.parse(data);
			$("#network_id").val(json[0]['network_id']);
			$("#node_id").text(json[0]['node_id']);
			$("#status").text(json[0]['zerotier_status']);  
			
			if($.trim(json[0]['zerotier_status']) != "")
			{ 
				$("#join_btn").prop('disabled', true);
				$("#forget_btn").prop('disabled', false);
			}
			else
			{ 
				$("#join_btn").prop('disabled', false);
				$("#forget_btn").prop('disabled', true);
			}
        })
    }
	
	function join()
	{
		var net_id = $("#network_id").val().trim();
		
		if(net_id == '')
		{
			alert("Please input your network id");
		}
		else
		{
			$.post("../router/router.php", {'request': "join", network_id: net_id},function(data)
			{
				alert(data);
				location.reload();
			})
		}
	}
	
	
function forget()
{
	var net_id = $("#network_id").val().trim();
	
	if(net_id == '')
	{
		alert("Please input your network id");
	}
	else
	{
		$.post("../router/router.php", {'request': "forget_network", network_id: net_id},function(data)
		{
			alert(data);
			location.reload();
		})
	}
}
</script>
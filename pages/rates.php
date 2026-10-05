<div class="container-fluid py-4"> 
     <!-- Manage Time Modal -->  
    <div class="modal fade" id="rates_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content"> 
            <form class="needs-validation" novalidate id = "myFormx">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Manage NON-VIP Rates</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <input type="hidden" id = "rowidx">
                <div class="form-floating mb-1 border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="credit"  onkeypress= "num_only(event)" maxlength="3" required> 
                    <label for="credit">Credit</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Credit
                    </div>
                </div> 
                <div class="form-floating  mb-1 border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="add_hrs"  onkeypress= "num_only(event)" value = '0' required> 
                    <label for="add_hrs">Hours</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Hours
                    </div>
                </div> 
				
				<div class="form-floating mb-1 border rounded-3">
					<input type="number" class="form-control px-2 text-center fw-bold fs-4" id="add_mins"  onkeypress= "num_only(event)"  value = '0' required> 
					<label for="add_mins">Minutes</label>
					<div class="invalid-feedback text-center mb-0">
					  Please Input Minute
					</div>
				</div> 
				  
                <div class="form-floating border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="points"  step="any" onkeypress= "num_only(event)" value = '0' required> 
                    <label for="points">Points</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Points
                    </div>
                </div> 
            </div>
            <div class="modal-footer ">
                <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal" onclick = "clear_form();">Close</button>
                <button type="submit" class="mb-0 btn btn-primary-x" >Save changes</button>
            </div> 
            </form>
        </div>
        </div>
    </div>


    <!-- VIP MODAL -->
    <div class="modal fade" id="viprates_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content"> 
            <form class="needs-validation vip_form" novalidate id = "vipmyFormx">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Manage VIP Rates</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <input type="hidden" id = "viprowidx">
                <div class="form-floating mb-1 border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="vipcredit"  onkeypress= "num_only(event)" maxlength="3" required> 
                    <label for="vipcredit">Credit</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Credit
                    </div>
                </div> 
                <div class="form-floating  mb-1 border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="viptime_hours"  onkeypress= "num_only(event)" value = '0' required> 
                    <label for="viptime_hours">Hours</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Hours
                    </div>
                </div> 
				 <div class="form-floating  mb-1 border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="viptime_minutes"  onkeypress= "num_only(event)" value = '0' required> 
                    <label for="viptime_minutes">Minutes</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Minutes
                    </div>
                </div> 
                <div class="form-floating border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="vippoints"  step="any" onkeypress= "num_only(event)" value = '0' required> 
                    <label for="vippoints">Points</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Points
                    </div>
                </div> 
            </div>
            <div class="modal-footer ">
                <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal" onclick = "vipclear_form();">Close</button>
                <button type="submit" class="mb-0 btn btn-primary-x" >Save changes</button>
            </div> 
            </form>
        </div>
        </div>
    </div>
	
	<!-- VVIP MODAL -->
    <div class="modal fade" id="vviprates_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content"> 
            <form class="needs-validation vvip_form" novalidate id = "vvipmyFormx">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Manage VVIP Rates</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <input type="hidden" id = "vviprowidx">
                <div class="form-floating mb-1 border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="vvipcredit"  onkeypress= "num_only(event)" maxlength="3" required> 
                    <label for="vvipcredit">Credit</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Credit
                    </div>
                </div> 
                <div class="form-floating  mb-1 border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="vviptime_hours"  onkeypress= "num_only(event)" value = '0' required> 
                    <label for="vviptime_hours">Hours</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Hours
                    </div>
                </div> 
				 <div class="form-floating  mb-1 border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="vviptime_minutes"  onkeypress= "num_only(event)" value = '0' required> 
                    <label for="vviptime_minutes">Minutes</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Minutes
                    </div>
                </div> 
                <div class="form-floating border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="vvippoints"  step="any" onkeypress= "num_only(event)" value = '0' required> 
                    <label for="vvippoints">Points</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Points
                    </div>
                </div> 
            </div>
            <div class="modal-footer ">
                <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal" onclick = "vvipclear_form();">Close</button>
                <button type="submit" class="mb-0 btn btn-primary-x" >Save changes</button>
            </div> 
            </form>
        </div>
        </div>
    </div>
  
 
	<div class="mt-0 mb-2">
	  <div class="card">
		<div class="card-header pt-2 pb-0 border-bottom">
		   
			<div class="d-flex align-items-center justify-content-between"> 
				<h6>NON-VIP Rates</h6> 
				<div class = "mb-1"> 
					<button type="button" class="mb-0 btn-sm btn btn-success f-6 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#rates_modal">
					  <i class="fa-solid fa-plus text-white fs-5 me-2"></i> Add Rates
					</button>
				</div> 
			</div>
		</div> 
		<div class="card-body px-0 pb-2">
		  <div class="p-3 pt-0 d-flex justify-content-center flex-column gap-1 align-items-center  w-100"> 
			 <table class="table table-hover table-dark responsive nowrap" width="100%" id = "myTable">
			  <thead class = 'thead-dark'>
				<tr>
				  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Credit</th>
				  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Time (hh:mm:ss)</th>
				  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Points</th>
				  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Actions</th>  
				</tr>
			  </thead>
			  <tbody id = 'tablex'>
				 
			  </tbody>
			</table>
		</div> 
	  </div>
		</div>  
	</div>  
 
 
	<div class="mt-0 mb-2">
		<div class="card">
			<div class="card-header pt-2 pb-0 border-bottom">
				<div class="d-flex align-items-center justify-content-between"> 
				   <h6>VIP Rates</h6> 
				   <div class = "mb-1"> 
						<button type="button" class="mb-0 btn-sm btn btn-success f-6 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#viprates_modal">
						  <i class="fa-solid fa-plus text-white fs-5 me-2"></i> Add Rates
						</button>
					</div> 
				</div> 
			</div> 
			<div class="card-body px-0 pb-2">
			  <div class="p-3 pt-0 d-flex justify-content-center flex-column gap-1 align-items-center  w-100"> 
				 <table class="table table-hover table-dark responsive nowrap" width="100%" id = "vipTable">
				  <thead class = 'thead-dark'>
					<tr>
					  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Credit</th>
					  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Time (hh:mm:ss)</th>
					  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Points</th>
					  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Actions</th>  
					</tr>
				  </thead>
				  <tbody id = 'viptablex'>
					 
				  </tbody>
				</table>
			</div> 
		  </div>
		</div>  
	</div> 
 
	<div class="mb-2">
        <div class="mt-0 mb-4">
          <div class="card">
            <div class="card-header pt-2 pb-0 border-bottom">
				<div class="d-flex align-items-center justify-content-between"> 
					<h6>VVIP Rates</h6> 
				   <div class = "mb-1"> 
						<button type="button" class="mb-0 btn-sm btn btn-success f-6 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#vviprates_modal">
						  <i class="fa-solid fa-plus text-white fs-5 me-2"></i> Add Rates
						</button>
					</div> 
				</div> 
			
            </div> 
            <div class="card-body px-0 pb-2">
              <div class="p-3 pt-0 d-flex justify-content-center flex-column gap-1 align-items-center  w-100"> 
                 <table class="table table-hover table-dark responsive nowrap" width="100%" id = "vvipTable">
                  <thead class = 'thead-dark'>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Credit</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Time (hh:mm:ss)</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Points</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Actions</th>  
                    </tr>
                  </thead>
                  <tbody id = 'vviptablex'>
                     
                  </tbody>
                </table>
            </div> 
          </div>
        </div> 
		</div>  
	</div>
</div>

<style>
    #myTable_wrapper{
        width: 100% !important;
    }
    #vipTable_wrapper{
        width: 100% !important;
    }
	#vvipTable_wrapper{
        width: 100% !important;
    }
</style>

<script>

    var table;
    var table2;
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
                    if (form.classList.contains('vip_form')) {
                        vipsave_rates_update(); 
                    } else if (form.classList.contains('vvip_form')) {
                        vvipsave_rates_update(); 
                    } else {
                        save_rates_update(); 
                    }
                }
                form.classList.add('was-validated')
            }, false)
            })
        })()

        //system_info()
        get_rates()
        get_vip_rates()
		get_vvip_rates();
    });


    function system_info()
    {
        $.post("../router/router.php", {'request': "system_info"},function(data)
        {
            if(data != '')
            {
                var json = JSON.parse(data);
                $.each(json, function(i,item)
                {
                    $.each(item, function(key, value) {
                        $("#" + key).text(value);
                        console.log("Key: " + key + " | Value: " + value);
                    });
                })
            }
        })
    }

    function get_rates()
    {
      $.post("../router/router.php", {'request': 'get_rates'}, function(data)
      {
        $("#tablex").html(data); 
        table = $('#myTable').DataTable( {
            responsive: true 
        } ); 
      });
    }

    function get_vip_rates()
    {
      $.post("../router/router.php", {'request': 'get_vip_rates'}, function(data)
      {
        $("#viptablex").html(data); 
        table2 = $('#vipTable').DataTable( {
            responsive: true 
        } ); 
      });
    }
	
	function get_vvip_rates()
    {
      $.post("../router/router.php", {'request': 'get_vvip_rates'}, function(data)
      {
        $("#vviptablex").html(data); 
        table2 = $('#vvipTable').DataTable( {
            responsive: true 
        } ); 
      });
    }


    function edit_rates(rowid,credit, time_sec, points)
    { 
        $("#rowidx").val(rowid);
        $("#credit").val(credit);
		
		let hours = Math.floor(time_sec / 3600);
		let minutes = Math.floor((time_sec % 3600) / 60);
        $("#add_hrs").val(hours);
        $("#add_mins").val(minutes);

        $("#points").val(points);
        $("#credit").prop('disabled', true);
        $("#rates_modal").modal('show');
    }

    function vipedit_rates(rowid,credit, time_sec, points)
    { 
        $("#viprowidx").val(rowid);
        $("#vipcredit").val(credit); 
		
		let hours = Math.floor(time_sec / 3600);
		let minutes = Math.floor((time_sec % 3600) / 60);
        $("#viptime_hours").val(hours);
        $("#viptime_minutes").val(minutes); 
		
        $("#vippoints").val(points);
        $("#vipcredit").prop('disabled', true);
        $("#viprates_modal").modal('show');
    }
	
	function vvipedit_rates(rowid,credit, time_sec, points)
    { 
        $("#vviprowidx").val(rowid);
        $("#vvipcredit").val(credit); 
		
		let hours = Math.floor(time_sec / 3600);
		let minutes = Math.floor((time_sec % 3600) / 60);
        $("#vviptime_hours").val(hours);
        $("#vviptime_minutes").val(minutes); 
		
        $("#vvippoints").val(points);
        $("#vvipcredit").prop('disabled', true);
        $("#vviprates_modal").modal('show');
    }
	
    function delete_rates(rowid)
    {
        var cnt = table.rows({ page: 'current' }).count(); 
        if(cnt == 1)
        {
            Swal.fire({
                title:'Sorry! Unable to delete this single rate!', 
                icon: 'warning', 
            }) 
            return;
        }
        Swal.fire({
            title: "Delete this rates?", 
            icon: 'question', 
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) { 
                $.post("../router/router.php", {'request': 'delete_rates', rowid: rowid}, function(data)
                {
                    if(data > 0)
                    {
                        Swal.fire({
                        title:'Delete success!', 
                        icon: 'success', 
                        }).then((result) => {
                            if (result.isConfirmed) { 
                                location.reload();
                            }
                        })
                    }
                });
            } 
        })
 
    }

    function vipdelete_rates(rowid)
    {
        var cnt = table2.rows({ page: 'current' }).count(); 
        if(cnt == 1)
        {
            Swal.fire({
                title:'Sorry! Unable to delete this single rate!', 
                icon: 'warning', 
            }) 
            return;
        }
        Swal.fire({
            title: "Delete this rates?", 
            icon: 'question', 
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) { 
                $.post("../router/router.php", {'request': 'vipdelete_rates', rowid: rowid}, function(data)
                {
                    if(data > 0)
                    {
                        Swal.fire({
                        title:'Delete success!', 
                        icon: 'success', 
                        }).then((result) => {
                            if (result.isConfirmed) { 
                                location.reload();
                            }
                        })
                    }
                });
            } 
        })
 
    }

    function clear_form()
    { 
        $('#myFormx')[0].reset();
        $("#rowidx").val(""); 
        $("#credit").prop('disabled', false);
    }

    function vipclear_form()
    { 
        $('#vipmyFormx')[0].reset();
        $("#viprowidx").val(""); 
        $("#vipcredit").prop('disabled', false);
    }
	
	function vvipclear_form()
    { 
        $('#vvipmyFormx')[0].reset();
        $("#vviprowidx").val(""); 
        $("#vvipcredit").prop('disabled', false);
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


    function save_rates_update()
    {
        var rowid    = $("#rowidx").val();
        var credit   = $("#credit").val();
        var add_hrs = $("#add_hrs").val();
        var add_mins = $("#add_mins").val(); 
		var time_sec  = (add_hrs * 3600) + (add_mins * 60); 
		
        var points   = $("#points").val();
        $.post("../router/router.php", {'request': 'save_rates_update', rowid: rowid, credit: credit, time_sec: time_sec, points: points}, function(data)
        {
            if(data == 1)
            {
                Swal.fire({
                title:"Save Success",  
                icon: 'success', 
                }).then((result) => {
                    if (result.isConfirmed) { 
                        location.reload();
                    }
                })
            }
            else
            {
                if(data != 0)
                {
                    Swal.fire({
                    title: data,  
                    icon: 'warning', 
                    }).then((result) => {
                        if (result.isConfirmed) { 
                            location.reload();
                        }
                    })
                }
               
            }
            
        });
    }

    function vipsave_rates_update()
    {
        var rowid    = $("#viprowidx").val();
        var credit   = $("#vipcredit").val(); 
        var add_hrs = $("#viptime_hours").val();
        var add_mins = $("#viptime_minutes").val(); 
		var time_sec  = (add_hrs * 3600) + (add_mins * 60); 
		
        var points   = $("#vippoints").val();
        $.post("../router/router.php", {'request': 'vipsave_rates_update', rowid: rowid, credit: credit, time_sec: time_sec, points: points}, function(data)
        {
            if(data == 1)
            {
                Swal.fire({
                title:"Save Success",  
                icon: 'success', 
                }).then((result) => {
                    if (result.isConfirmed) { 
                        location.reload();
                    }
                })
            }
            else
            {
                if(data != 0)
                {
                    Swal.fire({
                    title: data,  
                    icon: 'warning', 
                    }).then((result) => {
                        if (result.isConfirmed) { 
                            location.reload();
                        }
                    })
                }
               
            }
            
        });
    }
	
	function vvipsave_rates_update()
    {
        var rowid    = $("#vviprowidx").val();
        var credit   = $("#vvipcredit").val(); 
        var add_hrs = $("#vviptime_hours").val();
        var add_mins = $("#vviptime_minutes").val(); 
		var time_sec  = (add_hrs * 3600) + (add_mins * 60); 
		
        var points   = $("#vvippoints").val();
        $.post("../router/router.php", {'request': 'vvipsave_rates_update', rowid: rowid, credit: credit, time_sec: time_sec, points: points}, function(data)
        {
            if(data == 1)
            {
                Swal.fire({
                title:"Save Success",  
                icon: 'success', 
                }).then((result) => {
                    if (result.isConfirmed) { 
                        location.reload();
                    }
                })
            }
            else
            {
                if(data != 0)
                {
                    Swal.fire({
                    title: data,  
                    icon: 'warning', 
                    }).then((result) => {
                        if (result.isConfirmed) { 
                            location.reload();
                        }
                    })
                }
               
            }
            
        });
    }
	
	function vvipdelete_rates(rowid)
    {
        var cnt = table2.rows({ page: 'current' }).count(); 
        if(cnt == 1)
        {
            Swal.fire({
                title:'Sorry! Unable to delete this single rate!', 
                icon: 'warning', 
            }) 
            return;
        }
        Swal.fire({
            title: "Delete this rates?", 
            icon: 'question', 
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) { 
                $.post("../router/router.php", {'request': 'vvipdelete_rates', rowid: rowid}, function(data)
                {
                    if(data > 0)
                    {
                        Swal.fire({
                        title:'Delete success!', 
                        icon: 'success', 
                        }).then((result) => {
                            if (result.isConfirmed) { 
                                location.reload();
                            }
                        })
                    }
                });
            } 
        })
 
    }
	
</script>
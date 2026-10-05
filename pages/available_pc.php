<style>
.text-xxsm{
	font-size: 0.780rem !important;
}
 
</style> 
<div class="container-fluid py-2">  
  <div class="mb-2 d-flex justify-content-end">
    <?php if (in_array('wakeonlanall', $array) || $role == 'admin') { ?> 
      <button type="button" class="mb-0 btn-sm btn btn-info" onclick = "wake_all()" data-toggle="tooltip" data-placement="top" title="Wake Lan All"><i class="fa-solid fa-network-wired fs-6"></i></button>
  	<?php }?>
    <?php if (in_array('removeall', $array) || $role == 'admin') { ?> 
      <button type="button" class="ms-1 mb-0 btn-sm btn btn-danger" onclick = "remove_all()" data-toggle="tooltip" data-placement="top" title="Remove All"><i class="fa-solid fa-trash-can fs-6"></i></button>
    <?php }?>
    <?php if (in_array('addtimeall', $array) || $role == 'admin') { ?> 
      <button type="button" class="ms-1 mb-0 btn-sm btn btn-success" onclick = "add_all_time()" data-toggle="tooltip" data-placement="top" title="Add Time"><i class="fa-solid fa-hourglass-half fs-6"></i></button>
    <?php }?>
    <?php if (in_array('updateall', $array) || $role == 'admin') { ?> 
      <button type="button" class="ms-1 mb-0 btn-sm btn btn-warning" onclick = "update_rem_time('Reset all guest Time', 0)" data-toggle="tooltip" data-placement="top" title="Reset Guest Time"><i class="fa-solid fa-clock-rotate-left fs-6"></i></button>
    <?php }?>
    <?php if (in_array('chat', $array) || $role == 'admin') { ?> 
      <button type="button" class="ms-1 mb-0 btn-sm btn btn-info" onclick = "chatModal()" data-toggle="tooltip" data-placement="top" title="Broadcast Message"><i class="fas fa-comments fs-6"></i> </button> 
    <?php }?>
  </div>
	<hr class="dark horizontal my-0 mb-2">  
  
  <div id="navigation"> 
    <div class="nav-wrapper" id = "navlist"> 
      <ul class="nav nav-tabs nav-fill flex-column flex-lg-row mb-3 shadow-sm" id="mainTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active"
            id="pc-list-tab"
            data-bs-toggle="tab"
            href="#pc-list"
            role="tab"
            aria-controls="pc-list"
            aria-selected="true">
            <i class="material-icons align-middle me-1">desktop_windows</i>
            PC LIST
          </a>
        </li>

        <li class="nav-item" role="presentation">
          <a class="nav-link"
            id="performance-tab"
            data-bs-toggle="tab"
            href="#performance"
            role="tab"
            aria-controls="performance"
            aria-selected="false">
            <i class="material-icons align-middle me-1">bar_chart</i>
            PC PERFORMANCE
          </a>
        </li>

        <li class="nav-item" role="presentation">
          <a class="nav-link"
            id="spectate-tab"
            data-bs-toggle="tab"
            href="#spectate"
            role="tab"
            aria-controls="spectate"
            aria-selected="false">
            <i class="material-icons align-middle me-1">visibility</i>
            SPECTATE
          </a>
        </li>
      </ul> 
    </div>



    <div class="tab-content mt-2">
      <div class="tab-pane fade show active" id="pc-list" role="tabpanel" aria-labelledby="pc-list-tab">
        <div class="row g-2 list_pc"></div>
      </div>

      <div class="tab-pane fade" id="performance" role="tabpanel" aria-labelledby="performance-tab"> 
        <div class="row g-2 performance"></div> 
      </div> 

      <div class="tab-pane fade" id="spectate" role="tabpanel" aria-labelledby="spectate-tab">
        <div class="row g-2 spectate"> </div>
      </div> 
    </div>
    
  </div>
   

  <!-- CHAT MODAL -->
  <div class="modal fade" id="chatModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content shadow-lg border-0">

              <!-- HEADER -->
              <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title text-white"><i class="fas fa-comments"></i> Send Message</h5>
                  <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>

              <!-- BODY -->
              <div class="modal-body">

                  <!-- Select Target -->
                  <div class="mb-3">
                      <label class="form-label fw-bold" for = "targetClient">Send To:</label>
                      <select id="targetClient" class="border p-3 form-select"> 
                      </select>
                  </div>

                  <!-- Template Selector -->
                  <div class="mb-3">
                      <label class="form-label fw-bold" for = "messageTemplate">Message Template:</label>
                      <select id="messageTemplate" class="border p-3 form-select"> 
                      </select>
                  </div>

                  <!-- Message Box -->
                  <div class="mb-3">
                      <label class="form-label fw-bold" for = "chatMessage">Message:</label>
                      <textarea id="chatMessage" class="p-3 border form-control" rows="4" placeholder="Type your message here..."></textarea>
                  </div>

              </div>

              <!-- FOOTER -->
              <div class="modal-footer">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button class="btn btn-info" id="sendChatBtn">
                      <i class="fas fa-paper-plane"></i> Send Message
                  </button>
              </div>

          </div>
      </div>
  </div>

<!-- TOP UP Modal -->  
  <div class="modal fade" id="top_up_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <form class="needs-validation top_up_form" novalidate>
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="top_up_title"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="form-floating mb-1 border rounded-3"> 
                <input type="hidden" id = "top_up_rowid">
                <input type="hidden" id = "top_up_table">
                <input type="number" class="form-control ps-2 text-center fw-bold fs-4" onkeypress= "num_only(event)" id="top_up"  min = "0">
                <label for="top_up">Credit (PHP):</label>
              </div>  
          </div>
          <div class="modal-footer ">
            <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="mb-0 btn btn-success" id = "addCredit">Add Credit</button>
            <button type="submit" class="mb-0 btn btn-danger" id = "deductCredit">Deduct Credit</button>
          </div> 
        </form>
      </div>
    </div>
  </div>
  
  <!-- Manage Time Modal -->  
  <div class="modal fade" id="mange_time_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <form class="needs-validation" novalidate>
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="mng_time_title"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="form-floating mb-1 border rounded-3">
                <input type="hidden" id = "rowid">
                <input type="hidden" id = "table">
                <input type="text" class="form-control ps-2 text-center fw-bold fs-6"  id="pc_name" readonly>
                <label for="pc_name">PC NAME</label>
              </div> 
			  
			   <label for="m_hours" class="mb-0 mt-0">Time (hh:mm:ss)</label>  
				<div class="mb-0 mt-0 d-flex">
					<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="m_hours" value="0" min="0"   oninput="num_only(event)" required>
					<span class = " fs-4">:</span>
					<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="m_mins" value="0" min="0" max="59"  oninput="num_only(event); validateInput(event);" required>
					<span class = " fs-4">:</span>
					<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="m_seconds" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
				</div>
					
          </div>
          <div class="modal-footer ">
            <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="mb-0 btn btn-primary-x" >Update</button>
          </div> 
        </form>
      </div>
    </div>
  </div>
  
  
  
   <!-- Add Guest Time Modal -->  
  <div class="modal fade" id="add_mange_time_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <form class="needs-validation add_guest_time"  novalidate>
          <div class="modal-header">
            <h1 class="modal-title fs-5">Manage Guest Time</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="form-floating mb-1 border rounded-3"> 
                <input type="hidden" id = "add_rowid">
                <input type="hidden" id = "add_table">
                <input type="text" class="form-control ps-2 text-center fw-bold fs-6"  id="add_pc_name" readonly>
                <label for="add_pc_name">PC NAME</label>
              </div> 
			  
			   <label for="add_m_hours" class="mb-0 mt-0">Time (hh:mm:ss)</label>  
				<div class="mb-0 mt-0 d-flex">
					<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="add_m_hours" value="0" min="0"   oninput="num_only(event)" required>
					<span class = " fs-4">:</span>
					<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="add_m_mins" value="0" min="0" max="59"  oninput="num_only(event); validateInput(event);" required>
					<span class = " fs-4">:</span>
					<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="add_m_seconds" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
				</div>
					
          </div>
          <div class="modal-footer ">
            <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="mb-0 btn btn-success" id = "addTimeButton">Add Time</button>
            <button type="submit" class="mb-0 btn btn-danger" id = "deductTimeButton">Deduct Time</button>
          </div> 
        </form>
      </div>
    </div>
  </div>
  
  <!-- Transfer Modal -->  
  <div class="modal fade" id="transfer_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <form class="needs-validation tranfer_form" novalidate>
          <div class="modal-header">
            <h1 class="modal-title fs-5">Transfer Time</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
			<div class="form-floating mb-1 border rounded-3"> 
                <input type="text" class="form-control ps-2 text-center fw-bold fs-4"  id="from_pc" readonly>
                <input type="hidden" class="form-control ps-2 text-center fw-bold fs-4"  id="from_rowid" readonly>
                <label for="from_pc">From:</label>
			</div>
			<div class="w-100 form-floating">
			  <select class="ps-4 form-select text-center fw-bold fs-6" id="to_pc" aria-label="Floating label select example" required>
			 
			  </select>
			  <label for="to_pc">TO:</label>
			   <div class="invalid-feedback text-center mb-0">
                  Please Select pc
                </div>
			</div>		
          </div> 
		  
          <div class="modal-footer ">
            <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="mb-0 btn btn-primary-x" >Transfer Now</button>
          </div> 
        </form>
      </div>
    </div>
  </div>
  
  
  <!-- Change Background Modal -->  
  <div class="modal fade" id="bck_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <form class="needs-validation validation3" novalidate id = "form_background">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="bck_title"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
		  
			<div class="card">
			  <img src="" class="p-1 card-img-top" id = "prev_img" alt="...">
			  <video id="ftech_background_video" style="display:none; max-width:100%; height:auto;" autoplay loop muted></video>
			  <div class="card-body mb-0">
				<div class="input-group mb-1">
				  <input type = "hidden" id = "file_id" name = "file_id">
				  <input type="file" class="form-control border" id="file" name = "file" required accept="image/*,video/mp4"> 
				</div>
			  </div>
			</div>

          </div>
          <div class="modal-footer ">
            <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="mb-0 btn btn-primary-x" >Save changes</button>
          </div> 
        </form>
      </div>
    </div>
  </div>
  
  <!-- ADD ALL Time Modal -->  
  <div class="modal fade" id="add_time_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <form class="needs-validation validation2" novalidate>
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="add_time_title"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body"> 
 
			  
			    <label for="m_hours" class="mb-0 mt-0">Time (hh:mm:ss)</label>  
				<div class="mb-0 mt-0 d-flex">
					<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="add_hrs" value="0" min="0"   oninput="num_only(event)" required>
					<span class = " fs-4">:</span>
					<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="add_mins" value="0" min="0" max="59"  oninput="num_only(event); validateInput(event);" required>
					<span class = " fs-4">:</span>
					<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="add_seconds" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
				</div>
				
          </div>
          <div class="modal-footer ">
            <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="mb-0 btn btn-primary-x" >Add</button>
          </div> 
        </form>
      </div>
    </div>
  </div> 
  <!-- END MODAL --> 
</div>


<script>
  $(document).ready(function(){ 
    get_pc_list(); 
    get_pc_performance();  
    getTemplate();
   
    setInterval(update_per_pc, 1000);

    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) { 
        const target = $(e.target).attr("href");   
        clearInterval(window.performanceInterval); 
        const iframes = document.querySelectorAll(".monitor-frame"); 
        if (target === '#performance') {   
            iframes.forEach(frame => {
              frame.src = "";
            });
          if ($("#navigation:contains('SUBSCRIPTION REQUIRED')").length == 0) { 
            window.performanceInterval = setInterval(updatePCPerformance, 1000);
          } 
        } 
        else if (target === '#spectate') 
        {
          iframes.forEach(frame => {
            const realSrc = frame.getAttribute("data-src");
            if (frame.src !== realSrc) {
                frame.src = realSrc;
            }
          });
        }
        else { 
          iframes.forEach(frame => {
              frame.src = "";
          }); 
        }
    });
 
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
				if (form.classList.contains('validation2')) {
					save_add_time();
				} 
				else if(form.classList.contains('validation3')){
					Swal.fire({
						title: 'Loading...',
						text: 'Please wait while we process your request.',
						allowOutsideClick: false, // Prevent closing by clicking outside
						didOpen: () => {
							Swal.showLoading(); // Show the loading spinner
						}
					});  
					upload_file();
				}
				else if(form.classList.contains('tranfer_form'))
				{
					 transfer_now();
				}
				else if(form.classList.contains('top_up_form'))
				{ 
					if (clickedButton.id == 'addCredit') {
						top_up_guest();
					} 
					else if (clickedButton.id == 'deductCredit') {
						deduct_top_up_guest();
					}
				}
				else if(form.classList.contains('add_guest_time'))
				{ 
					console.log(clickedButton);
					if (clickedButton.id == 'addTimeButton') {
						add_guest_time_submit();
					} 
					else if (clickedButton.id == 'deductTimeButton') {
						deductTimeAction();
					}
				} 
				else{
					manage_time_guest();
				} 
            }
            form.classList.add('was-validated')
          }, false)
        })
    })() 
  })

 
  function get_pc_list() {
    $.post("../router/router_main.php", { request: "get_pc_list" }, function(data) { 
        $(".list_pc").empty();
        $(".spectate").empty();
        if(data.status == 'nopc')
        {
          $(".list_pc").html(data.msg); 
          $(".spectate").html(data.msg); 
          $("#targetClient").html("<option value = ''>-- No Available Pc --s</option>");  
        }
        else
        {
          $(".list_pc").html(data.pc_list);  
          $(".spectate").html(data.spectate);  
          $("#targetClient").html(data.options);  
          
        }
    }, 'json');  
  }

  function getTemplate() {
    $.post("../router/router_main.php", { request: "getTemplate" }, function(data) { 
      $("#messageTemplate").html(data.options);  
    }, 'json');  
  }


  function get_pc_performance()
  {
    $.post("../router/router_main.php", {request: "get_pc_performance"}, function(data){ 
      $(".performance").empty(); 
      $(".performance").html(data);  
    });
  }

  function update_per_pc()
  {
    $.post("../router/router.php", {request: "update_per_pc"}, function(data){
      var json = JSON.parse(data); 
      $.each(json,function(i,val){
        $(".rem_time_" + val['rowid']).text(val['rem_time']);
        $("#tot_cred_" + val['rowid']).text(val['tot_cred']);
        $(".username_" + val['rowid']).text(val['username']);
        $("#last_inserted_" + val['rowid']).text(val['last_inserted']);
        $("#online_stat_" + val['rowid']).text(val['online_stat']);
		
		if(val['online_stat'] == "ONLINE")
		{ 
			if(val['rem_time'] != '00:00:00')
			{ 
				$("#online_stat_" + val['rowid']).removeClass('text-danger');
				$("#online_stat_" + val['rowid']).removeClass('text-warning');
				$("#online_stat_" + val['rowid']).addClass('text-success');
				 
				$("#pc_logo_" + val['rowid']).removeClass('text-danger');
				$("#pc_logo_" + val['rowid']).removeClass('text-warning');
				$("#pc_logo_" + val['rowid']).addClass('text-success');
			}
			else
			{
				$("#online_stat_" + val['rowid']).removeClass('text-danger');
				$("#online_stat_" + val['rowid']).removeClass('text-success');
				$("#online_stat_" + val['rowid']).addClass('text-warning');
				 
				$("#pc_logo_" + val['rowid']).removeClass('text-danger');
				$("#pc_logo_" + val['rowid']).removeClass('text-success');
				$("#pc_logo_" + val['rowid']).addClass('text-warning');
			}
		}
		else
		{
			$("#online_stat_" + val['rowid']).removeClass('text-success');
			$("#online_stat_" + val['rowid']).addClass('text-danger');
			
			$("#pc_logo_" + val['rowid']).removeClass('text-success');
			$("#pc_logo_" + val['rowid']).addClass('text-danger');
		}
      });
    });
  }

  function manage_time(id, table, hours,mins,seconds,pc_name)
  {
    $("#pc_name").val(pc_name);
    $("#rowid").val(id);
    $("#table").val(table);
    $("#mng_time_title").text("Manage Time");
	$("#m_hours").val(hours);   
	$("#m_mins").val(mins);   
	$("#m_seconds").val(seconds);   
    $("#mange_time_modal").modal('show');
  }
  
  
  function add_guest_time(id, table, pc_name)
  {
    $("#add_rowid").val(id);
    $("#add_table").val(table);
	$("#add_pc_name").val(pc_name);    
    $("#add_mange_time_modal").modal('show');
  }
  
  function add_guest_time_submit()
  {   
    var table = $("#add_table").val();
    var rowid = $("#add_rowid").val() 
	
	var m_hours    = Number($("#add_m_hours").val());
	var m_mins     = Number($("#add_m_mins").val());
	var m_seconds  = Number($("#add_m_seconds").val()); 
	var time  = Number((m_hours * 3600) + (m_mins * 60) + (m_seconds));  

	Swal.fire({
		title: 'Loading...',
		text: 'Please wait while we process your request.',
		allowOutsideClick: false, // Prevent closing by clicking outside
		didOpen: () => {
			Swal.showLoading(); // Show the loading spinner
		}
	});  
			
    $.post("../router/router.php", {request: "add_time", table: table, rowid:rowid, time: time}, function(data){
      if(data > 0)
      {
        Swal.fire({
          title: 'Add Time success!',
          text: "Add Time",
          icon: 'success', 
        }).then((result) => {
          if (result.isConfirmed) { 
            location.reload();
          }
        })
      }
    });
  }
  
  function deductTimeAction()
  {
	var table = $("#add_table").val();
    var rowid = $("#add_rowid").val() 
	
	var m_hours    = Number($("#add_m_hours").val());
	var m_mins     = Number($("#add_m_mins").val());
	var m_seconds  = Number($("#add_m_seconds").val()); 
	var time  = Number((m_hours * 3600) + (m_mins * 60) + (m_seconds));  

	Swal.fire({
		title: 'Loading...',
		text: 'Please wait while we process your request.',
		allowOutsideClick: false, // Prevent closing by clicking outside
		didOpen: () => {
			Swal.showLoading(); // Show the loading spinner
		}
	});  
			
    $.post("../router/router.php", {request: "deduct_time", table: table, rowid:rowid, time: time}, function(data){
      if(data > 0)
      {
        Swal.fire({
          title: 'Deduct Time success!',
          text: "Deduct Time",
          icon: 'success', 
        }).then((result) => {
          if (result.isConfirmed) { 
            location.reload();
          }
        })
      }
    });
  } 
  
  function change_background(id, table, background_img)
  { 
    var fallback_img = "/admin/assets/img/default.png";
	
	let path = background_img;
	let ext = path.split('.').pop().toLowerCase(); // get file extension 
	if (ext === "mp4") {
		// Hide image, show video 
		$("#prev_img").hide();
		$("#ftech_background_video")
		.attr("src", path)
		.show()[0].play();
	} else { 
		$("#ftech_background_video").hide();
		$('#prev_img').attr('src', background_img).on('error', function() {
			$(this).attr('src', fallback_img);
		}).show();
	}
	$("#file_id").val(id);
    $("#bck_title").text("Change FTECH Background");
    $("#bck_modal").modal('show');
  }

  function reset_time(id, table)
  { 
    Swal.fire({
      title: 'Are you sure?',
      text: "Reset Time!",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Reset!'
      }).then((result) => {
      if (result.isConfirmed) { 
          $.post("../router/router.php", {request: "reset_time", table: table, rowid:id}, function(data){
            if(data > 0)
            {
              Swal.fire({
                title: 'Reset Time success!',
                text: "Reset Time",
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


  function remove(rowid)
  {
    Swal.fire({
      title: 'Are you sure?',
      text: "Remove PC",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Remove!'
      }).then((result) => {
      if (result.isConfirmed) { 
          $.post("../router/router.php", {request: "remove_pc", rowid:rowid}, function(data){
            if(data > 0)
            {
              Swal.fire({
                title: 'Removed success!', 
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

  function num_only(event) { 
    var charCode = (typeof event.which === "number") ? event.which : event.keyCode;
    if (charCode !== 8 && (charCode < 48 || charCode > 57)) {
      event.preventDefault();
    }
  }

  function returnZero(inputElement)
  { 
    if(inputElement.value.trim() === "")
    {
      inputElement.value = "0";
    }
  }


  function manage_time_guest()
  { 
    var table = $("#table").val();
    var rowid = $("#rowid").val() 
	
	var m_hours    = Number($("#m_hours").val());
	var m_mins     = Number($("#m_mins").val());
	var m_seconds  = Number($("#m_seconds").val()); 
	var time  = Number((m_hours * 3600) + (m_mins * 60) + (m_seconds));  
	
    $.post("../router/router.php", {request: "manage_time_guest", table: table, rowid:rowid, time: time}, function(data){
      if(data > 0)
      {
        Swal.fire({
          title: 'Update success!',
          text: "Manage Time",
          icon: 'success', 
        }).then((result) => {
          if (result.isConfirmed) { 
            location.reload();
          }
        })
      }
    });
  }


function enableApp(state, rowid)
{
	var enable_autoshutdown = "true";
	if (!state.checked) {
		enable_autoshutdown = "false";
	}
	
	var initialCheckedState = !state.checked; 
	
	Swal.fire({
	  title: 'Are you sure?',
	  text: (enable_autoshutdown == "true") ? "Enable FTECH APP" : "Disable FTECH App",
	  icon: 'question',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes!'
	  }).then((result) => {
		if (result.isConfirmed) { 
			$.post("../router/router.php", {request: "enableApp",rowid:rowid, state: enable_autoshutdown}, function(data){
			console.log("Update success");
		  });
		}
		else
		{
			$(state).prop('checked', initialCheckedState);
		}
	})
}


function update_rem_time(action, rem_time)
{
	Swal.fire({
	  title: 'Are you sure?',
	  text: action,
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
			$.post("../router/router.php", {request: "update_rem_time", rem_time:rem_time, action: action}, function(data){
				if(data > 0)
				{
					Swal.fire({
					  title: action + ' success!',
					  text: action,
					  icon: 'success', 
					}).then((result) => {
					  if (result.isConfirmed) { 
						location.reload();
					  }
					})
				}
				else
				{
					Swal.close(); 
				}
		  });
		} 
	})
}

function add_all_time()
{ 
	$("#add_time_title").text("Add Time To All");
	$("#add_time_modal").modal('show');
} 

function chatModal()
{
	$("#chatModal").modal('show');
}

function save_add_time()
{
	var hrs   = Number($("#add_hrs").val());
    var mins  = Number($("#add_mins").val()); 
	var add_seconds  = Number($("#add_seconds").val()); 
	var time  = Number((hrs * 3600) + (mins * 60) + (add_seconds));   
	update_rem_time("Add Time", time); 
}


$('#file').on('change', function() {
	const file = this.files[0];
	
	if (file) { 
		const reader = new FileReader();
        const ext = file.name.split('.').pop().toLowerCase(); // check extension

        reader.onload = function(event) {
            if (ext === "mp4") {
                // Show video
                $('#prev_img').hide();
                $('#ftech_background_video')
                    .attr('src', event.target.result)
                    .show()[0].play();
            } else {
                // Show image
                $('#ftech_background_video').hide();
                $('#prev_img')
                    .attr('src', event.target.result)
                    .show();
            }
        }; 
        reader.readAsDataURL(file);
	} else {
		$('#prev_img').attr('src', '').hide();
	}
});




function upload_file()
{
	var formData = new FormData($("#form_background")[0]);
    formData.append("request", "change_background"); 
    $.ajax({
        url: '../router/router.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){  
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: "Successfully updated!",
              showConfirmButton: false,
              timer: 1500
            }).then((result) => {
               location.reload();
            });
        },
        error: function(xhr, status, error){
            // Handle errors
            console.error(xhr.responseText);
        }
    });
}

function set_as_vip(rowid)
{
  Swal.fire({
        title: 'VIP STATUS',
        html: `
            <select id="dropdown-menu" class="swal2-select"> 
                <option value="YES">VIP</option>
                <option value="YYES">VVIP</option>
                <option value="NO">NON-VIP</option> 
            </select>
        `,
        confirmButtonText: 'OK',
        preConfirm: () => {
            const dropdown = Swal.getPopup().querySelector('#dropdown-menu');
            return dropdown.value;
        },
        willClose: () => {
            const selectedOption = Swal.getPopup().querySelector('#dropdown-menu').value; 
        }
    }).then((result) => {
        if (result.isConfirmed) { 
          if(result.value != "")
          { 
            $.post("../router/router.php", {request: "set_as_vip", rowid:rowid, value:result.value }, function(data){
            if(data > 0)
            {
              Swal.fire({
                title:'Update success!', 
                icon: 'success', 
              }).then((result) => {
                if (result.isConfirmed) { 
                  location.reload();
                }
              })
            }
          });

          }
        }
    });
}
 
 
 function transfer_time(rowid,pcname)
 { 
	get_transfer_pc(rowid)
	setTimeout(function() {  
		$("#transfer_modal").modal('show');
		$("#from_pc").val(pcname);
		$("#from_rowid").val(rowid);
		
    }, 200);
 }
 
 function get_transfer_pc(rowid)
 {
	$.post("../router/router.php", {request: "get_transfer_pc", rowid:rowid}, function(data){ 
		$("#to_pc").html(data);
  });
 }
 
 function transfer_now(from_rowid, to_rowid)
 {
	var from_rowid = $("#from_rowid").val();
	var to_rowid = $("#to_pc").val();
	
	Swal.fire({
		title: 'Loading...',
		text: 'Please wait while we process your request.',
		allowOutsideClick: false, // Prevent closing by clicking outside
		didOpen: () => {
			Swal.showLoading(); // Show the loading spinner
		}
	});  
	$.post("../router/router.php", {request: "transfer_now", from_rowid:from_rowid, to_rowid:to_rowid}, function(data){ 
		if(data > 0)
		{
			Swal.fire({
                title:'Transfer success!', 
                icon: 'success', 
              }).then((result) => {
                if (result.isConfirmed) { 
                  location.reload();
                }
              })
		}
	});
 }
 
 function shutdown_reboot_pc(rowid, fields)
 {
	 
	Swal.fire({
      title: 'Are you sure?',
      text: fields[0].toUpperCase() + fields.slice(1),
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: fields[0].toUpperCase() + fields.slice(1)
      }).then((result) => {
      if (result.isConfirmed) {  
			$.post("../router/router.php", {request: "shutdown_reboot_pc", rowid:rowid, fields: fields}, function(data){ 
				Swal.fire({
					title:'Success!', 
					icon: 'success', 
				})
			});
        }
	})
	
 }
 
 function wake_on_lan(mac)
 { 
	$.post("../router/router.php", {request: "wake_on_lan", mac:mac}, function(data){ 
		Swal.fire({
			title:'Please wait...', 
			text: data, 
		})
	});
 }
 
 function wake_all()
 {
	$.post("../router/router.php", {request: "wake_all"}, function(data){ 
		Swal.fire({
			title:'Please wait...', 
			text: data, 
		})
	}); 
 }
 
 function top_up(rowid,table,title)
 { 
    $("#top_up_title").text(title);
	  $("#top_up_rowid").val(rowid);
    $("#top_up_table").val(table);
    $("#top_up_modal").modal('show');
 }
 
 function top_up_guest()
 {
	var top_up_rowid = $("#top_up_rowid").val();
	var top_up_table = $("#top_up_table").val();
	var credit = $("#top_up").val();
	
	if(credit == "" || credit == 0)
	{
		Swal.fire({
			title:'Invalid Top Up',  
			icon: 'warning'
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
	$.post("../router/router.php", {request: "top_up", top_up_rowid:top_up_rowid, top_up_table:top_up_table, credit:credit}, function(data){ 
		if(data > 0)
		{
			Swal.fire({
                title:'Top Up success!', 
                icon: 'success', 
			}).then((result) => {
                if (result.isConfirmed) { 
                  location.reload();
                }
			})
		}
	});
 }
 
 function deduct_top_up_guest()
 {
	var top_up_rowid = $("#top_up_rowid").val();
	var top_up_table = $("#top_up_table").val();
	var credit = $("#top_up").val();
	
	if(credit == "" || credit == 0)
	{
		Swal.fire({
			title:'Invalid Top Up',  
			icon: 'warning'
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
	$.post("../router/router.php", {request: "deduct_top_up_guest", top_up_rowid:top_up_rowid, top_up_table:top_up_table, credit:credit}, function(data){ 
		if(data > 0)
		{
			Swal.fire({
                title:'Deduct Credit success!', 
                icon: 'success', 
			}).then((result) => {
                if (result.isConfirmed) { 
                  location.reload();
                }
			})
		}
	});
 }
 

 function validateInput(event) {
  let input = event.target;
  let value = input.value;
 
  if (value > 59) {
    input.value = 59;
  } else if (value < 0) {
    input.value = 0;
  } else if (value.length > 2) {
    input.value = value.substring(0, 2);  // Allow only 2 digits
  }
}

function remove_all()
{
	Swal.fire({
	  title: 'Are you sure?',
	  text: "Delete all PC",
	  icon: 'question',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: "YES"
	  }).then((result) => {
	  if (result.isConfirmed) {  
			$.post("../router/router.php", {request: "remove_all"}, function(data){  
				Swal.fire({
					title:'Delete success!', 
					icon: 'success', 
				}).then((result) => {
					if (result.isConfirmed) { 
					  location.reload();
					}
				})
			});
		}
	})
}
 
function updatePCPerformance() {
  fetch('../router/router_main.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'request=ajax_get_pc_performance_json'
  })
  .then(res => res.json())
  .then(data => {
    if (!data || Object.keys(data).length === 0) return;

    Object.entries(data).forEach(([pcId, pc]) => {
      if (!pc) return; // ✅ skip null data

      // ---------------- CPU ----------------
      if (pc.CPU) {
        const cpuUsage = parseFloat(pc.CPU.Usage) || 0;
        const cpuTemp = pc.CPU.Temperature !== 'N/A' ? pc.CPU.Temperature : 'N/A';

        const cpuUsageEl = document.getElementById('cpu_usage_' + pcId);
        const cpuTempEl = document.getElementById('cpu_temp_' + pcId);
        const cpuBar = document.getElementById('cpu_bar_' + pcId);

        if (cpuUsageEl) cpuUsageEl.innerText = cpuUsage.toFixed(0) + '%';
        if (cpuTempEl) cpuTempEl.innerText = cpuTemp + '°C';

        if (cpuBar) {
          let cpuColor = cpuUsage > 80 ? 'danger' : cpuUsage > 60 ? 'warning' : 'success';
          cpuBar.style.width = cpuUsage + '%';
          cpuBar.className = 'progress-bar bg-' + cpuColor;
          if (cpuUsageEl) cpuUsageEl.className = 'fw-bold text-' + cpuColor;
        }
      }

      // ---------------- Memory ----------------
      if (pc.Memory) {
        const memPercent = parseFloat(pc.Memory.UsagePercent) || 0;
        const memColor = memPercent > 80 ? 'danger' : memPercent > 60 ? 'warning' : 'success';

        const memUsageEl = document.getElementById('mem_usage_' + pcId);
        const memBar = document.getElementById('mem_bar_' + pcId);
        const memTextEl = document.getElementById('mem_text_' + pcId);

        if (memUsageEl) {
          memUsageEl.innerText = memPercent + '%';
          memUsageEl.className = 'fw-bold text-' + memColor;
        }
        if (memBar) {
          memBar.style.width = memPercent + '%';
          memBar.className = 'progress-bar bg-' + memColor;
        }
        if (memTextEl) {
          memTextEl.innerText = `${pc.Memory.UsedGB} / ${pc.Memory.TotalGB} GB`;
        }
      }

      // ---------------- Network ----------------
      if (pc.Network) {
        const uploadEl = document.getElementById('net_upload_' + pcId);
        const downloadEl = document.getElementById('net_download_' + pcId);
        if (uploadEl) uploadEl.innerText = `${pc.Network.UploadKBs} KB/s`;
        if (downloadEl) downloadEl.innerText = `${pc.Network.DownloadKBs} KB/s`;
      }

      // ---------------- GPUs ----------------
      if (pc.GPUs && Array.isArray(pc.GPUs)) {
        pc.GPUs.forEach((gpu, index) => {
          let gpuUsage = gpu.UsagePercent !== 'N/A' ? parseFloat(gpu.UsagePercent) : 0;
          let gpuColor = gpuUsage > 80 ? 'danger' : 'success';

          const gpuUsageEl = document.getElementById(`gpu_usage_${pcId}_${index}`);
          const gpuTempEl = document.getElementById(`gpu_temp_${pcId}_${index}`);
          const gpuBar = document.getElementById(`gpu_bar_${pcId}_${index}`);

          if (gpuUsageEl) {
            gpuUsageEl.innerText = gpu.UsagePercent !== 'N/A' ? gpuUsage + '%' : 'N/A';
            gpuUsageEl.className = 'fw-bold text-' + gpuColor;
          }
          if (gpuTempEl) {
            gpuTempEl.innerText = gpu.TemperatureC !== 'N/A' ? gpu.TemperatureC + '°C' : 'N/A';
          }
          if (gpuBar) {
            gpuBar.style.width = gpu.UsagePercent !== 'N/A' ? gpuUsage + '%' : '0%';
            gpuBar.className = 'progress-bar bg-' + gpuColor;
          }
        });
      }

      // ---------------- Disks ----------------
      if (pc.Disks && Array.isArray(pc.Disks)) {
        pc.Disks.forEach((disk, index) => {
          const diskColor = parseFloat(disk.UsedPercent) > 80 ? 'danger' : 'success';
          const diskUsageEl = document.getElementById(`disk_usage_${pcId}_${index}`);
          const diskBar = document.getElementById(`disk_bar_${pcId}_${index}`);

          if (diskUsageEl) {
            diskUsageEl.innerText =
              `${disk.UsedGB} / ${disk.TotalGB} GB (${disk.UsedPercent}%)`;
            diskUsageEl.className = 'text-' + diskColor;
          }
          if (diskBar) {
            diskBar.style.width = disk.UsedPercent + '%';
            diskBar.className = 'progress-bar bg-' + diskColor;
          }
        });
      }
    });
  })
  .catch(err => console.error('Error updating PC performance:', err));
}
 
// APPLY TEMPLATE
document.getElementById("messageTemplate").onchange = function () {
  let template = this.value; 
  document.getElementById("chatMessage").value = template; 
};


$(document).on('click', '#sendChatBtn', function() {
  var msg = $('#chatMessage').val();
  var targetClient = $('#targetClient').val();

  if($.trim(msg) == "")
  {
    Swal.fire({
			title:'Please type your message!.',  
			icon: 'warning'
		})
    return;
  }
  sendMessage(msg,targetClient)
})

function sendMessage(msg,targetClient)
{ 
  $.post("../router/router_main.php", {request: "sendMessage",msg:msg,target:targetClient}, function(data){   
    
    $("#chatModal").modal('hide');
    if(data.status == "success")
    {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "success",
        title: data.msg
      });
    }
    else
    {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "error",
        title: data.msg
      });
    }
  }, 'json');
}

function toggleButton(el,rowid,type) {  

    Swal.fire({
      title: 'Are you sure?',
      html: `Switching to <strong>${type}</strong> for better cpu performance?`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes!'
      }).then((result) => {
      if (result.isConfirmed) { 
        $.post("../router/router.php", {request: "updateffmpeg", type: type, rowid:rowid}, function(data){
          if(data > 0)
          {
            Swal.fire({
              title: 'Update success!', 
              text: "Please reboot your computer.",
              icon: 'success', 
            })  
            const links = el.closest('ul').querySelectorAll('.nav-link');
            links.forEach(link => link.classList.remove('active', 'bg-success', 'text-white'));
            el.classList.add('active', 'bg-success', 'text-white'); 
          }
          else
          {
            Swal.fire({
              title: 'No Changes have beend made!', 
              icon: 'info', 
            }) 
          }
        });
      }
    })
}

</script>
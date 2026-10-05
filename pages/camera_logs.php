<div class="container-fluid py-2">   
	<!-- Video List Modal -->
	<div class="modal fade" id="videoListModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	  <div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
		  <div class="modal-header bg-info text-white">
			<h5 class="modal-title text-white"  ><i class="fas fa-list"></i> Available Videos</h5>
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<ul id="videoList" class="list-group">
			  <!-- Video items will be dynamically added here -->
			</ul>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>

	<!-- Play Video Modal -->
	<div class="modal fade" id="playVideoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" style = "z-index: 9999 !important;">
	  <div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
		  <div class="modal-header bg-dark text-white">
			<h5 class="modal-title text-white"><i class="fas fa-play"></i> Play Video</h5>
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="stopVideo()"></button>
		  </div>
		  <div class="modal-body text-center">
			<video id="videoPlayer" width="100%" height="auto" controls autoplay>
			  <source src="" type="video/mp4">
			  Your browser does not support the video tag.
			</video>
		  </div>
		</div>
	  </div>
	</div>
		

    <div class="mb-4">
        <div class="mt-0 mb-4">
			<div class="card">
				<div class="card-header py-2 border-bottom">
					<div class=" d-flex align-items-center justify-content-between"> 
						<h6 class = "mb-0">Recording Config</h6> 
						<!--div class = "mb-0">
							<button class = "mb-0 btn-sm btn btn-danger f-6" onclick= "delete_all_member();">Clear</button>
						</div-->
					</div>
				</div> 
				<div class="card-body px-0 pb-1">
				
					<div class = "mt-0 mb-3 px-3"> 
					 
						<h6 class = "mb-0 mt-0 text-sm fs-6 text-muted">Set recording retention (1–7 days). Recordings older than the set days will be deleted automatically.<span class = "text-danger opacity-8 ms-1" id = "loading"></h6>
						<div class = "row g-2">
							<div class="col-xl-6 col-md-12">
								<div class="w-100 form-floating mb-1 border rounded-3"> 
									<input type="text" class="form-control ps-2 text-center fw-bold fs-5" id="idle_time" onkeypress="return limitRange(event)">
									<label for="idle_time">Auto-Cleanup After (Days):</label>
								</div> 
							</div>
							
							<div class="col-xl-6 col-md-12">
								<div class="w-100 form-floating">
									<select class="ps-4 form-select text-center" id="filter_by" name="filter_by" aria-label="Floating label select example">
										<option value="" selected>-- Select Filter --</option>
										<option value="TODAY">Today</option>
										<option value="YESTERDAY">Yesterday</option>
										<option value="2_DAYS_AGO">2 Days Ago</option>
										<option value="3_DAYS_AGO">3 Days Ago</option>
										<option value="4_DAYS_AGO">4 Days Ago</option>
										<option value="5_DAYS_AGO">5 Days Ago</option>
										<option value="6_DAYS_AGO">6 Days Ago</option>
										<option value="7_DAYS_AGO">7 Days Ago</option>
									</select>
								  <label for="filter_by">Filter by:</label>
								</div>
							</div> 
						</div> 	  
					</div> 
				</div>
			</div>  
		</div> 
		
		<div class="mt-0 mb-4">
			<div class="card">
				<div class="card-header py-2 border-bottom">
					<div class=" d-flex align-items-center justify-content-between"> 
						<h6 class = "mb-0">Recording Logs</h6>  
					</div>
				</div> 
				<div class="card-body d-flex justify-content-center align-items-center" id="recording_logs_body">
				  <h6 class="mb-0 fs-6 text-muted">No Available Records</h6>
				</div> 
			</div>  
		</div>
	</div> 
</div>

  
<script>
const BASE_URL = "<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>/recording/";
    
$(document).ready(function(){
	getRetainDays();
});
function getRetainDays()
{
	$.post("../router/router.php", {request: "getRetainDays"}, function(data){  
		$("#idle_time").val(data);
	});  
} 
function limitRange(e) {
   const key = e.key;

    // Allow control keys like backspace, delete, arrows
    if (e.ctrlKey || e.metaKey || key === "Backspace" || key === "Delete" || key === "ArrowLeft" || key === "ArrowRight") {
        return true;
    }

    // Prevent non-digit input
    if (!/^\d$/.test(key)) {
        return false;
    }

    const input = e.target;
    const nextValue = input.value + key;

    // Limit to 1 or 2 digits
    if (nextValue.length > 2) return false;

    // Limit number between 1 and 7
    const num = parseInt(nextValue, 10);
    if (num < 1 || num > 7) return false;

    return true;
}
let typingTimer;  
let doneTypingInterval = 1000;   
$('#idle_time').on('keyup', function(event) { 
    var inputValue = $(this).val();
     
    if (event.keyCode === 8) {
        return;  
    }
     
    clearTimeout(typingTimer);
 
    $("#loading").text("Please wait...");
    $("#loading").removeClass('text-success');
    $("#loading").addClass('text-danger');
 
    typingTimer = setTimeout(function() { 
        if(inputValue != "") { 
            $.post("../router/router.php", {request: "save_retention", retentionday: inputValue}, function(data) {
                if(data > 0) {
                    $("#loading").text("Successfully saved!");
                    $("#loading").removeClass('text-danger');
                    $("#loading").addClass('text-success');
                }
				else
				{
                    $("#loading").text("");
				}
            }); 
        }
    }, doneTypingInterval);
});

const filterSelect = document.getElementById('filter_by');
const logsBody = document.getElementById('recording_logs_body');

$('#filter_by').on('change', function() {
	var selectedValue = $(this).val(); // get selected value
	var idleTime = $('#idle_time').val(); // get the auto-cleanup input value if needed

	// make POST request
	if(selectedValue != "")
	{
		
		// show loading spinner
		$('#recording_logs_body').html(`
			<div class="d-flex justify-content-center align-items-center">
				<div class="spinner-border text-primary" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</div>
		`);


		$.post("../router/router.php", 
			{ request: "getRecordingLogs", filter_by: selectedValue}, 
			function(data) {
				$('#recording_logs_body').html(data); 
			}
		);
	}

});


function watchVideo(sessionid) {

    let videoList = document.getElementById("videoList");
    videoList.innerHTML = "<li class='list-group-item'>Loading videos...</li>";

    // Call your PHP controller via router.php
    $.post("../router/router.php", { request: "get_recording", sessionid: sessionid }, function(data) {

        // Parse the JSON returned by your controller
        let videos = [];
        try {
            videos = JSON.parse(data);
        } catch (e) {
            console.error("Error parsing JSON", e);
        }

        videoList.innerHTML = ""; // Clear old list

        if (videos && videos.length > 0) {
            videos.forEach(video => {
                let li = document.createElement("li");
                li.className = "list-group-item d-flex justify-content-between align-items-center";
                li.innerHTML = `
                    ${video.filename}
                    <button class="btn btn-sm btn-success" onclick="playVideo('${video.filename}')">
                        <i class="fas fa-play"></i> Play
                    </button>
                `;
                videoList.appendChild(li);
            });
        } else {
            videoList.innerHTML = '<li class="list-group-item text-danger">No videos available</li>';
        }

        // Show the video list modal
        new bootstrap.Modal(document.getElementById("videoListModal")).show();
    });
}
 

function playVideo(filename) {
	let videoPlayer = document.getElementById("videoPlayer");
	videoPlayer.src = BASE_URL + filename;
	videoPlayer.load();
	new bootstrap.Modal(document.getElementById("playVideoModal")).show();
}

function stopVideo() {
    let videoPlayer = document.getElementById("videoPlayer");
    videoPlayer.pause();
    videoPlayer.currentTime = 0;
    videoPlayer.src = "";
}
</script>
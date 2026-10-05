

<div class="container-fluid py-2">

	<div class="mb-4 d-flex justify-content-end">
	  <button type="button" class="mb-0 btn btn-primary-x" onclick = "shutdown_reboot('SHUTDOWN')">Shutdown</button>
	  <button type="button" class="ms-1 mb-0 btn btn-warning" onclick = "shutdown_reboot('REBOOT')">Reboot</button>
	</div>
	
	
	
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
		
      <div class="row g-2 mb-sm-3 mb-xl-0">  
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Today's Sales</p>
                <h3 class="mb-0" id="today_sale"></h3>
              </div>
            </div>  
            <hr class="dark horizontal my-0"> 
            <div class="card-footer p-2">  </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">computer</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Machine Connected</p>
                <h3 class="mb-0" id = "machine_online"></h3>
              </div>
            </div>   
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2">  </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-sm-0 mb-xl-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-danger shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">desktop_access_disabled</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Machine Disconnected</p>
                <h3 class="mb-0" id = "machine_offline"></h3>
              </div>
            </div> 
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2">  </div>
          </div>
        </div> 
      </div>
      <div class="row mt-3 g-2 mt-sm-0 mt-xl-0">
        <div class="col-lg-6 col-md-6 mt-4 mb-2">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Daily Sales</h6>
              <p class="text-sm mb-0 ">Daily Sales History</p> 
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 mt-4 mb-1">
          <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 "> Monthly Sales </h6>
              <p class="text-sm mb-0">Monthly Sales History</p> 
            </div>
          </div>
        </div> 
      </div>
      <div class="row mt-0 mb-0 g-2">
        <div class="col-lg-8 col-md-6 mb-1">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>PC Monitoring</h6>
                  <!-- <p class="text-sm mb-0">
                    <i class="fas fa-desktop text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">30 done</span> this month
                  </p> -->
                </div> 
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="pe-4 ps-4 pb-4">
              <table class="table table-hover table-dark responsive nowrap" width="100%" id = "myTable">
                  <thead class = 'thead-dark'>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Computer Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">IP Address</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Remaining Time</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">User</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Today Sales</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">VIP PC</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Status</th>
                    </tr>
                  </thead>
                  <tbody id = 'tablex'>
                     
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card">
            <div class="card-header pb-0">
				<h6 class = "mb-0">Overview</h6> 
				<div class="w-100 form-floating">
				  <select class="ps-4 form-select" id="over_view_filter" aria-label="Floating label select example">
				    <option value = "ALL" selected>All</option>
					<option value = "LOGIN">LOGIN/LOGOUT</option> 
					<option value = "TOPUP">TOPUP</option>
				  </select>
				  <label for="over_view_filter">Filter By:</label>
				</div> 
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">  
                <div id = 'notif'>
                  
                </div>
               

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
<script>
  const BASE_URL = "<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>/recording/";
    
  function daily_chart(valuex)
  { 
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        datasets: [{
          label: "Daily Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "rgba(255, 255, 255, .8)",
          data: valuex,
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

  } 

  function monthly_chart(value)
  {
    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Monthly Sales",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: value,
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  }
  
     
    $(document).ready(function()
    { 
      get_today_sale();
      get_online_offline();
	  over_view_filter();
      get_overview();
      get_table_pc();
      get_daily_sales();
      get_monthly_sales();
	  
	  setInterval(function() {  
		  get_today_sale();
		  get_online_offline(); 
		  get_table_pc(); 
	  }, 5000);
    });


    function get_daily_sales()
    {
      $.post("../router/router.php", {'request': 'get_daily_sales'}, function(data)
      { 
        var arr = [];
        var json = JSON.parse(data);
        arr.push(json[0]['sunday'],json[0]['monday'],json[0]['tuesday'],json[0]['wednesday'],json[0]['thursday'],json[0]['friday'],json[0]['saturday']);
        daily_chart(arr);
      });
    }

    function get_monthly_sales()
    {
      $.post("../router/router.php", {'request': 'get_monthly_sales'}, function(data)
      { 
        var arr = [];
        var json = JSON.parse(data);
        arr.push(json[0]['jan'],json[0]['feb'],json[0]['mar'],json[0]['apr'],json[0]['may'],json[0]['jun'],json[0]['jul'],json[0]['aug'],json[0]['sep'],json[0]['oct'],json[0]['nov'],json[0]['dec']);
        monthly_chart(arr)
      });
    }

    function get_today_sale()
    {
      $.post("../router/router.php", {'request': 'get_today_salex'}, function(data)
      {
        $("#today_sale").html(" &#8369;" + " " + data);  
      });
    }

    function get_online_offline()
    {
      $.post("../router/router.php", {'request': 'get_online_offline'}, function(data)
      {
        var json = JSON.parse(data); 
        $("#machine_online").html(json[0]['online_cnt']);
        $("#machine_offline").html(json[0]['offline_cnt']);
      });
    }

    function get_overview()
    {
      $.post("../router/router.php", {request: 'get_overview'}, function(data)
      { 
        $("#notif").html(data);
      });
    }


	function over_view_filter()
	{
		$.post("../router/router.php", {request: 'over_view_filter'}, function(data)
		{ 
			$("#over_view_filter").append(data);
		})
	}

    function get_table_pc() {
	  $.post("../router/router.php", { request: 'get_table_pc' }, function(data) {
		// Destroy existing DataTable instance if it exists
		if ( $.fn.DataTable.isDataTable('#myTable') ) {
		  $('#myTable').DataTable().destroy();
		}

		// Replace HTML and reinitialize DataTable
		$("#tablex").html(data); 
		$('#myTable').DataTable({
		  responsive: true
		});
	  });
	}

	 
	 
	 
 function shutdown_reboot(cmd, state = false)
  {
    if(state == false)
    {
      Swal.fire({
        title: cmd,
        text: "Are you sure?",
        icon: 'question', 
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.isConfirmed) { 
          $.post("../router/router.php", {'request': "shutdown_reboot", cmd: cmd},function(data)
          {
            Swal.fire({
              title: cmd + ' success!', 
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
    else
    {
      $.post("../router/router.php", {'request': "shutdown_reboot", cmd: cmd},function(data)
      {
        Swal.fire({
          title: cmd + ' success!', 
          icon: 'success', 
        }).then((result) => {
          if (result.isConfirmed) { 
            location.reload();
          }
        })
      });
    }
    
  }
  
  
$('#over_view_filter').on('change', function() {
    var selectedValue = $(this).val(); // Get the selected value
    if (selectedValue == "ALL") {
        // If "ALL" is selected, show all .timeline-block elements
        $(".timeline-block").show();
    } else {
        // Otherwise, hide all .timeline-block elements and show only the ones matching the selected class
        $(".timeline-block").each(function() {
            // Check if the current .timeline-block has the selected value as a class
            if ($(this).hasClass(selectedValue)) {
                $(this).show(); // Show matching elements
            } else {
                $(this).hide(); // Hide non-matching elements
            }
        });
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
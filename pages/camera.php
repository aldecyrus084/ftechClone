
<div class="container-fluid py-2">
    <div class="mb-4">
        <div class="mt-0 mb-4">
            <div class="card">
                <div class="card-header pt-2 pb-0 border-bottom">
                    <h6>Camera Live Stream</h6> 
                </div> 
                <div class="card-body d-flex justify-content-center px-4 pb-4 position-relative"> 
                    
                    <!-- Spinner overlay -->
                    <div id="spinnerOverlay" class="position-absolute d-flex justify-content-center align-items-center w-100 h-100 bg-white spinner-visible" style="z-index:10;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <!-- Camera stream -->
                    <img id="cameraStream"
                         src="http://<?php echo $_SERVER['SERVER_NAME']; ?>:8080/?action=stream" 
                         class="img-fluid rounded shadow"
                         alt="Camera Stream"/>
                </div> 
            </div>
        </div> 
    </div> 
</div>

<script>
$(document).ready(function() {
    startcam();
    setupStreamWatchdog();
});

function startcam() { 
    $.post("../router/router.php", { request: "startcam" }, function(data) {
        console.log("StartCam Response:", data);
    });
}

function setupStreamWatchdog() {
    const $img = $("#cameraStream");
    const $spinner = $("#spinnerOverlay");

    function checkStream() {
        if ($img[0].complete && $img[0].naturalWidth > 0) {
            $spinner.removeClass("d-flex").addClass("d-none");
        } else {
            $spinner.removeClass("d-none").addClass("d-flex");
        }
    }

    // Initial check
    checkStream();

    // Event handlers
    $img.on("load", function() {
        $spinner.removeClass("d-flex").addClass("d-none");
        lastLoaded = Date.now();
    });

    $img.on("error", function() {
        $spinner.removeClass("d-none").addClass("d-flex");
    });

    // Watchdog to reload stream if frozen
    let lastLoaded = Date.now();
    setInterval(function() {
        checkStream();
        if (Date.now() - lastLoaded > 5000) {
            const newUrl = "http://" + window.location.hostname + ":8080/?action=stream&ts=" + Date.now();
            $img.attr("src", newUrl);
            console.log("🔄 Reloading stream...");
        }
    }, 3000);
}
</script>

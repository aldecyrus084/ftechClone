<div class="container-fluid py-4">
  <div class="row">
    <!-- Device Info on the left -->
    <div class="col-xl-3 col-lg-4 mb-4">
      <div class="card h-100">
        <div class="card-header p-3 pt-2 bg-gradient-primary shadow-primary border-radius-lg">
          <div class="text-white text-center">
            <h6 class="mb-0">Device Info</h6>
          </div>
        </div>
        <div class="card-body text-start" id="device_info_card">
          <!-- Info will be filled by JS -->
        </div>
      </div>
    </div>

    <!-- Metrics on the right -->
    <div class="col-xl-9 col-lg-8">
      <div class="row" id="system_metrics_cards">
        <!-- Dynamic cards will be appended here -->
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
  Swal.fire({
    title: 'Loading...',
    text: 'Please wait while we gather system information.',
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading()
  });

  system_info();
  setInterval(system_info, 10000);
});

function system_info() {
  $.post("../router/router.php", { 'request': "system_info" }, function(data) {
    // Device info
    let deviceInfoHtml = `
      <p class = "mb-1"><strong>Model:</strong> ${data.device_model}</p>
      <p class = "mb-1"><strong>Processor:</strong> ${data.processor}</p>
      <p class = "mb-1"><strong>CPU Temp:</strong> ${data.cpu_temp}</p>
      <p class = "mb-1"><strong>Uptime:</strong> ${data.up_time}</p>
      <p class = "mb-1"><strong>Serial:</strong> ${data.serial}</p>
      <p class = "mb-1"><strong>IP:</strong> ${data.local_ip}</p>
      <p class = "mb-1"><strong>Gateway:</strong> ${data.gateway}</p>
      <p><strong>Sys Ver:</strong> ${data.sys_ver}</p>`;
    $("#device_info_card").html(deviceInfoHtml);

    $("#system_metrics_cards").empty();

    // RAM
    let ram_used = parseFloat(data.ram_used);
    let ram_total = parseFloat(data.ram_total);
    let ram_percent = (ram_used / ram_total) * 100;

    let ramCard = generateCard("RAM Usage", `
      <p class = "mb-1">Total: ${data.ram_total}</p>
      <p class = "mb-1">Free: ${data.ram_free}</p>
      <p class = "mb-1">Used: ${data.ram_used}</p>
      <div class="progress progress-sm">
        <div class="progress-bar bg-info" style="width: ${ram_percent.toFixed(1)}%"></div>
      </div>
      <small>${ram_percent.toFixed(1)}%</small>
    `, "info");
    $("#system_metrics_cards").append(ramCard);

    // Storage
    let storage_percent = 50; // You can calculate actual used percent
    let storageCard = generateCard("Storage", `
      <p>Total: ${data.storage}</p>
      <div class="progress progress-sm">
        <div class="progress-bar bg-success" style="width: ${parseFloat(data.used_storage)}%"></div>
      </div>
      <small>${parseFloat(data.used_storage)}%</small>
    `, "success");
    $("#system_metrics_cards").append(storageCard);

    // CPU cores
    let cores = JSON.parse(data.cpu_usage);
    $.each(cores, function(i, v) {
      let colorClass = 'bg-primary';
      if (v >= 70) colorClass = 'bg-danger';
      else if (v >= 40) colorClass = 'bg-warning';

      let coreCard = generateCard(`CPU Core ${i}`, `
        <p>${v}% Usage</p>
        <div class="progress progress-sm">
          <div class="progress-bar ${colorClass}" style="width: ${v}%"></div>
        </div>
        <small>${v}%</small>
      `, "primary");
      $("#system_metrics_cards").append(coreCard);
    });

    Swal.close();
  }, 'json');
}

function generateCard(title, bodyHtml, color) {
  return `
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header p-3 pt-2 bg-gradient-${color} shadow-${color} border-radius-lg">
          <div class="text-white text-center">
            <h6 class="mb-0">${title}</h6>
          </div>
        </div>
        <div class="card-body text-start">
          ${bodyHtml}
        </div>
      </div>
    </div>`;
}

</script>
<style>
    .dataTables_wrapper{
        width: 100% !important;
    } 
</style>

<div class="container-fluid py-2">
    <div class="mb-4"> 
        <div class="mb-2 d-flex justify-content-end">
          <button type="button" class="mb-0 btn btn-primary-x" onclick = "shutdown_reboot('SHUTDOWN')">Shutdown</button>
          <button type="button" class="ms-1 mb-0 btn btn-warning" onclick = "shutdown_reboot('REBOOT')">Reboot</button>
        </div>
        <div class="mt-0">
			<div class="card">
			  <div class="card-header mt-1 pt-2 pb-1">
				<div class="box d-flex align-items-center justify-content-between">
				  <h5 class="mb-0 w-100 fs-6"><i class="fas fa-server me-2"></i> Server IP Configuration</h5>
				  <a href="#" class="px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					<i class="fs-4 fa-solid fa-caret-down float-end" id="toggle-icon"></i>
				  </a>
				</div>
			  </div>
			  <div class="pb-2">
				<div class="collapse" id="collapseOne">
				  <div class="card-body px-0 pb-2">
					<div class="mb-1 px-2 d-flex justify-content-center flex-column gap-1 align-items-center">
					  <!-- Add your input fields or content here -->
					  <div class="w-100 mb-1 px-2 d-flex justify-content-center flex-column gap-1 align-items-center"> 
						<div class="w-100 form-floating">
						  <select class="ps-4 form-select" id="network_type" aria-label="Floating label select example">
							<option value = "DHCP">DHCP</option>
							<option value = "STATIC">STATIC IP</option> 
						  </select>
						  <label for="network_type">Configure IP</label>
						</div>
					  </div>
					  
						<div class="w-100 px-2">
							<div class = "row g-2"> 
								<div class = "col-xl-6 col-md-6  col-sm-12">
								  <div class="w-100 form-floating mb-1 border rounded-3 static_ip">
									<!-- IP Address input with pattern validation -->
									<input type="text" class="form-control ps-2 text-center fw-bold fs-5" id="local_ip" oninput = "valid_ip(this)">
									<label for="local_ip">IP Address</label>
								  </div> 
								</div>
								<div class = "col-xl-6 col-md-6 col-sm-12">
								  <div class="w-100 form-floating mb-1 border rounded-3 static_ip">
									<!-- IP Address input with pattern validation -->
									<input type="text" class="form-control ps-2 text-center fw-bold fs-5" id="gateway" disabled>
									<label for="gateway">Gateway</label>
								  </div>
								</div>
							</div>
						</div>

						
						<small class="text-muted float-left">
							Note: If your IP configuration is set to static, please set it back to DHCP before changing your network or ISP.
						</small>

						  
					</div>
					<div class="px-3 mt-0 pb-2">
					  <button type="button" class="ms-1 mb-0 btn-sm btn btn-success float-end" onclick="save_ip()">Save</button>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>


        <div class="mt-2  ">
          <div class="card"> 
			<div class="card-header mt-1 pt-2 pb-1">
               <div class="box d-flex align-items-center justify-content-between">  
                  <h5 class = "mb-0 w-100 fs-6"><i class="fas fa-hourglass-half me-2"></i> Timers & Others Settings</h5> 
                  <a href="#" class = "px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fs-4 fa-solid fa-caret-down  float-end" id = "toggle-icon2"></i>
                  </a>  
              </div>  
            </div>  
			<div class="pb-2"> 
			  <div class="collapse "  id = "collapse2">
				<div class = "timer_settings">
				</div> 
			  </div> 
			</div> 
          </div>
        </div> 
		
		<div class="mt-2  ">
          <div class="card"> 
			<div class="card-header mt-1 pt-2 pb-1">
               <div class="box d-flex align-items-center justify-content-between">  
                  <h5 class = "mb-0 w-100 fs-6"><i class="fas fa-shield-alt me-2"></i> Anti-Abuse Login Rules</h5> 
                  <a href="#" class = "px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fs-4 fa-solid fa-caret-down  float-end" id = "toggle-icon11"></i>
                  </a>  
              </div>  
            </div>  
			<div class="pb-2"> 
			  <div class="collapse "  id = "collapse11">
				<div class = "antiabuse_settings">
				</div> 
			  </div> 
			</div> 
          </div>
        </div> 
		
		
		<div class="mt-2  ">
          <div class="card"> 
			<div class="card-header mt-1 pt-2 pb-1">
               <div class="box d-flex align-items-center justify-content-between">  
                  <h5 class = "mb-0 w-100 fs-6"><i class="fas fa-user-check me-2"></i> Whitelist Application <span class = 'text-muted fs-6 text-sm'>(Use this if you enable auto close all running app on lockscreen)</span></h5> 
                  <a href="#" class = "px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fs-4 fa-solid fa-caret-down  float-end" id = "toggle-icon9"></i>
                  </a>  
              </div>  
            </div>  
			<div class="pb-2 px-2"> 
			  <div class="collapse "  id = "collapse9">
				<div class="mt-0 mb-4 px-2">
				  <div class="card">
					<div class="card-header pt-2 pb-0 border-bottom">
					    
						<div class="d-flex align-items-center justify-content-between">  
							<h6 class = 'text-sm text-muted'>Exempted Item</h6> 
							<div class = "mb-1">  
								<button type="button" class="mb-0 btn-sm btn btn-success f-6 d-flex align-items-center justify-content-center" onclick = 'add_app();'>
								  <i class="fa-solid fa-plus text-white fs-5 me-2"></i> Add
								</button>
							</div>
						</div>
					  
					</div> 
					<div class="card-body px-0 pb-2">
					  <div class="p-3 pt-0 d-flex justify-content-center flex-column gap-1 align-items-center  w-100"> 
						 <table class="table table-hover table-dark   responsive nowrap" width="100%" id = "myTable">
						  <thead class = 'thead-dark'>
							<tr>
							  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">#</th>
							  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Application Name</th> 
							  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Remove</th>  
							</tr>
						  </thead>
						  <tbody id = 'tablex'>
							 
						  </tbody>
						</table>
					</div> 
				  </div>
				</div> 
			  </div> 
			</div> 
          </div>
        </div> 

        <div class="mt-2 ">
          <div class="card"> 
            <div class="card-header mt-1 pt-2 pb-1">
               <div class="box d-flex align-items-center justify-content-between">  
                  <h5 class = "mb-0 w-100 fs-6"><i class="fas fa-bullhorn me-2"></i> Announcement</h5> 
                  <a href="#" class = "px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fs-4 fa-solid fa-caret-down  float-end" id = "toggle-icon3"></i>
                  </a>  
              </div>  
            </div> 
            <div class="pb-2"> 
              <div class="collapse "  id = "collapse3">
                <div class="card-body px-0 pb-2 " >
                  <div class="mb-1 px-3 d-flex justify-content-center flex-column gap-1 align-items-center"> 
                    <div class="w-100 form-floating mb-1 border rounded-3"> 
                      <textarea name="lock_msg" id="lock_msg" class=" form-control px-2" style="height: 120px"></textarea>
                      <label for="lock_msg">Lock Screen Announcement</label> 
                    </div> 
                    <div class="w-100 form-floating mb-1 border rounded-3"> 
                      <textarea name="before_msg" id="before_msg" class=" form-control px-2" style="height: 120px"></textarea>
                      <label for="before_msg">Before Close Announcement</label> 
                    </div>  
                  </div> 
                  <div class="px-3 mt-0">
                    <button type="button" class="mb-0 btn btn-success float-end" onclick = "update_announcement()">Save</button>
                  </div>
                </div> 
              </div> 
            </div>
          </div>
        </div>  

        <div class="mt-2 ">
          <div class="card"> 
            <div class="card-header mt-1 pt-2 pb-1">
               <div class="box d-flex align-items-center justify-content-between">  
                  <h5 class = "mb-0 w-100 fs-6"><i class="fas fa-calendar-alt me-2"></i> Shop Schedule</h5> 
                  <a href="#" class = "px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fs-4 fa-solid fa-caret-down  float-end" id = "toggle-icon4"></i>
                  </a>  
              </div>   
            </div> 
            <div class="pb-2"> 
              <div class="collapse "  id = "collapse4">
                <div class="form-check form-switch d-flex align-items-center w-100 pe-3 me-3 justify-content-center mb-0 mt-1">
                  <input class="form-check-input mt-0 fs-2" type="checkbox" id = "enable_schedule">
                  <p class="text-xs text-secondary font-weight-bold mb-0 ms-2">Enable Schedule Time</p>
                </div>  

                <div class="card-body px-0 pb-2 " >
                  <div class="mb-1 px-3 d-flex justify-content-center flex-wrap gap-1 align-items-center"> 
                    <div class="w-100 form-floating mb-1 border rounded-3"> 
                      <input type="time" class="form-control px-2 text-center fw-bold fs-4" id="time_open" required> 
                      <label for="time_open">Open Time</label> 
                    </div>  
					 
                    <div class="w-100 form-floating mb-1 border rounded-3"> 
                      <input type="time" class="form-control px-2 text-center fw-bold fs-4" id="early_warning" required> 
                      <label for="early_warning">Before Close Time</label> 
                    </div>  
					
                    <div class="w-100 form-floating mb-1 border rounded-3"> 
                      <input type="time" class="form-control px-2 text-center fw-bold fs-4" id="time_close"  required> 
                      <label for="time_close">Closed Time</label> 
                    </div> 
                  </div> 
                  <div class="px-3 mt-0">
                    <button type="button" class="mb-0 btn btn-success float-end" id = "sched_btn" onclick = "update_open_closed()" disabled>Save</button>
                  </div>
                </div> 
              </div> 
            </div>
          </div>
        </div> 

		<div class="mt-2  ">
          <div class="card"> 
			<div class="card-header mt-1 pt-2 pb-1">
               <div class="box d-flex align-items-center justify-content-between">  
                  <h5 class = "mb-0 w-100 fs-6"><i class="fas fa-comments me-2"></i> Chat Message Template</h5> 
                  <a href="#" class = "px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fs-4 fa-solid fa-caret-down  float-end" id = "toggle-icon12"></i>
                  </a>  
              </div>  
            </div>  
			<div class="pb-2 px-2"> 
			  <div class="collapse "  id = "collapse12">
				<div class="mt-0 mb-4 px-2">
				  <div class="card">
					<div class="card-header pt-2 pb-0 border-bottom">
					    
						<div class="d-flex align-items-center justify-content-between">  
							<h6 class = 'text-sm text-muted'>Templates</h6> 
							<div class = "mb-1">  
								<button type="button" class="mb-0 btn-sm btn btn-success f-6 d-flex align-items-center justify-content-center" onclick = 'add_chat();'>
								  <i class="fa-solid fa-plus text-white fs-5 me-2"></i> Add
								</button>
							</div>
						</div>
					  
					</div> 
					<div class="card-body px-0 pb-2">
					  <div class="p-3 pt-0 d-flex justify-content-center flex-column gap-1 align-items-center  w-100"> 
						 <table class="table table-hover table-dark responsive nowrap" width="100%" id = "chatmyTable">
						  <thead class = 'thead-dark'>
							<tr>
							  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">#</th>
							  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Title</th> 
							  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Message</th> 
							  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Remove</th>  
							</tr>
						  </thead>
						  <tbody id = 'chattablex'>
							 
						  </tbody>
						</table>
					</div> 
				  </div>
				</div> 
			  </div> 
			</div> 
          </div>
        </div> 

		<div class="mt-2 ">
          <div class="card"> 
            <div class="card-header mt-1 pt-2 pb-1">
               <div class="box d-flex align-items-center justify-content-between">  
                  <h5 class = "mb-0 w-100 fs-6"><i class="fas fa-cogs me-2"></i> F-Tech Logo</h5> 
                  <a href="#" class = "px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fs-4 fa-solid fa-caret-down  float-end" id = "toggle-icon5"></i>
                  </a>  
              </div>  
            </div> 
            <div class="pb-2"> 
              <div class="collapse " id = "collapse5">
				<div class="form-check form-switch d-flex align-items-center w-100 pe-3 me-3 justify-content-center mb-2 mt-1">
                  <input class="form-check-input mt-0 fs-2" type="checkbox" id = "enable_logo">
                  <p class="text-xs text-secondary font-weight-bold mb-0 ms-2">Show/Hide Logo</p>
                </div>  
                <div class="card-body px-0 pb-2 " style = "margin-top: -15px !important; text-align: center;" >  

					<div class="px-3 me-1 mb-2">
						<div class="row g-2">

							<?php
								$path = '/var/www/html/admin/assets/logo/';
								$files = array_diff(scandir($path), ['.', '..']);
							?>

							<!-- LEFT COLUMN -->
							<div class="col-12 col-lg-8" >

								<div class="filelist me-2 w-100">

									<ul class="list-group">
										<?php foreach ($files as $file): ?>
											<li class="list-group-item d-flex justify-content-between align-items-center file-item-logo"
												data-filename="<?= htmlspecialchars($file, ENT_QUOTES) ?>"
												onclick="selectItemLogo(this, '<?= $file ?>')"
												style="cursor:pointer;">

												<span title="<?= htmlspecialchars($file) ?>">
													<?= htmlspecialchars(substr($file, 0, 20)) ?>
													<?= strlen($file) > 20 ? '...' : '' ?>
												</span>

												<div>
													<!-- Activate Icon -->
													<i class="fa-regular fa-circle-check text-success me-2"
													style="cursor:pointer;"
													onclick="update_logo('<?= $file ?>'); event.stopPropagation();"
													title="Select/Activate"></i>

													<!-- Delete Icon -->
													<i class="fa-regular fa-trash text-danger"
													style="cursor:pointer;"
													onclick="deleteFileLogo('<?= $file ?>'); event.stopPropagation();"
													title="Delete"></i>
												</div>

											</li>
										<?php endforeach; ?>
									</ul>

								</div>
							</div>

							<!-- RIGHT COLUMN (PREVIEW BOX) -->
							<div class="col-12 col-lg-4"
								style="height:300px;">

								<div class="border rounded imglist p-2 d-flex align-items-center justify-content-center"
									style="height:100%; overflow:hidden; border-radius:6px; background:#f8f9fa;">

									<img id="ftech_logo"
										src="/admin/assets/logo/FTECH_LOGO.png"
										class="img-fluid"
										alt="Preview"
										style="max-width:100%; max-height:100%; object-fit:contain;">  
								</div>
							</div>

						</div>

					</div>

					<form class="needs-validation validation3" novalidate id = "form_logo" enctype="multipart/form-data"> 
						<div class="px-3 input-group mb-1"> 
						  <input type="file" class="form-control border" id="file" name = "file" required accept="image/*"> 
						</div>
						
					  <div class="px-3 mt-0">
						<button type="submit" class="mb-0 btn btn-success float-end" id = "save_logo">Save</button>
					  </div> 
					</form>
                </div> 
              </div> 
            </div>
          </div>
        </div> 
		
		
		<div class="mt-2 ">
          <div class="card"> 
            <div class="card-header mt-1 pt-2 pb-1">
               <div class="box d-flex align-items-center justify-content-between">  
                  <h5 class = "mb-0 w-100 fs-6"><i class="fas fa-image me-2"></i> Global Wallpaper</h5> 
                  <a href="#" class = "px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fs-4 fa-solid fa-caret-down  float-end" id = "toggle-icon10"></i>
                  </a>  
              </div>  
            </div> 
            <div class="pb-2"> 
              <div class="collapse " id = "collapse10">
				<div class="form-check form-switch d-flex align-items-center w-100 pe-3 me-3 justify-content-center mb-2 mt-1">
                  <input class="form-check-input mt-0 fs-2" type="checkbox" id = "overwrite_bg">
                  <p class="text-xs text-secondary font-weight-bold mb-0 ms-2">Overwrite Wallpaper</p>
                </div>  
                <div class="card-body px-0 pb-2 " style = "margin-top: -15px !important; text-align: center;" >  

					<div class="px-3 me-1 mb-2">
						<div class="row g-2">

							<?php
								$path = '/var/www/html/admin/assets/globalwallpaper/';
								$files = array_diff(scandir($path), ['.', '..']);
							?>

							<!-- LEFT COLUMN -->
							<div class="col-12 col-lg-8" >

								<div class="filelist me-2 w-100">

									<ul class="list-group">
										<?php foreach ($files as $file): ?>
											<li class="list-group-item d-flex justify-content-between align-items-center file-item"
												data-filename="<?= htmlspecialchars($file, ENT_QUOTES) ?>"
												onclick="selectItem(this, '<?= $file ?>')"
												style="cursor:pointer;">

												<span title="<?= htmlspecialchars($file) ?>">
													<?= htmlspecialchars(substr($file, 0, 20)) ?>
													<?= strlen($file) > 20 ? '...' : '' ?>
												</span>

												<div>
													<!-- Activate Icon -->
													<i class="fa-regular fa-circle-check text-success me-2"
													style="cursor:pointer;"
													onclick="update_globalWallpaper('<?= $file ?>'); event.stopPropagation();"
													title="Select/Activate"></i>

													<!-- Delete Icon -->
													<i class="fa-regular fa-trash text-danger"
													style="cursor:pointer;"
													onclick="deleteFile('<?= $file ?>'); event.stopPropagation();"
													title="Delete"></i>
												</div>

											</li>
										<?php endforeach; ?>
									</ul>

								</div>
							</div>

							<!-- RIGHT COLUMN (PREVIEW BOX) -->
							<div class="col-12 col-lg-4"
								style="height:300px;">

								<div class="border rounded imglist p-2 d-flex align-items-center justify-content-center"
									style="height:100%; overflow:hidden; border-radius:6px; background:#f8f9fa;">

									<img id="ftech_background"
										src="/admin/assets/globalwallpaper/FTECH BACKGROUND.jpg"
										class="img-fluid"
										alt="Preview"
										style="max-width:100%; max-height:100%; object-fit:contain;">

									<video id="ftech_background_video"
										style="display:none; max-width:100%; max-height:100%; object-fit:contain;"
										autoplay loop muted></video>

								</div>
							</div>

						</div>

					</div>
					
					<form class="needs-validation validation4" novalidate id = "form_bg"  enctype="multipart/form-data"> 
						<div class="px-3 input-group mb-1"> 
						  <input type="file" class="form-control border" id="bgfile" name = "file" required accept="image/*,video/mp4"> 
						</div>
						
					  <div class="px-3 mt-0">
						<button type="submit" class="mb-0 btn btn-success float-end" id = "save_bg">Save</button>
					  </div> 
					</form>
                </div> 
              </div> 
            </div>
          </div>
        </div> 
		
		
		
		<div class="mt-2 ">
          <div class="card"> 
            <div class="card-header mt-1 pt-2 pb-1">
               <div class="box d-flex align-items-center justify-content-between">  
                  <h5 class = "mb-0 w-100 fs-6"><i class="fas fa-coins me-2"></i> Coin Slot Settings</h5> 
                  <a href="#" class = "px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fs-4 fa-solid fa-caret-down  float-end" id = "toggle-icon6"></i>
                  </a>  
              </div>  
            </div> 
            <div class="pb-2"> 
              <div class="collapse "  id = "collapse6">
                <div class="card-body px-0 pb-2 " style = "margin-top: -15px !important;" >
				  <p class = "text-sm opacity-10 text-danger ps-3 mb-0">Other pins are not tested, test at your own risk (Default Coin Pin: 3, Default Set Pin: 5)</p>
                  <div class="mb-1 px-3 d-flex justify-content-center flex-column gap-1 align-items-center"> 
					<div class="w-100 form-floating">
					  <select class="ps-4 form-select" id="coin_pin" aria-label="Floating label select example" disabled>
						 
					  </select>
					  <label for="coin_pin">COIN PINS</label>
					</div>
                  </div> 
				  <div class="mb-1 px-3 d-flex justify-content-center flex-column gap-1 align-items-center"> 
                    <div class="w-100 form-floating">
					  <select class="ps-4 form-select" id="set_pins" aria-label="Floating label select example" disabled>
					 
					  </select>
					  <label for="set_pins">SET PINS</label>
					</div>
                  </div>
				  
				  <div class="mb-1 px-3 d-flex justify-content-center flex-column gap-1 align-items-center"> 
                    <div class="w-100 form-floating">
					  <select class="ps-4 form-select" id="relay_state" aria-label="Floating label select example" disabled>
					 
					  </select>
					  <label for="relay_state">RELAY STATE</label>
					</div>
                  </div>
				  
                  <div class="px-3 mt-0">
                    <button type="button" class="mb-0 btn btn-success float-end zindex-1" onclick = "update_coin_settings()" disabled>Save</button>
                  </div>
				  <div class = 'ms-4 w-70'><p class = "text-sm opacity-5 text-dark">Note: Reboot the device to take effect changes!</p></div>
                </div> 
              </div> 
            </div>
          </div>
        </div> 
		
		
		<div class="mt-2 ">
          <div class="card"> 
            <div class="card-header mt-1 pt-2 pb-1">
               <div class="box d-flex align-items-center justify-content-between">  
                  <h5 class = "mb-0 w-100 fs-6"><i class="fas fa-money-bill-wave me-2"></i> Bill Acceptor Settings</h5> 
                  <a href="#" class = "px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapseOne" disabled>
                    <i class="fs-4 fa-solid fa-caret-down  float-end" id = "toggle-icon7"></i>
                  </a>  
              </div>  
            </div> 
            <div class="pb-2"> 
              <div class="collapse "  id = "collapse7">
                <div class="card-body px-0 pb-2 " style = "margin-top: -15px !important;" > 
				
				<div class="form-check form-switch d-flex align-items-center w-100 pe-3 me-3 justify-content-center mb-2 mt-1">
					<input class="form-check-input mt-0 fs-2" type="checkbox" id = "ena_bill" disabled>
					<p class="text-xs text-secondary font-weight-bold mb-0 ms-2">Enable Bill Acceptor</p>
				</div>  
				
				  <p class = "text-sm opacity-10 text-danger ps-3 mb-0">Other pins are not tested, test at your own risk (Default Pin: PIN7)</p>
                  <div class="mb-1 px-3 d-flex justify-content-center flex-column gap-1 align-items-center"> 
					<div class="w-100 form-floating">
					  <select class="ps-4 form-select" id="bill_pin" aria-label="Floating label select example" disabled>
						 
					  </select>
					  <label for="bill_pin">BILL PINS</label>
					</div>
                  </div> 
				  <div class="mb-1 px-3 d-flex justify-content-center flex-column gap-1 align-items-center"> 
                    <div class="w-100 form-floating">
					  <select class="ps-4 form-select" id="credit_per_pulse" aria-label="Floating label select example" disabled>
						<option value = "1">1</option>
						<option value = "5">5</option>
						<option value = "10">10</option>
					  </select>
					  <label for="credit_per_pulse">Credit per Pulse</label>
					</div>
                  </div>
				   
                  <div class="px-3 mt-0">
                    <button type="button" class="mb-0 btn btn-success float-end zindex-1" onclick = "update_bill_settings()" disabled>Save</button>
                  </div>
				  <div class = 'ms-4 w-70'><p class = "text-sm opacity-5 text-dark">Note: Reboot the device to take effect changes!</p></div>
                </div> 
              </div> 
            </div>
          </div>
        </div> 
		
		
		 <div class="mt-2">
			<div class="card">
			  <div class="card-header mt-1 pt-2 pb-1">
				<div class="box d-flex align-items-center justify-content-between">
				  <h5 class="mb-0 w-100 fs-6"><i class="fas fa-key me-2"></i> App Password</h5>
				  <a href="#" class="px-3 py-1 rounded-1 toggle-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapseOne">
					<i class="fs-4 fa-solid fa-caret-down float-end" id="toggle-icon8"></i>
				  </a>
				</div>
			  </div>
			  <div class="pb-2">
				<div class="collapse" id="collapse8">
				  <div class="card-body px-0 pt-0 pb-2">
					<div class="mb-1 px-2 d-flex justify-content-center flex-column gap-1 align-items-center">  
						<div class="w-100 px-2">
							<div class="w-100 form-floating mb-1 border rounded-3 position-relative"> 
								<input type="password" class="form-control ps-2 text-center fw-bold fs-5" id="app_password">
								<label for="app_password">F-Tech Application Password</label> 
								<i class="fa fa-eye position-absolute top-50 end-0 me-2 translate-middle-y" id = "eyeIcon" onclick="togglePassword();" style="cursor: pointer;"></i>
							</div>
						</div> 
					</div>
					<div class="px-3 mt-0 pb-2">
					  <button type="button" class="ms-1 mb-0 btn-sm btn btn-success float-end" onclick="update_pass()">Save</button>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
		
		

    </div>  
</div>
<script>
	var local_ip;
	var g_network;
	var table;
	var chattable;
  function updateIcon(collapseId, iconId) {
    var $collapseElement = $(collapseId);
    var $iconElement = $(iconId);

    function update() {
        if ($collapseElement.hasClass('show')) {
            $iconElement.removeClass('fa-caret-up').addClass('fa-caret-down');
        } else {
            $iconElement.removeClass('fa-caret-down').addClass('fa-caret-up');
        }
    }

    update();

    $collapseElement.on('hide.bs.collapse', update);
    $collapseElement.on('show.bs.collapse', update);
  }

  $(document).ready(function(){
    server_ip();
    get_timer_settings();
    get_loginRules();
    // system_info()   
    updateIcon("#collapseOne", "#toggle-icon");
    updateIcon("#collapse2", "#toggle-icon2");
    updateIcon("#collapse3", "#toggle-icon3");
    updateIcon("#collapse4", "#toggle-icon4");
    updateIcon("#collapse5", "#toggle-icon5");
    updateIcon("#collapse6", "#toggle-icon6");
    updateIcon("#collapse7", "#toggle-icon7");
    updateIcon("#collapse8", "#toggle-icon8");
    updateIcon("#collapse9", "#toggle-icon9");
    updateIcon("#collapse10", "#toggle-icon10");
    updateIcon("#collapse11", "#toggle-icon11");
    updateIcon("#collapse12", "#toggle-icon12");
	
	get_whitelisted();
    get_announcement();
	get_coin_pins();
	get_bill_pins();
	get_set_pins();
	get_relay_state();
	get_chat();
	
	
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
				if (form.classList.contains('validation3')) { 
					Swal.fire({
					  title: 'Uploading...',
					  text: 'Please wait while we process your file.',
					  allowOutsideClick: false,
					  didOpen: () => {
						Swal.showLoading();
					  } 
					});
					upload_file();
				}  
				if (form.classList.contains('validation4')) { 
					Swal.fire({
					  title: 'Uploading...',
					  text: 'Please wait while we process your file.',
					  allowOutsideClick: false,
					  didOpen: () => {
						Swal.showLoading();
					  }
					});
					upload_bg();
				}  
            }
            form.classList.add('was-validated')
          }, false)
        })
    })()
	
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
 

  function enable_input(input)
  {
    $("#" + input).prop('disabled', false);
    $("#" + input).focus();
  }

function getFirstThreeOctets(ip) {
	return ip.split('.').slice(0, 3).join('.');
}
		
function save_ip()
{   
	const ip = $('#local_ip').val();
	const gateway = $('#gateway').val();
	const network_type = $('#network_type').val();
	
	if (getFirstThreeOctets(ip) !== getFirstThreeOctets(gateway)) { 
		alert('The IP address and Gateway are NOT on the same subnet.');
		return;
	}   
	
	if(g_network == network_type && local_ip == ip)
	{
		alert('No changes have been made!');
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
		
	
   $.post("../router/router.php", {'request': "change_ip", ip:ip, gw: gateway, network_type: network_type},function(data)
	{ 
		Swal.close(); 
		if (data.includes('Success'))
		  {
			 Swal.fire({
			  title: 'Reboot the device to take effect changes!',
			  text: "Reboot now?",
			  icon: 'question', 
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes!'
			}).then((result) => {
			  if (result.isConfirmed) {  
				shutdown_reboot("REBOOT",true)
			  } 
			})
			g_network = network_type;
			local_ip = ip;
		  }
		else
		{ 
			alert(data);
		}	
	})
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

  function get_timer_settings()
  {
    $.post("../router/router.php", {'request': "get_timer_settings"},function(data)
    {
      $(".timer_settings").html(data);
    });
  }
  
  function get_loginRules()
  {
	$.post("../router/router.php", {'request': "get_loginRules"},function(data)
    {
      $(".antiabuse_settings").html(data);
    });
  }

function save_timer()
{  
	var enabledInputs = $('.timer_settings input:enabled, .timer_settings select:enabled');

	var formData = new FormData(); 
	var i = 0;
	formData.append("request", "save_timer"); 
	enabledInputs.each(function() {
	  i++;
	  console.log($(this).attr('id'));

	  var input = $(this);
	  var name = input.attr('name');  
	  var value = input.val();   
	  formData.append(name, value); 
	});

	$.ajax({
		url: '../router/router.php',  
		type: 'POST',
		data: formData,
		processData: false,  
		contentType: false, 
		success: function(response) {
		  if(response > 0)
		  {
			Swal.fire({
			  title:'Update success!', 
			  icon: 'success', 
			}) 
		  }
		},
		error: function(xhr, status, error) {
			console.error('Error:', status, error);  
		}
	}); 
}


function save_loginrules()
{  
	var enabledInputs = $('.antiabuse_settings input:enabled, .antiabuse_settings select:enabled');

	var formData = new FormData(); 
	var i = 0;
	formData.append("request", "save_loginrules"); 
	enabledInputs.each(function() {
	  i++;
	  console.log($(this).attr('id'));

	  var input = $(this);
	  var name = input.attr('name');  
	  var value = input.val();   
	  formData.append(name, value); 
	});

	$.ajax({
		url: '../router/router.php',  
		type: 'POST',
		data: formData,
		processData: false,  
		contentType: false, 
		success: function(response) {
		  if(response > 0)
		  {
			Swal.fire({
			  title:'Update success!', 
			  icon: 'success', 
			}) 
		  }
		},
		error: function(xhr, status, error) {
			console.error('Error:', status, error);  
		}
	}); 
}


function HideActiveWallpaper(file)
{ 
	const item = $('.file-item[data-filename="' + file + '"]');

	item.find('i.fa-circle-check').remove();  
	item.find('i.fa-trash').remove();       

	item.addClass('active');   
	if (item.find('.badge-active').length === 0) {  
		item.append('<span class="badge bg-success ms-2 badge-active">ACTIVE</span>');
	}
}

function HideActiveLogo(file)
{ 
	const item = $('.file-item-logo[data-filename="' + file + '"]');

	item.find('i.fa-circle-check').remove();  
	item.find('i.fa-trash').remove();       

	item.addClass('active');   
	if (item.find('.badge-active').length === 0) {  
		item.append('<span class="badge bg-success ms-2 badge-active">ACTIVE</span>');
	}
}

function get_announcement()
{
	$.post("../router/router.php", {'request': "get_announcement"},function(data)
	{
		var json = JSON.parse(data);
		$("#before_msg").val(json[0]['speech_msg']);
		$("#lock_msg").val(json[0]['announcement']);
		$("#time_open").val(json[0]['time_open']);
		$("#time_close").val(json[0]['time_close']);
		$("#early_warning").val(json[0]['early_warning']); 
		$("#credit_per_pulse").val(json[0]['credit_per_pulse']); 
		$("#app_password").val(json[0]['password']); 
		
		$('#ftech_logo').attr('src', json[0]['logo_path']).on('error', function() {
			$(this).attr('src', fallback_img);
		}).show();
		
		// $('#ftech_background').attr('src', json[0]['bg_path']).on('error', function() {
			// $(this).attr('src', fallback_img);
		// }).show(); 
		let logopath = json[0]['logo_path'];
		let filelogo = logopath.split('/').pop();
		
		let path = json[0]['bg_path'];
		let file = path.split('/').pop(); // extract filename only
		let ext = path.split('.').pop().toLowerCase(); // get file extension

		if (ext === "mp4") {
			// Hide image, show video
			$("#ftech_background").hide();
			$("#ftech_background_video")
			.attr("src", path)
			.show()[0].play();
		} else {
			// Hide video, show image
			$("#ftech_background_video").hide();
			$("#ftech_background")
			.attr("src", path)
			.on("error", function () {
				$(this).attr("src", fallback_img);
			})
			.show();
		} 
			
		// Hide the active file in the list
		setTimeout(() => {
			HideActiveWallpaper(file);
			HideActiveLogo(filelogo);
		}, 100); 

		
		var ena = json[0]['enable_schedule']; 
		if(ena == 'N')
		{
			$("#enable_schedule").prop('checked', false);
			$("#sched_btn").prop('disabled', true);
		}
		else
		{ 
			$("#enable_schedule").prop('checked', true);
			$("#sched_btn").prop('disabled', false);
		}
		
		var ena1 = json[0]['enable_logo']; 
		if(ena1 == 'N')
		{
			$("#enable_logo").prop('checked', false);
			$("#save_logo").prop('disabled', true);
			$("#file").prop('disabled', true); 
		}
		else
		{ 
			$("#enable_logo").prop('checked', true);
			$("#save_logo").prop('disabled', false);
			$("#file").prop('disabled', false);
		}

		var ena_bill = json[0]['ena_bill']; 
		if(ena_bill == 'N')
		{
			$("#ena_bill").prop('checked', false); 
		}
		else
		{ 
			$("#ena_bill").prop('checked', true); 
		}
		
		var ena2 = json[0]['overwrite_bg']; 
		if(ena2 == 'N')
		{
			$("#overwrite_bg").prop('checked', false);
			$("#save_bg").prop('disabled', true);
			$("#bgfile").prop('disabled', true); 
		}
		else
		{ 
			$("#overwrite_bg").prop('checked', true);
			$("#save_bg").prop('disabled', false);
			$("#bgfile").prop('disabled', false);
		}
		
	});
}

function server_ip()
{
	$.post("../router/router.php", {'request': "server_ip"},function(data)
	{
		local_ip = data['local_ip'];
		g_network = data['network_type'].toUpperCase()
		$("#local_ip").val(local_ip);  
		$("#gateway").val(data['gateway']);  
		$("#network_type").val(g_network);
		if(data['network_type'] == "dhcp")
		{
		$("#local_ip").prop("disabled", true);  
		}
	}, 'json');
}

  function update_announcement()
  {
    var before_msg = $("#before_msg").val();
    var lock_msg   = $("#lock_msg").val();
    $.post("../router/router.php", {'request': "update_announcement", lock_msg: lock_msg, before_msg: before_msg},function(data)
    {
      Swal.fire({
        title:'Update success!', 
        icon: 'success', 
      }) 
    });
  }
  
  
  function num_only(event) { 
    var charCode = (typeof event.which === "number") ? event.which : event.keyCode;
    if (charCode !== 8 && (charCode < 48 || charCode > 57)) {
      event.preventDefault();
    }
  }


  function update_open_closed()
  {
    var time_open = $("#time_open").val();
    var time_close   = $("#time_close").val();
    var early_warning = $("#early_warning").val(); 
    $.post("../router/router.php", {'request': "update_open_closed", time_open: time_open, time_close: time_close, early_warning: early_warning},function(data)
    {
      Swal.fire({
        title:'Update success!', 
        icon: 'success', 
      }) 
    });
  }

  $("#enable_schedule").change(function(){ 
   $.post("../router/router.php", {'request': "update_enable_schedule",state: this.checked},function(data)
    { 
    });

    if(this.checked == true)
    {
      $("#sched_btn").prop('disabled', false);
    }
    else
    {
      $("#sched_btn").prop('disabled', true);
    }
  })
  
  $("#enable_logo").change(function(){ 
   $.post("../router/router.php", {'request': "enable_logo",state: this.checked},function(data)
    {  
    }); 
	if(this.checked == true)
	{ 
		$("#save_logo").prop('disabled', false);
		$("#file").prop('disabled', false); 
	}
	else
	{
		$("#save_logo").prop('disabled', true);
		$("#file").prop('disabled', true); 
	} 
  })

  $("#ena_bill").change(function(){ 
   $.post("../router/router.php", {'request': "ena_bill",state: this.checked},function(data)
    {  
		if(data == 0 || data == false){
			alert("failed to enable bill acceptor");
		}
    }); 
  })
  
  $("#overwrite_bg").change(function(){ 
   $.post("../router/router.php", {'request': "overwrite_bg",state: this.checked},function(data)
    {  
    }); 
	if(this.checked == true)
	{ 
		$("#save_bg").prop('disabled', false);
		$("#bgfile").prop('disabled', false); 
	}
	else
	{
		$("#save_bg").prop('disabled', true);
		$("#bgfile").prop('disabled', true); 
	} 
  })
  
  
   

function get_coin_pins()
{
	$.post("../router/router.php", {'request': "get_coin_pins"},function(data)
    { 
		$("#coin_pin").html(data);
    });
	
}

function get_bill_pins()
{
	$.post("../router/router.php", {'request': "get_bill_pins"},function(data)
    { 
		$("#bill_pin").html(data);
    });
	
}

function get_set_pins()
{
	$.post("../router/router.php", {'request': "get_set_pins"},function(data)
    { 
		$("#set_pins").html(data);
    });
	
}


function get_relay_state()
{
	$.post("../router/router.php", {'request': "get_relay_state"},function(data)
    { 
		$("#relay_state").html(data);
    }); 
}

 function update_coin_settings()
  {
	var coin_pin = $("#coin_pin").val();
    var set_pins   = $("#set_pins").val();
    var relay_state   = $("#relay_state").val();
    $.post("../router/router.php", {'request': "update_coin_settings", coin_pin: coin_pin, set_pins: set_pins, relay_state: relay_state},function(data)
    {
      Swal.fire({
        title:'Update success!', 
        icon: 'success', 
      }) 
    });
  }
  
  function update_bill_settings()
  {
	var bill_pin = $("#bill_pin").val(); 
    var credit_per_pulse = $("#credit_per_pulse").val();
    $.post("../router/router.php", {'request': "update_bill_settings", bill_pin: bill_pin, credit_per_pulse: credit_per_pulse},function(data)
    {
      Swal.fire({
        title:'Update success!', 
        icon: 'success', 
      }) 
    });
  }
  
document.getElementById('network_type').addEventListener('change', function () {
  var localIpInput = document.getElementById('local_ip'); 
  if (this.value === 'STATIC') {
    localIpInput.disabled = false;
  } else { 
    localIpInput.disabled = true; 
	$("#local_ip").val(local_ip);  
  }
});

function valid_ip(input) { 
  let value = input.value; 
  value = value.replace(/[^0-9.]/g, '');  
  input.value = value;
}


$('#file').on('change', function() {
	const file = this.files[0];
	
	if (file) {
		const reader = new FileReader();
		
		reader.onload = function(event) {
			$('#ftech_logo').attr('src', event.target.result).show();
		};
		
		reader.readAsDataURL(file);
	} else {
		$('#ftech_logo').attr('src', '').hide();
	}
});


$('#bgfile').on('change', function() {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();
        const ext = file.name.split('.').pop().toLowerCase(); // check extension

        reader.onload = function(event) {
            if (ext === "mp4") {
                // Show video
                $('#ftech_background').hide();
                $('#ftech_background_video')
                    .attr('src', event.target.result)
                    .show()[0].play();
            } else {
                // Show image
                $('#ftech_background_video').hide();
                $('#ftech_background')
                    .attr('src', event.target.result)
                    .show();
            }
        };

        reader.readAsDataURL(file);
    } else {
        $('#ftech_background, #ftech_background_video').hide().attr('src', '');
    }
});



function upload_file()
{
	var formData = new FormData($("#form_logo")[0]);
    formData.append("request", "change_logo"); 
    $.ajax({
        url: '../router/router.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){ 
			if(response == "Failed")
			{ 
				Swal.fire({
				  position: "center",
				  icon: "error",
				  title: "Upload Failed!",
				  showConfirmButton: false,
				  timer: 1500
				});
			}	
			else
			{
				Swal.fire({
				  position: "center",
				  icon: "success",
				  title: "Successfully updated!",
				  showConfirmButton: false,
				  timer: 1500
				}).then((result) => {
				   location.reload();
				});
			}
        },
        error: function(xhr, status, error){
            // Handle errors
            console.error(xhr.responseText);
        }
    });
}


function upload_bg()
{
	var formData = new FormData($("#form_bg")[0]);
    formData.append("request", "change_bg"); 
    $.ajax({
        url: '../router/router.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){    
			if(response == "Failed")
			{ 
				Swal.fire({
				  position: "center",
				  icon: "error",
				  title: "Upload Failed!",
				  showConfirmButton: false,
				  timer: 1500
				});
			}	
			else
			{
				Swal.fire({
				  position: "center",
				  icon: "success",
				  title: "Successfully updated!",
				  showConfirmButton: false,
				  timer: 1500
				}).then((result) => {
				   location.reload();
				});
			} 
        },
        error: function(xhr, status, error){
            // Handle errors
            alert(xhr.responseText);
        }
    });
}


function update_globalWallpaper(file)
{
	Swal.fire({
		title: "Activate Wallpaper",
		text: "Activate " + file + "?",
		icon: 'question', 
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes!'
	}).then((result) => {
		if (result.isConfirmed) { 
			$.post("../router/router.php", {'request': "update_globalWallpaper", file: file},function(data)
			{
			Swal.fire({
				title: 'Activate success!', 
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
 
function update_logo(file)
{
	Swal.fire({
		title: "Activate Logo",
		text: "Activate " + file + "?",
		icon: 'question', 
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes!'
	}).then((result) => {
		if (result.isConfirmed) { 
			$.post("../router/router.php", {'request': "update_logo", file: file},function(data)
			{
			Swal.fire({
				title: 'Activate success!', 
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

function togglePassword() {
	var passwordField = document.getElementById('app_password');
	var eyeIcon = document.getElementById('eyeIcon');
	
	if (passwordField.type === "password") {
		passwordField.type = "text"; // Show the password
		eyeIcon.classList.remove('fa-eye');
		eyeIcon.classList.add('fa-eye-slash');
	} else {
		passwordField.type = "password"; // Hide the password
		eyeIcon.classList.remove('fa-eye-slash');
		eyeIcon.classList.add('fa-eye');
	}
}

 function update_pass()
{ 
	var app_pass = $("#app_password").val(); 
	$.post("../router/router.php", {'request': "app_update_pass", pass: app_pass},function(data)
	{
		if(data > 0)
		{
			Swal.fire({
              title: "Update Success",
              icon: "success" 
            }) ;
		}
	})
}

function get_whitelisted()
{
  $.post("../router/router.php", {'request': 'get_whitelisted'}, function(data)
  {
	if(table) {
	  $("#tablex").html("")
	  table.destroy();
	}    
	
	$("#tablex").html(data); 
	table = $('#myTable').DataTable( {
		responsive: true   ,
		ordering: false  // Disable auto sorting
		
	} ); 
  });
}

function get_chat()
{
  $.post("../router/router.php", {'request': 'get_chat'}, function(data)
  {
	if(chattable) {
	  $("#chattablex").html("")
	  chattable.destroy();
	}    
	
	$("#chattablex").html(data); 
	chattable = $('#chatmyTable').DataTable( {
		responsive: true   ,
		ordering: false  // Disable auto sorting
		
	} ); 
  });
}


function delete_app(rowid)
{
	$.post("../router/router.php", {'request': 'delete_app', rowid: rowid}, function(data)
	{
		if(data > 0)
		{
			get_whitelisted();
			const Toast = Swal.mixin({
			  toast: true,
			  position: "top-end",
			  showConfirmButton: false,
			  timer: 1500,
			  timerProgressBar: true,
			  didOpen: (toast) => {
				toast.onmouseenter = Swal.stopTimer;
				toast.onmouseleave = Swal.resumeTimer;
			  }
			});
			Toast.fire({
			  icon: "success",
			  title: "Delete successfully"
			});
		}
	});
}

async function add_app()
{
	const { value: app_name } = await Swal.fire({
	  title: "Enter Application Name",
	  input: "text",
	  inputLabel: "Application Name",
	  inputPlaceholder: "Enter Application Name",
	  inputAttributes: { 
		autocapitalize: "off",
		autocorrect: "off"
	  },
	  showCancelButton: true,   
	  confirmButtonText: "SAVE", 
	  cancelButtonText: "CANCEL", 
	  reverseButtons: false  
	});
	if (app_name) {
		$.post("../router/router.php", {'request': 'add_app', app_name: app_name}, function(data)
		{
			if(data > 0)
			{
				get_whitelisted(); 
			}
		});
	}
}

async function add_chat() {
    const { value: formValues } = await Swal.fire({
        title: "Add Template",
        html: `
            <input id="swal-template-title" class="swal2-input" placeholder="Template Title" style="width:70%">
            <textarea id="swal-template-message" class="swal2-textarea" placeholder="Template Message" style="width:70%; height:100px;"></textarea>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "SAVE",
        cancelButtonText: "CANCEL",
        preConfirm: () => {
            const title = document.getElementById('swal-template-title').value.trim();
            const message = document.getElementById('swal-template-message').value.trim();
            if (!title || !message) {
                Swal.showValidationMessage('Both fields are required');
                return false;
            }
            return { title, message };
        }
    });

    if (formValues) {
        $.post("../router/router.php", {
            request: 'add_chat',
            title: formValues.title,
            msg: formValues.message
        }, function (data) {
            if (data > 0) {
                get_chat(); // refresh your list or template table
            }
        });
    }
}

function delete_chat(rowid)
{
	$.post("../router/router.php", {'request': 'delete_chat', rowid: rowid}, function(data)
	{
		if(data > 0)
		{
			get_chat();
			const Toast = Swal.mixin({
			  toast: true,
			  position: "top-end",
			  showConfirmButton: false,
			  timer: 1500,
			  timerProgressBar: true,
			  didOpen: (toast) => {
				toast.onmouseenter = Swal.stopTimer;
				toast.onmouseleave = Swal.resumeTimer;
			  }
			});
			Toast.fire({
			  icon: "success",
			  title: "Delete successfully"
			});
		}
	});
}

function selectItem(listItem, filename) {
    // Remove highlight from all
    document.querySelectorAll('.file-item').forEach(el => {
        el.classList.remove('active');
    });

    // Highlight selected item
    listItem.classList.add('active');

    // Preview file
    previewFile(filename);
}

function selectItemLogo(listItem, filename) {
    // Remove highlight from all
    document.querySelectorAll('.file-item-logo').forEach(el => {
        el.classList.remove('active');
    });

    // Highlight selected item
    listItem.classList.add('active');

    // Preview file
    previewFileLogo(filename);
}

function previewFile(filename) {
    const img = document.getElementById('ftech_background');
    const video = document.getElementById('ftech_background_video');
    const ext = filename.split('.').pop().toLowerCase();
    const path = '/admin/assets/globalwallpaper/' + filename;

    // Reset display
    img.style.display = 'none';
    video.style.display = 'none';
    video.pause();
    video.src = '';

    // Check file type
    if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'].includes(ext)) {
        img.src = path;
        img.style.display = 'block';
    } else if (['mp4', 'webm', 'ogg', 'mov'].includes(ext)) {
        video.src = path;
        video.style.display = 'block';
        video.play();
    } else {
        alert('Unsupported file type');
    }
}

function previewFileLogo(filename) {
    const img = document.getElementById('ftech_logo');   
    const path = '/admin/assets/logo/' + filename;
    // Reset display
    img.style.display = 'none'; 
	img.src = path;
	img.style.display = 'block';
}

function deleteFile(filename) {
    if (!confirm("Are you sure you want to delete:\n" + filename + "?")) {
        return;
    }

    $.post(
        "../router/router.php",
        { file: filename, request: "deleteglobalwallpaper" },
        function (result) {
            result = result.trim();

            if (result === "OK") {

                // Remove the exact item by data-filename (works for long names)
                $('.file-item').filter(function() {
                    return $(this).attr('data-filename') === filename;
                }).remove();


                // Clear preview
                const img = $("#ftech_background");
                const video = $("#ftech_background_video");

                const currentImg = img.attr("src")?.split("/").pop();
                const currentVid = video.attr("src")?.split("/").pop();

                if (filename === currentImg || filename === currentVid) {
                    img.hide();
                    video.hide().trigger("pause");
                }

                alert("File deleted successfully!");

            } else {
                alert("Failed to delete file: " + result);
            }
        }
    ).fail(function (xhr, status, error) {
        alert("Error: " + error);
    });
}


function deleteFileLogo(filename) {
    if (!confirm("Are you sure you want to delete:\n" + filename + "?")) {
        return;
    }

    $.post(
        "../router/router.php",
        { file: filename, request: "deletelogo" },
        function (result) {
            result = result.trim();

            if (result === "OK") {

                // Remove the exact item by data-filename (works for long names)
                $('.file-item-logo').filter(function() {
                    return $(this).attr('data-filename') === filename;
                }).remove();
 
                // Clear preview
                const img = $("#ftech_logo"); 
                const currentImg = img.attr("src")?.split("/").pop(); 

                if (filename === currentImg) {
                    img.hide(); 
                }

                alert("File deleted successfully!");

            } else {
                alert("Failed to delete file: " + result);
            }
        }
    ).fail(function (xhr, status, error) {
        alert("Error: " + error);
    });
}

</script>
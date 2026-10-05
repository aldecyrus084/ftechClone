<div class="container-fluid py-2">
    <div class="mb-1 d-flex flex-wrap gap-1   justify-content-center justify-content-md-end">
          <!-- Manage Time -->
		<button type="button" class="btn btn-info" 
				onclick="getSelectedMembers()" 
				title="Manage Time">
			<i class="fa-solid fa-clock me-1"></i>
			<span class="d-none d-md-inline">Manage Time</span>
		</button>

		<!-- Delete Members -->
		<button type="button" class="btn btn-danger" 
				onclick="delete_all()" 
				title="Delete Members">
			<i class="fa-solid fa-trash me-1"></i>
			<span class="d-none d-md-inline">Delete Members</span>
		</button>

		<!-- Add Member -->
		<button type="button" class="btn btn-success" 
				data-bs-toggle="modal" data-bs-target="#rates_modalx" 
				id="add_member" onclick="change_title()" 
				title="Add Member">
			<i class="fa-solid fa-user-plus me-1"></i>
			<span class="d-none d-md-inline">Add Member</span>
		</button>
        <!--a href = "../router/router.php?request=backup" class="mb-0 btn btn-warning">Back Up</a> 
        <button type="button" class="mb-0 btn btn-info"  data-bs-toggle="modal" data-bs-target = "#restore_modal">Restore</button--> 
    </div>
	
	 <!-- Manage Time Modal -->  
    <div class="modal fade" id="restore_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content"> 
            <form class="needs-validation restore_form" novalidate id = "form_background">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Restore</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <input type="hidden" id = "rowidx">
                <div class="form-floating mb-1 border rounded-3">
                    <input type="file" class="form-control px-2 text-center fw-bold fs-5" id="file" name = "file" accept=".sql"  required> 
                    <label for="name">File Name</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please select file
                    </div>
                </div> 
                 
                
               
            </div>
            <div class="modal-footer ">
                <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal" onclick = "clear_form();">Close</button>
                <button type="submit" class="mb-0 btn btn-primary-x" >Restore</button>
            </div> 
            </form>
        </div>
        </div>
    </div>

     <!-- Manage Time Modal -->  
    <div class="modal fade" id="rates_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content"> 
            <form class="needs-validation" novalidate id = "myFormx">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id = "add_member_title">Add Member</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <input type="hidden" id = "rowidx">
                <div class="form-floating mb-1 border rounded-3">
                    <input type="text" class="form-control px-2 text-center fw-bold fs-5" id="name" required> 
                    <label for="name">Name</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Name
                    </div>
                </div> 
                <div class="form-floating mb-1 border rounded-3">
                    <input type="text" class="form-control px-2 text-center fw-bold fs-5" id="username" required> 
                    <label for="username">Username</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Username
                    </div>
                </div> 
                <div class="form-floating mb-1 border rounded-3">
                    <input type="password" class="form-control px-2 text-center fw-bold fs-5" id="password"  required> 
                    <label for="password">Password</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Password
                    </div>
                </div> 
                <div class="form-floating border rounded-3">
                    <input type="password" class="form-control px-2 text-center fw-bold fs-5" id="confirm"  required> 
                    <label for="password">Confirm Password</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Confirm Password
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
	
	
	<!-- manage Time -->  
	  <div class="modal fade" id="manageTime" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		  <div class="modal-content"> 
			<form class="needs-validation validation3" novalidate>
			  <div class="modal-header">
				<h1 class="modal-title fs-5">Manage User's Time</h1>
				<input type="hidden" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="rowidx2">		
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  	<div class="modal-body">    
				
					<!-- Nav tabs -->
					<ul class="nav nav-tabs mb-3"  role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="all-nonvip-tab" data-bs-toggle="tab" data-bs-target="#all-nonvip" type="button" role="tab" aria-controls="all-nonvip" aria-selected="true">
								Nonvip
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="all-vip-tab" data-bs-toggle="tab" data-bs-target="#all-vip" type="button" role="tab" aria-controls="all-vip" aria-selected="false">
								Vip
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="all-vvip-tab" data-bs-toggle="tab" data-bs-target="#all-vvip" type="button" role="tab" aria-controls="all-vvip" aria-selected="false">
								Vvip
							</button>
						</li>

						<li class="nav-item" role="presentation">
							<button class="nav-link" id="all-points-tab" data-bs-toggle="tab" data-bs-target="#all-points" type="button" role="tab" aria-controls="all-points" aria-selected="false">
								Points
							</button>
						</li>
					</ul>

					<!-- Tab content -->
					<div class="tab-content">
						
						<!-- NON VIP Tab -->
						<div class="tab-pane fade show active" id="all-nonvip" role="tabpanel" aria-labelledby="all-nonvip-tab"> 
							<label for="m_hours" class="mb-0 mt-1">NON-VIP Time (hh:mm:ss)</label> 
							<div class = "mb-1">					
								<div class="mb-1 mt-0 d-flex">
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="m_hoursx" value="0" min="0"   oninput="num_only(event)" required>
									<span class = " fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="m_minsx" value="0" min="0" max="59"  oninput="num_only(event); validateInput(event);" required>
									<span class = " fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="m_secondsx" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
								</div> 
								<div class = "d-flex gap-1 justify-content-end">
									<button type="submit" class="mb-0 btn btn-success float-right" id = "addTimeButtonx">Add Time</button>
									<button type="submit" class="mb-0 btn btn-danger float-right" id = "deductTimeButtonx">Deduct Time</button>
								</div>  
							</div> 
						</div>

						<!-- VIP Tab -->
						<div class="tab-pane fade" id="all-vip" role="tabpanel" aria-labelledby="all-vip-tab"> 
							<label for="v_m_hours" class="mb-0 mt-1">VIP Time (hh:mm:ss)</label>  
							<div class = "mb-1">			
								<div class="mb-1 mt-0 d-flex">
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="v_m_hoursx" value="0" min="0"   oninput="num_only(event)" required>
									<span class = " fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="v_m_minsx" value="0" min="0" max="59"  oninput="num_only(event); validateInput(event);" required>
									<span class = " fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="v_m_secondsx" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
								</div>
								<div class = "d-flex gap-1 justify-content-end">
									<button type="submit" class="mb-0 btn btn-success float-right" id = "addTimeButton2x">Add Time</button>
									<button type="submit" class="mb-0 btn btn-danger float-right" id = "deductTimeButton2x">Deduct Time</button>
								</div>  
							</div>
						</div>

						
						<!-- VVIP Tab -->
						<div class="tab-pane fade" id="all-vvip" role="tabpanel" aria-labelledby="all-vvip-tab">   
							<label for="vv_m_hours" class="mb-0 mt-1">VVIP Time (hh:mm:ss)</label>
							<div class = "mb-1">						
								<div class="mb-1 mt-0 d-flex">
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="vv_m_hoursx" value="0" min="0"   oninput="num_only(event)" required>
									<span class = " fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="vv_m_minsx" value="0" min="0" max="59"  oninput="num_only(event); validateInput(event);" required>
									<span class = " fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="vv_m_secondsx" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
								</div>
								<div class = "d-flex gap-1 justify-content-end">
									<button type="submit" class="mb-0 btn btn-success float-right" id = "addTimeButton3x">Add Time</button>
									<button type="submit" class="mb-0 btn btn-danger float-right" id = "deductTimeButton3x">Deduct Time</button>
								</div>   
							</div>
						</div>

						
						<!-- POINTS Tab -->
						<div class="tab-pane fade" id="all-points" role="tabpanel" aria-labelledby="all-points-tab">   
							<label for="pointsx" class="mb-0 mt-1">Points</label>
							<div class = "mb-1">						
								<div class="mb-1 mt-0 d-flex">
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="pointsxx" value="0" min="0"   oninput="num_only(event)" required> 
								</div>
								<div class = "d-flex gap-1 justify-content-end">
									<button type="submit" class="mb-0 btn btn-success float-right" id = "addPointsx">Add Points</button>
									<button type="submit" class="mb-0 btn btn-danger float-right" id = "deductPointsx">Deduct Points</button>
								</div>   
							</div>
						</div>
					</div>  
			  	</div>
			  <div class="modal-footer ">
				<button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal">Close</button> 
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
				<h1 class="modal-title fs-5">Manage User's Time</h1>
				<input type="hidden" class="border rounded-3 form-control px-2 text-center fw-bold fs-4 gap" id="rowidx2">		
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  	<div class="modal-body"> 
					<!-- Nav tabs -->
					<ul class="nav nav-tabs mb-3" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="nonvip-tab" data-bs-toggle="tab" data-bs-target="#nonvip" type="button" role="tab" aria-controls="nonvip" aria-selected="true">
								Nonvip
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="vip-tab" data-bs-toggle="tab" data-bs-target="#vip" type="button" role="tab" aria-controls="vip" aria-selected="false">
								Vip
							</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="vvip-tab" data-bs-toggle="tab" data-bs-target="#vvip" type="button" role="tab" aria-controls="vvip" aria-selected="false">
								Vvip
							</button>
						</li>

						<li class="nav-item" role="presentation">
							<button class="nav-link" id="points-tab" data-bs-toggle="tab" data-bs-target="#points" type="button" role="tab" aria-controls="points" aria-selected="false">
								Points
							</button>
						</li>
					</ul>

					<!-- Tab content -->
					<div class="tab-content">

						<!-- NON-VIP Tab -->
						<div class="tab-pane fade show active" id="nonvip" role="tabpanel" aria-labelledby="nonvip-tab">
							<div class="mb-1">
								<label for="m_hours" class="form-label mb-1">NON-VIP Time (hh:mm:ss)</label>
								<div class="d-flex gap-1 mb-2">
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="m_hours" value="0" min="0" oninput="num_only(event)" required>
									<span class="fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="m_mins" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
									<span class="fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="m_seconds" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
								</div>
								<div class="d-flex gap-1 justify-content-end mb-2">
									<button type="submit" class="btn btn-success" id="addTimeButton">Add Time</button>
									<button type="submit" class="btn btn-danger" id="deductTimeButton">Deduct Time</button>
								</div> 
							</div>
						</div>

						<!-- VIP Tab -->
						<div class="tab-pane fade" id="vip" role="tabpanel" aria-labelledby="vip-tab">
							<div class="mb-1">
								<label for="v_m_hours" class="form-label mb-1">VIP Time (hh:mm:ss)</label>
								<div class="d-flex gap-1 mb-2">
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="v_m_hours" value="0" min="0" oninput="num_only(event)" required>
									<span class="fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="v_m_mins" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
									<span class="fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="v_m_seconds" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
								</div>
								<div class="d-flex gap-1 justify-content-end mb-2">
									<button type="submit" class="btn btn-success" id="addTimeButton2">Add Time</button>
									<button type="submit" class="btn btn-danger" id="deductTimeButton2">Deduct Time</button>
								</div> 
							</div>
						</div>

						<!-- VVIP Tab -->
						<div class="tab-pane fade" id="vvip" role="tabpanel" aria-labelledby="vvip-tab">
							<div class="mb-1">
								<label for="vv_m_hours" class="form-label mb-1">VVIP Time (hh:mm:ss)</label>
								<div class="d-flex gap-1 mb-2">
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="vv_m_hours" value="0" min="0" oninput="num_only(event)" required>
									<span class="fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="vv_m_mins" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
									<span class="fs-4">:</span>
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="vv_m_seconds" value="0" min="0" max="59" oninput="num_only(event); validateInput(event);" required>
								</div>
								<div class="d-flex gap-1 justify-content-end mb-2">
									<button type="submit" class="btn btn-success" id="addTimeButton3">Add Time</button>
									<button type="submit" class="btn btn-danger" id="deductTimeButton3">Deduct Time</button>
								</div> 
							</div>
						</div>

						<div class="tab-pane fade" id="points" role="tabpanel" aria-labelledby="points-tab"> 
							<!-- Points Section (separate from tabs) -->
							<label for="pointsx" class="form-label mb-1">Points</label>
							<div class="mb-1">
								<div class="d-flex mb-2">
									<input type="number" class="border rounded-3 form-control px-2 text-center fw-bold fs-4" id="pointsx" value="0" min="0" oninput="num_only(event)" required>
								</div>
								<div class="d-flex gap-1 justify-content-end">
									<button type="submit" class="btn btn-success" id="addPoints">Add Points</button>
									<button type="submit" class="btn btn-danger" id="deductPoints">Deduct Points</button>
								</div>
							</div> 
						</div>

					</div> 
				</div>

			  <div class="modal-footer ">
				<button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal">Close</button> 
			  </div> 
			</form>
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
                <input type="number" class="form-control ps-2 text-center fw-bold fs-4" onkeypress= "num_only(event)" id="top_up" min = "0">
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
  
  <!-- END MODAL --> 
  

    <div class="mb-4">
        <div class="mt-0 mb-4">
          <div class="card">
            <div class="card-header py-2 border-bottom">
				<div class=" d-flex align-items-center justify-content-between"> 
					<h6 class = "mb-0">Members List</h6> 
					<!--div class = "mb-0">
						<button class = "mb-0 btn-sm btn btn-danger f-6" onclick= "delete_all_member();">Clear</button>
					</div-->
				</div>
            </div> 
            <div class="card-body px-0 pb-1">
			
				<div class = "mt-0 mb-3 px-3"> 
				 
					<h6 class = "mb-0 mt-0 text-sm fs-6 text-muted">Note: Please set to zero(0) if you dont want to auto delete inactive members.<span class = "text-danger opacity-8 ms-1" id = "loading"></h6>
					<div class = "row g-2">
						<div class="col-xl-6 col-md-12">
							<div class="w-100 form-floating mb-1 border rounded-3"> 
								<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="idle_time" value = "0" onkeypress= "num_only(event)">
								<label for="idle_time">Maximum Idle (Days):</label>
							</div> 
						</div>
						
						<div class="col-xl-6 col-md-12">
							<div class="w-100 form-floating">
							  <select class="ps-4 form-select text-center" id="filter_by" name = "filter_by"  aria-label="Floating label select example">
								<option value = "" selected>-- Select Fitler --</option>
								<option value = "LOGIN">Login</option>
								<option value = "LOGOUT">Logout</option>
							  </select>
							  <label for="filter_by">Filter by:</label>
							</div>
						</div>
						
					</div>
							  
				</div>
			  
              <div class="px-3 pt-0"> 
                 <table class="table table-hover table-dark responsive nowrap" width="100%" id = "myTable">
                  <thead class = 'thead-dark'>
                    <tr>
						<th class="text-center">
							<input type="checkbox" id="selectAll">
						</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Username</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Password</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Vip Remaining Time</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">VVip Remaining Time</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Non-Vip Remaining Time</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Remaining Credit</th>  
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Remaining Points</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Idle Time</th>      
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Last Login</th>   
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Login Status</th>  
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
</div>

<style>
    #myTable_wrapper{
        width: 100% !important;
    }
</style>

<script>
var table;
let max_credit;
let max_points;
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
					var clickedButton = event.submitter || event.target.querySelector(':focus'); // Identify clicked button
					if (form.classList.contains('validation2')) {
						if (clickedButton.id == 'addTimeButton') {
							save_add_time();
						} 
						else if (clickedButton.id == 'addTimeButton2') {
							save_add_time2();
						}
						else if (clickedButton.id == 'addTimeButton3') {
							save_add_time3();
						}
						else if (clickedButton.id == 'addPoints') {
							addPoints();
						} 
						else if (clickedButton.id == 'deductPoints') {
							deductPoints();
						} 
						
						else if (clickedButton.id == 'deductTimeButton') {
							deduct_save_add_time();
						}
						else if (clickedButton.id == 'deductTimeButton2') {
							deduct_save_add_time2();
						}
						else if (clickedButton.id == 'deductTimeButton3') {
							deduct_save_add_time3();
						}
						
					}else if (form.classList.contains('validation3')) {
						if (clickedButton.id == 'addTimeButtonx') {
							save_add_timex();
						} 
						else if (clickedButton.id == 'addTimeButton2x') {
							save_add_time2x();
						}
						else if (clickedButton.id == 'addTimeButton3x') {
							save_add_time3x();
						}
						else if (clickedButton.id == 'addPointsx') {
							addPointsx();
						} 
						else if (clickedButton.id == 'deductPointsx') {
							deductPointsx();
						} 
						
						else if (clickedButton.id == 'deductTimeButtonx') {
							deduct_save_add_timex();
						}
						else if (clickedButton.id == 'deductTimeButton2x') {
							deduct_save_add_time2x();
						}
						else if (clickedButton.id == 'deductTimeButton3x') {
							deduct_save_add_time3x();
						}
						
					}
					else if(form.classList.contains('restore_form')) {
						restore();
					}
					else if(form.classList.contains('top_up_form'))
					{
						if (clickedButton.id == 'addCredit') {
							top_up_member();
						} 
						else if (clickedButton.id == 'deductCredit') {
							deduct_top_up_member();
						}
					}
					else
					{
						save_member();
					}
                }
                form.classList.add('was-validated')
            }, false)
            })
        })()
		get_idle_cnt();
        get_member()
    });
 


	function save_add_time()
	{
		var m_hours    = Number($("#m_hours").val());
		var m_mins     = Number($("#m_mins").val());
		var m_seconds  = Number($("#m_seconds").val()); 
		var time  = Number((m_hours * 3600) + (m_mins * 60) + (m_seconds)); 
		 
		update_rem_time("Add Time", time, "remaining_time"); 
	}
	
	function save_add_timex()
	{
		var m_hours    = Number($("#m_hoursx").val());
		var m_mins     = Number($("#m_minsx").val());
		var m_seconds  = Number($("#m_secondsx").val()); 
		var time  = Number((m_hours * 3600) + (m_mins * 60) + (m_seconds)); 
		 
		update_rem_timex("Add Time", time, "remaining_time"); 
	}
	
	function save_add_time2()
	{ 
		var v_m_hours    = Number($("#v_m_hours").val());
		var v_m_mins     = Number($("#v_m_mins").val());
		var v_m_seconds  = Number($("#v_m_seconds").val());  
		var v_time  = Number((v_m_hours * 3600) + (v_m_mins * 60) + (v_m_seconds));  
		 
		update_rem_time("Add Time", v_time, "vip_rem_time"); 
	}
	
	function save_add_time2x()
	{ 
		var v_m_hours    = Number($("#v_m_hoursx").val());
		var v_m_mins     = Number($("#v_m_minsx").val());
		var v_m_seconds  = Number($("#v_m_secondsx").val());  
		var v_time  = Number((v_m_hours * 3600) + (v_m_mins * 60) + (v_m_seconds));  
		 
		update_rem_timex("Add Time", v_time, "vip_rem_time"); 
	}

	function save_add_time3()
	{  
		var vv_m_hours    = Number($("#vv_m_hours").val());
		var vv_m_mins     = Number($("#vv_m_mins").val());
		var vv_m_seconds  = Number($("#vv_m_seconds").val()); 
		var vv_time  = Number((vv_m_hours * 3600) + (vv_m_mins * 60) + (vv_m_seconds)); 
		 
		update_rem_time("Add Time", vv_time, "vvip_rem_time"); 
	}
	
	function save_add_time3x()
	{  
		var vv_m_hours    = Number($("#vv_m_hoursx").val());
		var vv_m_mins     = Number($("#vv_m_minsx").val());
		var vv_m_seconds  = Number($("#vv_m_secondsx").val()); 
		var vv_time  = Number((vv_m_hours * 3600) + (vv_m_mins * 60) + (vv_m_seconds)); 
		 
		update_rem_timex("Add Time", vv_time, "vvip_rem_time"); 
	}
	
	
	function addPoints()
	{
		var pointsx = Number($("#pointsx").val()); 
		Swal.fire({
		  title: 'Are you sure?',
		  text: "Add Points",
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
	
				$.post("../router/router.php", {request: "addPoints",rowid:$("#rowidx2").val(), points:pointsx}, function(data){
					if(data > 0)
					{
						Swal.fire({
						  title: 'Add Points Success!', 
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
	
	function addPointsx()
	{
		let selected = [];
		let selectedNames = [];
		
		// Loop all rows in DataTables (not only visible ones)
		table.rows().every(function() {
			let node = this.node();
			let checkbox = $(node).find('.member-check');

			if (checkbox.prop('checked')) {
				selected.push(checkbox.val());
				selectedNames.push($(node).find('td:nth-child(3)').text().trim()); // name column
			}
		});
	

		if (selected.length == 0) { 
			alert("Please select member first!");
			return;
		}   

		
		var pointsx = Number($("#pointsxx").val()); 
		Swal.fire({
		  title: 'Are you sure?', 
		  html: "You are about to add Points :<br><b>" + selectedNames.join(", ") + "</b>", 
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
	
				$.post("../router/router.php", {request: "addPointsx", points:pointsx, ids: JSON.stringify(selected)}, function(data){
					if(data > 0)
					{
						Swal.fire({
						  title: 'Add Points Success!', 
						  icon: 'success', 
						}).then((result) => {
						  if (result.isConfirmed) { 
							location.reload();
						  }
						})
					}  else{
						Swal.fire({
						  title:  "Failed to Points points", 
						  icon: 'warning', 
						})
					} 
			  });
			} 
		})
	}
	
	
	function deductPoints()
	{
		var pointsx = Number($("#pointsx").val()); 
		Swal.fire({
		  title: 'Are you sure?',
		  text: "Deduct Points",
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
	
				$.post("../router/router.php", {request: "deductPoints",rowid:$("#rowidx2").val(), points:pointsx}, function(data){
					if(data > 0)
					{
						Swal.fire({
						  title: 'Deduct Points Success!', 
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
	
	function deductPointsx()
	{
		let selected = [];
		let selectedNames = [];
		
		// Loop all rows in DataTables (not only visible ones)
		table.rows().every(function() {
			let node = this.node();
			let checkbox = $(node).find('.member-check');

			if (checkbox.prop('checked')) {
				selected.push(checkbox.val());
				selectedNames.push($(node).find('td:nth-child(3)').text().trim()); // name column
			}
		});
	

		if (selected.length == 0) { 
			alert("Please select member first!");
			return;
		}   
		
		var pointsx = Number($("#pointsxx").val()); 
		Swal.fire({
		  title: 'Are you sure?', 
		  html: "You are about to Deduct Points:<br><b>" + selectedNames.join(", ") + "</b>", 
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
	
				$.post("../router/router.php", {request: "deductPointsx", points:pointsx, ids: JSON.stringify(selected)}, function(data){
					if(data > 0)
					{
						Swal.fire({
						  title: 'Deduct Points Success!', 
						  icon: 'success', 
						}).then((result) => {
						  if (result.isConfirmed) { 
							location.reload();
						  }
						})
					} else{
						Swal.fire({
						  title:  "Failed to deduct points", 
						  icon: 'warning', 
						})
					} 
			  });
			} 
		})
	}
	
	function deduct_save_add_time()
	{
		var m_hours    = Number($("#m_hours").val());
		var m_mins     = Number($("#m_mins").val());
		var m_seconds  = Number($("#m_seconds").val()); 
		var time  = Number((m_hours * 3600) + (m_mins * 60) + (m_seconds)); 
		 
		deduct_rem_time("Deduct Time", time, "remaining_time"); 
	}
	
	function deduct_save_add_timex()
	{
		var m_hours    = Number($("#m_hoursx").val());
		var m_mins     = Number($("#m_minsx").val());
		var m_seconds  = Number($("#m_secondsx").val()); 
		var time  = Number((m_hours * 3600) + (m_mins * 60) + (m_seconds)); 
		 
		deduct_rem_timex("Deduct Time", time, "remaining_time"); 
	}
	
	function deduct_save_add_time2()
	{ 
		var v_m_hours    = Number($("#v_m_hours").val());
		var v_m_mins     = Number($("#v_m_mins").val());
		var v_m_seconds  = Number($("#v_m_seconds").val());  
		var v_time  = Number((v_m_hours * 3600) + (v_m_mins * 60) + (v_m_seconds));  
		 
		deduct_rem_time("Deduct Time", v_time, "vip_rem_time"); 
	}
	
	function deduct_save_add_time2x()
	{ 
		var v_m_hours    = Number($("#v_m_hoursx").val());
		var v_m_mins     = Number($("#v_m_minsx").val());
		var v_m_seconds  = Number($("#v_m_secondsx").val());  
		var v_time  = Number((v_m_hours * 3600) + (v_m_mins * 60) + (v_m_seconds));  
		 
		deduct_rem_timex("Deduct Time", v_time, "vip_rem_time"); 
	}
	
	function deduct_save_add_time3()
	{  
		var vv_m_hours    = Number($("#vv_m_hours").val());
		var vv_m_mins     = Number($("#vv_m_mins").val());
		var vv_m_seconds  = Number($("#vv_m_seconds").val()); 
		var vv_time  = Number((vv_m_hours * 3600) + (vv_m_mins * 60) + (vv_m_seconds)); 
		 
		deduct_rem_time("Deduct Time", vv_time, "vvip_rem_time"); 
	}
	
	function deduct_save_add_time3x()
	{  
		var vv_m_hours    = Number($("#vv_m_hoursx").val());
		var vv_m_mins     = Number($("#vv_m_minsx").val());
		var vv_m_seconds  = Number($("#vv_m_secondsx").val()); 
		var vv_time  = Number((vv_m_hours * 3600) + (vv_m_mins * 60) + (vv_m_seconds)); 
		 
		deduct_rem_timex("Deduct Time", vv_time, "vvip_rem_time"); 
	}
	
	function deduct_rem_time(action, rem_time, fields)
	{ 
		Swal.fire({
		  title: 'Are you sure?',
		  text: action,
		  icon: 'warning',
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
	
				$.post("../router/router.php", {request: "deduct_user_time",rowid:$("#rowidx2").val(), rem_time:rem_time, fields:fields}, function(data){
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
			  });
			} 
		})
	} 
	
	function deduct_rem_timex(action, rem_time, fields)
	{ 
		let selected = [];
		let selectedNames = [];
		
		// Loop all rows in DataTables (not only visible ones)
		table.rows().every(function() {
			let node = this.node();
			let checkbox = $(node).find('.member-check');

			if (checkbox.prop('checked')) {
				selected.push(checkbox.val());
				selectedNames.push($(node).find('td:nth-child(3)').text().trim()); // name column
			}
		});
	

		if (selected.length == 0) { 
			alert("Please select member first!");
			return;
		}   

		Swal.fire({
		  title: 'Are you sure?', 
		  html: "You are about to deduct time:<br><b>" + selectedNames.join(", ") + "</b>", 
		  icon: 'warning',
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
	
				$.post("../router/router.php", {request: "deduct_user_timex",rem_time:rem_time, fields:fields, ids: JSON.stringify(selected)}, function(data){
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
					} else{
						Swal.fire({
						  title:  "Failed to deduct time", 
						  icon: 'warning', 
						})
					} 
			  });
			} 
		})
	} 
	
	function update_rem_time(action, rem_time, fields)
	{ 
		Swal.fire({
		  title: 'Are you sure?',
		  text: action,
		  icon: 'warning',
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
	
				$.post("../router/router.php", {request: "update_user_time",rowid:$("#rowidx2").val(), rem_time:rem_time, fields:fields}, function(data){
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
			  });
			} 
		})
	} 
	
	function update_rem_timex(action, rem_time, fields)
	{  
		let selected = [];
		let selectedNames = [];
		
		// Loop all rows in DataTables (not only visible ones)
		table.rows().every(function() {
			let node = this.node();
			let checkbox = $(node).find('.member-check');

			if (checkbox.prop('checked')) {
				selected.push(checkbox.val());
				selectedNames.push($(node).find('td:nth-child(3)').text().trim()); // name column
			}
		});
	

		if (selected.length == 0) { 
			alert("Please select member first!");
			return;
		} 

		Swal.fire({
		  title: 'Are you sure?', 
		  html: "You are about to add time:<br><b>" + selectedNames.join(", ") + "</b>", 
		  icon: 'warning',
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
	
				$.post("../router/router.php", {request: "update_user_timex",rem_time:rem_time, fields:fields, ids: JSON.stringify(selected)}, function(data){
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
					}else{
						Swal.fire({
						  title:  "Failed to add time", 
						  icon: 'warning', 
						})
					} 
			  });
			} 
		})
	} 
 
    function get_member()
    {
		Swal.fire({
			title: 'Loading...',
			text: 'Please wait while we process your request.',
			allowOutsideClick: false, // Prevent closing by clicking outside
			didOpen: () => {
				Swal.showLoading(); // Show the loading spinner
			}
		});
		
		$.post("../router/router.php", {'request': 'get_member'}, function(data)
		{
			 // Destroy existing datatable if exists
			if ($.fn.DataTable.isDataTable('#myTable')) {
				$('#myTable').DataTable().destroy();
			}
			
			$("#tablex").html(data); 
			table = $('#myTable').DataTable( {
				responsive: true
			} );
			Swal.close();
		});
    }


    function change_pass(rowid,username,name)
    { 
        $("#rowidx").val(rowid);
        $("#username").val(username);  
        $("#name").val(name);  
        $("#username").prop('disabled', true);
		$("#add_member_title").text("Change Password");
        $("#rates_modal").modal('show');
    }
	
	function change_title()
	{
		$("#add_member_title").text("Add Member");
        $("#rates_modal").modal('show');
	}
	function add_time(data)
    {   
        $("#rowidx2").val(data.rowid);
        $("#user").val(data.username);    
        $("#add_time_modal").modal('show');
    }
	

    function delete_member(rowid)
    {
        Swal.fire({
            title: "Delete this Member?", 
            icon: 'question', 
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) { 
                $.post("../router/router.php", {'request': 'delete_member', rowid: rowid}, function(data)
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
        $("#username").prop('disabled', false);  
    }
	 
	function resetx(rowid)
	{
		Swal.fire({
			title: "Please choose action to reset member's time",
			text: "Reset Time",
			icon: "warning",
			showDenyButton: true,
			showCancelButton: false, // Remove Cancel button
			confirmButtonText: "Reset VIP Time", // First button
			denyButtonText: "Reset VVIP Time", // Second button
			showCloseButton: true,
			footer: '<button id="customButton" class="swal2-confirm swal2-styled m-0" style="background-color: #4CAF50; color: white;" onclick = "reset_non_vip(' + rowid + ')">Reset NON-VIP Time</button>'
		}).then((result) => {
            if (result.isConfirmed) { 
			 
				Swal.fire({
					title: 'Are you sure?',
					icon: 'question',
					text: 'Reset VIP TIME',
					confirmButtonText: "YES",
					showCancelButton: true,
				}).then((result) => {
					if (result.isConfirmed) {
						$.post("../router/router.php", {'request': 'user_time_reset', rowid: rowid, fields: 'vip_rem_time'}, function(data)
						{
							if(data > 0)
							{
								Swal.fire({
								title:'Reset VIP Time Success!', 
								icon: 'success', 
								}).then((result) => {
									if (result.isConfirmed) { 
										location.reload();
									}
								})
							}
						});
					}
				});  
            } 
			else if (result.isDenied) { 
				Swal.fire({
					title: 'Are you sure?',
					icon: 'question',
					text: 'Reset VVIP TIME',
					confirmButtonText: "YES",
					showCancelButton: true,
				}).then((result) => {
					if (result.isConfirmed) {
						$.post("../router/router.php", {'request': 'user_time_reset', rowid: rowid, fields: 'vvip_rem_time'}, function(data) {
							if (data > 0) {
								Swal.fire({
									title: 'Reset VVIP Time Success!',
									icon: 'success',
								}).then((result) => {
									if (result.isConfirmed) {
										location.reload();
									}
								});
							}
						});
					}
				});  
			}  		
        })
	}
	
	
	function reset_non_vip(rowid) {
		Swal.fire({
			title: 'Are you sure?',
			icon: 'question',
			text: 'Reset NON-VIP TIME',
			confirmButtonText: "YES",
			showCancelButton: true,
		}).then((result) => {
			if (result.isConfirmed) {
				$.post("../router/router.php", {'request': 'user_time_reset', rowid: rowid, fields: 'remaining_time'}, function(data) {
					if (data > 0) {
						Swal.fire({
							title: 'Reset NON-VIP Time Success!',
							icon: 'success',
						}).then((result) => {
							if (result.isConfirmed) {
								location.reload();
							}
						});
					}
				});
			}
		}); 
	};
 

    function save_member()
    {
        var rowid    = $("#rowidx").val();
        var name     = $("#name").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var confirm  = $("#confirm").val();

        if(password != confirm)
        {
            Swal.fire({
                title:"Password does not match!",  
                icon: 'warning', 
            })
            return;
        }
        $.post("../router/router.php", {'request': 'save_member', rowid: rowid, name: name, username: username, password: password}, function(data)
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
	
	function restore()
	{ 
		var formData = new FormData($("#form_background")[0]);
		formData.append("request", "restore"); 
		$.ajax({
			url: '../router/router.php',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response){  
				alert(response);
				location.reload();
			},
			error: function(xhr, status, error){
				// Handle errors
				console.error(xhr.responseText);
			}
		});
	
	}
	 
	 
	  
 function top_up(rowid,table,title)
 { 
    $("#top_up_title").text(title);
	$("#top_up_rowid").val(rowid);
    $("#top_up_table").val(table);
    $("#top_up_modal").modal('show');
 }
 
 
 function top_up_member()
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
 
 function deduct_top_up_member()
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
 
$('#filter_by').on('change', function () {
	var filterValue = $(this).val(); // Get selected value
	table.column(8).search(filterValue).draw(); // Column 1 is the 'Category' column (index 1)
});

function num_only(event) {  
	var charCode = (typeof event.which === "number") ? event.which : event.keyCode;
	if (charCode !== 8 && (charCode < 48 || charCode > 57)) {
	  event.preventDefault();
	}
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
            $.post("../router/router.php", {request: "member_idle", member_idle: inputValue}, function(data) {
                if(data > 0) {
                    $("#loading").text("Successfully saved!");
                    $("#loading").removeClass('text-danger');
                    $("#loading").addClass('text-success');
                }
            });
        }
    }, doneTypingInterval);
});

  
  
  function get_idle_cnt()
  {
	$.post("../router/router.php", {request: "get_idle_cnt"}, function(data){  
		$("#idle_time").val(data);
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

function detec_max_credit(event) { 
  let input = event.target;
  let value = Number(input.value); 
 
  if (value > max_credit) {
    input.value = max_credit;  
  } else if (value < 0) {
    input.value = 0;  
  } else if (value.toString().length > max_credit.toString().length) { 
    input.value = value.toString().substring(0, max_credit.toString().length);  
  }
  
}

function detec_max_points(event) {
  let input = event.target;
  let value = Number(input.value); 
 
  if (value > max_points) {
    input.value = max_points;  
  } else if (value < 0) {
    input.value = 0;  
  } else if (value.toString().length > max_points.toString().length) { 
    input.value = value.toString().substring(0, max_points.toString().length);  
  }
}

 function togglePassword(id) {
	var passwordField = document.getElementById('passwordField' + id);
	var eyeIcon = document.getElementById('eyeIcon' + id);
	
	if (passwordField.type === "password") {
		passwordField.type = "text"; // Show the password
		eyeIcon.classList.add('fa-eye-slash');
		eyeIcon.classList.remove('fa-eye');
	} else {
		passwordField.type = "password"; // Hide the password
		eyeIcon.classList.add('fa-eye');
		eyeIcon.classList.remove('fa-eye-slash');
	}
}
 

function delete_all()
{ 
	let selected = [];
	let selectedNames = [];
    
    // Loop all rows in DataTables (not only visible ones)
    table.rows().every(function() {
        let node = this.node();
        let checkbox = $(node).find('.member-check');

        if (checkbox.prop('checked')) {
            selected.push(checkbox.val());
			selectedNames.push($(node).find('td:nth-child(3)').text().trim()); // name column
        }
    });
 

	if (selected.length == 0) { 
		alert("Please select member first!");
		return;
	} 

	Swal.fire({
	  title: 'Are you sure?',
	  html: "You are about to delete:<br><b>" + selectedNames.join(", ") + "</b>", 
	  icon: 'question',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: "YES"
	  }).then((result) => {
	  if (result.isConfirmed) {  
			$.post("../router/router.php", {request: "delete_all_members",ids: JSON.stringify(selected)}, function(data){  
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

$('#selectAll').on('click', function() {
    let checked = this.checked;

    // Select all rows (across all DataTable pages)
    table.rows().every(function() {
        let node = this.node();
        $(node).find('.member-check').prop('checked', checked);
    });
});


function getSelectedMembers() {
   let selected = [];
    
    // Loop all rows in DataTables (not only visible ones)
    table.rows().every(function() {
        let node = this.node();
        let checkbox = $(node).find('.member-check');

        if (checkbox.prop('checked')) {
            selected.push(checkbox.val());
        }
    });
 

	if (selected.length > 0) {
		$('#manageTime').modal('show');
	}else{
		alert("Please select member first!");
	}
}
 
</script>
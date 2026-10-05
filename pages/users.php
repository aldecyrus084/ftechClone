<div class="container-fluid py-2"> 

     <!-- Manage Time Modal -->  
    <div class="modal fade" id="add_users" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content"> 
            <form class="needs-validation" novalidate id = "myFormx">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id = "add_user_title">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <input type="hidden" id = "rowidx">
                <div class="form-floating mb-1 border rounded-3">
                    <input type="hidden"   id="rowid"> 
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
                <div class="form-floating mb-1 border rounded-3 position-relative">
                    <input type="password" class="form-control px-2 text-center fw-bold fs-5" id="password"  required> 
                    <label for="password">Password</label>
					<i class="fa fa-eye position-absolute top-50 end-0 me-2 translate-middle-y" id = "eyeIcon" onclick="togglePassword();" style="cursor: pointer;"></i>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Password
                    </div>
                </div>   
				
				<!-- Checkboxes Inline -->
				<label class="fw-bold mt-3">Select Access</label>
				<div class="row mt-1 mb-0">
					<!-- Manage PC -->
					<div class="col-6 mb-0">
						<div class="form-check">
							<input type="checkbox" class="checkbox" id="manage_pc">
							<label class="form-check-label small-label ms-2" for="manage_pc">Manage Pc</label> 
						</div>
					</div>
 
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="rates">
							<label class="form-check-label small-label ms-2" for="rates">Timer Rates</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="redeem_rates">
							<label class="form-check-label small-label ms-2" for="redeem_rates">Redeem Rates</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="redeem_history">
							<label class="form-check-label small-label ms-2" for="redeem_history">Redeem History</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="sales_history">
							<label class="form-check-label small-label ms-2" for="sales_history">Reports</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="system_info">
							<label class="form-check-label small-label ms-2" for="system_info">System Info</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="settings">
							<label class="form-check-label small-label ms-2" for="settings">Settings</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="remote">
							<label class="form-check-label small-label ms-2" for="remote">Remote</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="telegram">
							<label class="form-check-label small-label ms-2" for="telegram">Telegram</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="license">
							<label class="form-check-label small-label ms-2" for="license">License</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="profile">
							<label class="form-check-label small-label ms-2" for="profile">Profile</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="users">
							<label class="form-check-label small-label ms-2" for="users">Sub-Users</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="camera">
							<label class="form-check-label small-label ms-2" for="camera">Camera</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="members">
							<label class="form-check-label small-label ms-2" for="members">Members</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="subvendo">
							<label class="form-check-label small-label ms-2" for="subvendo">Sub-Coinslot</label>
						</div>
					</div>
					<div class="col-6 mb-0">
						<div class="form-check ">
							<input type="checkbox" class="checkbox" id="voucher">
							<label class="form-check-label small-label ms-2" for="voucher">Pisonet Voucher</label>
						</div>
					</div>

					<!-- ========================= -->
					<!-- Hidden section for MANAGE PC -->
					<!-- ========================= -->
					<div id="manage_pc_options" class="mt-3 d-none">
						<label class="fw-bold">Manage PC Options</label>
						<div class="row">

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="wakeonlanall">
									<label class="form-check-label small-label ms-2" for="wakeonlanall">Wake On Lan (ALL)</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="removeall">
									<label class="form-check-label small-label ms-2" for="removeall">Remove Pc (ALL)</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="addtimeall">
									<label class="form-check-label small-label ms-2" for="addtimeall">Add Guest Time (ALL)</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="updateall">
									<label class="form-check-label small-label ms-2" for="updateall">Reset Guest Time (ALL)</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="chat">
									<label class="form-check-label small-label ms-2" for="chat">Chat</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="guesttopup">
									<label class="form-check-label small-label ms-2" for="guesttopup">Manage Guest Top Up</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="guesttime">
									<label class="form-check-label small-label ms-2" for="guesttime">Manage Guest Time</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="resettime">
									<label class="form-check-label small-label ms-2" for="resettime">Reset Time</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="transfertime">
									<label class="form-check-label small-label ms-2" for="transfertime">Transfer Time</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="setvip">
									<label class="form-check-label small-label ms-2" for="setvip">Set as Vip</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="changebackground">
									<label class="form-check-label small-label ms-2" for="changebackground">Change Background</label>
								</div>
							</div>

							<div class="col-6 mb-0">
								<div class="form-check">
									<input type="checkbox" class="checkbox" id="remove">
									<label class="form-check-label small-label ms-2" for="remove">Remove</label>
								</div>
							</div> 
						</div>
					</div>
				</div> 
				<!-- Checkboxes Inline -->
				
            </div>
            <div class="modal-footer ">
                <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal" onclick = "clear_form();">Close</button>
                <button type="submit" class="mb-0 btn btn-primary-x" id = 'save_userx'>Save</button>
            </div> 
            </form>
        </div>
        </div>
    </div>
	   
  <!-- END MODAL --> 
  

    <div class="mb-4">
        <div class="mt-0 mb-4">
          <div class="card">  
			<div class="card-header pt-2 pb-0 border-bottom">
				<div class="d-flex align-items-center justify-content-between"> 
               <h6>Sub-users List</h6> 
				   <div class = "mb-1">  
						<button type="button" class="mb-0 btn-sm btn btn-success f-6 d-flex align-items-center justify-content-center"  data-bs-toggle="modal" data-bs-target = "#add_users" id = "add_users">
							<i class="fa-solid fa-plus text-white fs-5 me-2"></i> Add Users
						</button> 
					</div> 
				</div> 
			</div> 
			
            <div class="card-body px-0 pb-1">  
              <div class="px-3 pt-0"> 
                 <table class="table table-hover table-dark responsive nowrap" width="100%" id = "myTable">
                  <thead class = 'thead-dark'>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Username</th> 
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Password</th>  
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Access Control</th>  
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
$(document).ready(function(){
	get_sub_users();
	
	
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
                    event.preventDefault();
					
					var action = $("#save_userx").text(); 
					save_users(action);
                }
                form.classList.add('was-validated')
            }, false)
            })
        })()
		
});
function get_sub_users()
{
  $.post("../router/router.php", {'request': 'get_sub_users'}, function(data)
  {
	$("#tablex").html(data); 
	table = $('#myTable').DataTable( {
		responsive: true
	} );
  });
}



 function togglePassword() {
	var passwordField = document.getElementById('password');
	var eyeIcon = document.getElementById('eyeIcon');
	
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

 function togglePassword2(rowid) {
	var passwordField = document.getElementById('passwordField' + rowid);
	var eyeIcon = document.getElementById('eyeIcon' + rowid);
	
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

function delete_users(rowid)
{ 
	Swal.fire({
            title: "Delete this user?", 
            icon: 'question', 
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
		if (result.isConfirmed) { 
			$.post("../router/router.php", {'request': 'delete_users', rowid: rowid}, function(data)
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
	$("#add_user_title").text("Add User");
	$('input[type="checkbox"]').prop('checked', false);
	$("#save_userx").text('Save');
}


function save_users(action)
{  
	var selectedIds = $('.checkbox:checked').map(function() {
		return this.id; // Get the ID of the checkbox
	}).get();
	 
	var concatenatedIds = selectedIds.join(','); 
	
	
	var name = $("#name").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var rowid = $("#rowid").val();
	$.post("../router/router.php", {'request': 'save_users', action:action, name: name,username:username ,password:password, access: concatenatedIds, rowid: rowid}, function(data)
	{
		if(data == "Already Exist!")
		{
			Swal.fire({
			title: 'User: ' + username + ' ' + data, 
			icon: 'info', 
			}) 
		}
		else
		{
			Swal.fire({
			title: action + 'success!', 
			icon: 'success', 
			}).then((result) => {
				if (result.isConfirmed) { 
					location.reload();
				}
			})
		}
	});
}

function update_users(rowid,full_name,username,password,access)
{
	$("#rowid").val(rowid);
	$("#name").val(full_name);
	$("#username").val(username);
	$("#password").val(password);
	$("#save_userx").text('Update');
	var idsArray = access.split(','); 
	$.each(idsArray, function(index, id) {
		$("#" + id).prop('checked', true); 
		if(id == "manage_pc")
		{
			const section = document.getElementById("manage_pc_options");
    		section.classList.toggle("d-none");
		}
	});
		
	$("#add_user_title").text("Update Users Info");
	$("#add_users").modal('show');
}

document.getElementById("manage_pc").addEventListener("change", function () {
    const section = document.getElementById("manage_pc_options");
    section.classList.toggle("d-none", !this.checked);
});
</script>
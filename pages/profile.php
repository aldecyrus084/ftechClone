<div class="container-fluid py-2">
    <div class="mb-4">
        <div class="mt-0 mb-4">
          <div class="card">
            <div class="card-header pt-2 pb-0 border-bottom">
               <h6>My Profile</h6> 
            </div> 
            <div class="card-body px-4 pb-4">
			
			<div class="alert  alert-info alert-dismissible text-white" role="alert" id = "alert">
				<span class="text-sm"><i class="fa-regular fa-face-smile me-3 fs-5"></i><span class = "fs-5 opacity-9">Welcome back <span class= "text-dark fs-3 opacity-10"><?php echo $_SESSION['full_name']; ?></span>, Ready to manage your profile?</span></span>
				<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
				<form class="needs-validation" novalidate id = "myFormx">
					<div class=" pb-2 d-flex justify-content-center flex-column gap-1 align-items-center"> 
						<div class="w-100  form-floating mb-1 border rounded-3"> 
							<input type="text" class="form-control ps-2 text-center fw-bold fs-6"  id="name" value = "<?php echo $_SESSION['full_name']; ?>">
							<label for="rem_time">Name</label>
						</div> 
					  <div class="w-100  form-floating mb-1 border rounded-3"> 
						<input type="text" class="form-control ps-2 text-center fw-bold fs-6"  id="username" value = "<?php echo $_SESSION['username']; ?>">
						<label for="rem_time">Username</label>
					  </div> 
						<div class="w-100 form-floating mb-1 border rounded-3 position-relative">
							<input type="password" class="form-control px-2 text-center fw-bold fs-5" id="old_password"  required> 
							<label for="old_password">Old Password</label>
							<i class="fa fa-eye position-absolute top-50 end-0 me-2 translate-middle-y" id = "eyeIcon1" onclick="togglePassword1();" style="cursor: pointer;"></i>
							<div class="invalid-feedback text-center mb-0">
							Please Input Old Password
							</div> 
						</div>
						<div class="w-100 form-floating mb-1 border rounded-3 position-relative">
							<input type="password" class="form-control px-2 text-center fw-bold fs-5" id="new_password"  required> 
							<label for="new_password">New Password</label>
							<i class="fa fa-eye position-absolute top-50 end-0 me-2 translate-middle-y" id = "eyeIcon2" onclick="togglePassword2();" style="cursor: pointer;"></i>
							<div class="invalid-feedback text-center mb-0">
							Please Input New Password
							</div> 
						</div> 
						<div class="w-100 form-floating mb-1 border rounded-3 position-relative">
							<input type="password" class="form-control px-2 text-center fw-bold fs-5" id="confirm_password"  required> 
							<label for="confirm_password">Confirm Password</label>
							<i class="fa fa-eye position-absolute top-50 end-0 me-2 translate-middle-y" id = "eyeIcon3" onclick="togglePassword3();" style="cursor: pointer;"></i>
							<div class="invalid-feedback text-center mb-0">
							Please Input Confirm Password
							</div> 
						</div> 
					</div>

					<div class="mt-0"> 
						<button type="submit" class="mb-0 btn btn-primary-x float-end" >Change Pass</button>
					</div> 					
				</form>
              </div>    
            </div> 
          </div>
        </div> 
    </div> 
</div>


<script>

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
					update_pass();
                }
                form.classList.add('was-validated')
            }, false)
		})
	})() 
});
	

 function update_pass()
{
	var old_pass = $("#old_password").val();
	var new_pass = $("#new_password").val();
	var confirm_pass = $("#confirm_password").val();
	var name = $("#name").val();
	var username = $("#username").val();

	if(old_pass != "<?php echo $_SESSION['password'];?>")
	{
		Swal.fire({
		title:'Incorrect old password!', 
		icon: 'warning', 
		})
		return;
	}

	if(new_pass != confirm_pass)
	{ 
		Swal.fire({
		title:'Password do not match!', 
		icon: 'warning', 
		})
		return;
	}

	$.post("../router/router.php", {'request': "update_pass", full_name: name, username:username, password:new_pass},function(data)
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
			title: 'Update success!', 
			icon: 'success', 
			}).then((result) => {
				if (result.isConfirmed) { 
					location.reload();
				}
			})
		}
		
	})
}

 function togglePassword1() {
	var passwordField = document.getElementById('old_password');
	var eyeIcon = document.getElementById('eyeIcon1');
	
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

 function togglePassword2() {
	var passwordField = document.getElementById('new_password');
	var eyeIcon = document.getElementById('eyeIcon2');
	
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

 function togglePassword3() {
	var passwordField = document.getElementById('confirm_password');
	var eyeIcon = document.getElementById('eyeIcon3');
	
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

$('#username').on('input', function() {
	// Remove spaces in the input value
	$(this).val($(this).val().replace(/\s+/g, ''));
});
 
 $('#new_password').on('input', function() {
	// Remove spaces in the input value
	$(this).val($(this).val().replace(/\s+/g, ''));
});

$('#old_password').on('input', function() {
	// Remove spaces in the input value
	$(this).val($(this).val().replace(/\s+/g, ''));
});

$('#confirm_password').on('input', function() {
	// Remove spaces in the input value
	$(this).val($(this).val().replace(/\s+/g, ''));
});
</script>
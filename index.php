 

<?php
require_once("init.php"); 
session_start();
if(isset($_SESSION['_islogin']))
{
  //echo 'log in';
  header("Location: pages/index.php?page=dashboard");
}
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/logo.png">
  <title>
    Login
  </title>
  <link rel="stylesheet" type="text/css" href="assets/css/roboto.css" /> 
  <link href="assets/css/material_icon.css" rel="stylesheet">
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" /> 
  
  
  <link href="assets/css/fontawesome.css" rel="stylesheet" />
  <link href="assets/css/brands.css" rel="stylesheet" />
  <link href="assets/css/solid.css" rel="stylesheet" />
  <link href="assets/css/ftech.css" rel="stylesheet" />
  
</head>

<body class="bg-gray-200" > 
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-90"   id = "particles-js" style="background-color: #FF4057"> 
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 opacity-9 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center p-3">Sign in</h4>

					<div class="d-flex justify-content-center align-items-center">
						<div class="text-center">
						  <a class="btn btn-link px-3" href="https://www.facebook.com/profile.php?id=100095681855035" target="_blank"> 
							<i class="fa-brands fa-facebook  text-white text-lg"></i>
						  </a>
						</div>  
						<div class="text-center">
						  <a class="btn btn-link px-3" href="https://www.youtube.com/@xprogrammer0410" target="_blank"> 
							<i class="fa-brands fa-youtube text-white text-lg"></i>
						  </a>
						</div>
					</div>
 
						
                </div>
              </div>
              <div class="card-body">
                <form role="form" action="" method="post" class="text-start"> 
				  
					<div class="w-100 form-floating mb-1 border rounded-3 position-relative"> 
						<input type="text" class="form-control ps-2 text-center fw-bold fs-5" id="uname">
						<label for="uname">Username</label>  
					</div>
							 
				  
					<div class="w-100 form-floating mb-1 border rounded-3 position-relative"> 
						<input type="password" class="form-control ps-2 text-center fw-bold fs-5" id="pwd">
						<label for="pwd">Password</label> 
						<i class="fa fa-eye position-absolute top-50 end-0 me-2 translate-middle-y" id = "eyeIcon" onclick="togglePassword();" style="cursor: pointer;"></i>
					</div>
					
                  <div class="text-center">
                    <button type="button"   id="btn_login"  class="btn bg-gradient-dark w-100 my-4 mb-2 text-white">Sign in</button>
                  </div>
                  <p class="mt-4 text-sm text-center"> 
                    <a href="javascript:void(0)" class="text-primary text-gradient font-weight-bold" onclick = "forgot()">Forgot Password</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/particles.min.js"></script>
  <script>
    $(document).ready(function(){ 
      $("#btn_login").click(function(){

        if($('#uname').val() == '')
        {
          alert('Username is required');
          return;
        }
        if($('#pwd').val() == '')
        {
          alert('Password is required');
          return;
        }
      //  alert("das");
        $.post('router/router.php', {'request': 'login', uname: $('#uname').val(), pwd: $('#pwd').val()}, function(data)
        {  
          if(data == '')
          { 
            alert("Incorrect username or password");
          }
          else
          { 
            location.href = 'pages/index.php?page=dashboard';
          }
        })
      })
    }); 
	
	
	function forgot()
	{
		let text = "Do you want to retrieve your password?";
		if (confirm(text) == true) {
			$.post('router/api.php', {'request': 'forgotPassword'}, function(data)
			{   
				alert("Please check your telegram Account");		
			})
		}  
	}
	
	
	$('#pwd').on('keypress', function(event) {
        if (event.which === 13) {  
            event.preventDefault();  
            $("#btn_login").click();
        }
    });
	
	$('#uname').on('keypress', function(event) {
        if (event.which === 13) {  
            event.preventDefault();  
            $("#btn_login").click();
        }
    });



function togglePassword() {
	var passwordField = document.getElementById('pwd');
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
 
particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 140,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});

 

  </script> 
  <script src="assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>
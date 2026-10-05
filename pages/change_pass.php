<div class="container-fluid py-4">
    <div class="mb-4">
        <div class="mt-0 mb-4">
          <div class="card">
            <div class="card-header pt-2 pb-0 border-bottom">
               <h6>System Info</h6> 
            </div> 
            <div class="card-body px-0 pb-2">
              <div class="px-3 pb-2 d-flex justify-content-center flex-column gap-1 align-items-center"> 
                <ul class="list-group list-group-horizontal w-100">
                    <li class="list-group-item w-40 bg-gray-300 d-flex align-items-center">Old Password</li>  
                    <li class="list-group-item w-60 border border-success"><input type="password"  id = "old_pass"  class = "h-100 form-control border-0 shadow-none text-center fs-4" value = ""></li>  
                </ul>
                <ul class="list-group list-group-horizontal w-100">
                    <li class="list-group-item w-40 bg-gray-300 d-flex align-items-center">New Password</li> 
                    <li class="list-group-item w-60 border border-success"><input type="password"  id = "new_pass"  class = "h-100 form-control border-0 shadow-none text-center fs-4" value = ""></li>  
                </ul>
                <ul class="list-group list-group-horizontal w-100">
                    <li class="list-group-item w-40 bg-gray-300 d-flex align-items-center">Confirm Password</li> 
                    <li class="list-group-item w-60 border border-success"><input type="password"  id = "confirm_pass"  class = "h-100 form-control border-0 shadow-none text-center fs-4" value = ""></li>  
                </ul> 
              </div>
                <div class="px-3 mt-0">
                    <button type="button" class="mb-0 mt-0 btn btn-success float-end" onclick = "update_pass()">Update</button>
                </div> 

            </div> 
          </div>
        </div> 
    </div> 
</div>


<script>
    function update_pass()
    {
        var old_pass = $("#old_pass").val();
        var new_pass = $("#new_pass").val();
        var confirm_pass = $("#confirm_pass").val();

        if(old_pass != "<?php echo $_SESSION['password'];?>")
        {
            alert("Incorrect Old Password!");
            return;
        }

        if(new_pass != confirm_pass)
        {
            alert("Password do not match!");
            return;
        }

        $.post("../router/router.php", {'request': "update_pass", pass: new_pass},function(data)
        {
            if(data > 0)
            {
                $("#old_pass").val("");
                $("#new_pass").val("");
                $("#confirm_pass").val("");
                alert("Update success");
            }
        })
    }
</script>
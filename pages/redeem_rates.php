<div class="container-fluid py-4"> 
     <!-- Manage Time Modal -->  
    <div class="modal fade" id="rates_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content"> 
            <form class="needs-validation" novalidate id = "myFormx">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Manage Redeem Rates</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <input type="hidden" id = "rowidx" name = "rowidx">
                <div class="form-floating mb-1 border rounded-3">
                    <input type="number" class="form-control px-2 text-center fw-bold fs-4" id="credit"  onkeypress= "num_only(event)" maxlength="3" required> 
                    <label for="credit">Points</label>
                    <div class="invalid-feedback text-center mb-0">
                    Please Input Points
                    </div>
                </div> 
                <div class="form-floating mb-1 border rounded-3"> 
					<input type="number" class="form-control px-2 text-center fw-bold fs-4" id="add_hrs"  onkeypress= "num_only(event)" required> 
					<label for="add_hrs">Hours</label>
					<div class="invalid-feedback text-center mb-0">
					  Please Input Hour
					</div>
				  </div> 
				<div class="form-floating border rounded-3">
					<input type="number" class="form-control px-2 text-center fw-bold fs-4" id="add_mins"  onkeypress= "num_only(event)" required> 
					<label for="add_mins">Minutes</label>
					<div class="invalid-feedback text-center mb-0">
					  Please Input Minute
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


     
  

    <div class="mb-4">
        <div class="mt-0 mb-4">
          <div class="card">
            <div class="card-header pt-2 pb-0 border-bottom">
			   
				<div class="d-flex align-items-center justify-content-between"> 
					<h6>Redeem Rates</h6> 
					<div class = "mb-1">  
						<button type="button" class="mb-0 btn-sm btn btn-success f-6 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#rates_modal">
						  <i class="fa-solid fa-plus text-white fs-5 me-2"></i> Add Rates
						</button>
					</div>
				</div>
			  
            </div> 
            <div class="card-body px-0 pb-2">
              <div class="p-3 pt-0 d-flex justify-content-center flex-column gap-1 align-items-center  w-100"> 
                 <table class="table table-hover table-dark   responsive nowrap" width="100%" id = "myTable">
                  <thead class = 'thead-dark'>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Points</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Reward Time (hh:mm:ss)</th> 
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
                    save_rates_update(); 
                }
                form.classList.add('was-validated')
            }, false)
            })
        })()

        //system_info()
        get_rates() 
    });
 

    function get_rates()
    {
      $.post("../router/router.php", {'request': 'redeem_get_rates'}, function(data)
      {
        $("#tablex").html(data); 
        table = $('#myTable').DataTable( {
            responsive: true   ,
			ordering: false  // Disable auto sorting
            
        } ); 
      });
    }
 

    function edit_rates(rowid,credit, time_sec)
    { 
        $("#rowidx").val(rowid);
        $("#credit").val(credit); 
		
		let hours = Math.floor(time_sec / 3600);
		let minutes = Math.floor((time_sec % 3600) / 60);
        $("#add_hrs").val(hours);
        $("#add_mins").val(minutes);
		
        $("#credit").prop('disabled', true);
        $("#rates_modal").modal('show');
    }
 
    function delete_rates(rowid)
    { 
        Swal.fire({
            title: "Delete this rates?", 
            icon: 'question', 
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) { 
                $.post("../router/router.php", {'request': 'redeem_delete_rates', rowid: rowid}, function(data)
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
        $("#rowidx").val("");
        $("#credit").prop('disabled', false);
    }
 

    function num_only(event) { 
        var charCode = (typeof event.which === "number") ? event.which : event.keyCode;
        var inputValue = event.target.value;
        
        if (charCode === 8) {
            return;
        }

        if ((charCode >= 48 && charCode <= 57) || charCode === 46) {
            if (charCode === 46) {
                if (inputValue.indexOf('.') !== -1) {
                    event.preventDefault();
                }
            }
        } else {
            event.preventDefault();
        }
    }


    function save_rates_update()
    {
        var rowid    = $("#rowidx").val();
        var credit   = $("#credit").val();  
		var hrs   = $("#add_hrs").val();
		var mins  = $("#add_mins").val();
		var time_sec  = (hrs * 3600) + (mins * 60); 
		
        $.post("../router/router.php", {'request': 'redeem_save_rates_update', rowid: rowid, credit: credit, time_sec: time_sec}, function(data)
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

    
</script>
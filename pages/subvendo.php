 
<div class="container-fluid py-2">

    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"> 
                <form class="needs-validation was-validated" novalidate id = "myFormx">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Update Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"> 
                        <input type="hidden" id = "rowidx">
                        <div class="form-floating mb-1 border rounded-3">
                            <input type="text" class="form-control px-2 text-center fw-bold fs-4" id="coinslotname" required disabled> 
                            <label for="coinslotname">Sub-Coinslot Name</label>
                            <div class="invalid-feedback text-center mb-0">
                            Please Input Sub-Coinslot Name
                            </div>
                        </div> 
                        <div class="form-floating  mb-1 border rounded-3">
                            <input type="text" class="form-control px-2 text-center fw-bold fs-4" id="description" required> 
                            <label for="description">Sub-Coinslot Description</label>
                            <div class="invalid-feedback text-center mb-0">
                            Please Input Sub-Coinslot Description
                            </div>
                        </div>  

                         <div class="form-floating  mb-1 border rounded-3"> 
                            <select class="ps-4 form-select" id="status" name = "status"  aria-label="Floating label select example" required>
							   <option value="Y" selected>Active</option> 
							   <option value="N">Inactive</option>  
                            </select>
                            <label for="status">Sub-Coinslot Status</label>
                            <div class="invalid-feedback text-center mb-0">
                            Please Select Sub-Coinslot Status
                            </div>
                        </div>  
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="mb-0 btn btn-secondary" data-bs-dismiss="modal" onclick = "clear_form();">Close</button>
                        <button type="submit" class="mb-0 btn btn-primary-x" >Update</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    
    <div class="vendo-count"></div> 
    <div class="vendo-List"></div> 

</div> 


<script> 
    $(document).ready(function()
    {   
        Swal.fire({
            title: 'Loading...',
            text: 'Please wait while we process your request.',
            allowOutsideClick: false, // Prevent closing by clicking outside
            didOpen: () => {
                Swal.showLoading(); // Show the loading spinner
            }
        });


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
                    updateSubVendo(); 
                }
                form.classList.add('was-validated')
            }, false)
            })
        })()
        

        getCount(); 
        getVendoList();
    });
    function getCount()
    {
        $.post("../router/router_main.php", {'request': 'getSubvendo'}, function(data)
        { 
            $('.vendo-count').html(data);
        });
    } 

    function getVendoList(isClose = true)
    {  
        $(".vendo-List").html("");
        $.post("../router/router_main.php", { request: "getVendoList"}, function(data) {  
            if ($.fn.DataTable.isDataTable('#myTable')) {
                $('#myTable').DataTable().clear().destroy();
            }

            $(".vendo-List").html(data);
            $('#myTable').DataTable();
            if(isClose)
            {
                Swal.close();
            }
        });
    }

    function deleteSub(rowid)
    {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                DeleteSubVendo(rowid);
               
            }
        });
    }

    function DeleteSubVendo(rowid)
    {
        $.post("../router/router_main.php", { request: "DeleteSubVendo", rowid: rowid}, function(data) { 
           if(data > 0)
            {
                getCount(); 
                getVendoList(false);
                Swal.fire({
                    title: "Deleted!",
                    text: "Delete Success!",
                    icon: "success"
                });
            }
            else
            {
                Swal.fire({
                    title: "Failed!",
                    text: "Failed to delete this data, please try again later",
                    icon: "error"
                });
            }
        });
    }

    function update(rowid,name,desc,isactive)
    { 
        $('#rowidx').val(rowid);
        $('#coinslotname').val(name);
        $('#description').val(desc);
        $("#status").val(isactive);
        $("#editModal").modal('show');
    }

    function clear_form()
    { 
        $('#myFormx')[0].reset();
        $("#rowidx").val("");  
    }

    function updateSubVendo()
    {
        var rowid        = $('#rowidx').val();
        var coinslotname = $('#coinslotname').val();
        var description  = $('#description').val();
        var status       = $("#status").val();

        $.post("../router/router_main.php", { request: "updateSubVendo", rowid: rowid, coinslotname: coinslotname, description: description, status:status}, function(data) { 
           if(data > 0)
            { 
                $("#editModal").modal('hide');
                getVendoList(false);
                Swal.fire({
                    title: "Updated!",
                    text: "Updated Success!",
                    icon: "success"
                });
            }
            else
            {
                Swal.fire({
                    title: "Failed!",
                    text: "No Changes have been made!",
                    icon: "waning"
                });
            }
        });

    }

</script>
 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Bootstrap Modal CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="completename" class="form-label">Name</label>
            <input type="text" class="form-control" id="completename">
        </div>
        <div class="mb-3">
            <label for="completemail" class="form-label">E-Mail</label>
            <input type="email" class="form-control" id="completemail">
        </div>
        <div class="mb-3">
            <label for="completemobile" class="form-label">Mobile</label>
            <input type="number" class="form-control" id="completemobile">
        </div>
        <div class="mb-3">
            <label for="completeplace" class="form-label">Place</label>
            <input type="text" class="form-control" id="completeplace">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" onclick="adduser()">Submit</button>
        <button type="button" class="btn btn-danger">Close</button>
      </div>
    </div>
  </div>
</div>
<!--Update modal-->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Update Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="updatename" class="form-label">Name</label>
            <input type="text" class="form-control" id="updatename">
        </div>
        <div class="mb-3">
            <label for="updatemail" class="form-label">E-Mail</label>
            <input type="email" class="form-control" id="updatemail">
        </div>
        <div class="mb-3">
            <label for="updatemobile" class="form-label">Mobile</label>
            <input type="number" class="form-control" id="updatemobile">
        </div>
        <div class="mb-3">
            <label for="updateplace" class="form-label">Place</label>
            <input type="text" class="form-control" id="updateplace">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" onclick="updateDetails()">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" id="hiddendata">
      </div>
    </div>
  </div>
</div>

    <div class="container my-3">
        <h1 class="text-center">PHP CRUD Operations using Bootstrap Modal</h1>
        <button type="button" class="btn btn-dark my-4" data-bs-toggle="modal" data-bs-target="#completeModal">
  Add New User
</button>
      <div id="displayDataTable"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
         $(document).ready(function(){
            displayData();
         });
        //Display function:
        function displayData(){
            var displayData="true";
            $.ajax(
                {
                    url:"display.php",
                    type:'post',
                    data:{
                        displaySend:displayData
                    },
                    success:function(data,status){
                       $('#displayDataTable').html(data);
                    }
                }
            );
        }
        function adduser(){
            var nameAdd=$('#completename').val();
            var emailAdd=$('#completemail').val();
            var mobileAdd=$('#completemobile').val();
            var placeAdd=$('#completeplace').val();
            $.ajax(
                {
                    url:"insert.php",
                    type:'post',
                    data:{
                        nameSend:nameAdd,
                        emailSend:emailAdd,
                        mobileSend:mobileAdd,
                        placeSend:placeAdd
                    }
                    ,success:function(data,status){
                        //function to display data:
                        //console.log(status);
                        $('#completeModal').modal('hide');
                        displayData();
                    }
                }
            );
        }
        //Delete Record:
        function DeleteUser(deleteid){
            $.ajax({
                url:"delete.php",
                type:'post',
                data:{
                    deletesend:deleteid
                },
                success:function(data,status){
                    displayData();
                }
            });

        }
        //Update function:
        function GetDetails(updateid){
            $('#hiddendata').val(updateid);
            $.post("update.php",{updateid:updateid},function(data,status){
                var userid=JSON.parse(data);
                $('#updatename').val(userid.name);
                $('#updatemail').val(userid.email);
                $('#updatemobile').val(userid.mobile);
                $('#updateplace').val(userid.place);
            });
            $('#updateModal').modal("show");

        }
        function updateDetails(){
         var updatename=$('#updatename').val();
         var updatemail=$('#updatemail').val();
         var updatemobile=$('#updatemobile').val();
         var updateplace=$('#updateplace').val();
         var hiddendata=$('#hiddendata').val();

         $.post("update.php",{
          updatename:updatename,
          updatemail:updatemail,
          updatemobile:updatemobile,
          updateplace:updateplace,
          hiddendata:hiddendata
         },function(data,status){
            $('#updateModal').modal('hide');
            displayData();
         });
        }
    </script>
  </body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined"
      rel="stylesheet">
      <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>/httpdocs/images/fav-icon.png">
    <title>Glumos || Get High paying Jobs</title>
        <!-- Select2 CSS --> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

<!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  </head>
  <body>
  <style>
      .btn-view-job{
          color:white;
          border-radius:20px;
          background-color:#020bff;
      }
      .btn-view-job:hover{
        color:#020bff;
          background-color:white; 
          border:2px solid #020bff;
      }
      .text-1{
          color:black;
          font-weight:500;
          font-size:25px;
          line-height:14px;
      }
      .right-icon{
          float: right;
    margin-left: -50%;
          color:white;
          background:gray;
          border-radius:50%;
          padding:5px;
      }
      .modal-open .container-fluid, .modal-open  .container {
    -webkit-filter: blur(5px) grayscale(90%);
}
  </style>

<!-- Modal -->

    <?= $this->include('front/components/navbar');?>
  <?php
  $session=session();
  $usertype=$session->get('userdata')['usertype'];
 
  ?>
  <div class="mt-5 pt-2 dashboard-hero bg-light shadow-lg" style="max-width:900px;margin:auto;border-radius:10px;height:500px">
   

  <div class="bg-light p-2 rounded row d-flex justify-content-between" style="max-width:900px;margin:auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <div class="col-3 row d-flex justify-content-between">
      <div class="col-2">
          <span class="material-icons-outlined">vpn_key</span>
      </div>
      <div class="col-10">
          Passwords
      </div>
      </di>
  </div> 
      <div class="col-auto">
          <span class="material-icons-outlined">chevron_right</span>
      </div>
      
  
 
      
  </div>
  <hr class="my-0" style="max-width:890px;margin:auto">
  <div class="bg-light p-2 rounded row d-flex justify-content-between" style="max-width:900px;margin:auto" data-bs-toggle="modal" data-bs-target="#exampleModal02">
      <div class="col-3 row d-flex justify-content-between">
      <div class="col-2">
          <span class="material-icons-outlined">payments</span>
      </div>
      <div class="col-10">
          Payment Info
      </div>
      </di>
  </div> 
      <div class="col-auto">
          <span class="material-icons-outlined">chevron_right</span>
      </div>
      
  
 
      
  </div>
  <hr class="my-0" style="max-width:890px;margin:auto">
  <div class="bg-light p-2 rounded row d-flex justify-content-between" style="max-width:900px;margin:auto"  data-bs-toggle="modal" data-bs-target="#exampleModal01">
      <div class="col-3 row d-flex justify-content-between">
      <div class="col-2">
          <span class="material-icons-outlined">attach_money</span>
      </div>
      <div class="col-10">
          Currency
      </div>
      </di>
  </div> 
      <div class="col-auto">
          <span class="material-icons-outlined">chevron_right</span>
      </div>
      
  
 
      
  </div>
  <hr class="my-0" style="max-width:890px;margin:auto">
  <div class="bg-light p-2 rounded row d-flex justify-content-between" style="max-width:900px;margin:auto">
      <div class="col-3 row d-flex justify-content-between">
      <div class="col-2">
          <span class="material-icons-outlined">shield</span>
      </div>
      <div class="col-10">
         Verification
      </div>
      </di>
  </div> 
      <div class="col-auto">
          <span class="material-icons-outlined">chevron_right</span>
      </div>
      
  
 
      
  </div>
  <hr class="my-0" style="max-width:890px;margin:auto">
  </div>
  
<!-- Modal1 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Password Reset Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center p-5">
          <div id="response-div" class="text-center">
          <a class="btn btn-primary text-white" id="send-mail">Email Me Reset Password Link</a>    
          </div>
        
      </div>
      
    </div>
  </div>
</div>
     <!---Ends--Modal1-->
<!-- Modal01 -->
<div class="modal fade" id="exampleModal01" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Your Currency</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center p-5">
        
      </div>
      
    </div>
  </div>
</div>
     <!---Ends--Modal1-->
<!-- Modal2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Logo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form method="POST" action="<?php echo base_url('upload-featured-photo/2');?>" enctype="multipart/form-data">
             <div class="form-group"> 
             <div class="text-center">
                 <!--Uploaded Image Display-->
                 <img src="" style="height:70px;width:70px;margin:auto" id="output1"/>
                 <br>
                 
                 <!---->
                
                 
                 <input type="file" name="userfile" id="f_img1" accept="image/*" onchange="loadFile(event)" style="">
                </div>
                <script>
                  var loadFile = function(event) {
                    var output = document.getElementById('output1');
                    output.src = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                      URL.revokeObjectURL(output.src) // free memory
                    }
                  };
                </script>
              
              <div class="text-center">
                  <input type="submit" name="submit-featured" class="btn btn-primary bg-theme text-white" vale="Submit">
              </div>   
             </div> 
          </form>
        ...
      </div>
      
    </div>
  </div>
</div>
     <!---Ends--Modal-->   
     
<!-- Modal3 -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Hr deatils</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form method="POST" action="<?php echo base_url('upload-info/1');?>" >
             <div class="form-group"> 
             <div class="text-center">
                <div class="form-floating">
  <textarea class="form-control" placeholder="Give the info about HR" id="floatingTextarea2" name="text" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Enter Details in 200 words(max)</label>
</div></div>
              
              <div class="text-center">
                  <input type="submit" name="submit-featured" class="btn btn-primary bg-theme text-white" vale="Submit">
              </div>   
             </div> 
          </form>
        ...
      </div>
      
    </div>
  </div>
</div>
     <!---Ends--Modal-->  
     
<!-- Modal4 -->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Overview deatils</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form method="POST" action="<?php echo base_url('upload-info/2');?>" >
             <div class="form-group"> 
             <div class="text-center">
                <div class="form-floating">
  <textarea class="form-control" placeholder="Give the info about Company Mention Location and Capacity" id="floatingTextarea2" name="text" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Enter Details in 200 words(max)</label>
</div></div>
              
              <div class="text-center">
                  <input type="submit" name="submit-featured" class="btn btn-primary bg-theme text-white" vale="Submit">
              </div>   
             </div> 
          </form>
        ...
      </div>
      
    </div>
  </div>
</div>
     <!---Ends--Modal-->   
  <div class="d-md-none">  
    <?= $this->include('front/user/mobile-footer');?></div>
    
<?= $this->include('front/components/lite-footer');?>    
     
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <!---<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAG-s7im1nYLttgSoqnzBhO3rBXtvoQk3o&libraries=places&callback=initMap">-->
</script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
  
   
           $("#send-mail").click(function(){
             $("#send-mail").text("Sending Please Wait");
           
            var emailValue = document.getElementById('username').value;
            
             
             $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('send-reset-link') ?>",
                        data:{
                       'emailed':emailValue,
                          },  
                        success : function(response){
                            var resp=JSON.parse(response);
                            console.log(resp);
                        $("#send-mail").attr("disabled", true);    
                         $("#send-mail").text("Send me reset-password Link"); 
                        $("#response-div").html('<span class="alert alert-warning py-2 px-1">'+resp.message+'</span>');   
                        
                        },
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });
                
         })
   </script>
<script>
 $("#open-hr").addClass("bot-bor");
       $("#HR").hide(); 
       $("#overview").show();
        $("#hr-edit-btn").hide();
          $("#overview-edit-btn").show();
        $("#open-hr").addClass("bot-bor");
    $("#open-hr").on('click',function(){
        $("#open-hr").addClass("bot-bor");
        $("#open-overview").removeClass("bot-bor");
       $("#HR").show(); 
        $("#hr-edit-btn").show();
       $("#overview").hide();
        $("#overview-edit-btn").hide();
    });
    $("#open-overview").on('click',function(){
        $("#open-hr").removeClass("bot-bor");
        $("#open-overview").addClass("bot-bor");
          $("#hr-edit-btn").hide();
            $("#overview-edit-btn").show();
       $("#HR").hide(); 
       $("#overview").show();
    });
</script>
<script>
    $(function(){
    $("menu-toggler").on('click',function(){
    
       $('#show-menu').toggleClass('active'); 
       
    });
    
    
});
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="<?php echo base_url();?>/httpdocs/toaster/dist/jquery.toast.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
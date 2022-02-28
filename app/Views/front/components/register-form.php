
<div class="bg-light" style="margin:auto;margin-top:10px;width:94%;">
<div class="row d-flex justify-content-around">
    <div class="col-md-5 d-none d-md-block">
        <img src="<?php echo base_url();?>/httpdocs/images/jumbo-img2.png" alt="ui-register">
    </div>
    <div class="col-md-7 col-12 px-5 py-2 align-right" style="">
        <h3 class="m-0 text-center ">Join Glumous Community</h3>
        <p class="m-0 text-center" style="font-size:13px">Already have account<a href="<?php echo base_url('/signin');?>">Login ?</a></p>
        <div class="col-10 my-3 m-auto">
        
        <div class="row d-flex justify-content-around py-3">
            <div class="col-md-5 my-1 row d-flex  bg-white p-3 shadow-sm" onclick="check('seeker')" id="seeker"  style="border-radius:10px">
               <div class="form-check col-10">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                  <label class="form-check-label" for="flexRadioDefault2">
                    I am a Job Seeker
                  </label>
                </div> 
                <div class="col-2">
                    <span  class="material-icons-outlined">drive_file_rename_outline</span>
                </div>
              </div>
            
             <div class="col-md-5 my-1 row d-flex  bg-white p-3 shadow-sm" onclick="check('employer')" id="employer" style="border-radius:10px">
               <div class="form-check col-10">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    I am a Employer
                  </label>
                </div> 
                <div class="col-2">
                    <span  class="material-icons-outlined">apartment</span>
                </div>
              </div>
        </div>
        
        <hr>
        <h6 class="text-dark" >
        <?php if(isset($_GET['signup'])==""){ echo "Full Name"; 
            
        }elseif($_GET['signup']=="employer"){ echo "Company Name"; } else{
                  echo "Full Name"; }?></h6>
        <div class="row d-flex">
             <div class="col-md-6">
           <div class="input-group mb-3">
  <span class="material-icons input-group-text" id="basic-addon1">person</span>
  <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" id="full Name">
        </div> 
        </div>
        <div class="col-md-6 ">
            <div class="input-group mb-3">
  <span class="material-icons input-group-text" id="basic-addon1">person</span>
  <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" id="Last  Name">
       </div></div>
        </div>
    
<?php if("a"=="b") {?>

<?php }elseif("a"=="c"){?>

<?php }?>

    </div>
    
    </div>
</div>
</div>

<script>
  function check(i){
      if(i=="seeker"){
     document.getElementById("flexRadioDefault2").checked=true;  
     document.getElementById("employer").style.border="none";
     document.getElementById("name-type").innerHTML="Full name";
      }else if(i=="employer"){
     document.getElementById("last-name").style.display="none";       
     document.getElementById("seeker").style.border="none";          
     document.getElementById("flexRadioDefault1").checked=true; 
     document.getElementById("name-type").innerHTML="Company Name";
      }
    document.getElementById(i).style.border="2px solid blue";
    document.getElementById(i).style.borderRadius="10px";
  }
 
    
</script>
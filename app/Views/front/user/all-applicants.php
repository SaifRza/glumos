<div class="p-3 text-center" style="min-height:100vh">
    
    <?php if($error){?>
    
    <div class="conatiner p-5 bg-white" style="max-width:500px;margin:auto;margin-top:150px">
        <h3 class="text-warning fw-bolder"><?=$error;?></h3>
    </div>
    
    <?php }else{?>
<h3>Applications For <span class="text-success"><?php print_r($job[0]->job_heading);?></span></h3>
 <?php if($applicants){?>
 
    <?php 
    foreach($applicants as $seeker){?>
    <?php //print_r($seeker);?>
    <?php if($seeker->marks_obtained*100>50){?>
<div class="row bg-white px-1 py-3 justify-content-around" style="max-width:700px;margin:auto">
    <?php //print_r($seeker);?>
    <div class="col-2 my-auto">
        <?php if($seeker->profile_img==""){?>
        <img src="https://apexturbine.com/wp-content/uploads/2019/07/default_user_icon16-09-201474352760.png" style="width:100px;height:100px;border-radius:50%" class="py-auto" alt="default-user-logo">
        <?php }else{?>
        <img src="<?php echo base_url();?>/httpdocs/logo-images/<?=$seeker->profile_img;?>" style="width:100px;height:100px;border-radius:50%" class="py-auto" alt="default-user-logo">
        <?php }?>
        
    </div>
    <div class="col-4 my-auto">
        <div class="row d-flex justify-contents-around py-auto">
           
            <div class="col-auto fw-bolder"><?=$seeker->name;?></div>
        </div>
        <div class="row d-flex justify-contents-around py-auto">
           
            <div class="col-auto">
            <a href="https://api.whatsapp.com/send?phone=<?=$seeker->contact_number;?>" target="_blank"><span class="material-icons-outlined">
                whatsapp
                </span></a>
  
            </div>
            <div class="col-auto">
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?=$seeker->email;?>" target="_blank">
             <span class="material-icons-outlined">
                email
                </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-2 my-auto">
        <p class="text-muted fw-bolder"><?=$seeker->marks_obtained*100;?> %</p>
    </div>
    <div class="col-2 my-auto">
        <a class="btn btn-primary" href="<?php echo base_url('/view-profile');?>/<?=md5($seeker->email);?>">Profile</a>
    </div>
</div> 
<hr style="max-width:700px;margin:auto;">



<!-- Modal -->
<div class="modal fade" id="answerModal-<?=$seeker->id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Answer <?=$seeker->id;?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="loadOn-<?=$seeker->id;?>">
           here 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php }?>
<?php }?>   
    <?php }else{?>
    <div class="conatiner p-5 bg-white" style="max-width:500px;margin:auto;margin-top:150px">
        <h3 class="text-warning fw-bolder">No Application made So Far</h3>
    </div>
    <?php }?>
    

<?php }?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function loadAnswerSheet(i,jobid){
        //alert(i);
         $.ajax({  
         method: "POST",
         url: "<?php echo base_url('get-answers')?>",
         data:{'application_id':i,'jobid':jobid}, 
         success : function(response){
         // var resp=JSON.parse(response);
         console.log(response);
         var id="loadOn-"+i;
        document.getElementById(id).innerHTML=response;
                   },
                  error : function(data,textStatus,errorMessage){
                         
                  }
              });
    }
</script>

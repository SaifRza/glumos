<style>
    label:enabled{color: red;}  label:disabled{color:grey;}
    .cursor:hover{
        cursor:pointer;
    }
    .blue-cursor:hover{
        cursor:pointer;
        color:#012bff;
    }
    .pending-pill{
        color:white;
        font-size:10px;
        border-radius:2px;
        width:50px;
        text-align:center;
        background:rgb(255,0,0,0.4);
    }
    .live-pill{
        color:black;
        font-size:10px;
        border-radius:2px;
        width:50px;
        text-align:center;
        background:rgb(0,255,0,0.4);
    }
    .draft-pill{
        color:#fff;
        font-size:10px;
        border-radius:2px;
        width:50px;
        text-align:center;
        background:rgb(0,0,0,0.4);
    }
    
    
</style>
<?php
$file_name=$myData[0]->verification_file;
$verified=$myData[0]->verification;?>
<?php 
if($verified=="0"||$verified=="2"){?>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal123" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verification-documents</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="<?php echo base_url('/company-verification-file');?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="py-3 px-5">
            <h4 class="fw-bold">Company Registration certificate (pdf).</h4>
            <p class="m-1">Previous provide the company registration certificate to verify the company you are presenting.</p>
            
            <p class="text-muted my-3">Only pdf files are allowed</p>
            <span id="label-above">Uploaded File Name</span>
            <label for="input-file" class="mt-3 mb-2 w-100 text-center">
                <div class="m-auto p-2" style="border:3px solid #eee">
                   <span class="material-icons-outlined">cloud_upload</span> 
                   <p class="text-muted m-0">Click here to upload File</p>
                </div>
            </label><br>
            <input name="userfile" type="file" accept="application/pdf" id="input-file"  style="height:2px;"/>
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary mx-3" id="smt-btn">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="p-3 bg-light wid-90" style="margin:auto">
    <div class="row d-flex justify-content-center col-md-11 col-12">
        <div class="col-auto">
           <img src="<?php echo base_url('httpdocs/images/verification_image.png');?>" style="height:220px;" > 
        </div>
        <div class="col-6">
            
            <h5><?=$verified=="0"?'Verify your company to post your first jobs':'Verification is pending at admin';?></h5>
            <p class="m-0"><?=$verified=="0"?'Provide your company verification documents so as to approved by admin':'Once admin will verify you documents you would be able to post jobs then';?> </p>
            <?=$verified=="0"?'<a class="btn btn-primary bg-theme w-25" data-bs-toggle="modal" data-bs-target="#exampleModal123">Submit</a>':'<a class="btn btn-primary bg-theme w-50" href="'.base_url('httpdocs/document-files/')."/".$file_name.'"  target="_blank">View documents</a>'?>
            
        </div>
    </div>
    
</div> 
<?php }?>

<div class="row d-flex justify-content-around" style="width:100%;margin:auto;min-height:100vh;" >
            <div class="col-md-9 col-12 row d-flex justify-content-around py-2" style="background:transparent;">
                <!----My Jobs--->
             <div class="bg-white  my-2 rounded">
                 <div class="row d-flex justify-content-between   align-middle py-2" >
                    <div class="col-6  align-middle">
                    <h3 class="text-1">Posted Jobs</h3>    
                    </div>
                    <div class="col-md-3 col-6">
                        <a class="btn btn-primary bg-theme w-100" href="<?php if($myData[0]->verification=="0"||$verified=="2"){ }else{ echo base_url('post-job'); };?>">Post Job</a>
                    </div>
                </div>
                <div class="py-2 bg-white mt-2" style="height:auto;">
                 <?php //print_r(count($myjobs));
                 if($verified=="0"||$verified=="2"){}else{?>
                  
                <?php
               
                if(count($myjobs)<1){?>
                
                <div class="text-center">
                    <h1 class="mt-5 text-2" style="color:#bebebe">No Jobs Posted Yet</h1>
                </div>
                <?php }else{?>
                <!---Here Will be Job posted---->
                
                <?php foreach($myjobs as $jobs){?>
                <?php $pid=$jobs->find_by;?>
                
                <div class="row d-flex justify-content-around py-2" style="border:2px solid #eee">
                    <div class="col-md-7 col-4 v-mid ">
                       
                        <p class="m-0  mx-3 cursor <?php if($jobs->status=="1"){echo "live-pill";}elseif($jobs->status=="0"){ echo "draft-pill";}elseif($jobs->status=="2"){ echo "pending-pill";};?>"><?php if($jobs->status=="1"){echo "Live";}elseif($jobs->status=="0"){ echo "Draft";}elseif($jobs->status=="2"){ echo "Removed";};?></p>
                        <p class="m-0 mx-3 cursor fw-bolder text-2" style=""><?=$jobs->job_heading==""?'Empty Job title':$jobs->job_heading;?></p>
                        <p class="m-0 mx-3 cursor text-muted text-3" style=""><?=$jobs->requirement_type=="1"?'Freelance':'Fulltime';?></p>
                    </div>
                    <div class="col-md-3 col-4 v-mid my-auto">
                        <a <?php if($subs[$pid]==""){ }else{ ?> href="<?php echo base_url();?>/view-applicants/<?=$pid;?>"   <?php };?>   style="color:black"><p class="m-0 cursor blue-cursor my-auto" style="font-size:14px"><?php if($subs[$pid]==""){ echo 0; }else{ print_r($subs[$pid]);};?> submisions</p></a>
                    </div>
                   
                    
                    
             <div class="col-md-2 col-4 v-mid cursor my-auto dropdown m-1 t-dots" style="">
                      <span class="material-icons-outlined dropbtn" >
                            more_vert
                        </span>
                        <?php if($jobs->status!='2'){?>
                      <div class="dropdown-content" style="width:100px;">
                       <?php if($jobs->status=="0"){?>
                       <a href="<?php echo base_url('continue-job-post');?>/<?=$jobs->find_by;?>" class="dbt">Continue Editing</a>
                       <form method="POST" action="<?php echo base_url('delete-job');?>/<?=$jobs->find_by;?>">
                        <button class="dbt btn btn-white m-0 p-0" type="submit">Delete Job </button>   
                        
                       </form>
                       <?php }elseif($jobs->status=="1"){?>
                       <form method="POST" action="<?php echo base_url('unlive-job');?>/<?=$jobs->find_by;?>">
                        <button class="dbt btn btn-white  m-0 p-0" type="submit">Remove </button>   
                        
                       </form>
                       <form method="POST" action="<?php echo base_url('delete-job');?>/<?=$jobs->find_by;?>">
                        <button class="dbt btn btn-white  m-0 p-0" type="submit">Delete Job </button>   
                        
                       </form>
                       
                        <a class="text-dark" href="<?php echo base_url();?>/jobview/<?=$jobs->find_by;?>"><button class="dbt btn btn-white  m-0 p-0" type="button">
                            View Job</button> </a> 
                       <?php }?>
                      </div>
                      <?php }?>
           </div>
                    
                    
                </div>
                <?php }?>
                 <?php } }?>
                </div>
                
                </div>
                
               
                
            </div>
            <div class="col-md-3 py-2"  >
                
                <div class="bg-white p-2 mt-3 rounded">
                    <h5 class="py-2 mb-0">My Talents 
                    <?=$subscribed!="1"?'<span style="color:blue;font-size:10px;font-weight:900">Join premium</span>':'<span></span>';?></h5>
                    <hr class="m-0">
                        <?php if($talents){ ?>
                        
                        <?php foreach($talents as $tal){
                       
                        ?>
                        <div class="p-1 w-100 mx-auto" style="border:2px solid #eee">
                                <h6 class="text-capitalize d-flex justify-content-between">
                                    <span class="col-auto my-auto">
                                        <img src="<?php echo base_url();?>/httpdocs/logo-images/default_logo.png" style="height:30px;width:30px"  />
                                        </span>
                                    <span class="col-auto  v-mid my-auto"><?=$tal->seeker_name;?></span>
                                    <span class="col-auto v-mid my-auto"><a href="<?php echo base_url('view-profile');?>/<?=$tal->hashmail;?>" target="_blank"><span class="material-icons-outlined text-muted">chevron_right</span></a></span>
                                    </h6>
                            
                            
                        </div>
                        
                        <?php } ?>
                        <?php }else{?>
                        <li class="nav-item">No talents Exists</li>
                        <?php }?>
                        
                       
                
                </div>
                <div class="bg-white p-2 mt-3 rounded">
                    
                    <h5 class="py-2 mb-0">My Tests</h5>
                    <hr class="m-0">
                   
                       <?php 
                        foreach($myTemplates as $template){?>
                        <div class="row d-flex justify-content-between p-1 w-100 mx-auto" style="border:2px solid #eee">
                            <div class="col-auto  v-mid my-auto">
                                <h6 class="text-capitalize"><?= $template->template_name;?></h6>
                            </div>
                            <div class="col-auto v-mid my-auto">
                                <a href="<?php echo base_url('add-template');?>"><span class="material-icons-outlined text-muted">chevron_right</span></a>
                            </div>
                        </div>
                        <?php }?>
                  
                    <div class="w-100 text-center mt-2">
                     <a class="btn btn-primary text-center p-1 m-auto" href="<?php echo base_url('add-template');?>" >Add Test</a>   
                    </div>
                    
                </div>
            </div>
                
            
      </div> 
   <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
    $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
           $("#label-above").html(fileName);
           $("#smt-btn").prop('type','submit');
        });
    });
</script>   
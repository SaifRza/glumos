
<div class="row d-flex justify-content-around" style="width:auto;margin:auto;min-height:80vh">
            <div class="col-md-9 row d-flex justify-content-around p-3" style="background:transparent">
                <!----My Jobs--->
             <div class="bg-white  my-2 rounded">
                 <div class="row d-flex justify-content-between   align-middle p-2" >
                    <div class="col-6  align-middle">
                    <h3>Applied Jobs</h3>    
                    </div>
                    <div class="col-3">
                        <a class="btn btn-primary bg-theme w-100" href="<?php echo base_url('/browse-jobs');?>" >Browse Jobs</a>
                    </div>
                </div>
                <hr class="mt-0" style="color:#eee">
                <div class="py-2 bg-white mt-2" style="height:auto;">
                 <?php //print_r(count($myjobs));
                 if($verified=="0"||$verified=="2"){}else{?>
                  
                <?php
               
                if(count($myapplied)<1){?>
                
               
                <?php }else{?>
                <!---Here Will be Job posted---->
                
                <?php foreach($myapplied as $jobs){?>
             
                
                <div class="row d-flex justify-content-around py-4" style="border:2px solid #eee">
                    <div class="col-7 v-mid ">
                       
                        
                        <p class="m-0 mx-3 cursor fw-bolder" style="font-size:16px"><?=$jobs->job_heading==""?'Empty Job title':$jobs->job_heading;?></p>
                        <p class="m-0 mx-3 cursor text-muted" style="font-size:14px"><?=$jobs->requirement_type=="1"?'Freelance':'Fulltime';?></p>
                    </div>
                    <div class="col-3 v-mid my-auto">
                       
                    </div>
                   
                    
                    
                    <div class="col-2 v-mid cursor my-auto dropdown m-1" style="width:100px;">
                      <span class="material-icons-outlined dropbtn" >
                            more_vert
                        </span>
                        <?php if($jobs->status!='2'){?>
                      <div class="dropdown-content" style="width:100px;">
                      <a class="lis-item nav-link" href="<?php echo base_url('/jobview')."/".$jobs->find_by;?>">View Job Add</a>
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
                
                <div class="bg-white fw-bolder p-2 mt-3 rounded">
                    <h6 class="py-2 mb-0 text-center">  My Profile</h6>
                    <hr class="m-0">
                    <div class="text-center mt-1">
                        <img src="<?php echo base_url();?>/httpdocs/logo-images/default_logo_1.png" style="height:35px;width:35px;border-radius:50%;border:1px solid gray" />
                        <p class="mt-1 fw-bolder">Syed Saif Raza</p>
                    </div>
                   <div class="bg-theme text-white fw-bolder my-3 mx-1 py-3 px-2 rounded-5 text-center" style="border-radius:8px">
                       <h6 class="w-100 d-flex justify-content-between">
                           <span class="">Available tokens</span>
                           <span class="">
                               <span class="badge rounded-pill bg-light text-dark">Free Tier</span>
                           </span>
                       </h6>
                       
                       <h1 class="mt-3 d-flex justify-content-start">
                           <span class="bg-light text-center text-dark fw-bolder px-2" style="height:44px;width:45px;border-radius:50%;font-size:30px">
                               g
                           </span>
                           <span class="my-auto h1 mx-2">
                               50
                           </span>
                       </h1>
                   </div>    
                
                </div>
            </div>
                
            
      </div> 

<?php
//print_r($jobInfo);
?>
<style>
    .img-bg{
        background-image: url("<?php echo base_url('/httpdocs/featured-images/');?>/<?=$company_assets[0]->featured_img;?>");
  background-color: #fff;
  height: 200px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
  margin-left:auto;
  margin-right:auto;
  border-radius:10px 10px 0px 0px;
  border-bottom:1px solid gray;
    }
    .active-tab{
        color:#012bff;
        border-bottom:3px solid #012bff;
        cursor:pointer;
    }
    .inactive-tab{
        color:gray;
        cursor:pointer;
    }
    .active-tab .inactive-tb :hover{
        cursor:pointer;
    }
    .action-icons{
        vertical-align: middle;
        padding:8px;
        border:1px solid #eee;
        border-radius:5px;
    }
    .apply-job-section{
        width:90%;margin:auto;
        margin-top:-30px;
    }
     .fav-col{
        color:rgb(2, 27, 121);
    }
    .bg-grad1{
    background: linear-gradient(to right, rgb(5, 117, 230), rgb(2, 27, 121));
    }
    .bg-grad2{
    background: linear-gradient(to right, rgb(55, 59, 68), rgb(66, 134, 244));
    }
    .shadow-1{
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
     border-radius:10px;  
    }
     .material-icons, .icon-text {
      vertical-align: middle;
    }
    .styled-logo{
        margin-top:-40px;
        margin-left:60px;
        
    }
    .logo-img{
        height:90px;width:90px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        border-radius:6px;
        border:3px solid white;
        border-radius:10px;
        background:white;
    }
</style>
<div class="browse-section">
 <!----   
<div class="search-card bg-white py-auto px-3 d-none d-md-block shadow-lg" style="width:80%;">
<p class="m-0">Try Searching a Job</p>
   <div class="row d-flex justify-content-around py-3">
       <div class="col-5">
    <div class="input-group mb-3">
  <span class="material-icons-outlined input-group-text" id="basic-addon2">search</span>
  <input type="text" class="form-control" placeholder="Type Keywords or a skill" aria-label="Search your Skill" aria-describedby="basic-addon2">
    </div>
    
    
       </div>
       <div class="col-2">
           <div class="input-group mb-3">
  <span class="material-icons-outlined input-group-text" id="basic-addon3">room</span>
  <input type="text" class="form-control" placeholder="Select Location" aria-label="Search your Skill" aria-describedby="basic-addon3">
    </div>
       </div>
       <div class="col-2">
        <p  class="btn btn-success w-100">Searh Now</p>
       </div>
       <div class="col-2">
        <p  class="btn btn-primary w-100">Create Job Alert</p>
       </div>
   </div> 
</div>  -->


<div class="row  d-flex justify-content-around" >
   
    
   
    
 <div class="col-md-8 m-auto" style="height:auto">
     <?php //print_r($data);?>
  
    
  
  <div class="bg-white  mb-3 pb-3" style="margin:auto;border-radius:10px;min-height:100vh;height:auto">
      <div class="col-12 img-bg" style="padding-top:200px;">
       <div class="styled-logo">
           <img src="<?php echo base_url('/httpdocs/logo-images/');?>/<?=$company_assets[0]->logo_img;?>" class="logo-img">
       </div> 
       <?php 
       $session=session();
       $usertype=$session->get('userdata')['usertype'];?>
       <div class="row d-flex justify-content-between mt-5" style="width:95%;margin:auto">
           <div class="col-auto">
               <h3 class="text-dark fw-bolder"><?= $jobInfo->job_heading;?></h3>
           </div>
           <div class="col-3 d-flex justify-content-end">
             <?php if($usertype=="employer"){?>
           
           <?php }else{?>
           <a class="btn btn-primary text-white bg-theme" data-bs-toggle="modal" data-bs-target="#cofirmationModal">Apply Now</a> 
           <?php }?>
            
               </div>
       </div>
       
       <div class="row d-flex justify-content-between mt-1" style="width:95%;margin:auto">
           <div class="col-auto fw-bolder">
               <p class=""><span class="text-muted">Location</span> <span class="text-dark  fw-bolder"><?=$company_assets[0]->location_name;?></span></p>
           </div>
           <div class="col-auto d-flex justify-content-end">
               <?php
               
               ?>
               <p class="text-dark fw-bolder"><span class="text-muted">Posted 1 day ago</span></span></p>
           </div>
       </div>
      <input type="hidden" id="post_url" value="<?php echo base_url('/my-job-status');?>"/>
      <input type="hidden" id="test_link" value="<?php echo base_url('apply-for-job');?>/<?=$jobInfo->find_by;?>"/>

      <input type="hidden" id="next_url" value="<?php echo base_url('apply-for-job');?>/<?=$jobInfo->find_by;?>"/>
      
       <div class="row d-flex justify-content-around mt-3" style="width:95%;margin:auto;border:1px solid #dedede;border-radius:7px">
          <div class="col-3 p-3 py-3" style="">
              <p class="m-0 text-muted">Job Type</p>
              <p class="m-0 my-2 text-dark fw-bolder">
                  <?php if($jobInfo->experience_type=="1"){ echo "Freelance";}else{ echo "Fulltime"; };?>
              </p>
          </div>
          
          <div class="col-3 p-3 py-3" style="">
              <p class="m-0 text-muted">Experience</p>
              <p class="m-0 my-2 text-dark fw-bolder">
               <?php if($jobInfo->requirement_type=="1"){ echo "Expert";}elseif($jobInfo->experience_type=='2'){ echo "Intermediate"; }else{ echo "Beginner";  };?>   
              </p>
          </div>
           <?php 
           if($jobInfo->complete_rate==""){
          $rate=0;
      }else{
          if($jobInfo->wage_type=="1"){
              $rate="/hour";
          }elseif($jobInfo->wage_type=="2"){
              $rate="/day";
          }elseif($jobInfo->wage_type=="3"){
              $rate="/week";
          }elseif($jobInfo->wage_type=="4"){
              $rate="/month";
          }
      }
           ?>
          <div class="col-3 p-3 py-3" style="">
              <p class="m-0 text-muted">Offer Salary</p>
              <p class="m-0 my-2 text-dark fw-bolder">$ <?=$jobInfo->complete_rate<1?$jobInfo->hourly_rate.$rate:$jobInfo->complete_rate  ;?></p>
          </div>
        
        
       </div>
      
       

 </div> 
 <div class="col-12 bg-white" style="height:auto;margin-top:350px;">
    <div class="row d-flex justify-content-start fw-bolder mt-5 mx-3">
           <div class="col-auto " >
               <p class="h5 active-tab fw-bolder" onclick="show(1)" id="on1">Job description</p>
           </div>
            <div class="col-2 ">
               <p class="h5 inactive-tab fw-bolder"  onclick="show(2)" id="on2">Skills</p>
           </div>
            <div class="col-2 ">
               <p class="h5 inactive-tab fw-bolder " onclick="show(3)" id="on3">Overview</p>
           </div>
       </div>
     
       <div class="py-3 px-2 w-auto mx-1" id="1" >
           <p class="w-100"><?=$jobInfo->job_description;?></p>
       </div>
       <div class="py-3 px-3  mx-1" id="2">
           <p><?php $tags=$jobInfo->skill_tags;
        $array=explode("+",$tags);
        foreach($array as $arr){
            $list.='<span class="badge rounded-pill text-dark mx-1 text-capitalize" style="background:#dedede;font-size:15px;">'.$arr.'</span>';
        }
        echo $list;
  
       ?></p>
       </div>
       <div class="py-3 px-3  mx-1" id="3">
           <p><?=$company_assets[0]->overview_info;?></p>
       </div>
     
      </div> 
 </div>

</div>


</div>


<!-- Modal -->
<div class="modal fade" id="cofirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apply Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="my-3">
              <p class="m-0 fw-bolder">Please note the Following things :</p>
              
               <p class="m-0">This Application will add 4-Glus.</p > 
               <p class="m-0">You must have to attempt a number of question related with the Job title scope.</p >
               <p class="m-0">By clicking apply you agree to apply for the job.</p >
              </ul>
          </div>
          
          <div class="row d-flex justify-content-around">
        <a class="col-auto btn btn-primary fav-bg" type="button" class="btn btn-secondary" data-bs-dismiss="modal"  >Cancel</a>  
        <a class="col-auto btn btn-primary fav-bg"  onclick="applyMe('<?=$jobInfo->find_by;?>')">Apply</a>
          </div>
        
      </div>
   
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
show(1);
        function show(i){
            var toshow=i;
            var onshow="on"+i;
            if(i=="1"){
                var tohide1=2;var tohide2=3;
                var toh1="on3";var toh2="on2";
            }else if(i=="2"){
                var tohide1=1;var tohide2=3;
                var toh1="on1";var toh2="on3";
            }else if(i=="3"){
                var tohide1=1;var tohide2=2;
                var toh1="on1";var toh2="on2";
            }
          
            
            document.getElementById(toshow).style.display="block";
            document.getElementById(onshow).style.color="#012bff";
            document.getElementById(onshow).style.borderBottom="2px solid #012bff";
            
            document.getElementById(tohide1).style.display="none";
            document.getElementById(toh1).style.color="gray";
            document.getElementById(toh1).style.borderBottom="none";
            document.getElementById(tohide2).style.display="none";
            document.getElementById(toh2).style.color="gray";
            document.getElementById(toh2).style.borderBottom="none";
            
        }
   
   
    function applyMe(id){
       
    var test_url=document.getElementById('test_link').value;    
    var post_url=document.getElementById('post_url').value;
    //find if I ve already applied for this Job;
     $.ajax({  
        method: "POST",
        url: post_url,
        data:{job_id:id,required:4}, 
        success : function(response){
         var resp=JSON.parse(response);
                         
          if(resp.response==true){
              window.location.href=test_url;
          }else{
          alert("Already Applied for this Job !");
         }},
                        error : function(data,textStatus,errorMessage){
                         
                        }
                    });
    }
</script>
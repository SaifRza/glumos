<style>
.preview-inputs{
    border:1px solid #dedede;
    outline:none;
}
.preview-inputs:hover{
    border:1px solid gray;
    outline:none;
}
.title{
    color:#787878;
    font-weight:500;
    font-size:20px;
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


<div class="row  d-flex justify-content-around surfing-area" >
   
  <div clas="col-md-9 m-auto p-5 bg-white text-center shadow-lg" id="success-div" style="margin-top:200px;background:white;width:500px;margin:auto;padding:100px;border-radius:20px;">
      <h1 class="text-center">Successfully Posted</h1>
      <h1 class="text-center mt-3"><span class="material-icons-outlined" style="background:#012bff;color:white;border-radius:50%;font-size:60px">check</span></h1>
  </div>  
   
    
 <div class="col-md-9 m-auto" id="main-div">
   
  
    
 
  <div class="bg-white shadow-sm mb-3 p-3" style="margin:auto;border-radius:10px;height:auto">
      
    <form method="POST" id="publishForm">   
  <div class="row justify-content-between">
      <div class="col-8 my-auto">
          <h6 class="fw-bolder" style="font-size:20px">Review your Job before publishing it</h6>
      </div>
      <div class="col-2 my-auto btn btn-secondary mb-2">
          <a class="text-white " style=''  href="<?php echo base_url('/dashboard');?>"  >Save draft</a>
      </div>
      <div class="col-2 my-auto">
          <a class="btn btn-primary text-white mb-2" style='background:#012bff'  onclick="publishNow()"  id="publish-btn">Publish Now</a>
      </div>
  </div>
  <hr class="m-0">
  <div class="mt-5"></div>

  <div class="py-2 px-3">
  <p class="title m-0" style="font-size:20px">Title</p>
  <input type="text" name="title" class="preview-inputs" value="<?= $jobInfo[0]->job_heading;?>" style="height:40px;width:350px;font-size:13px;padding:9px" required />
  </div>
  <div class="py-2 px-3">
  <p class="title mt-3" style="font-size:20px">Job description</p>
  <p class="text-muted" style="font-size:12px">Give a brief description of the job that you’re posting, this will help jobseekers know exactly what you’re expecting to deliver from them.</p>
 <textarea  id="w3review" >
 </textarea>
  </div>
 <hr> 
   <div class="fw-bolder py-2 px-3">
       <h6 class="title">Type</h6>
        <div class="input-group w-25">
            <input type="hidden" name="w3review" id="wVal" class=""/>
         <select class="form-select form-select-md material-input mb-3" aria-label=".form-select-lg example" style="font-size:15px;" name="req_type">
          <option <?php if($jobInfo[0]->requirement_type=="1"){?> selected <?php }?> value="1">Freelance</option>
          <option <?php if($jobInfo[0]->requirement_type=="2"){?> selected <?php }?> value="2">Fulltime</option>
        </select>
         
         </div>  
   </div>
   
    <div class="fw-bolder py-2 px-3">
       <h6 class="title">Experience</h6>
        <div class="input-group w-25">
         <select class="form-select form-select-md material-input mb-3" aria-label=".form-select-lg example" style="font-size:15px;" name="exp_type">
          <option <?php if($jobInfo[0]->experience_type=="1"){?> selected <?php }?> value="1">Expert</option>
          <option <?php if($jobInfo[0]->experience_type=="2"){?> selected <?php }?> value="2">Intermediate</option>
           <option <?php if($jobInfo[0]->experience_type=="3"){?> selected <?php }?> value="3">Beginner</option>
        </select>
         
         </div>  
   </div>
 
 
 <div class="fw-bolder py-2 px-3">
       <h6 class="title">Skills</h6>
  <p><?php $tags=$jobInfo[0]->skill_tags;
        $array=explode("+",$tags);
        foreach($array as $arr){
            $list.='<span class="badge rounded-pill text-dark mx-1 text-capitalize" style="background:#dedede;font-size:15px;">'.$arr.'</span>';
        }
        echo $list;
  
       ?></p>
   </div>
 
 
  
    <?php
  
      if($jobInfo[0]->complete_rate==""){
          $rate=0;
      }else{
          if($jobInfo[0]->wage_type=="1"){
              $rate="/hour";
          }elseif($jobInfo[0]->wage_type=="2"){
              $rate="/day";
          }elseif($jobInfo[0]->wage_type=="3"){
              $rate="/week";
          }
          elseif($jobInfo[0]->wage_type=="4"){
              $rate="/month";
          }
      }
 
  ?>
 
 <!---
    <div class="fw-bolder py-2 px-3">
       <h6 class="fw-bolder">Budget</h6>
        <div class="input-group w-25">
        <h6 class='fw-bolder'>$ <?=$jobInfo[0]->complete_rate<1?$jobInfo[0]->hourly_rate.$rate:$jobInfo[0]->complete_rate  ;?></h6>
         
         </div>  
   </div> --->
   
   
    
    <div class="fw-bolder py-2 px-3">
       <h6 class="title">Budget rate ($)</h6>
       <div class="row d-flex justify-content-start">
        <div class="col-auto input-group w-25">
        <input type="number" class="material-input mb-3" placeholder="Rate Amount" name="rate_amu" value="<?=$jobInfo[0]->hourly_rate;?>"> 
         
         </div>  
         <div class="col-auto input-group w-auto">
         <select class="form-select form-select-md material-input mb-3" aria-label=".form-select-lg example" style="font-size:15px;" name="w_type">
          <option <?php if($jobInfo[0]->wage_type=="1"){?> selected <?php }?> value="0">/hour</option>
          <option <?php if($jobInfo[0]->wage_type=="2"){?> selected <?php }?> value="1">/day</option>
           <option <?php if($jobInfo[0]->wage_type=="3"){?> selected <?php }?> value="2">/week</option>
           <option <?php if($jobInfo[0]->wage_type=="3"){?> selected <?php }?> value="3">/month</option>
        </select>
         
         </div>
         
         </div>
   </div>
    
   
<hr>

</form>

  <h5 class="fw-bolder">Screening Questions</h6>
  <?php
  foreach($myTemplates as $data){
            if($data->skill_type=="1"){
                $hard.='<div class="p-2 mt-2 bg-light">
                <h6  class="text-capitalize fw-bolder">Q.   '.$data->question_text.'</h6>
                <div class="p-3 mx-5">
                <p style="font-size:13px;">A)'.$data->option_a.'</p>
                <p style="font-size:13px;">B)'.$data->option_b.'</p>
                <p style="font-size:13px;">C)'.$data->option_c.'</p>
                <p style="font-size:13px;">D)'.$data->option_d.'</p>
                <p style="font-size:13px;">Correct : '.$data->correct.'</p>
                </div>
                  </div>';
            }else{
                $soft.='<div class="p-2 mt-2 bg-light">
                <h6 class="text-capitalize fw-bolder">Q. '.$data->question_text.'</h6>
                <div class="p-3 mx-5">
                <p style="font-size:13px;">A)'.$data->option_a.'</p>
                <p style="font-size:13px;">B)'.$data->option_b.'</p>
                <p style="font-size:13px;">C)'.$data->option_c.'</p>
                <p style="font-size:13px;">D)'.$data->option_d.'</p>
                <p>Correct : '.$data->correct.'</p>
                </div>
                  </div>';
            }
           
        }?>
        <?php if($soft){?>
         <h5>SoftSkill questions</h5>
         <?= $soft;?>
        <?php }else{?>
        <p class="text-muted my-2">No Softskill questions Selected</p>
        <?php }?>
       
       
        <?php if($hard){?>
         <h5>HardSkill questions</h5>
         <?= $hard;?>
        <?php }else{?>
        <p class="text-muted my-2">No Hardskill questions Selected</p>
        <?php }?>
  <?php //print_r($jobInfo);?>

 </div> 
   </form>
</div>
  </div>

</div>
<script>
 //document.getElementById('publish-btn').onclick='';
// document.getElementById('publish-btn').style.opacity="0.5";
document.querySelector('textarea') // find a DOM element (by tag name at this case)
  .addEventListener('keydown', // bind an event listener for "keydown" event
    e => { // declare a callback function when that event happens
      
      if(e.target.value.length<200){
       document.getElementById('counter').innerHTML='<span class="text-danger">Minimum 200 Length</span>';
       document.getElementById('publish-btn').onclick='publishNow()';
       document.getElementById('publish-btn').style.opacity="0.5";
      }else{
        document.getElementById('counter').innerHTML='<span class="text-muted">Maximum 4000 Length</span>';
       document.getElementById('publish-btn').setAttribute( "onClick", "publishNow()" );
       document.getElementById('publish-btn').style.opacity="1";   
      }
    })
 

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
var textval=$(".ck").text();
//alert(textval);
 $("#main-div").show();
  $("#success-div").hide();
    function publishNow(){
        
        var w3=$(".ck-content").html();
        document.getElementById('wVal').value=w3;
        if(w3==''){
            alert("Please Enter the job description field.");
            document.getElementById('w3review').style.border="1px solid red";
        }
        else{
        var formData=$("#publishForm").serialize();
        var queryString=$("#publishForm").serialize();
       
       if(queryString.indexOf('?') > -1){
                        queryString = queryString.split('?')[1];
                    }
                    var pairs = queryString.split('&');
                    var result = {};
                    pairs.forEach(function(pair) {
                        pair = pair.split('=');
                        result[pair[0]] = decodeURIComponent(pair[1] || '');
                    });
                    
         $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('updateJob') ?>",
                        data:result,  
                        success : function(response){
                        var resp=JSON.parse(response);
                        console.log(resp)
                        
                           if(resp.response==true){
                              $("#main-div").hide();
                               $("#success-div").show();
                                setTimeout(function() {
                    window.location.href="<?php echo base_url('/dashboard');?>";
                    }, 3000);
                              
                           } 
                        }
                        ,
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });                
       } 
       
    }
    function pubForm(i){
       var purl=parseInt(i)+1;
       var queryString=$("#form-"+i).serialize();
       if(i=="1"||i=="2"||i=="3"){
       if(queryString.indexOf('?') > -1){
                        queryString = queryString.split('?')[1];
                    }
                    var pairs = queryString.split('&');
                    var result = {};
                    pairs.forEach(function(pair) {
                        pair = pair.split('=');
                        result[pair[0]] = decodeURIComponent(pair[1] || '');
                    });
                    
                    var stringify=JSON.stringify(result);
       var passurl="<?php echo base_url('/post-job');?>?tabval="+purl;
       var stringed= JSON.stringify(result);
     // alert(stringed);
       }else if(i=="4"){
           var passurl="<?php echo base_url('/post-job');?>?tabval="+purl;
           var tagged=$("#tags").val();
           var result={'skills':tagged };
           //alert(result);
       }else{
           var temp=$("#tempo").val();
           var result={'template_id':temp}
       }
         $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('updateJob') ?>",
                        data:result,  
                        success : function(response){
                        var resp=JSON.parse(response);
                        //console.log(resp)
                        if(i!=5){
                           if(resp.response==true){
                              window.location.href=passurl;
                           }
                        }
                        else{
                           if(resp.response==true){
                               window.location.href="<?php echo base_url('/Dashboard/previewJobs/');?>/<?= $find_by ;?>";
                           } 
                        }
                        },
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });
       
   }      
</script>
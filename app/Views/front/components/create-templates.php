<div class="" id="login-form">
    <?php 
    $temp=count($myTemplates);
    //print_r($myTemplates);?>
<div class="mt-5 col-6 bg-white" style="margin:auto;">  
<div class="row d-flex justify-content-between p-3">
    <?=$subscribed!="1"?'<span style="color:blue;font-size:13px;font-weight:900">You can add only 3 question per test in freemium . Join Premium now</span>':'<span></span>';?>
    <div class="col-auto">
        <h3 class="text-dark">All Templates (<?= $temp;?>)</h3>
    </div>
    <div class="col-auto">
        <a class="btn btn-info bg-grad1 text-white"  id="addnew">Add New</a>
    <!---- <a class="btn btn-info bg-grad1 text-white"  data-bs-toggle="modal" data-bs-target="#exampleModal1">Add New</a>-->
    </div>
</div>
<div id="template-form">
    <form method="POST" id="templateForm">
    <div class="row d-flex justify-content-around p-3">
       <div class="col-8">
           <input type="text" style="height:40px;font-size:16px" class="w-100 material-input" placeholder="Enter Template Name" name="template_name" id="template_name">
       </div>
       <div class="col-2">
           <button type="button" onclick="add()" class="btn btn-primary w-100">Add</button>
       </div>
       <div class="col-2">
           <button type="button" id="closeForm" class="btn btn-secondary w-100">Close</button>
       </div>
    </div>
    </form>
</div>

<ol class="list-group list-group-numbered">
    <?php if($temp<1){?>
    <h3 class="text-center text-muted mt-3">No Templates Available</h3>
    
    <?php }else{?>
    <?php 
    foreach($myTemplates as $template){?>
    <?php //print_r($template);?>
     <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold text-uppercase "  style="font-size:14px;"><?= $template->template_name;?><span style="font-size:12px;">(<?=$template->total_counts;?> questions )</span></div>
      <span class="text-muted" style="font-size:12px;"><?= $template->created_at;?></span>
    </div>
    <button data-bs-toggle="modal" data-bs-target="#viewModal-<?= $template->template_id;?>"  class="btn btn-primary py-1 px-2 my-auto mx-2" style="font-size:12px"><span class="" onclick="getQuestions(<?= $template->template_id ?>)" >View</span></button>
    <button data-bs-toggle="modal"  <?php if($subscribed=="0"){ if($template->total_counts<3){?> data-bs-target="#exampleModal-<?= $template->template_id;?>"   <?php } else{?>  data-bs-target="#pricingModal"   <?php } }else{?> data-bs-target="#exampleModal-<?= $template->template_id;?>"  <?php }?> class="btn btn-primary py-1 px-2 my-auto" style="font-size:12px">+Questions</button>
  </li>
  <div class="modal fade" id="exampleModal-<?= $template->template_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
     <form method="POST" action="<?php echo base_url('add-question') ?>" enctype="multipart/form-data" id="form-<?=$template->template_id;?>">
  <div class="modal-dialog  modal-lg"  >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
       <div class="row d-flex">
           <div class="col-auto">
               <h6><?= $template->template_name;?></h6>
                <select name="type_of" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="border:none;outline:none">
          <option selected value="1">Hardskill</option>
          <option value="2">Softskill</option>
        </select>
           </div>
       </div>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <div class="modal-body">
        <div class="row d-flex jsutify-conntent-around m-auto">
            <div class="col-1">
                <h3>Q.</h3>
            </div>
            <div class="col-10">
             <input type="text" placeholder="Enter your Question here" name="question" class="material-input w-100">
             <input type="hidden"  name="parent_id" value="<?= $template->template_id;?>">
            </div>
            <div class="col-1">
                <label for="uploader">
                <span class="material-icons-outlined upload-btn" >image</span></label>
            </div>
            <input type="file" style="height:1px;width:1px;" id="uploader" accept="image/*" name='userfile' onchange="loadFile(event)">
<script>

  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }

    
  };
 
</script>
        </div>
        
        
        <div class="row d-flex justify-content-around  m-auto">
        <div class="col-3 mt-3">
            <?php for($i=1;$i<5;$i++){?>
            <div class="form-check mt-2 w-75 m-auto">
              <input class="form-check-input" type="radio" name="radioBox" id="radioBox-<?=$i;?>" value="<?= $i;?>">
              <label class="form-check-label" for="radioBox-<?=$i;?>">
                <input type="text" name="option-<?=$i;?>" placeholder="Option <?= $i;?>" class="material-input">
              </label>
            </div>
            <?php } ?>
        </div>
        
         <div class="col-6 mt-3 text-center" id="show-question">
            <img src="https://glumos.webleader.in/httpdocs/images/glumos.png" class="img-fluid shadow-sm" id="output" style="height:200px;width:auto;border:1px solid gray;">
           
        </div>
        </div>
        
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  onclick="resetForm('<?= $template->template_id;?>')">Reset</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div></form>
</div>

<!--Viewing Modal--->
 <div class="modal fade" id="viewModal-<?= $template->template_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
     <form method="POST" id="questionform">
  <div class="modal-dialog  modal-xl"  >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
       <div class="row d-flex">
           <div class="col-auto">
               <h6><?= $template->template_name;?></h6>
           </div>
       </div>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <div class="modal-body">
        <div class="row d-flex justify-content-around">
           <div class="col-6">
               <h5 class="text-muted text-center">Hardskills</h5>
               <div class="" id="hard-questions-<?= $template->template_id;?>"  style="max-height:500px;overflow-y:scroll;">
                   
               </div>
           </div> 
            <div class="col-6">
               <h5 class="text-muted text-center">Softskills</h5>
               <div class="" id="soft-questions-<?= $template->template_id;?>" style="max-height:500px;overflow-y:scroll;">
                   
               </div>
           </div>
        </div>
      </div>
      
      
    </div>
  </div></form>
</div>
<!--Viewing Ends  Modall--->
    <?php }?>
    <?php }?>
 
  
  
</ol>


</div> 
<!---Add question Modal--->


<!-- Modal -->

<!--End of Modal-->
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
$(document).ready(function(){
    $("#template-form").hide();
  $("#addnew").click(function(){
    $("#template-form").fadeIn("slow");
  });
  $("#closeForm").click(function(){
    $("#template-form").fadeOut("slow");
  });
});
</script>
   <script>
   function getQuestions(i){
   
       $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('PostJob/getQuestions') ?>",
                        data:{'parent_id':i},  
                        success : function(response){
                        var resp= JSON.parse(response);
                        document.getElementById('hard-questions-'+i).innerHTML=resp.hard;
                        document.getElementById('soft-questions-'+i).innerHTML=resp.soft;
                        
                        /* if(resp.response==true){
                                    $.toast({
                            heading: 'Done ',
                            text: resp.message,
                            icon: 'success',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600',  // To change the background
                            position:'top-right'
                        });
                           window.location.href="";
                           }else{
                                $.toast({
                            heading: 'Failed',
                            text: resp.message,
                            icon: 'error',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600',  // To change the background
                            position:'top-right'
                        });
                           } */
                        },
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });
   }
   function resetForm(i){
       var name="form-"+i;
    document.getElementById(name).reset();
    document.getElementById("output").src="";
   }
   function saveForm(i){
       var id='#questionForm'+i;
     var queryString=$("#questionform-"+i).serialize();
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
                        url: "<?php echo base_url('add-question') ?>",
                        data:result,  
                        success : function(response){
                        var resp= JSON.parse(response);
                        if(resp.response==true){
                                    $.toast({
                            heading: 'Done ',
                            text: resp.message,
                            icon: 'success',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600',  // To change the background
                            position:'top-right'
                        });
                           window.location.href="";
                           }else{
                                $.toast({
                            heading: 'Failed',
                            text: resp.message,
                            icon: 'error',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600',  // To change the background
                            position:'top-right'
                        });
                           } 
                        },
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });
   }
   
    function add(){
    var qing=$("#templateForm").serialize();
       if(qing.indexOf('?') > -1){
                        qing = qing.split('?')[1];
                    }
                    var pairs = qing.split('&');
                    var results = {};
                    pairs.forEach(function(pair) {
                        pair = pair.split('=');
                        results[pair[0]] = decodeURIComponent(pair[1] || '');
                    });
                   
         $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('add-template') ?>",
                        data:results,  
                        success : function(response){
                        var resp= JSON.parse(response);
                         if(resp.response==true){
                                    $.toast({
                            heading: 'Done ',
                            text: resp.message,
                            icon: 'success',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600',  // To change the background
                            position:'top-right'
                        });
                           window.location.href="";
                           }else{
                                $.toast({
                            heading: 'Failed',
                            text: resp.message,
                            icon: 'error',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600',  // To change the background
                            position:'top-right'
                        });
                           }
                        },
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });
   }
   
   
        
   </script>
   <script>
       
   </script> 
<script>
function toggleVisiblity(){
    document.getElementById('login-btn').onClick="login()";
    var getVisiblity=document.getElementById('basic-addon21').textContent;
    
    if(getVisiblity=="visibility_off"){
      document.getElementById('basic-addon21').innerHTML="visibility"; 
      document.getElementById("password").type="text";
    }else if(getVisiblity=="visibility"){
      document.getElementById('basic-addon21').innerHTML="visibility_off";  
      document.getElementById("password").type="password";
    }
}
  function check(i){
      
      var linkFor="<?php echo base_url('');?>/"+i;
     
   window.location.href=linkFor;
     
   
  }
function loginHandle(){
    
    var employerChecked=document.getElementById('employerRadio').checked;
    var seekerChecked=document.getElementById('seekerRadio').checked;
    var passwordBox = document.getElementById('password');
    var emailBox = document.getElementById('username');
    var passwordValue = document.getElementById('password').value;
    var emailValue = document.getElementById('username').value;
     var allError = function() { passwordBox.classList.add('error');
    emailBox.classList.add('error'); };
    var passwordError = function() { passwordBox.classList.add('error');
    };
    var emailError = function() { emailBox.classList.add('error'); };
    
    if(passwordValue=="" && emailValue==""){
    allError();   
    }else if(passwordValue=="" || emailValue==""){
        if(passwordValue==""){
            passwordError();
        }else if(emailValue==""){
            emailError();
        }
    }else{
        if(employerChecked==true){
        //for employer
        if(passwordValue=="glumos@2021" && emailValue=="employer@glumos.com"){
       
         $.toast({
    heading: 'Login Successfull',
    text: 'Redirecting to Dashboard....',
    icon: 'success',
    loader: true,        // Change it to false to disable loader
    loaderBg: '#9EC600',  // To change the background
    position:'top-right'
});
    document.getElementById("login-btn").innerHTML="Logging Please Wait....";
    document.getElementById("login-btn").disabled="true";
    setTimeout(function(){
     window.location.href="<?php echo base_url('Dashboard/userAuth');?>";   
    },1000);  
            
        }else{
                 $.toast({
    heading: 'Incorrect',
    text: 'Login provoked entered wrong details',
    icon: 'error',
    loader: true,        // Change it to false to disable loader
    loaderBg: '#9EC600',  // To change the background
    position:'top-right'
});    
        }
        //for employer   
        }else if(employerChecked==false){
        //for freelancer
        if(passwordValue=="glumos@2021" && emailValue=="user@glumos.com"){
       
         $.toast({
    heading: 'Login Successfull',
    text: 'Redirecting to Dashboard....',
    icon: 'success',
    loader: true,        // Change it to false to disable loader
    loaderBg: '#9EC600',  // To change the background
    position:'top-right'
});
    document.getElementById("login-btn").innerHTML="Logging Please Wait....";
    document.getElementById("login-btn").disabled="true";
    setTimeout(function(){
     window.location.href="<?php echo base_url('Dashboard/userAuth');?>";   
    },1000);  
            
        }else{
                 $.toast({
    heading: 'Incorrect',
    text: 'Login provoked entered wrong details',
    icon: 'error',
    loader: true,        // Change it to false to disable loader
    loaderBg: '#9EC600',  // To change the background
    position:'top-right'
});    
        }
        //for freelancer
        }
    }
    
   /* $.toast({
    heading: 'Login Successfull',
    text: 'Redirecting to Dashboard....',
    icon: 'success',
    loader: true,        // Change it to false to disable loader
    loaderBg: '#9EC600',  // To change the background
    position:'top-right'
});
    document.getElementById("login-btn").innerHTML="Logging Please Wait....";
    document.getElementById("login-btn").disabled="true";
    setTimeout(function(){
     window.location.href="<?php echo base_url('Dashboard/userAuth');?>";   
    },1000);*/
 
} 



    
</script>
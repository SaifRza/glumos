<?php if($message){?>
<!-- Button trigger modal -->

<div class="bg-white text-center p-5 w-50 m-auto shadow-lg">
    <h4><?=$message;?></h4>
    <span class="text-success h1">
        
    </span>
    
</div>

<?php }else{?>

<?php //print_r($myTemplates);?>
<div class="" id="login-form">
    <?php 
    $temp=count($myTemplates);
    //print_r($myTemplates);?>
    
<?php if($application_info[0]->status>0){?>
  <div clas="col-md-9 mx-auto p-5 bg-white text-center shadow-lg" id="success-div" style="margin-top:200px;background:white;width:500px;margin:auto;padding:100px;border-radius:20px;">
      <h1 class="text-center">Successfully Submitted</h1>
      <p class="text-muted">You will be contacted once if you will pass the test.</p>
      <h1 class="text-center mt-3"><span class="material-icons-outlined" style="background:#012bff;color:white;border-radius:50%;font-size:60px">check</span></h1>
      <div class="text-center">
      <a class="btn btn-secondary mt-5 w-75 m-auto mt-5" href="<?php echo base_url('/dashboard');?>">Go to Dashboard</a></div>
  </div>  

<?php }else{?>
<div class="mt-5 col-6 bg-white" style="margin:auto;">  
<div class="row d-flex justify-content-between p-3">
    <div class="col-auto">
        <h3 class="text-dark">Total Questions (<?= $temp;?>)</h3>
    </div>
    <div class="col-auto">
        <a  class="btn btn-primary text-white"  data-bs-toggle="modal" data-bs-target="#viewModal-<?= $template_id;?>" onclick="getQuestions(<?= $template_id?>)">Start Test</a>
    <!---- <a class="btn btn-info bg-grad1 text-white"  data-bs-toggle="modal" data-bs-target="#exampleModal1">Add New</a>-->
    </div>
</div>




<ol class="list-group list-group-numbered">
    <?php if($temp<1){?>
    <h3 class="text-center text-muted mt-3">No Templates Available</h3>
    
    <?php }else{?>
    <?php 
    foreach($myTemplates as $template){?>
     <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold"><?= $template->question_text;?></div>
    </div>
    
    
    
  </li>



    <?php }?>
    <?php }?>
 
  
  
</ol>


</div> 
<!--Viewing Modal--->
 <div class="modal fade" id="viewModal-<?= $template_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
     <form method="POST" id="questionform" action="<?php echo base_url('/submit-user-test');?>">
         <input type="hidden" name="template_id" value="<?=$template_id;?>"/>
         <input type="hidden" name="ref_id" value="<?=$application_info[0]->id;?>"/>
         <input type="hidden" name="post_id" value="<?=$application_info[0]->post_id;?>"/>
  <div class="modal-dialog  modal-xl"  >
    <div class="modal-content" style="background-color:#eee">
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

           <div class="col-md-6">
               <h5 class="text-muted text-center">Hardskills</h5>
               <div class="" id="hard-questions"  style="max-height:500px;overflow-y:scroll;">
                   
               </div>
           </div> 
            <div class="col-md-6">
               <h5 class="text-muted text-center">Softskills</h5>
               <div class="" id="soft-questions" style="max-height:500px;overflow-y:scroll;">
                   
               </div>
           </div>
           <div class="text-center mt-3">
               <div class="form-check row d-flex justify-content-center">
  <div class="col-auto"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked90"></div>
 <div class="col-auto"> <label class="form-check-label" for="flexCheckChecked">
    I hereby agree the rules and regulation
  </label></div>
  <div class="text-center mt-2">
      <button type="submit" id="test-submit" class="btn btn-primary w-75 m-auto"  disabled>Submit Test</button>
  </div>
</div>
           </div>
        </div>
      </div>
      
      
    </div>
  </div></form>
</div>

<?php }?>

<!--Viewing Ends  Modall--->
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
  $("#flexCheckChecked90").click(function(){
   if($('#flexCheckChecked90').is(':checked')){ 
$("#test-submit").attr('disabled',false); 
}else{
   $("#test-submit").attr('disabled',true);
}
  });
});
</script>
   <script>
   function getQuestions(i){
   
       $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('PostJob/getQuestionsForm') ?>",
                        data:{'parent_id':i},  
                        success : function(response){
                        var resp= JSON.parse(response);
                        document.getElementById('hard-questions').innerHTML=resp.hard;
                        document.getElementById('soft-questions').innerHTML=resp.soft;
                        
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
   
   function submitTest(){
       var formData=$("#questionForm").serialize();
       alert(formData);
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
<?php }?>
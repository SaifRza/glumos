<div class="bg-white" id="login-form">
<div class="row d-flex justify-content-around w-100">
    <div class="col-md-5 d-none d-md-block bg-light pt-5" style="height:100vh">
        <div class="mx-5">
          <img src="<?php echo base_url();?>/httpdocs/images/glumos.png" class="" style="width:100px" >  
        </div>
         
    <div class="text-center">
        <img src="<?php echo base_url();?>/httpdocs/images/signin-ui.png" alt="ui-register" style="height:400px;">  
    </div>  
    </div>
    <div class="col-md-7 pt-5" style="height:100vh">
        <div class="mt-5 login-heading" style="">
          <h3 class="m-0 fw-bolder" >Reset Your Password here</h3>
        <p class="mt-2" style="font-size:16px">Not a member ?<a href="<?php echo base_url('/freelancer-signup');?>">Signup Now</a></p>   
        </div>
        
        <div class="col-md-9 col-10 my-3 m-auto" style="margin:auto">
        
        
        
       <!--form-->
       <div class="w-100 p-5 bg-light mx-3 my-5">
  <div class="m-auto">      
  <label for="username" class="form-label m-0 labler">Enter Registered Email</label>  
       <div class="input-group mb-2 mt-2">         
  <input type="email" class="form-control" placeholder="Email" aria-label="Username" id="username" name="username" aria-describedby="basic-addon1">
</div>

 <div class="text-ceneter m-auto" id="response-div"></div>
<div class="mt-2">.</div>

        <input  type="hidden" name="type" id="type" value="seeker">
                 

<div class="text-center mt-2">
    <button class="btn btn-primary w-75 m-auto"  id="send-mail">Send Reset-Password Link</button>
</div>


</div>
         </div>
       <!--form ends--->
       
       
       </div>
       
       
    </div>
</div>
</div>

</div>
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
   
      if(i=="seeker"){
     document.getElementById("seekerRadio").checked=true;  
     document.getElementById("employer").style.border="none";
      document.getElementById("selected-type").innerHTML="FreeLancer";
      }else if(i=="employer"){       
     document.getElementById("seeker").style.border="none";          
     document.getElementById("employerRadio").checked=true; 
       document.getElementById("selected-type").innerHTML="Employer";
      }
    document.getElementById(i).style.border="1px solid blue";
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

<div class="bg-white" id="login-form" style="min-height:100vh">
<div class="row d-flex justify-content-around w-100">
    <div class="col-md-5 d-none d-md-block bg-light pt-5" style="height:100vh">
     <div class="h-100 py-auto" >       
     <div class="mx-5">
            <a href="<?php echo base_url();?>">
          <img src="<?php echo base_url();?>/httpdocs/images/glumos.png" class="" style="width:100px" > </a> 
        </div>
    <div class="text-center mt-5" style="margin-top:auto;margin-bottom:auto">
        <img src="<?php echo base_url();?>/httpdocs/images/signin-ui.png" alt="ui-register" style="height:400px;">  
    </div>  
    </div>
    
    </div>
    <div class="col-md-7 py-auto h-100" style="height:100vh;margin-top:auto;margin-bottom:auto;">
        <div class="d-md-none" style="margin-top:100px">.</div>
        <div class="" style="">
          <div class="login-heading" style="">
          <h3 class="m-0 fw-bolder" >Login to Glumos Community</h3>
        <p class="mt-2" style="font-size:16px">Not a member ?<a href="<?php echo base_url('/freelancer-signup');?>">Signup Now</a></p>   
        </div>
        
        <div class="col-md-9 col-10  my-auto" style="margin:auto">
        
        
        
       <!--form-->
  <div class="m-auto">      
  <label for="username" class="form-label m-0 labler">Email or Username</label>  
       <div class="input-group mb-2 mt-2">         
  <input type="text" class="form-control" placeholder="Email or Username" aria-label="Username" id="username" name="username" aria-describedby="basic-addon1">
</div>

  <label for="password" class="form-label m-0 labler">Password</label>
        <div class="input-group mb-2 mt-2">            
  <input type="password" class="form-control" placeholder="Password" aria-label="Password" id="password" name="password" aria-describedby="basic-addon2">
  <span class="material-icons-outlined input-group-text" id="basic-addon21" onclick="toggleVisiblity()">visibility_off</span>
</div>
 
<div class="mt-2"></div>
        <input  type="hidden" name="type" id="type" value="seeker">
                 
<div class="form-check my-2">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
  <label class="form-check-label" for="flexCheckDefault">
   By Signing in you agree to our <a href=''>Terms & Conditions</a>
  </label>
</div>

<div class="text-center mt-2">
    <button class="btn btn-primary w-100"  id="login-btn">Login </button>
</div>
<div class="my-2"><a href="<?php echo base_url('reset-password');?>"><span class="theme-color">Forget Password ?</span></a></div>

</div>
</div>  
        </div>
        
       <!--form ends--->
    </div>
</div>
</div>

</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
  
   
           $("#login-btn").click(function(){
            var passwordBox = document.getElementById('password');
            var emailBox = document.getElementById('username');
            var passwordValue = document.getElementById('password').value;
            var emailValue = document.getElementById('username').value;
            var selected = $(".flexRadio:checked").val();
            $("#type").val(selected);
            var selectValue = document.getElementById('type').value;
              var data=JSON.stringify({
                       'passworded':passwordValue,
                       'emailed':emailValue,
                       'type':"2"
                   });
             
             $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('logincheck') ?>",
                        data:{
                       'passworded':passwordValue,
                       'emailed':emailValue,
                       'type':selected
                          },  
                        success : function(response){
                            var resp=JSON.parse(response);
                           
                         if(resp.response==true){
                                    $.toast({
                            heading: 'Login Successfull',
                            text: resp.message,
                            icon: 'success',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600',  // To change the background
                            position:'top-right'
                        });
                           window.location.href="<?php echo base_url('/dashboard');?>";
                           }else{
                                $.toast({
                            heading: 'Incorrect',
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
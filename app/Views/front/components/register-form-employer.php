<div class="bg-white" id="login-form">
   
<div class="row d-flex justify-content-around w-100">
    <div class="col-md-5 d-none d-md-block bg-light pt-5" style="height:100vh">
        <div class="mx-5">
          <img src="<?php echo base_url();?>/httpdocs/images/glumos.png" class="" style="width:100px" >  
        </div>
         
    <div class="text-center mt-5">
        <img src="<?php echo base_url();?>/httpdocs/images/signin-ui.png" alt="ui-register" style="height:400px;">  
    </div>  
    </div>
    <div class="col-md-7 h-100 my-auto" style="height:100vh;">
        <div class="my-auto" style="">
        <div class="mt-3 login-heading" style="">
            <?php $session=session();
            if(empty($session->get('userdata')['name'])){
            ?>
           <h3 class="m-0 fw-bolder" >Join with Glumos Community</h3>
        <p class="mt-2" style="font-size:16px">Have an Account ?<a href="<?php echo base_url('/login-now');?>">Login Now</a></p>
           <?php }else{?>
          <h3 class="m-0 fw-bolder" >Its Seems Empty Here</h3>
        <p class="mt-2" style="font-size:16px">Jump Back to Dashboard ?<a href="<?php echo base_url('/dashboard');?>">Go to Dashboard</a></p> 
           <?php }?>
             
        </div>
        
        <div class="col-md-9 col-10 my-3 m-auto" style="margin:auto">
       <?php if(isset($error)){?>
    <div class="my-auto text-center">
        <img class="img-fluid" src="<?php echo base_url();?>/httpdocs/images/bad-gateway.png" style="height:200px;"/>
        <h1 style="font-weight:400"><?= $error;?></h1>
        <h3 style="font-size:20px;"><?= $message;?></h3>
    </div>
    <?php } else{?>  
        <div class="row d-flex justify-content-around py-3 m-auto">
            
            <div class="col-md-4 mt-1 m-auto row d-flex  bg-white p-3 shadow-sm <?php if($typeof=="seeker"){ echo "selected-check"; }?>" onclick="check('freelancer-signup')" id="seeker"  style="border-radius:10px">
               <div class="form-check col-10">
                  <input class="form-check-input flexRadio" type="radio" name="flexRadioDefault" id="seekerRadio" <?php if($typeof=="seeker"){ echo "checked"; }?> value="jobseeker" checked>
                  <label class="form-check-label" for="seekerRadio">
                    I am Jobseeker
                  </label>
                </div> 
                <div class="col-2">
                    <span  class="material-icons-outlined">drive_file_rename_outline</span>
                </div>
              </div>
            
             <div class="col-md-4 mt-1 m-auto row d-flex  bg-white p-3 shadow-sm <?php if($typeof=="employer"){ echo "selected-check"; }?>" onclick="check('company-signup')" id="employer" style="border-radius:10px">
               <div class="form-check col-10">
                  <input class="form-check-input flexRadio " type="radio" name="flexRadioDefault" id="employerRadio" value="employer" <?php if($typeof=="employer"){ echo "checked"; }?>>
                  <label class="form-check-label" for="employerRadio">
                    I am  Employer
                  </label>
                </div> 
                <div class="col-2">
                    <span  class="material-icons-outlined">apartment</span>
                </div>
              </div>
        </div>
        
        
       <!--form-->
       <form method="POST" id="signup-form" autocomplete="off">
       <div class="m-auto">
    <?php if($typeof=="employer"){?>       
       <label for="company_name" class="form-label m-0 labler">Company Name</label>
        <div class="input-group mb-2 mt-2">            
  <input type="text" class="form-control" placeholder="Company Name" aria-label="Password" autocomplete="off" id="company_name" name="company_names" aria-describedby="basic-addon2">
 
     </div> 
     <?php }else{?>
       <div class="row d-flex">
       <div class="col-md-6">
      <label for="fullname" class="form-label m-0 labler">First name</label>  
       <div class="input-group mb-2 mt-2">         
     <input type="text" class="form-control" placeholder="First Name" aria-label="Username" id="fullname" autocomplete="off" name="fullname" aria-describedby="basic-addon1">
     </div>      
       </div>
             <div class="col-md-6">
     <label for="lastname" class="form-label m-0 d-none d-md-block">.</label>  
       <div class="input-group mb-2 mt-2">         
  <input type="text" class="form-control" placeholder="Last Name" aria-label="Username" id="lastname" name="lastname" autocomplete="off" aria-describedby="basic-addon1">
   </div>      
       </div>
       </div>
       <?php }?>
            
       <div class="row d-flex">
       <div class="col-md-6">
      <label for="email" class="form-label m-0 labler">Email</label>  
       <div class="input-group mb-2 mt-2">         
     <input type="text" class="form-control" placeholder="Email" aria-label="Username" id="email" name="emails" autocomplete="off" autocomplete="off" aria-describedby="basic-addon1" onkeyup="setUsername()">
   </div>      
       </div>
             <div class="col-md-6">
      <label for="username" class="form-label m-0 labler">Username</label>  
       <div class="input-group mb-2 mt-2">         
  <input type="text" class="form-control" placeholder="Username" aria-label="Username" id="username" autocomplete="off" name="usernames" aria-describedby="basic-addon1">
   </div>      
       </div>
       </div>
 

  <label for="password" class="form-label m-0 labler">Password</label>
        <div class="input-group mb-2 mt-2">            
  <input type="password" class="form-control" placeholder="Password" aria-label="Password" id="password" autocomplete="off" name="passwords" autocomplete="off" aria-describedby="basic-addon2">
  <span class="material-icons-outlined input-group-text" id="basic-addon21" onclick="toggleVisiblity()">visibility_off</span>
</div>
 

        <input  type="hidden" name="type" id="type" value="<?php if($typeof=="seeker"){ echo "seeker";}elseif($typeof=="company"){ echo "employer";  }?>">
                 
<div class="form-check my-2">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
  <label class="form-check-label" for="flexCheckDefault">
   By Signing in you agree to our <a href=''>Terms & Conditions</a>
  </label>
</div>

<div class="text-center mt-2">
    <button type="button" class="btn btn-primary w-100"  id="signup-btn">Sign up</button>
</div>

</div>
        </form>
        <!--form ends--->
   <?php }?>
</div>
        </div>
    </div>
</div>


</div>

</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <script>
   function setUsername(){
       var mail=document.getElementById('email').value;
      document.getElementById('username').value=mail
   }
           $("#signup-btn").click(function(){
            document.getElementById('signup-btn').disabled=true;
                        document.getElementById('signup-btn').innerHTML="Please Wait ....";   
              var queryString=$("#signup-form").serialize();
                 var pairs = queryString.split('&');
                    var result = {};
                    pairs.forEach(function(pair) {
                        pair = pair.split('=');
                        result[pair[0]] = decodeURIComponent(pair[1] || '');
                    });
              
              
               $.ajax({  
                        method: "POST",
                        url: "<?php echo site_url('/register') ?>",
                        data:result, 
                        success : function(responsed){
                            console.log(responsed);
                            var resp=JSON.parse(responsed);
                          
                        if(resp.response==true){
                        document.getElementById('signup-btn').disabled=true;
                        document.getElementById('signup-btn').innerHTMl="Please Wait ....";
                        
                                    $.toast({
                            heading: 'Registration  Successfull',
                            text: resp.message,
                            icon: 'success',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600',  // To change the background
                            position:'top-right'
                        });
                         
                           }else{
                             document.getElementById('signup-btn').enabled=true;
                          document.getElementById('signup-btn').innerHTML="Please Wait..."; 
                          setTimeout(function(){
                             document.getElementById('signup-btn').disabled=true;
                          document.getElementById('signup-btn').innerHTML="Signup";     
                          },'5000');
                                $.toast({
                            heading: 'Failed To Register',
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
           });
   
        /*   $("#login-btn").click(function(){
            var employerChecked=document.getElementById('employerRadio').checked;
            var seekerChecked=document.getElementById('seekerRadio').checked;
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
                        url: "<?php echo site_url('/logincheck') ?>",
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
                           window.location.href="<?php echo base_url('/Dashboard/userAuth/');?>";
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
                
         }) */
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
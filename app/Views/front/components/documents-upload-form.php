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
    <div class="col-md-7 pt-2" style="height:100vh">
        <div class="mt-2 login-heading" style="">
          <h3 class="m-0 fw-bolder" >Upload Required Documents to Verify</h3>
        <p class="mt-2" style="font-size:16px">Verifiation Lets you stand out from others.</p>   
        </div>
        
        <div class="col-md-9 col-10 my-3 m-auto" style="margin:auto">
        
        
        
       <!--form-->
  <div class="row d-flex justify-content-around m-auto">
      <div class="col-5 shadow-lg p-2 text-center">
          <h6>Enter Address Details</h6>
         <input type="text" class="material-input" placeholder="Enter your Adress">
         
         <input type="text" class="material-input" placeholder="Enter Your city">
         
         <input type="text" class="material-input" placeholder="Enter Your State or Province">
         
         <input type="text" class="material-input" placeholder="Enter Your Country Name">
            
      </div>
  
  
      <div class="col-5 shadow-lg p-2  text-center">
          <h6>Upload your Adress Proof</h6>
          <img src="<?php echo base_url('/httpdocs/images/pan_card.png');?>"  style="height:150px;margin:auto;width:180px" id="address_proof">
         <label for="upload_adress_proof"><a class="btn btn-success" style="border-radius:20px">Click To Upload</a></label> 
          <input type="file" style="height:1px;width:1px" accept="image/*" id="upload_adress_proof" onchange="loadFile(event)">

<script>
  var loadFile = function(event) {
    var output = document.getElementById('address_proof');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
      </div>
  </div>
  
   <div class="row d-flex justify-content-around m-auto mt-3">
     <div class="col-5 shadow-lg p-2 text-center">
          <h6>Enter Banking Details</h6>
         <input type="text" class="material-input" placeholder="Enter Bank Name">
         
         <input type="text" class="material-input" placeholder="IFSC code">
         
         <input type="text" class="material-input" placeholder="Account Number">
         
         <input type="text" class="material-input" placeholder="Account Holder">
            
      </div>
  
  
      <div class="col-5 shadow-lg p-2  text-center">
                    <h6>Upload your Bank Statement</h6>
          <img src="<?php echo base_url('/httpdocs/images/bank_card.png');?>"  style="height:150px;margin:auto;width:180px" id="bank_proof">
         <label for="upload_bank_proof"><a class="btn btn-success" style="border-radius:20px">Click To Upload</a></label> 
          <input type="file" style="height:1px;width:1px" accept="image/*" id="upload_bank_proof" onchange="loadFile(event)">

<script>
  var loadFile = function(event) {
    var output = document.getElementById('bank_proof');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
      </div>
  </div>
  
    
    <div class="text-center mt-2">
         <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
      <label class="form-check-label" for="defaultCheck1">
        I hereby , agree the documents uploaded by me is accurate 100%.
      </label>
    </div>
        <a class="btn btn-primary w-75 mt-2" style="border-radius:20px;">Process for Verification</a>
    </div>
    
       <!--form ends---></div>
    </div>
</div>
</div>

</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
  
   
           $("#login-btn").click(function(){
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
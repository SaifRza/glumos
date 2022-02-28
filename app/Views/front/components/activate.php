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
        <div class="mt-3 login-heading" style="">
          <h3 class="m-0 fw-bolder" >Welcome to Glumos Community</h3>
        <p class="mt-2" style="font-size:16px">Account activation Done ?<a href="<?php echo base_url('/login-now');?>">Login Now</a></p>   
        </div>
        
        <div class="col-md-9 col-10 my-3 m-auto" style="margin:auto">
       <?php if(2>1)
       {?>
    <div class="my-auto text-center">
        <img class="img-fluid" src="<?php echo base_url();?>/httpdocs/images/bad-gateway.png" style="height:200px;"/>
        <h1 style="font-weight:400">Account activated Succesfully</h1>
        <h3 style="font-size:20px;"><span class="text-success">Hey welcome</span>, go and click the login link above to login now.</h3>
    </div>
    <?php }?>  
       
</div>
  
    </div>
</div>


</div>

</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
           $("#signup-btn").click(function(){
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
                        success : function(response){
                            var resp=response;
                           console.log(resp);
                        /* if(resp.response==true){
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
                           } */
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
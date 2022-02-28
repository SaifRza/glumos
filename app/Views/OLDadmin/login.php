
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url();?>/httpdocs/toaster/dist/jquery.toast.min.css"/>

    <title>Login Panel || Admin</title>
  </head>
  <style>
  body{
   height:100%;
        width:100%; 
        background:rgb(0 0 0 /10%);
  }
    .full-container{
        height:100%;
        width:100%;
    }  
    .login-container{
        margin-left:auto;
        margin-right:auto;
        margin-top:20px;
        max-width:400px;
        background:#f7f7f7;
        border-radius:20px;
    }
     .logo-image{ 
         margin-top:200px;
        margin-bottom:0px;
        width:150px;
    }
    @media only screen and (max-width: 600px) {
  .login-container{
        margin-left:30px;
        margin-right:30px;
         margin-top:20px;
        max-width:400px;
    }
    .logo-image{ 
        margin-top:150px;
        width:150px;
    }
}
  </style>
  <body>
      <div class="full-container">
          
          <div class="text-center m-0">
              <?php
            $session = \Config\Services::session();
            if(!empty($session->getFlashdata('message'))){?>
              <p class="alert alert-danger"><?= $session->getFlashdata('message');?></p>  
           <?php }
            ?>
              <img src="<?php echo base_url();?>/httpdocs/images/glumos.png" class="img-fluid logo-image" >
          </div>
          <form method="POST" id="admin-form">
          <div class="login-container p-3 shadow-lg">
              <div class="mb-3">
  <label for="email" class="form-label">Email address</label>
  <input type="email" name="emailed" class="form-control" id="email" placeholder="admin@glumos.com">
               </div>
               <div class="mb-3">
 <label for="password" class="form-label">Enter Password</label>
  <input type="password" name="passworded" class="form-control" id="password" placeholder="password">
               </div>
               
               <div class="text-center mt-3">
                   <button type="button" class="btn btn-info w-75" name="checkLogin" id="admin-login-btn">Login Now</button>
               </div>

          </div>
          </form>
      </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
   var passworded=$("#password").val();
   var emailed=$("#email").val();
   
           $("#admin-login-btn").click(function(){
            var passworded=$("#password").val();
            var emailed=$("#email").val();
              var data=JSON.stringify({
                       'passworded':passworded,
                       'emailed':emailed,
                   });
             
             $.ajax({  
                        method: "POST",
                        url: "<?php echo site_url('/adminlogin') ?>",
                        data:{
                       'passworded':passworded,
                       'emailed':emailed,
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
                           window.location.href="<?php echo base_url('Thilak');?>";
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?php echo base_url();?>/httpdocs/toaster/dist/jquery.toast.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
     <link rel="stylesheet" href="<?php echo base_url('');?>/httpdocs/css/custom.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
      <link rel="stylesheet" href="<?php echo base_url();?>/httpdocs/toaster/dist/jquery.toast.min.css"/>
    
      <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    
    <title>Sample Page</title>
    <head>

  </head>
  <body>
<div class="row d-flex m-auto" style="background:#f8f8f8">
  
  <?= $this->include('partials/sidebar')?>


     <?= $this->renderSection('content') ?> 

</div>
   
     
       
 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(function(){
    $(".toggle-btn").on('click',function(){
    
       $('#navbar,#sidebar , #content ').toggleClass('active'); 
       
    });
});
  function verifyEmployer(i){
                $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('Admin/viewEmployer') ?>",
                        data:{'id':i},  
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
                           window.location.href="<?php echo base_url('/Thilak');?>";
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
    }
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/httpdocs/toaster/dist/jquery.toast.min.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    
    
  </body>
</html>
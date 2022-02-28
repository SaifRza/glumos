
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined"
      rel="stylesheet">
      <link rel="icon" href="<?php echo base_url();?>/httpdocs/images/glumos-favicon.png" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo base_url();?>/httpdocs/images/glumos-favicon.png" type="image/x-icon" />
    <title>Glumos || Get High paying Jobs</title>
  <body>

  
  <?= $this->include('front/components/navbar')?>


     <?= $this->renderSection('content') ?> 


   
     
       
 
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    
    
  </body>
</html>
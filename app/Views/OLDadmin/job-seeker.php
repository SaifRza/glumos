<?= $this->extend('layout/main')?>

<?=$this->section('content')?>
<?=$this->include('partials/navbar')?>
<div class="page-content text-dark p-1" id="content" style="margin-top:70px">

<div class="col-8 m-auto p-2 bg-white">
    <h4 class="mx-3">Total Jobseekers <span class="text-success"><?=count($jobseekers);?></span></h4>
    <hr>
<?php //print_r($employers );?>
<?php foreach($jobseekers as $seeker){?>
  
      <div class="row d-flex justify-content-around">
          <div class="col-3 v-med">
             <?=$seeker->profile_img==""?'<img src="'.base_url('httpdocs/default_company.png').'" style="height:100px;width:100px;border-radius:50%">':'<img src="'.base_url('httpdocs/logo-images/')."/".$seeker->profile_img.'" style="height:100px;width:100px;border-radius:50%">';?>
          </div>
          <div class="col-4 v-med my-auto">
              <h5 class="text-muted m-0"><?=$seeker->name;?></h5>
              <p class="m-0"><?= $seeker->username;?></p>
              <p class="m-0"><?= $seeker->email;?></p>
          </div>
          <div class="col-2 v-med">
              <a class="btn btn-primary bg-theme py-1 px-2" href="<?php echo base_url('view-profile');?>/<?=$seeker->hashmail;?>"  target="_blank">View Profile</a>
          </div>
          
         
      </div>
      <hr class="m-0">
   
      
<?php }?>
</div> 

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function setStatus(i,j){
        alert(i);
        alert(j);
       $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('Admin/updateCompanyStatus') ?>",
                        data:{'id':i,'status':j},  
                        success : function(response){
                        var resp=JSON.parse(response);
                      
                      if(resp.response==true){
                               window.location.href="<?php echo base_url('/Admin/company/');?>";
                           }
                        /* if(i!=5){
                           if(resp.response==true){
                              window.location.href=passurl;
                           }
                        }
                        else{
                           if(resp.response==true){
                               window.location.href="<?php echo base_url('/Admin/company/');?>";
                           } 
                        } */
                        },
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });
    }
</script>



<?= $this->endSection();?>
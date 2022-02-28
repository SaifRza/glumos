<?= $this->extend('layout/main')?>

<?=$this->section('content')?>
<?=$this->include('partials/navbar')?>
<div class="page-content text-dark p-1" id="content" style="margin-top:70px">

<div class="col-8 m-auto p-2 bg-white">
    <h4 class="mx-3">Total Employers <span class="text-success"><?=count($employers);?></span></h4>
    <hr>
<?php //print_r($employers );?>
<?php foreach($employers as $company){?>
   
      <div class="row d-flex justify-content-around">
          <div class="col-3 v-med">
              <img src="<?php echo base_url('httpdocs/default_company.png');?>" style="height:100px;width:100px;border-radius:50%">
          </div>
          <div class="col-4 v-med my-auto">
              <h5 class="text-muted m-0"><?=$company->name;?></h5>
              <p class="m-0"><?= $company->username;?></p>
              <p class="m-0"><?= $company->email;?></p>
          </div>
          <div class="col-2 v-med">
              <?=$company->verification_file!=""?'<a class="btn btn-primary bg-theme py-1 px-2" href="'.base_url('httpdocs/document-files/')."/".$company->verification_file.'"  target="_blank">View</a>':''?>
          </div>
          <div class="col-2 v-med m-auto">
              <?php 
              if($company->verification=="0"||$company->verification=="2"){?>
              <span class="material-icons v-med text-warning fw-bolder">
            circle
            </span>
             <span class="v-med text-warning fw-bolder">Pending</span>
             
             <?php }elseif($company->verification=="1"){?>
            <span class="material-icons v-med text-success fw-bolder">
            circle
            </span>
             <span class="v-med text-success fw-bolder">Verified</span>
          
             <?php } 
             elseif($company->verification=="3"){?>
             <span class="material-icons v-med text-danger fw-bolder">
            circle
            </span>
             <span class="v-med text-danger fw-bolder">
                 Rejected</span>
             <?php }?>
          </div>
          <div class="col-1 v-med m-auto">
             
                <div class="dropdown">
  <span class="material-icons-outlined"  type="button" id="dropdownMenuButton-<?=$company->email;?>" data-toggle="dropdown" aria-expanded="false">
                more_horiz
                </span>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?=$company->email;?>">
     <?php if($company->verification=="0"){?>
     <a class="text-success fw-bolder" onclick="setStatus('<?=$company->email;?>','1')">Verify</a><br>
     <a class="text-danger fw-bolder" onclick="setStatus('<?=$company->email;?>','3')">Reject</a>
     <?php }elseif($company->verification=="1"){?>
     <a class="text-warning fw-bolder" onclick="setStatus('<?=$company->email;?>','0')">Delay</a><br>
     <a class="text-danger fw-bolder" onclick="setStatus('<?=$company->email;?>','3')">Reject</a>
     <?php }elseif($company->verification=="2"){?>
     <a class="text-success fw-bolder" onclick="setStatus('<?=$company->email;?>','1')">Verify</a>
     <?php }?>
  </div>
</div>
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
<?= $this->extend('layout/main')?>

<?=$this->section('content')?>
<div class="page-content text-dark p-1" id="content" >
<h4 class="mx-3">Total Employers <span class="text-success"><?=count($employers);?></span></h4>

<div class="row d-flex justify-content-around">
<?php foreach($employers as $company){?>
     <div class="col-4 bg-white mt-1 p-2 shadow-lg">
         <div class="row d-flex">
             <div class="col-4"><img src="<?php echo base_url();?>/httpdocs/logos/logo-<?php echo mt_rand(1,30);?>.png" style="height:70px;width:70px;border-radius:50%;"></div>
             <div class="col-6 fw-bolder align-middle"> <h5><?= $company->email;?></h5>
             <?php if($company->verification<1){?>
             <a class="btn btn-info text-white" onclick="verifyEmployer('<?=  $company->id;?>')" style="border-radius:20px;">Verify It</a>
             <?php } else{?>
             <a class="btn btn-danger text-white" onclick="blockEmployer('<?php $company->id;?>')" style="border-radius:20px;">Block Him</a>
             <?php }?>
             </div>
         </div>
         <div class="row mt-2 d-flex justify-content-around">
             <div class='col-auto'>
                 <h6 class="text-success">Payment</h6>
                 <p classs="m-0 text-success">verified</p>
             </div>
             <div class='col-auto'>
                 <h6 class="text-primary">Company Ver.</h6>
                 <p classs="m-0 text-primary">verified</p>
             </div>
             <div class='col-auto'>
                 <h6 class="text-info">Total Spent</h6>
                 <p classs="m-0 text-info">$200</p>
             </div>
         </div>
     </div>
      
<?php }?>
</div>

</div>




<?= $this->endSection();?>
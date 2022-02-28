<?= $this->extend('layout/main')?>

<?=$this->section('content')?>
<?=$this->include('partials/navbar')?>
<div class="page-content text-white p-1" id="content" style="margin-top:70px;overflow-y:scroll;">
 
 <span style="color:black">here will the contents </span> 
 <div class="alert alert-primary">Section and Option for categories</div>
<?=form_open_multipart('some_file.php');?>
<div class="" style="width: 100%;display: inline-block;overflow-x: auto;">
    <div class="" style="width:auto;display:flex;flex-direction:row;">
   <?php for($i=0;$i<4;$i++){?>
   <div class="image-upload m-auto mx-3">
  <label for="file-input-<?=$i;?>">
    <img class="img-upload" src="<?php echo base_url();?>/httpdocs/images/image-upload.png" />
  </label>

  <input id="file-input-<?=$i;?>" type="file" class="d-none" />
</div>
   <?php }?>
   </div>

</div>

<?=form_close();?>
 
 
  <div class="alert alert-success mt-3">Side bar Image categories</div>
 <div class="alert alert-warning mt-3">rendered section of above categories</div>
     
     
 

</div>



<?= $this->endSection();?>
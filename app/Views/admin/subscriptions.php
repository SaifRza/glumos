<?= $this->extend('layout/main')?>

<?=$this->section('content')?>
<div class="page-content text-dark p-1" id="content" style="">

<div class="col-8 m-auto p-2 bg-white">
    <h4 class="mx-3">Subscriptions <span class="text-success"><?=count($payments);?></span></h4>
    <hr>
<?php //print_r($employers );?>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Email</th>
      <th scope="col">Customer_id</th>
      <th scope="col">Status</th>
      <th scope="col">Due Date</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($payments as $seeker){?>
  
     <tr>
      <th scope="row"><?=$seeker->stripe_id;?></th>
      <td><?=$seeker->email;?></td>
      <td><?=$seeker->customer_id;?></td>
      <td><span class="btn btn-dark">Active</span></td>
      <td><?=date('d M Y',$seeker->period_end);?></td>
    </tr>
<?php }?>
  </tbody>
</table>
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
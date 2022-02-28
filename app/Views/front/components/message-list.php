<div class="row d-flex justify-content-around p-2 m-0" style="font-size:20px">
   <div class="col-2">
      <span class="material-icons-outlined" style="font-size:36px">
        chevron_left
        </span>
   </div>
   <div class="col-8 text-center">
       Messages
   </div>
   <div class="col-2">
       <span class="material-icons-outlined" style="font-size:36px">
        settings
        </span>
   </div>
</div>
<hr class="m-0">
<?php for($i==3;$i<9;$i++){;?>
<div class="row d-flex justify-content-between px-2 py-1 my-1">
    <div class="col-2">
        <img src="https://randomuser.me/api/portraits/men/<?php echo 40+mt_rand(1,20) ;?>.jpg" style="height:50px;width:50px;border-radius:50%">
    </div>
    <div class="col-8">
        <p class="text-success m-0">Vishal Maisha(1)</p>
        <p class="text-muted m-0" style="font-size:10px;">This is a random message</p>
    </div>
</div>
<hr class="m-0">
<?php }?>
<style>
    .bg-gray{
        background:#eee;
        font-weight:700;
        color:black;
    }
</style>
<div class="bg-white p-3 " style="height:60%;display: flex;
  flex-direction: column-reverse;overflow-y:scroll;scroll-snap-type: y proximity;">
    <div style="margin-top:auto;">
    <?php print_r($messages);?>  
    <?php foreach($messages as $msg){?>
    <div class="w-auto mt-3 mx-1">
       <?php if($msg->send_to=="2"){?>
       <div class="w-100 " style="display: flex; justify-content: flex-start">
        <div class="w-25 ml-auto bg-gray p-2" style="border-radius:10px">
            <?= $msg->message_text;?>
        </div></div>
        <?php }else{?>
        <div class="w-100" style="display: flex; justify-content: flex-end;">
        <div class="w-25 ml-auto bg-gray p-2" style="border-radius:10px">
            <?= $msg->message_text;?>
        </div></div>
        
        <?php }?>
    </div>
    
    <?php }?> 
    
    <div class="input-group flex-nowrap">
  <span class="material-icons-outlined input-group-text" id="addon-wrapping">attach_file</span>
  <input type="text" class="form-control" placeholder="Type Something to send" aria-label="Username" aria-describedby="addon-wrapping">
  <span class="material-icons-outlined input-group-text bg-primary text-white" id="addon-wrapping">send</span>
</div>
     </div>   
      
    
   
</div>
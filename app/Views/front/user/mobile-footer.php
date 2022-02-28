   <footer class="text-center w-100 text-center shadow bg-white p-2">
       <div class="row justify-content-around w-100 m-auto">
           <div class="col-3 m-auto">
               <a class="text-dark"  href="<?php if(isset($userid)){ echo base_url('/Dashboard/userAuth');}else{ echo base_url('/Dashboard/userAuth');};?>">
               <img src="<?php echo base_url();?>/httpdocs/icons/home-seller.png" style="width:30px;height:30px;">
               <p style="margin:0px;font-size:12px">Dashboard</p></a>
           </div>
           <div class="col-3 m-auto text-center">
                <a class="text-dark"  href="<?php echo base_url('/Dashboard/message');?>">
               <img src="<?php echo base_url();?>/httpdocs/icons/request-seller.png" style="width:30px;height:30px;">
               <p style="margin:0px;font-size:12px">Requests</p></a>
           </div>
           <div class="col-3 m-auto text-center">
                <a class="text-dark"  href="<?php if(isset($userid)){ echo base_url('/Dashboard/userAuth');}else{ echo base_url('/Dashboard/userAuth');};?>">
               <img src="<?php echo base_url();?>/httpdocs/icons/send-seller.png" style="width:30px;height:30px;">
               <p style="margin:0px;font-size:12px">Send</p></a>
           </div>
           <div class="col-3 m-auto text-center">
                <a class="text-dark"  href="<?php if(isset($userid)){ echo base_url('/Dashboard/userAuth');}else{ echo base_url('/Dashboard/userAuth');};?>">
               <img src="<?php echo base_url();?>/httpdocs/icons/mine-seller.png" style="width:30px;height:30px;">
               <p style="margin:0px;font-size:12px">Profile</p></a>
           </div>
       </div>
   </footer>
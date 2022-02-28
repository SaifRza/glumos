<div class="vertical-nav bg-light d-none d-md-block" id="sidebar">
<div class="py-4 px-3  primary-bg" style=" background: linear-gradient(to right, rgb(0, 198, 255), rgb(0, 198, 255));">
        <div class="media md-flex  align-items-center">
            <img src="https://static.wixstatic.com/media/350acc_11d42e4ced984ce89cf8f0cb21b333f8~mv2.png/v1/crop/x_526,y_104,w_869,h_969/fill/w_468,h_504,al_c,q_85,usm_0.66_1.00_0.01/v3-foundX-MAGIC%20Blockchain%20Bootcamp.webp" alt="..." width="80" height="80"
            class="mr-3 rounded-circle img-thumbnail shadow-sm">
            
        </div>
        <div class="media-body">
                <h4 class="m-0 text-white">Thilak</h4>
                <p class="font-weight-normal text-muted mb-0">Glumos Admin</p>
            </div>
    </div>
 <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">
        Dashboard
  </p>

 <ul class="list-unstyled components">
         <li class="nav-item w-100">
             <a href="<?php echo base_url('Admin/company');?>" class="nav-link">Company</a>
         </li>
         <li class="nav-item w-100">
             <a href="<?php echo base_url('Admin/jobSeeker');?>" class="nav-link">Job Seeker</a>
         </li>
         <li class="nav-item w-100">
             <a href="<?php echo base_url('Admin/subscriptions');?>" class="nav-link">Subscriptions</a>
         </li>
         
     
          </ul>    
  
  
</div>  

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
          
          
          <ul class="list-unstyled components">
          <?php foreach($subjects as $subs){?>
           <li class="nav-item w-100">
               <a href="#<?php echo $subs->id;?>" class="nav-link text-dark bg-light drop-toggle" data-toggle="collapse" aria-expanded="false">
              <span class="material-icons col-3"><?php echo  $subs->menu_icon;?></span>
              <span class="col-9 text-capitalize"><?php echo  $subs->menu;?></span>
              </a>
              <ul class="collapse list-unstyled" id="<?php echo $subs->id;?>">
                 
                  <?php
                  $submenus=$subs->array_submenu;
                  $arr = explode (",", $submenus); 
                
                  
                  
                for($i="0";$i<9; $i++){?>
                <?php if($arr[$i]!=null){?>
                 <li class="nav-item m-0">
                      <a href="<?php echo base_url('Admin')."/".$arr[$i];?>" class="nav-link m-0 text-capitalize"><?php echo $arr[$i]?></a>
                  </li>
                  <?php } ?>
                  
                  <?php   }   ?>
                  
              </ul>
              
          </li>
          
          <?php } ?>
          </ul>
          
     
         
          
         
     
      </div>
     <!---signin/Logout  Section-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>----->
    </div>
  </div>
</div>
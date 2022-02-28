<?php
 $session=session();
  $usertype=$session->get('userdata')['usertype'];
  $company_id=$session->get('userdata')['id'];
  
if(empty($myData[0]->profile_img)){
 $dp='default_logo_1.png';  
}else{
    $dp=$myData[0]->profile_img;
}
?>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400&display=swap');
  .login-btn{
      background-color:white;
   color:#020bff;
  }
  .pricing-card{
     color:#120bff;
     background:white;
     border: 1px solid #120bff;
     padding:20px;
     border-radius:20px;
  }
  .pricing-card-active{
      color:white;
      background:#120bff;
      padding:20px;
     border-radius:20px;
  }
   li{
       list-style:none;
       font-weight:500;
   }
   li:hover{
       cursor:pointer;
       color:#120bff;
   }
   .li{
       list-style:none;
       font-weight:500;
   }
   .li:hover{
       cursor:pointer;
       color:#120bff;
   }
   .login-btn:hover{
   background-color:#020bff;
   color:white;     
     }
   .signup-btn:hover{
   background-color:white;
   color:#020bff;     
     }     
  .material-input{
      border:none;
      outline:none;
      border-bottom:2px solid #bebebe;
  }
  .material-input:focus{
     border:none;
      outline:none;
      border-bottom:2px solid limegreen; 
  }
  .upload-btn{
      font-size:28px;
      color:gray;
  }
  .upload-btn:hover{
      cursor:pointer;
      color:black;
  }
     
   body{
       font-family: 'Inter', sans-serif;
    background:rgb(0 0 0/5%);
    width:100%;
   }
   #basic-addon2,#basic-addon3{
       background:#eee;
        
   }
   .v-med{
       vertical-align:middle;
   }
   .v-mid{
       vertical-align:middle;
   }
   .bot-bor{
       border-bottom:3px solid blue;
       color:gray;
   }
   .error
    {
      animation: shake 0.2s ease-in-out 0s 2;
      box-shadow: 0 0 0.5em red;
    }
 /*   footer{
          position:fixed;
          width:100%;
          bottom:0;
          height:auto;
      } */
   .login-heading{
       margin-left:100px
   }
   #login-form a:hover{
       color:blue;
       
   }
   .labler{
       font-weight:700;
       margin-top:40px;
   }
   .card-class{
       background:white;
       border-radius:10px;
       box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
       padding:20px 10px 20px 10px;
   }
   .surfing-area{
       width:80%;
       margin:auto;
   }
   .search-card{
       color:black;
       font-weight:500;
       margin:auto;
       margin-top:-40px;
       border-radius:10px;
   }
   .browse-section{
      
   }
   a:hover{
     color:green;
   }
   .hoverable:hover{
       cursor:pointer;
   }
   .ul-3{
       margin-left:12px;margin-right:12px;
   }
   a{
       text-decoration:none;
   }
   .section-content{
       width:80%;margin:auto;
   }
   .post-btn{
       text-align:center;
       font-weight:500;
       margin-left:auto;
       margin-right:auto; padding: 8px 10px;
       margin-top:70px;
       font-size:20px;
       background-color:limegreen;
       color:white;
       border:1px solid white;
       border-radius:10px;
       width:100px;
      
       text-decoration:none;
   }
   .hero-h1{
     font-size:3rem; 
     font-weight:900;
   }
   .hero-p{
     font-size:20px;  
   }
   .hero-image{
       margin-top:30px;
      height:400px; 
   }
   .theme-gradient{
           background: linear-gradient(to right,  rgb(2, 27, 121),rgb(5, 117, 230));
           color:white;
   }
   .hero-view{
       height:500px;
   }
   .btn-theme{
       border-radius:15px;
       color:white;
      background-color:#020bff;
      width:80px;
      height:40px;
      font-weight:500;
   }
   .btn-theme-hovered {
       border-radius:15px;
       border:1px solid #eee;
       color:gray;
      background-color:white;
      width:80px;
      font-weight:700;
   }
   .btn-theme:hover {
       border-radius:15px;
       border:1px solid #020bff;
       color:#020bff;
      background-color:white;
      width:80px;
      font-weight:700;
   }
   .header-item{
       color:gray;
       font-size:15px;
   }
   .header-item:hover{
       color:black;
       cursor:pointer;
   }
   
   #search-jobs:focus{
       border:none;
   }
   
   .bg-theme{
       background-color:#020bff;
       color:white;
   }
   .theme-color{
       color:#020bff;
   }
    .logo-image{
        width:150px;
    } 
  .dashboard-hero{
      width:80%;
      margin:auto;
    
  }    
    
    .loader{
        width:70%;
    }
   .nav-width{
      width:84%;margin:auto; 
      
  } 
  .wid-90{
      width:90%
  }
   .t-dots{
      width:100px;
  }
  .dropbtn {
  
  color: black;
  font-size: 16px;
width:auto;
  max-height:40px;
  border:none;
  background:transparent;
  font-weight:500;
  /*box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px; 
  border: 1px solid #eee;
  border-radius:5px;*/
}
.dropbtn img{
 background:transparent;    
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 220px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  transition:all 3s;
  padding:30px 0px;
  border-radius:14px;
}

.dropdown-content a {
  color: black;
  padding: 8px;
  text-decoration: none;
  display: block;
  font-size:16px;
  font-weight:700;

}

.dropdown-content a:hover {background-color: #eee;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background:transparent; color:#020bff;}
  
   .balls{
     height:30px;
     width:30px;
     font-size:14px;
     border-radius:50%;
     background:#bebebe;
     color:white;
     vertical-align:center;
    }
   .hr{
        position:relative;
        border-top:4px solid #bebebe;
         margin-top:30px;
       
    }
    .hr-border{
        border-top:4px solid #012bff;
    }
     .question-card{
     transition:all 1.6s;
     padding:40px 20px;
     
     height:540px;
     width:540px;
     margin:auto;
     border-radius:20px;
     position:relative;margin-top:30px;
    }
     .content-q{
        color:black;
        font-size:29px;
    }
    .content-q2{
        color:black;
        font-size:22px;
    }
    .qt-5{
        margin-top:70px;
    }
    .qy-5{
        margin-top:30px;
        margin-bottom:30px;
    }
    .content-p{
        font-size:16px;
        color:gray;
    }
  
    @media only screen and (max-width: 600px) {
         .hr{
        position:relative;
        border-top:2px solid #bebebe;
         margin-top:12px;
       
    }
      .qt-5{
        margin-top:40px;
    }
     .qy-5{
        margin-top:10px;
        margin-bottom:10px;
    }
     .question-card{
     transition:all 1.6s;
     max-width:400px;
     width:90%;
     height:500px;
    }
    .content-q{
        color:black;
        font-size:18px;
    }
    .content-q2{
        color:black;
        font-size:16px;
    }
    .content-p{
        font-size:14px;
        color:gray;
    }
    
    .hr-border{
        border-top:2px solid #012bff;
    }

   .balls{
     height:25px;
     width:25px;
     font-size:10px;
     border-radius:50%;
     background:#bebebe;
     padding:7px;
     color:white;
     vertical-align:center;
    }        
        
  .logo-image{
        width:100px;
        
  }
  .dropbtn {
  
  color: black;
  font-size: 12px;
width:auto;
  max-height:40px;
  border:none;
  background:transparent;
  font-weight:500;
  /*box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px; 
  border: 1px solid #eee;
  border-radius:5px;*/
}
.dropbtn img{
 background:transparent;    
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 90px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  transition:all 1s;
  padding:7px 0px;
  border-radius:6px;
}

.dropdown-content a {
  color: black;
  padding: 2px;
  text-decoration: none;
  display: block;
  font-size:12px;
  font-weight:500;

}

.dropdown-content a:hover {background-color: #eee;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background:transparent; color:#020bff;}
  .t-dots{
      width:40px;
  }
  .wid-90{
      width:100%;
  }
  .text-1{
      font-size:20px;
  }
  .text-2{
      font-size:14px;
  }
  .text-3{
      font-size:10px;
  }
  .ul-3{
       margin-left:1px;margin-right:1px;
       padding-left:5px;
   }
  .section-content{
       width:99%;margin:auto;
   }
  .nav-width{
      width:99%;margin:auto; 
      height:40px;
      background:white;
      position: fixed; /* Set the navbar to fixed position */
      top: 0;
      margin-bottom:10px;
  }
  .logo-on-mobile{
      text-align:left;
      left:0;
  }
  .dashboard-hero{
      width:100%;
      margin:auto;
  }
  .labler{
       font-weight:700;
       margin-top:30px;
   }
  .login-heading{
       margin-left:50px;
       margin-bottom:50px;
   }
   
  .search-jobs{
      border-radius:20px 0px 0px 20px;
  }
  .card-class{
    background:rgb(0 0 0/0.5%);
       border-radius:0px;
       box-shadow: none; 
       padding:20px 0px 0px 0px;
  }
  .surfing-area{
       width:99%;
       margin:auto;
       margin-top:20px;
   }
  .nav-item{
      font-size:18px;
      color:black;
      font-weight:500;
      padding:5px 2px;
  }
  .nav-active{
      font-size:18px;
      color:#020bff;
  }
  li.material-icons{
      color:gray;
  }
  
 .hero-view{
       height:550px;
       margin-top:10px;
       width:100px;
   } 
   .hero-image{
       height:280px;
       margin:auto;
       margin-top:20px;
   }
   .hero-h1{
       text-align:left;
       font-weight:700;
       width:100%;
       font-size:24px;
       margin:auto;
      
       margin-top:10px;
   }
   .jumbo-text{
       width:100%;
       margin-left:auto;
   }
   .hero-p{
     text-align:left;
       font-weight:500;
       margin:auto;
       font-size:16px;
   }
   .post-btn{
           box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);
       text-align:center;
       font-weight:500;
       margin-left:auto;
       margin-right:auto; padding: 10px 20px;
       margin-top:70px;
       font-size:20px;
       background-color:limegreen;
       color:white;
       border:2px solid white;
       border-radius:8px;
       width:100px;
      
       text-decoration:none;
   }
    
}

</style>
<div class="bg-white   py-1" style="margin:auto" >
<div class="row d-flex justify-content-between start nav-width" style="">
   
    <?php $session=session();?>
    <div class="col-md-3 col-6 py-1 my-auto text-center logo-on-mobile" style="">
    <a class="btn btn-primary bg-theme text-uppercase fw-bolder">BETA</a>
      <a <?php if(!empty($session->get('userdata'))){?>  href="<?= base_url('dashboard');?>"  <?php }else{?> href="<?= base_url('');?>"  <?php }?> ><img src="<?php echo base_url();?>/httpdocs/images/glumos.png" class="img-fluid logo-image  text-right "></a>
    </div>
      <div class="col-md-0 d-md-none col-2 py-1">
       <span class="material-icons theme-color" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            menu
            </span>
    </div>
    <div class="col-md-3 d-none d-md-block pt-0">
        <?php 
        if(empty($session->get('userdata'))){?>
      
    <?php }?>
        
    </div>
    <div class="col-md-5 d-none d-md-block pt-0 justify-content-end" style="max-height:20px;">
        <?php 
        $session=session();
        if(empty($session->get('userdata'))){?>
        <div class="row d-flex justify-content-end" style=" ">
            <div class="col-10 py-1">
              <ul class="row d-flex justify-content-end pt-2">
                 <!--- <li class="col-auto" style=" ">Freelancing Jobs</li>
                  <li class="col-auto" style=" ">Fulltime Jobs</li>--->
                  <li class="col-auto" style=" " ><a class="li text-dark" href="<?php echo base_url('/login-now');?>">Login</a></li>
              </ul>
            </div>
        
           
                <div class="col-2 py-2">
                <a class="btn btn-primary bg-theme signup-btn py-1"  href="<?php echo base_url('/freelancer-signup');?>" >
                    Signup
                </a>
            </div>
        </div>
           <?php }else{?>
        <div class="row d-flex justify-content-end py-2 " style=" "> 
               
           <!--Dashboard-->
         
        <div class="col-auto dropdown mt-1">
        <button class="dropbtn dropdown-active"><a href="<?php echo base_url('dashboard');?>">Dashboard</a></button>
      
           </div>
           <!---Browse Section-->
        <div class="col-auto dropdown m-1">
        <button class="dropbtn">Browse</button>
        <div class="dropdown-content">
            <?php if($usertype=="employer"){?>
           <a href="<?php echo base_url('browse-jobs');?>">Browse Jobs</a>
            <?php }else{?>
           <a href="<?php echo base_url('browse-jobs');?>">Browse Jobs</a>  
            <?php }?>
     
  </div>
           </div>  
            <!--Chat-section--> 
      <!---  <div class="dropdown mx-2">
    <a href="<?php echo base_url('/messages');?>">  <button type="dropbtn" style="border:none;outline:none;background: transparent;" class="position-relative">
          
  <img src="<?php echo base_url('/httpdocs/icons/chat.png');?>" style="height:25px;width:25px" >
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-danger">
    4
    <span class="visually-hidden">unread messages</span>
  </span>
</button></a>
        <div class="dropdown-content" style="width:300px">
            <p class="text-center mb-0" style="font-weight:bolder">Chats </p>
            <hr class="m-0">
            <?php for($i="2";$i<5;$i++){?>
             <a href="#" class="row d-flex jusify-content-around"><p class="col-3"><img src="<?php echo base_url();?>/httpdocs/logo-images/<?=$dp;?>" style="height:40px;width:auto;border-radius:50%" /></p>
             <p class="col-6">Message here(2)</p>
             <p class="col-3" style="font-size:10px"><?=$i." minutes ago";?></p>
             </a> 
            <?php }?>
    
  </div>
           </div>----->    
            <!--Notification-section--> 
       <!---  <div class="dropdown mx-2">
      <button type="dropbtn" style="border:none;outline:none;background: transparent;" class="position-relative">
  <img src="<?php echo base_url('/httpdocs/icons/notification.png');?>" style="height:25px;width:25px" >
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-danger">
    1
    <span class="visually-hidden">unread messages</span>
  </span>
</button>
        <div class="dropdown-content "  style="width:300px">
      <p class="text-center mb-0" style="font-weight:bolder">Notifications </p>
            <hr class="m-0">
            
    
  </div>
           </div> ---->
           <!--User Section--> 
        <div class="col-auto dropdown">
        <button class="dropbtn"><img src="<?php echo base_url();?>/httpdocs/logo-images/<?=$dp;?>" style="height:35px;width:35px;border-radius:50%;border:1px solid gray" /></button>
        <div class="dropdown-content">
            <?php if($usertype=="jobseeker"){;?>
            <a href="<?php echo base_url('/digital-resume');?>">Digital Resume</a>
            <?php }else{ ?>
            <a href="<?php echo base_url('dashboard/profile');?>">Profile</a>
 
            <?php }?>
    
    <a href="<?php echo base_url('dashboard/settings');?>">Settings</a>
  
     <a href="<?php echo base_url('logout');?>">Logout</a>
  </div>
           </div> 
           
           
        
        <!--Dropdownns-->
    </div><?php }?>
    </div>

    <div class="col-md-1 d-none d-md-block py-2" style="">
        <?php if($session->get('userdata')){?>
        <a class="btn btn-primary bg-theme  signup-btn  py-1 hover-white" 
        <?php if($subscribed=="1"){?> <?php }else{?> 
        data-bs-toggle="modal" data-bs-target="#pricingModal"<?php }?> style="font-size:14px;">
            
            <?php if($subscribed=="1"){?> Subscribed<?php }else{?>Premium <?php }?>
        </a>
        
        <?php }?>
    </div>
   
   <!-- <div class="col-md-0 d-md-none col-2 py-1">
      <span class="material-icons-outlined" style="font-size:30px;color:gray">
        account_circle
        </span>
    </div>-->
</div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <img src="<?php echo base_url();?>/httpdocs/images/glumos.png" class="img-fluid" style="width:100px" >
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled" style="width:90%">
            <li class="nav-item row d-flex justify-content-between nav-active"><span class="col-auto">Home</span> <span class="material-icons col-auto">chevron_right</span></li>
            
           
            
            <?php $session=session();
            if(!empty($session->get('userdata')['name'])){?>
            <li class="nav-item row d-flex justify-content-between"><span class="col-auto"><a href="<?php echo base_url('/Dashboard/logout');?>">Logout</a></span> <span class="material-icons col-auto">chevron_right</span></li>
            <?php }else{?>
            <li class="nav-item row d-flex justify-content-between"><span class="col-auto"><a href="<?php echo base_url('/Signin');?>">Signin</a></span> <span class="material-icons col-auto">chevron_right</span></li>
            <?php }?>
              
              
        </ul>
      </div>
     <!--- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>-->
    </div>
  </div>
</div>
<!-- Button trigger modal -->


<!--Premium Pricing modal Modal -->
<div class="modal fade" id="pricingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Premium subscription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row d-flex justify-content-around">
            <div class="col-5 pricing-card">
                <h4>Personal</h4>
                <p class="m-0 text-muted">Perfect Plan for starters </p>
                <h2 class="mt-5">Free</h2>
                <p class="m-0 text-muted" style="font-size:12px;">For lifetime</p>
                <a class="btn btn-primary my-3 w-100 bg-primary text-white">
                    Free continued
                </a>
                
                <ul class="w-75">
                    <li class="text-muted fw-bolder d=flex"><span  class="material-icons-outlined text-success v-mid">check</span><span class="v-mid" style="font-size:12px;">Browse from many pages</span></li>
                    <li class="text-muted fw-bolder"><span  class="material-icons-outlined text-success v-mid">check</span><span class="v-mid" style="font-size:12px;">Browse unlimited jobs.</span></li>
                    <li class="text-muted fw-bolder"><span  class="material-icons-outlined text-success v-mid">check</span><span class="v-mid" style="font-size:12px;">Apply for unlimited jobs</span></li>
                    <li class="text-muted fw-bolder"><span  class="material-icons-outlined text-success v-mid">check</span><span class="v-mid" style="font-size:12px;">Save Unlimited jobs</span></li>
                </ul>
                
            </div> 
            <div class="col-5 pricing-card-active">
                <h4 class="text-white">Personal</h4>
                <p class="m-0 text-white">Perfect Plan for starters </p>
                  <?php if($usertype=="employer"){?>
                  <h2 class="mt-5 text-white">$ 24.99/month</h2>
                  <?php }else{?>
                  <h2 class="mt-5 text-white">$ 0.99/month</h2>
                  <?php }?>
                <p class="m-0 text-white" style="font-size:12px;">For one month</p>
                <a class="btn btn-primary my-3 w-100 bg-primary text-white"  <?php if(!empty($session->get('userdata'))){?>  href="<?php echo base_url('/payment-process');?>" <?php }else{?>  href="<?php echo base_url('/login-now');?>"  <?php }?>>
                    Buy Now
                </a>
                <ul class="w-75">
                    <li class="text-white fw-bolder d=flex"><span  class="material-icons-outlined text-white v-mid">check</span><span class="v-mid" style="font-size:12px;">Browse from many pages</span></li>
                    <li class="text-white fw-bolder"><span  class="material-icons-outlined text-white v-mid">check</span><span class="v-mid" style="font-size:12px;">Browse unlimited jobs.</span></li>
                    <li class="text-white fw-bolder"><span  class="material-icons-outlined text-white v-mid">check</span><span class="v-mid" style="font-size:12px;">Apply for unlimited jobs</span></li>
                    <li class="text-white fw-bolder"><span  class="material-icons-outlined text-white v-mid">check</span><span class="v-mid" style="font-size:12px;">Save Unlimited jobs</span></li>
                    <li class="text-white fw-bolder"><span  class="material-icons-outlined text-white v-mid">check</span><span class="v-mid" style="font-size:12px;">Get Personalised  emails</span></li>
                </ul>
               
            </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
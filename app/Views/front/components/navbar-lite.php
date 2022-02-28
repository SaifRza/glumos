<style>
   body{

   }
   #budget1,#budget2{
       border-radius:20px;
   }
   .nav-link{
       background:#eee;
       height:40px;
       width:40px;
       border-radius:50%;
   }
   .clicker .active{
       background:blue;
   }
   .changer-buttons{
background: #0012ff;
color:white;
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 1px );
-webkit-backdrop-filter: blur( 1px );
border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );

   }
   .changer-box{
background: white;
color:black;       
   box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 1px );
-webkit-backdrop-filter: blur( 1px );
border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );    
   }
   .material-input{
       border:none;
       outline:none;
       border-bottom:2px solid gray;
       margin-top:10px;
   }
   .material-input:focus{
       border:none;
       outline:none;
       border-bottom:3px solid blue;
   }
   #basic-addon2,#basic-addon3{
       background:#eee;
        
   }
   .selected-check{
       border:1px solid blue;
   }
   .error
    {
      
      box-shadow: 0 0 0.5em red;
    }
    footer{
          position:fixed;
          width:100%;
          bottom:0;
          height:auto;
      }
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
     color:white;
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
        width:100px;
    }
    @media only screen and (max-width: 600px) {
  .logo-image{
        width:100px;
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
       width:94%;
       margin:auto;
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
   } 
   .hero-image{
       height:280px;
       margin:auto;
       margin-top:20px;
   }
   .hero-h1{
       text-align:center;
       font-weight:700;
       font-size:34px;
       margin:auto;
       margin-top:10px;
   }
   .hero-p{
     text-align:center;
       font-weight:500;
       margin:auto;
       font-size:13px;
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
.timeline-steps {
    display: flex;
    justify-content: center;
    flex-wrap: wrap
}

.timeline-steps .timeline-step {
    align-items: center;
    display: flex;
    flex-direction: column;
    position: relative;
    margin: 0.5rem
}

@media (min-width:768px) {
    .timeline-steps .timeline-step:not(:last-child):after {
        content: "";
        display: block;
        border-top: .25rem dotted #3b82f6;
        width: 3.46rem;
        position: absolute;
        left: 7.5rem;
        top: .3125rem
    }
    .timeline-steps .timeline-step:not(:first-child):before {
        content: "";
        display: block;
        border-top: .25rem dotted #3b82f6;
        width: 3.8125rem;
        position: absolute;
        right: 7.5rem;
        top: .3125rem
    }
}

.timeline-steps .timeline-content {
    width: 8rem;
    text-align: center
}

.timeline-steps .timeline-content .inner-circle {
    border-radius: 1.5rem;
    height: 1rem;
    width: 1rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #3b82f6
}

.timeline-steps .timeline-content .inner-circle:before {
    content: "";
    background-color: #3b82f6;
    display: inline-block;
    height: 2rem;
    width: 2rem;
    min-width: 2rem;
    border-radius: 6.25rem;
    opacity: .5
}
</style>
<!-----
<div class="bg-white shadow-lg mx-1 mt-2 py-2" style="margin:auto" >
<div class="row d-flex justify-content-start" style="width:90%;margin:auto">
    <div class="col-md-0 d-md-none col-2 py-1">
       <span class="material-icons theme-color" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            menu
            </span>
    </div>
    <div class="col-md-2 col-8 py-1 text-center m-auto">
        <img src="<?php echo base_url();?>/httpdocs/images/glumos.png" class="img-fluid logo-image" >
    </div>
    <div class="col-md-3 d-none d-md-block pt-2">
     <ul class="list-unstyled row d-flex">
         <li class="nav-item">
         <div class="input-group">
         <input type="text" class="form-control" placeholder="Search a Job" aria-label="Username" id="search-jobs" aria-describedby="basic-addon1" style="border-radius:20px 0px 0px 20px;"> 
         <span class="input-group-text bg-theme material-icons-outlined" id="basic-addon1" style="border-radius:0px 20px 20px 0px;">search</span>
         </div>  
         </li>
         
     </ul>   
    </div>
    <div class="col-md-3 d-none d-md-block pt-2">
        <ul class="list-unstyled row d-flex justify-content-around pt-2">
            <li class="nav-item col-auto header-item active">Freelancing Jobs</li>
            <li class="nav-item col-auto header-item ">Fulltime Jobs</li>
            <li class="nav-item col-auto  header-item ">About Us</li>
        </ul>
    </div>
    <div class="col-md-2 d-none m-auto d-md-flex justify-content-end">
        <a class="btn btn-primary btn-theme-hovered p-auto mx-1 "  href="<?php echo base_url('/Auth/login');?>">Login</a>
          <a class="btn btn-primary btn-theme p-auto mx-1" href="<?php echo base_url('/Auth/signup');?>">Signup</a>
    </div>
    
    <div class="col-md-0 d-md-none col-2 py-1">
      <span class="material-icons-outlined" style="font-size:30px;color:gray">
        account_circle
        </span>
    </div>
</div>
</div>--->
<!-- Button trigger modal -->


<!-- Modal -->
<!---
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <img src="<?php echo base_url();?>/httpdocs/images/glumos.png" class="img-fluid" style="width:100px" >
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled" style="width:90%">
            <li class="nav-item row d-flex justify-content-between nav-active"><span class="col-auto">Home</span> <span class="material-icons col-auto">chevron_right</span></li>
            
            <li class="nav-item row d-flex justify-content-between"><span class="col-auto">Browse Jobs</span> <span class="material-icons col-auto">chevron_right</span></li>
            
            <li class="nav-item row d-flex justify-content-between"><span class="col-auto">Freelancing Jobs</span> <span class="material-icons col-auto">chevron_right</span></li>
            
            <li class="nav-item row d-flex justify-content-between"><span class="col-auto">Full Time Jobs</span> <span class="material-icons col-auto">chevron_right</span></li>
            
            <li class="nav-item row d-flex justify-content-between"><span class="col-auto">About Us</span> <span class="material-icons col-auto">chevron_right</span></li>
              
              
        </ul>
      </div>
     <!--- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>-->
  <!--  </div>
  </div>
</div>--->
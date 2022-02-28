<style>
    .hoverable:hover{
       cursor:pointer;
   }
</style>
<div class="w-100 bg-light hero-view" >
    <div class="row  d-flex justify-content-center flex-row-reverse m-auto section-content" >
        <div class="col-md-6 col-12 m-auto text-center">
            <img src="<?php echo base_url();?>/httpdocs/images/jumbo-img3.png" class="img-fluid hero-image">
        </div>
        <div class="col-md-6 col-12 m-auto jumbo-text" style="">
            <div class="py-1">
            <p class="alert alert-success p-1 m-0 shadow-sm text-dark" style="width:130px;font-size:13px;border-radius:10px">Looking for a Job ?</p></div>
            <h1 class="hero-h1">Find freelance and fulltime developer jobs.</h1> 
        <p class="hero-p w-100" style="color:gray">Glumos is a developer talent marketplace. Just try finding the perfect developer jobs for you</p>
    
    
        <form method="POST" id="searchJobs">
        <div class="row d-flex justify-content-center card-class">
      
         
           <div class="col-md-10 col-9">
          <div class="input-group">
         <input type="text" class="form-control search-jobs" class="text-capitalize" name="job_name" placeholder="Search a Job" aria-label="Username" id="search-jobs" <?php if($_GET['tabVal']=="1"||empty($_GET['tabVal'])){?> onchange="updateSearchButton()"   <?php } ?> style=""> 
         
         </div>       
            </div>
            
            <div class="col-md-2 col-3 btn btn-primary  bg-theme hoverable px-2 pt-2">
               <span class=" id="btnwa" style="" <?php if($_GET['tabVal']=="1"||empty($_GET['tabVal'])){?> onclick="loadData('Software')" <?php }else{?> onclick="find()"  <?php }?>>Search</span>
            </div>
            
            
         
        </div>
          </form>
        
        </div>
    </div>
</div>  

<div class="filter-buttons">
    
</div>    
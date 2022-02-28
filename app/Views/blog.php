<?= $this->extend('layout/main')?>

<?=$this->section('content')?>
<?=$this->include('partials/navbar')?>
<div class="page-content text-white p-1" id="content" style="margin-top:70px;overflow-y:scroll;">
 
 <div class="d-md-flex justify-content-around col-12 m-auto">
     <div class="col-md-6 m-auto">
         <div class="congratulations-card p-1 text-center">
            <h4>Congratulations ,
             Syed Saif </h4> 
             <p>You have done 57.6% more sales today. Check your new badge in your profile.</p>
         </div>
     </div>
     <div class="col-md-6 row d-md-flex justify-content-around  m-auto w-100">
        
        <div class="col-12 col-md-6 m-auto  p-1">
             <div class="general-card p-2">
                 <div class="bg-upper mt-5">
                  <div class="ml-5">
                      <span class="material-icons" height="50" width="50" style="background:rgb(221,160,221);color:white;border-radius:50%;padding:5px">
                          group
                      </span>
                  </div>   
                 </div>
                 <div class="bg-lower">
                <div id="curve_chart1" ></div>   
                 </div> 
             </div>
         </div>

         <div class="col-12 col-md-6 m-auto  p-1">
             <div class="general-card p-2">
                 <div class="bg-upper mt-5">
                  <div class="ml-5">
                      <span class="material-icons" height="50" width="50" style="background:rgb(221,160,221);color:white;border-radius:50%;padding:5px">
                          group
                      </span>
                  </div>   
                 </div>
                 <div class="bg-lower">
                <div id="curve_chart2"></div>   
                 </div> 
             </div>
         </div>
       
       
     </div>
 </div>
 
  <div class="d-md-flex justify-content-around mt-3 col-12" style="margin:auto">
     <div class="col-md-6 m-auto m-2">
        <div class="general-card d-md-flex justify-content-betwee text-dark p-1 text-center" style="height:auto">
        <div class="col-md-6 text-left">
            <h3>2.7k</h3>
            <p class="text-gray">Avg Sessions</p>
            <p class="text-gray mt-5"><span class="text-success">+5.2%</span> vs last 7 days</p>
            <a class="mt-5 btn btn-primary text-white w-100">View Details</a>
            <hr>
            <div class="">
            Users
            <div class="progress">
  <div class="progress-bar w-75 bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>
Locals
<div class="progress">
  <div class="progress-bar w-50 bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>
        </div>
        
       
        </div>
        <div class="col-md-6 d-none d-md-block  text-right">
            <p class="text-gray">Last 7 days</p>
            <div class="mt-5" id="chart_div_column"></div>
            <hr>
            <div class="">
            Users
            <div class="progress">
  <div class="progress-bar w-25 bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>

        </div>
        </div>
       
     
        
         </div>
     </div>
     <div class="col-md-6 m-auto m-2">
         <div class="general-card d-md-flex justify-content-betwee text-dark p-2 text-center" style="height:auto;">
        <div class="col-md-4 text-left">
            <p class="text-dark">Support Tracker</p>
            <h3>163</h3>
            <p class="text-gray">Tickets</p>
            <hr>
             <hr>
           Activities
             <div class="progress">
                 
  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>   
            
        </div>
        <div class="col-md-8 d-none d-md-block text-right">
            <p class="text-gray">Last 7 days</p>
            <!----<div class="mt-5" id="donutchart1" ></div>-->
            <div class="mt-5" id="donutchart1" ></div>
           <hr>
           
              Bookings 
              <div class="progress">
  <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>   
            
        </div>
        
        
               
</div>
            
        
         </div>
     </div>
     
   <div class="d-md-flex justify-content-around mt-5 col-12 " style="margin:auto">
     <div class="col-md-4 m-auto m-2" >
        <div class="general-card d-flex justify-content-betwee text-dark p-3 text-center" style="height:auto;">
        <div class="row col-12 d-flex justify-content-between  text-gray fw-lighter">
         <h5 class="text-left col-2 text-gray mx-auto"><span class="material-icons ">list</span></h5> 
         <h5 class="text-left col-8 text-gray align-middle mx-auto">Messages</h5>
         <h5 class="text-right col-2 mx-auto"><span class="material-icons">more_vert</span></h5>
        </div>
       
     
        
         </div>
     </div>
     
     <div class="col-md-4 m-auto m-2"  style="">
         <div class="general-card d-flex justify-content-betwee text-dark p-3 text-center" style="height:auto;">
         <div class="row col-12 d-flex justify-content-between  text-gray fw-lighter">
         <h5 class="text-left col-2 text-gray mx-auto"><span class="material-icons ">point_of_sale</span></h5> 
         <h5 class="text-left col-8 text-gray align-middle mx-auto">Sales</h5>
         <h5 class="text-right col-2 mx-auto"><span class="material-icons">more_vert</span></h5>
        </div>
        
        
               
        </div>
            
        
         </div>
         
     <div class="col-md-4 m-auto m-2"  style="">
         <div class="general-card d-flex justify-content-betwee text-dark p-3 text-center" style="height:auto;">
        <div class="row col-12 d-flex justify-content-between  text-gray fw-lighter">
         <h5 class="text-left col-2 text-gray mx-auto"><span class="material-icons ">dvr </span></h5> 
         <h5 class="text-left col-8 text-gray align-middle mx-auto">Orders</h5>
         <h5 class="text-right col-2 mx-auto"><span class="material-icons">more_vert</span></h5>
        </div>
        
        
               
        </div>
            
        
         </div>     
         
     </div>     
     
     
 

</div>



<?= $this->endSection();?>
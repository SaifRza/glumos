<style>
    .cool-input{
     border:none;
     outline:none; 
     padding:5px;
     background:#eee;
     border-radius:10px;
     color:black;
    }
    .cool-input::hover{
     border:none;
     outline:none; 
     padding:5px;
    }
    .fav-bg{
            background: #012bff;
            color:white;
    }
    .fav-boder{
        border:1px solid  #012bff; 
    }
    .fav-text{
       color:#012bff;; 
    }
    .material-input{
     border:none;
     outline:none;
     width:100%;
     height:40px;
     padding:10px;
     box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
     border-radius:10px;
    }
    .fav-col{
        color:rgb(2, 27, 121);
    }
    .bg-grad1{
    background: linear-gradient(to right, rgb(5, 117, 230), rgb(2, 27, 121));
    }
    .bg-grad2{
    background: linear-gradient(to right, rgb(55, 59, 68), rgb(66, 134, 244));
    }
    .shadow-1{
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
     border-radius:10px;  
    }
     .material-icons, .icon-text {
      vertical-align: middle;
      font-weight:500;}
    .company-logo{
        height:90px;width:90px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        border-radius:6px; 
    }
    .badge .material-icons{
        font-size:12px;
    }
    .badge .icon-text{
        font-size:12px;
    }
    .badge{
        border-radius:10px;
    }
    .badge-warning{
        background-color:orange;
    }
    .badge-success{
        background-color:green;
    }
    .badge-info{
        background-color:skyblue;
    }
    .alter{
        color:black;
        font-weight:700;
    }
    .actives{
       color:#020bff;  
    }
    .alter:hover{
        color:#020bff;
        cursor:pointer;
    }
</style>
<?php 
;?>
<div class="browse-section">
 <!----   
<div class="search-card bg-white py-auto px-3 d-none d-md-block shadow-lg" style="width:80%;">
<p class="m-0">Try Searching a Job</p>
   <div class="row d-flex justify-content-around py-3">
       <div class="col-5">
    <div class="input-group mb-3">
  <span class="material-icons-outlined input-group-text" id="basic-addon2">search</span>
  <input type="text" class="form-control" placeholder="Type Keywords or a skill" aria-label="Search your Skill" aria-describedby="basic-addon2">
    </div>
    
    
       </div>
       <div class="col-2">
           <div class="input-group mb-3">
  <span class="material-icons-outlined input-group-text" id="basic-addon3">room</span>
  <input type="text" class="form-control" placeholder="Select Location" aria-label="Search your Skill" aria-describedby="basic-addon3">
    </div>
       </div>
       <div class="col-2">
        <p  class="btn btn-success w-100">Searh Now</p>
       </div>
       <div class="col-2">
        <p  class="btn btn-primary w-100">Create Job Alert</p>
       </div>
   </div> 
</div>  -->
 <?php
 $uri = current_url(true);
 
 ?>

<div class="row  d-flex justify-content-around surfing-area" >
  <div class="row d-flex py-2 bg-white">
    <div class="col-auto">
        <a href="<?php if(empty($uri->getSegment(2))){ echo base_url()."?tabVal=1"; }else{ echo base_url('browse-jobs')."?tabVal=1"; };?>"><span class="alter <?php echo $_GET['tabVal']=="1"? 'actives': '' ?>" id="all-jobs">External Jobs</span></a>
    </div>
    <div class="col-auto">
       <a href="<?php if(empty($uri->getSegment(2))){ echo base_url()."?tabVal=2"; }else{ echo base_url('browse-jobs')."?tabVal=2"; };?>"> <span class="alter <?php echo $_GET['tabVal']=="2"? 'actives': '' ?>" id="featured-jobs">Glumos Jobs</span></a>
    </div>
    <div class="col-auto">
       <?php   $session=session();
  $usertype=$session->get('userdata')['usertype'];?>
       <a <?php if(isset($usertype)){?> href="<?php if(empty($uri->getSegment(2))){ echo base_url()."?tabVal=3"; }else{ echo base_url('browse-jobs')."?tabVal=3"; };?>"  <?php }else{?> href="<?php echo base_url('/login-now');?>"  <?php }?>> <span class="alter <?php echo $_GET['tabVal']=="3"? 'actives': '' ?>" id="saved-jobs-open">Saved Jobs</span></a>
    </div>
</div> 
<!--- 
   <div class="col-12  d-flex justify-content-around d-md-none py-1 pt-0">
       <div class="col-10 pt-2 px-2 bg-white"><span class="material-icons">sort </span> All types of Jobs</div>
       <div class="col-2 btn btn-primary"><span class="material-icons">filter_alt</span></div>
</div> 
--->

 <!--Search Sections ---->
 <?php
 $uri = current_url(true);
 
 ?>
  <?php if(!empty($uri->getSegment(2))){?>
 <form method="POST" id="searchJobs">
  <div class="row d-flex justify-content-around d-none d-md-flex">
    <div class="col-9 py-2 px-1   hero-p"><input type="text" placeholder="search-jobs" class="material-input shadow-none"  name="job_name" style="" <?php if(empty($_GET['tabVal'])||$_GET['tabVal']=="1"){ ?> id="search-jobs" onchange="updateSearchButton()"  <?php }?> ></div> 
    <!--- <div class="col-3 py-2 px-1">
         <select class="form-select form-select-md material-input mb-3" aria-label=".form-select-lg example" name="type">
          <option selected value="1">Freelancer</option>
          <option value="2">Fulltime</option>
        </select>
</div>--->
    <div class="col-3 py-2 px-1"><button type="button" class="btn btn-primary w-100 bg-grad1 text-white" <?php if($_GET['tabVal']=="1"||empty($_GET['tabVal'])){?> onclick="loadData('Block Chain','1','10')" <?php }else{?> onclick="find()"  <?php }?> id="btnwa">Search</button>

    </div>
  </div>
  </form>
  
  <?php }?>
 <!---Search Man--->
    
 <div class="col-md-9">
      <div class="row d-flex justify-content-center d-none" id="paginator">
  ghghghghghghghhghg
       </div>
   <div id="" class="text-primary fw-bolder">
      <h4 id="coutedResults"></h4>
  </div>    
  
  <div class="m-0" style="">
      
 <?php 
 if($_GET['tabVal']=="1"||$_GET['tabVal']==""){?> 
  <div id="all-jobs-here" > 
<div id="list-jobs">
      <!---<button type="button" onclick="getApiNow()" class="btn btn-primary w-100 bg-grad1 text-white">Load Data</button>-->
    
   <div id="img-loader" class="loader" style="width:200px">
       
   </div> 
</div>
  
  </div>
 
   
  <?php }
  elseif($_GET['tabVal']=="2"){?>
  <div id="featured-jobs-list" style="">
      <?php 
      date_default_timezone_set('Asia/Kolkata');
      $today=date_create(date('Y-m-d H:i:s'));
  foreach($allJobs as $jobs){
$interval = date_diff(date_create($jobs->post_time),$today);

  ?>

    
<div class="p-2 rounded bg-white my-2">
    <div class="row d-flex pt-2 justify-content-around">
        <div class="col-md-auto col-12">
            <?php $jobs->logo_img==""?$logo_url='/httpdocs/logo-images/default_company.png':$logo_url='/httpdocs/logo-images/'.$jobs->logo_img;?>
            <img src="<?=base_url($logo_url);?>" style="width:80px;height:80px;">
        </div> 
        <div class="col-md-6 col-9 text-left">
            <p class="m-0 text-muted"><?=$jobs->name;?></p><h4 class="m-0 fav-col fw-bolder"><?= $jobs->job_heading;?></h4><p class="m-0 text-muted">Location : N/A</p>
        </div> 
        <div class="col-md-3 d-none d-md-block text-right d-flex justify-content-end">
         <p class="m-0 text-muted text-right" style="font-size:14px;"> 
       <?php if($jobs->requirement_type=="1"){?>
             Posted <?=$interval->format('%R%a days');?>
             <?php }else{?>
             Posted <?=$interval->format('%R%a days');?>
             <?php }?>
             </p>
        </div>
        
    </div> 
     <?php
  
      if($jobs->complete_rate==""){
          $rate=0;
      }else{
          if($jobs->wage_type=="1"){
              $rate="/hour";
          }elseif($jobs->wage_type=="2"){
              $rate="/day";
          }elseif($jobs->wage_type=="3"){
              $rate="/week";
          }elseif($jobs->wage_type=="4"){
              $rate="/month";
          }
      }
 
  ?>   
    <div class="row d-flex mt-2 mx-3"> 
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >schedule</span><span class="icon-text"><?=$jobs->requirement_type=="1"?'Freelance':'Fulltime';?></span></p>
    </div>
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >attach_money</span><span class="icon-text"  > <?=$jobs->complete_rate<1?$jobs->hourly_rate.$rate:$jobs->complete_rate  ;?></span></p>
    </div>
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >work</span><span class="icon-text"  >Experience :<?php  if($jobs->experience_type=="1"){ echo "Expert";}elseif($jobs->experience_type=="2"){ echo "Intermediate";}else{ echo "Beginner";}?></span></p></div>
    </div>  
    
    <div class="py-3" style="max-height:100px">
        <ul class="ul-3">
         <?=substr($jobs->job_description,0,200).".....";?>
        </ul>
    </div>  
    
    <div class="row d-flex justify-content-around mx-0">
        <div class="col-7 my-auto">
          <!---  <p class="text-muted my-auto">0 applicants</p>-->
        </div>
        <div class="col-2 my-auto btn btn-primary bg-white fav-border fav-text  px-2 py-1" style="">
            <a class="fav-text"  <?php if(isset($usertype)){?> onclick="saveJob('<?=$jobs->find_by;?>')"  <?php }else{?> href="<?php echo base_url('/login-now');?>" <?php }?>   >Save Job</a>
        </div>
        <div class="col-2 my-auto btn btn-info fav-bg text-white px-2 py-1"  style="">
            <a class="text-white" href="<?php echo base_url('jobview');?>/<?=$jobs->find_by;?>" target="_blank">Apply Now
            </a>
        </div>
    </div>  
    
</div>    
      
  <?php } ?>
  </div>
  <?php ?>
  
  <?php 
    }elseif($_GET['tabVal']=="3"){?>
  <div id="saved-jobs">
   <?php 
      date_default_timezone_set('Asia/Kolkata');
      $today=date_create(date('Y-m-d H:i:s'));
  foreach($savedJobs as $jobs){
$interval = date_diff(date_create($jobs->post_time),$today);

  ?>

    
<div class="p-2 rounded bg-white my-2">
    <div class="row d-flex pt-2 justify-content-around">
        <div class="col-auto">
            <?php $jobs->logo_img==""?$logo_url='/httpdocs/logo-images/default_company.png':$logo_url='/httpdocs/logo-images/'.$jobs->logo_img;?>
            <img src="<?=base_url($logo_url);?>" style="width:80px;height:80px;">
        </div> 
        <div class="col-6 text-left">
            <p class="m-0 text-muted"><?=$jobs->name;?></p><h4 class="m-0 fav-col fw-bolder"><?= $jobs->job_heading;?></h4><p class="m-0 text-muted">Location : N/A</p>
        </div> 
        <div class="col-3 text-right d-flex justify-content-end">
         <p class="m-0 text-muted text-right" style="font-size:14px;"> 
       <?php if($jobs->requirement_type=="1"){?>
             Posted <?=$interval->format('%R%a days');?>
             <?php }else{?>
             Posted <?=$interval->format('%R%a days');?>
             <?php }?>
             </p>
        </div>
        
    </div> 
     <?php
  
      if($jobs->complete_rate==""){
          $rate=0;
      }else{
          if($jobs->wage_type=="1"){
              $rate="/hour";
          }elseif($jobs->wage_type=="2"){
              $rate="/day";
          }elseif($jobs->wage_type=="3"){
              $rate="/week";
          }elseif($jobs->wage_type=="4"){
              $rate="/month";
          }
      }
 
  ?>   
    <div class="row d-flex mt-2 mx-3"> 
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >schedule</span><span class="icon-text"><?=$jobs->requirement_type=="1"?'Freelance':'Fulltime';?></span></p>
    </div>
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >attach_money</span><span class="icon-text"  > <?=$jobs->complete_rate<1?$jobs->hourly_rate.$rate:$jobs->complete_rate  ;?></span></p>
    </div>
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >work</span><span class="icon-text"  >Experience :<?php  if($jobs->experience_type=="1"){ echo "Expert";}elseif($jobs->experience_type=="2"){ echo "Intermediate";}else{ echo "Beginner";}?></span></p></div>
    </div>  
    
    <div class="py-3">
        <ul class="mx-3">
         <?=substr($jobs->job_description,0,200).".....";?>
        </ul>
    </div>  
    
    <div class="row d-flex justify-content-around mx-0">
        <div class="col-7 my-auto">
          <!---  <p class="text-muted my-auto">0 applicants</p>-->
        </div>
        <div class="col-2 my-auto fav-text  px-2 py-1" style="">
           
        </div>
        <div class="col-2 my-auto btn btn-info fav-bg text-white px-2 py-1"  style="">
            <a class="text-white" href="<?php echo base_url('jobview');?>/<?=$jobs->find_by;?>" target="_blank">Apply Now
            </a>
        </div>
    </div>  
    
</div>    
      
  <?php } ?> 
  </div>
   <?php }?>
   
   <!------Pagination Buttons-->
   <div class="row d-flex justify-content-center">
       <div class="col-auto">
           <a class="btn btn-secondary" onclick="callList(0,0,10)" id="btn-0">Pre</a>
       </div>
       <div class="col-auto">
           <a class="btn btn-secondary" onclick="callList(1,10,20)"  id="btn-1">1</a>
       </div>
       <div class="col-auto">
           <a class="btn btn-secondary" onclick="callList(2,20,30)"  id="btn-2">2</a>
       </div>
       <div class="col-auto">
           <a class="btn btn-secondary" onclick="callList(3,30,40)"  id="btn-3">3</a>
       </div>
       <div class="col-auto">
           <a class="btn btn-secondary" onclick="callList(4,40,50)"  id="btn-4">Next</a>
       </div>
   </div>
   <!---Pagination Buttons Ends--->
 </div> 
 
 
 </div>
 <div class="col-md-3">
   
<form method="POST" id="filter-form"> 
<input type="hidden" name="category" value="<?php if($_GET['tabVal']=="1"||empty($_GET['tabVal'])){ echo 1;}else{ echo 2;}?>">
<div class="py-3"> 
 <div class="bg-white rounded py-3 px-3">
     <p class="text-dark m-0 mx-2 fw-bolder">Sort by</p>
     <div class="row d-flex justify-content-start px-1">
         <div class="col-auto">
             <div class="form-check">
  <input class="form-check-input" type="radio" name="sorter" id="flexRadioDefault2" checked  onchange="submitFilter()" value="1">
  <label class="form-check-label text-muted" for="flexRadioDefault2">
    Date Posted
  </label>
</div>
         </div>
         <div class="col-auto">
             <div class="form-check">
              <input class="form-check-input" type="radio" name="sorter" id="flexRadioDefault1" onchange="submitFilter()" value="0">
              <label class="form-check-label text-muted" for="flexRadioDefault1">
                Salary
              </label>
            </div>
         </div>
     </div>
 </div>
</div>

<!---Filters-main-->

<div class="bg-white rounded py-3 px-3 text-muted">
     <p class="text-muted m-0 mx-2 fw-bolder">Filters</p>
     <p class="text-muted  mx-2 my-2">Experience Level</p>
     <div class="form-check mx-2">
      <input class="form-check-input" type="radio" name="experience" onchange="submitFilter()" value="1" id="flexCheckDefault1" >
      <label class="form-check-label" for="flexCheckDefault1">
        Expert
      </label>
    </div>
    <div class="form-check mx-2">
      <input class="form-check-input" type="radio" name="experience" onchange="submitFilter()" value="2" id="flexCheckDefault2">
      <label class="form-check-label" for="flexCheckDefault2">
        Intermediate
      </label>
    </div>
    <div class="form-check mx-2">
      <input class="form-check-input" type="radio" name="experience" onchange="submitFilter()" value="3" id="flexCheckDefault2">
      <label class="form-check-label" for="flexCheckDefault2">
        Beginer
      </label>
    </div>
  
     
      <p class="text-muted  mx-2 my-2 mt-5">Job Type</p>
     <div class="form-check mx-2">
      <input class="form-check-input" type="radio" name="location" onchange="submitFilter()" value="1" id="flexCheckDefault1" >
      <label class="form-check-label" for="flexCheckDefault1">
       Freelance
      </label>
    </div>
    <div class="form-check mx-2">
      <input class="form-check-input" type="radio" name="location" onchange="submitFilter()" value="2" id="flexCheckDefault2">
      <label class="form-check-label" for="flexCheckDefault2">
        Fulltime
      </label>
    </div>
    <div class="form-check mx-2">
      <input class="form-check-input" type="radio" name="location" onchange="submitFilter()" value="3" id="flexCheckDefault2">
      <label class="form-check-label" for="flexCheckDefault2">
        Both
      </label>
    </div>
    
    
      
      
    
 </div>
</form>

 </div>
</div>


</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <script src="<?php echo base_url();?>/httpdocs/js/browse-jobs.js"></script>
       <script>
       callList(1,0,10);
       function callList(h,i,j){
           //alert("From " +i+ " to " +j+ "at button" +h);
           
           $(".btn-secondary").removeClass('btn-info');
           $("#btn-"+h).addClass('btn-info');
           
           //When Next is Pressed
           
       }
       function saveJob(i){
           //alert(i);
             $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('save-job')?>",
                        data: {'job_id':i}, 
                        success : function(response){
                         var resp=JSON.parse(response);
                         if(resp.statuse==true){
                         $.toast({
                            heading: 'Saved Successfully',
                            text: resp.message,
                            icon: 'success',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600',  // To change the background
                            position:'top-right'
                        });
                         }else{
                          $.toast({
                            heading: 'Failed to Save',
                            text: resp.message,
                            icon: 'info',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600',  // To change the background
                            position:'top-right'
                        });     
                         }
                         },
                        error : function(data,textStatus,errorMessage){
                         
                        }
                    });
       }
       
       function updateSearchButton(){
          var search=$("#search-jobs").val();
          var clicker="loadData('"+search+"','1','10')";
          $("#btnwa").attr("onclick",clicker);
       }
       
       function submitFilter(){
         
           var queryString=$("#filter-form").serialize();
      
         if(queryString.indexOf('?') > -1){
                        queryString = queryString.split('?')[1];
                    }
                    var pairs = queryString.split('&');
                    var result = {};
                    pairs.forEach(function(pair) {
                        pair = pair.split('=');
                        result[pair[0]] = decodeURIComponent(pair[1] || '');
                    });
       //db-ajax-->request
              $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('filter-jobs')?>",
                        data: result, 
                        success : function(response){
                         var resp=JSON.parse(response);
                        $("#coutedResults").fadeIn('slow').text("Found " +resp.results+ " matching results  with  '"+resp.title+ "'")
                      $("#featured-jobs-list").fadeIn('slow').html(resp.data);
                         },
                        error : function(data,textStatus,errorMessage){
                         
                        }
                    });
       
       
       
                    
       }
      
       function findSalary(){
           alert("gellp");
       }
      loadData('a','1','10'); 
      
      function getApiNow(){
         alert("hello");
        $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('browse/getApi')?>/",
                         
                        success : function(response){
                          console.log(response);
                          },
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });
 }
      
      
      
  function loadData(i,start,end){
           var img_url='<?php echo base_url('/httpdocs/logo-images/case-image.png');?>';
         // alert(start); 
          if(i==""){
              var str="software";
              
          }else{
              var str=i;
             
              
          }
          //alert(str);
          var encoded = encodeURIComponent(str);
          document.getElementById('list-jobs').innerHTML='<div id="img-loader"></div>';
         var loader=document.getElementById('img-loader');
         loader.innerHTML='<img src="https://i.pinimg.com/originals/76/77/ed/7677edd5a44b10130b8824ca020ba60b.gif" style="width:95%;height:auto;margin:auto">'
        $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('graphJobs')?>/"+encoded,
                         
                        success : function(response){
                             
                     var resp=JSON.parse(response);
                
                      console.log(resp);
                      //   $("#list-jobs").append(response);
                     var info=resp;
            

var datas = info.filter( jobs => String(jobs.position).match(str));

$("#paginator").html('<span>'+datas.length+'  Total Matched with '+str+' </span>'); 
//Paginating buutons
for (let i = 1; i < datas.length/10; i++) {

loadFnc="loadData('a',"+i*10+","+i*11+")";
var pageButtons ='<div class="col-auto p-2 bg-light text-center" style="width:60px;" onclick="'+loadFnc+'" id="page-'+i+'">'+i+'</div>';
$("#paginator").append(pageButtons);

}

var data_filter=datas.slice(start,end);

Object.values(data_filter).forEach((val) => {
      if(val){
           if(val.company_logo){
              var logo=val.company_logo; 
           }else{
               var logo=img_url;
           }
           var tagid="taga-"+val.id;
          
           
  
           
            const box='<div class="p-2 rounded bg-white my-2"><div class="row d-flex pt-2 justify-content-between"><div class="col-md-2 col-12"><img src="'+logo+'" style="height:auto;max-height:100px;width:auto; max-width:120px;" class="my-auto"></div><div class="col-md-8 col-12 text-left"><p class="m-0 text-muted">'+val.company+'</p><h4 class="m-0 fav-col fw-bolder">'+val.position+'</h4><p class="m-0 text-muted">Location : '+val.location+'</p></div><div class="col-md-2 d-none d-md-block text-right d-flex justify-content-end"> <p class="m-0 text-muted text-right" style="font-size:14px;"> '+new Date(val.date).toDateString()+' </p></div></div> <div class="row d-flex mt-2 mx-3"><div class="col-auto"><p class="m-0 text-muted fw-bolder" ><span class="icon-text"><span class="badge bg-success">'+val.tags[0]+'</span> <span class="badge bg-success">'+val.tags[1]+'</span><span class="badge bg-success">'+val.tags[2]+'</span>  </span></p></div></div>  <div class="py-3" style="max-height:120px><ul class="ul-3">'+val.description.split(".")[0]+'</ul> </div>  <div class="row d-flex justify-content-end mx-2"><div class="col-7 my-auto"><p class="text-muted my-auto"></p></div><div class="col-2 my-auto btn  px-2 py-1" style=""></div><div class="col-md-2 col-6 my-auto btn btn-info fav-bg text-white px-2 py-1"  style=""><a class="text-white" href="'+val.apply_url+'" target="_blank">Apply Now</a></div></div></div>';
            $("#list-jobs").append(box);
       }else{
           const box='<h3>No Results Matches</h3>'
           $("#list-jobs").append(box);
       }
      });
                             $("#img-loader").hide();
                              
                           
                           
                           
                       
                        },
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });
 }
            function find(){
     var queryString=$("#searchJobs").serialize();
      
       if(queryString.indexOf('?') > -1){
                        queryString = queryString.split('?')[1];
                    }
                    var pairs = queryString.split('&');
                    var result = {};
                    pairs.forEach(function(pair) {
                        pair = pair.split('=');
                        result[pair[0]] = decodeURIComponent(pair[1] || '');
                    });
                    
       
       var stringed= JSON.stringify(result);
       //alert(stringed);
        $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('search-job') ?>",
                        data:result,  
                        success : function(response){
                        var resp=JSON.parse(response);
                      $("#coutedResults").fadeIn('slow').text("Found " +resp.results+ " matching results  with  '"+resp.title+ "'")
                      $("#featured-jobs-list").fadeIn('slow').html(resp.data);
                        /* if(i!=5){
                           if(resp.response==true){
                              window.location.href=passurl;
                           }
                        }
                        else{
                           if(resp.response==true){
                               window.location.href="<?php echo base_url('/Dashboard/previewJobs/');?>/<?= $find_by ;?>";
                           } 
                        } */
                        },
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });
 }
       </script>
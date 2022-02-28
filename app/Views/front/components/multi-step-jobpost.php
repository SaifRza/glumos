<?php
$add_temp_url=base_url('/add-template');
// print_r($jobInfo);
$allTmp=count($myTemplates);
foreach($myTemplates as $mytempla){
    $mytemp.='<option value="'.$mytempla->template_id.'">'.$mytempla->template_name.'</option>';
}
?>
<style>
body{
    background:#eee;
}
a:hover{
    color:green;
}
.nav-btns{
    margin-top:200;
}
.rounded-btn{
    border-radius:30px;
    width:100px;
}
.next-btn{
    background:#012bff;
    color:white;
}
.prv-btn{
   background:white;
    color:#012bff; 
    border:2px solid #012bff;
}
   
    #tags {
    width:100%,
    color:red
}
   
    .blue-ball{
        background-color:#012bff;
    }
    .hr{
        position:relative;
        border-top:4px solid #bebebe;
         margin-top:30px;
       
    }
    .hr-border{
        border-top:4px solid #012bff;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
     background-color: #012bff;
      color:white;
      font-weight:500;
      padding:5px;
      border-radius:20px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
      background-color: #012bff;
      color:white;
      font-weight:500;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
       background-color: #012bff;
      color:white;
      
    }
</style>
<?php if($allTmp<1){?>
<!---Zero Template Case-->

<div class="bg-white shadow-lg m-auto   py-5 mt-5 text-center px-5" style="width:35%">
  <h4 class="text-center">Please Add Tests to proceed</h4>
  <p class="text-muted">Tests help you to add question when you post a job . It is helpful to find out the perfect candidate.</p>
  <a class="mt-5 btn btn-primary text-white" href="<?=$add_temp_url;?>">Add Test</a>
 
</div>

<?php }else{?>


<div class="w-100">
    <div class="d-md-none mt-3">.</div>
<div class="m-auto pag-btns">
    <?php 
$session=session();
$find_by=$session->get('job_find_by');
//print_r($ses_find_by);
    
if(isset($_GET['tabval'])){
$tab=$_GET['tabval']; 
}else{
    $tab="1";
}
    ?>
<div class="row d-flex justify-content-center">
    <?php for($i=1;$i<6;$i++){?>
    <div class="col-auto row d-flex justify-content-around">
        <?php if($i!="1"){?>
       <div class="col-3 hr <?php if($tab>=$i){?> hr-border <?php }?>"></div>
       <?php }?>
    <div class="col-3 balls mt-3 pt-2 <?php if($tab==""||$tab==$i||$tab>$i){?> blue-ball <?php }?>" style="text-align:center;vertical-align:center;" onclick="clickedon(<?= $i;?>)" >
       <a class="text-white" href="<?php echo base_url('post-job');?>?tabval=<?= $i;?>"><?= $i;?></a> 
    </div>
     <?php if($i!="5"){?>
    <div class="col-3 hr <?php if($i<$tab){?> hr-border <?php }?>"></div>
    <?php }?>
    </div>
    <?php }?>
</div>
  
 
       <?php for($q=1;$q<6;$q++){
      
$str="AngularJS Developer,
AWS Developer,
C# Developer,
C++ Developer,
CSS Developer,
Data Analyst,
Data Visualization Consultant,
DevOps Engineer,
eCommerce Developer,
Front End Developer,
Full Stack Developer,
Game Developer,
Golang Developer,
HTML5 Developer,
Machine Learning Engineer,
Magento Developer,
Mobile App Developer,
MySQL Developer,
Php Developer,
Python Developer,
React Native Developer,
ReactJs  Developer,
Ruby Developer,
Ruby on Rails Developer,
Rust Developer,
Scala Developer,
Shopify Developer,
Software Engineer,
Software QA Tester,
Unity 3D Developer,
Vue JS Developer,
Web Developer,
WordPress Developer,
2D Animator,
3D Designer,
Amazon FBA Specialist,
Conversion Rate Optimizer,
Copywriters,
Data Entry Specialist,
Data Scraper,
Database Programmer,
Digital Marketer,
Graphic Designer,
Microsoft Access Consultant,
Network Engineer,
Power BI Consultant,
Product Manager,
Product Marketer,
Project Manager,
Salesforce App Developer,
Software Developer
SEO Expert,
Tableau Expert,
Translator,
UI Designer,
UX Designer,
Web Designer,
Chatbot Service,
Cybersecurity & Data Protection Service,
Data Analysis & Report Service,
Database Service,
Desktop Application Service,
Development for Streamer Service,
eCommerce Development Service,
File Conversion Service,
Game Development Service,
Mobile App Development Service,
Online Coding Lesson,
QA Service,
Support & IT Service,
User Testing Service,
Web Programming Service,
Website & CMS Software Service,
WordPress Development Service,
Digital Marketing,
gramming & Tech,
WordPress";
$title_array=explode(",",$str);
$options="";
foreach($title_array as $title){
     $options.='<option value="'.$title.'">'.$title.'</option>'; 
    }
       if($q=="1"){ $question="Let's Start with the type of job you are posting"; $comment="This question can be used to decide whether you would like to hire a freelancer or fulltime jobseeker depending on your job's need"; 
       $content='<h5 class="content-q qt-5">What is the type of your Job ?</h5>
       <form method="post" id="form-'.$q.'">
       '.($jobInfo->requirement_type==""?'<select name="job_type" class="form-select form-select mb-3 mt-1" aria-label=".form-select example">
          <option selected>Choose job type</option>
          <option value="1">Freelance </option>
          <option value="2">Fulltime</option>
         
        </select>':'<select name="job_type" class="form-select form-select mb-3 mt-1" aria-label=".form-select example">
          <option selected>Choose job type</option>
           <option value="1" '.($jobInfo->requirement_type=="1"?'selected':'').'>Freelance </option>
          <option value="2"  '.($jobInfo->requirement_type=="2"?'selected':'').'>Fulltime</option>
         
        </select>').'
        
        
        </form>';
       }
       elseif($q=="2"){ $question="Give your job a perfect Title";
           $comment="This helps your job stand out of right candidates . Its first thing they will see, so make it count!";
         $content='<h5 class="my-5">What is the title of your Job ?</h5>
       <form method="post" id="form-'.$q.'" style="color:#120bff;background-color:blue"> 
    
'.($jobInfo->job_heading==""?'<select id="selUser" name="job_title" style="width:100%;margin:auto;font-size:24px;padding:10px"  class="form-select form-select mb-3 mt-1" aria-label=".form-select example">
    <option value="0">Choose a Title</option>'.
    $options
.'</select>':'<select id="selUser" name="job_title" style="width:100%;margin:auto;font-size:24px;padding:10px"  class="form-select form-select mb-3 mt-1" aria-label=".form-select example">
    <option  value="'.$jobInfo->job_heading.'">'.$jobInfo->job_heading.'</option>'.
    $options
.'
 </select>').'

</form>
' ; 
       }
       elseif($q=="3"){ $question="Tell us about your Budget ";
       $comment="This will help us to match you to talent within your range.";
       if(1>2){
       $content='       
       
<form method="post" id="form-'.$q.'">

        <h5 class="mt-3">Enter Monthly Salary</h5>
         <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">Rate</label>
   <div class="row d-flex">
    <div class="col-auto">
    <input type="text" class="form-control" id="inputPassword2" placeholder="$" name="working_rate">
    </div>
    <div class="col-auto">
     <span class="text" id="interval12"> /month </span>
    </div>
    </div>
    
    </div>
    <form>';
       }  else{
     $content='<form method="post" id="form-'.$q.'"><div class="row d-flex justify-content-around p-3">
     <div class="col-5 p-3 text-center shadow-sm hoverable" id="budget1" onclick="selectBudget(1,2)" role="presentation">
    <span class="active" >
    <span class="material-icons-outlined">schedule</span><br>Time Basis</span>
    </div>
    
     <div class="col-5 p-3 text-center shadow-sm hoverable" id="budget2"   onclick="selectBudget(2,1)"  role="presentation">
    <span class="" >
        <span class="material-icons-outlined">loyalty</span><br>Project Budget
    </span>
    </div>
     </div>
     <div id="present-1">
         <h5 class="content-q2 qy-3">Choose the time basis that you would like to pay.</h5>
         '.($jobInfo->wage_type==""?' <select name="payroll_period" id="period" class="form-select form-select mb-3 mt-1" aria-label=".form-select example">
          <option value="1" >Hourly</option>
          <option value="2" >Daily</option>
          <option value="3" >Weekly</option>
          <option value="4" >Monthly</option>
        </select>':' <select name="payroll_period" id="period" class="form-select form-select mb-3 mt-1" aria-label=".form-select example">
          <option value="1" '.($jobInfo->wage_type=="1"?'selected':'').' >Hourly</option>
          <option value="2" '.($jobInfo->wage_type=="2"?'selected':'').'  >Daily</option>
          <option value="3" '.($jobInfo->wage_type=="3"?'selected':'').'  >Weekly</option>
          <option value="4" '.($jobInfo->wage_type=="4"?'selected':'').'  >Monthly</option>
        </select>').'
       
        
        <h5 class="mt-3">Enter Here Rate</h5>
         <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">Rate</label>
    <div class="row d-flex">
    <div class="col-auto">
    <input type="number" value="'.($jobInfo->hourly_rate==""?'':$jobInfo->hourly_rate).'" class="form-control" id="inputPassword2" placeholder="$ " name="working_rate">
    </div>
    <div class="col-auto">
     <span class="text" > $ <span class="text" id="interval"> /hour </span></span>
    </div>
    </div>
   
     </div>
     </div>
    
    
     
     <div id="present-2">
      <h5 class="mt-3">Enter Your Budget</h5>
         <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">Rate</label>
    <input type="text" name="project_budget" class="form-control" id="inputPassword2" placeholder="$">
     </div>
     
     </div>
     </form>
     ';       
           
       }
      
       
       
       ;}
       elseif($q=="4"){ $question="Choose the skills  needed for the job.";
         $comment="";
          $content='<p class="text-muted">
          This will help you to match talent within your range
          </p>
          <h5 class="my-5">Select Skills you are searching for</h5>
          <form method="post" id="form-'.$q.'">
        <select id="tags" name="tags[]" multiple="multiple" style="width:100%;height:300px">
        </select>
         '.($jobInfo->experience_type==""?'<select name="experience_type" class="form-select form-select mb-3 mt-5" aria-label=".form-select example" >
          <option selected>Choose Experience Type</option>
          <option value="1">Expert</option>
          <option value="2">Intermediate</option>
          <option value="3">Beginner</option>
         
        </select>':'<select name="experience_type" class="form-select form-select mb-3 mt-5" aria-label=".form-select example">
          <option selected>Choose Experience Type</option>
           <option value="1" '.($jobInfo->experience_type=="1"?'selected':'').'>Expert</option>
          <option value="2"  '.($jobInfo->experience_type=="2"?'selected':'').'>Intermediate</option>
          <option value="3"  '.($jobInfo->experience_type=="3"?'selected':'').'>Beginner</option>
         
        </select>').'
        </form>';
       ;}
       elseif($q=="5"){ $question="Do you wish to verify the jobseekers' skills.";
         $comment="";
          $content='
          <p class="text-muted">This will allow the job seeker who are intereted in your job post to take a test to verify their skills and prove  themselves that they are eligible for the job.</p>
          <h5 class="mt-5">Choose test template</h5>
           <form method="post" id="form-'.$q.'"> 
    <select id="tempo" name="job_title" style="width:100%;margin:auto;"  class="form-select  mb-3 mt-1" aria-label="example">
    <option value="0">Choose a Title</option>'.
   $mytemp
.'</select></form>
<a class="" style="" href="'.$add_temp_url.'">add new test</a>';
       }
       ?>
       <?php if($q==$tab){?>
       <div class="card-body bg-white question-card" style="">
       <h3 class="mb-0 content-q" style=""><?=$question;?></h3>
       <p class="my-0 content-p" style=""><?=$comment;?></p>
       <div class="content">
           <?=$content;?>
       </div>
       
       <div class="row d-flex justify-content-between mt-2  nav-btns pb-3" style="position:absolute;bottom:0;width:80%">
            
           <div class="col-3 text-center">
              <?php if($q=="1"){?> 
               <a class="btn rounded-btn prv-btn" >Previous</a>
              <?php }else{ ?>
              <a class="btn rounded-btn prv-btn" href="<?php echo base_url('/post-job');?>?tabval=<?= $q-1;?>">Previous</a>
              <?php }?>
           </div>
           <div class="col-3 text-center">
               <?php if($q=="5"){?>
                <a class="btn rounded-btn next-btn" onclick="registerForm(<?= $q;?>)">Preview  </a>
               <?php }else{?>
                <a class="btn rounded-btn next-btn"  onclick="registerForm(<?= $q;?>)">Next  </a>
               <?php }?>
              
           </div>
       </div>
       <?php }?>
       </div>
       <?php }?> 
 

</div>
</div>

<?php }?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function next(i){
        var selectedCircle="pills-"+i+"-tab";
       alert(selectedCircle);
       document.getElementById(selectedCircle).setAttribute('aria-selected', 'true')
       } 
    function registerForm(i){
       var purl=parseInt(i)+1;
       var queryString=$("#form-"+i).serialize();
       if(i=="1"||i=="2"||i=="3"){
       if(queryString.indexOf('?') > -1){
                        queryString = queryString.split('?')[1];
                    }
                    var pairs = queryString.split('&');
                    var result = {};
                    pairs.forEach(function(pair) {
                        pair = pair.split('=');
                        result[pair[0]] = decodeURIComponent(pair[1] || '');
                    });
                    
                    var stringify=JSON.stringify(result);
       var passurl="<?php echo base_url('/post-job');?>?tabval="+purl;
       var stringed= JSON.stringify(result);
     // alert(stringed);
       }else if(i=="4"){
           var passurl="<?php echo base_url('/post-job');?>?tabval="+purl;
           var tagged=$("#tags").val();
           var result={'skills':tagged };
           //alert(result);
       }else{
           var temp=$("#tempo").val();
           var result={'template_id':temp}
       }
         $.ajax({  
                        method: "POST",
                        url: "<?php echo base_url('updateJob') ?>",
                        data:result,  
                        success : function(response){
                        var resp=JSON.parse(response);
                        //console.log(resp)
                        if(i!=5){
                           if(resp.response==true){
                              window.location.href=passurl;
                           }
                        }
                        else{
                           if(resp.response==true){
                               window.location.href="<?php echo base_url('/Dashboard/previewJobs/');?>/<?= $find_by ;?>";
                           } 
                        }
                        },
                        error : function(data,textStatus,errorMessage){
                           // alert( textStatus + data + " " + errorMessage);
                        }
                    });
       
   }      
</script>
   <script>
   $(document).ready(function(){
          
  
 $('#tags').select2({
	tags: true,
    data:["AngularJS ","AWS ","C# ","C++ ","CSS ","Data Analytics","Data Visualization Consultants","DevOps ","Docker","Firebase","Google Cloud Platform (GCP)","Golang ","HTML5 ","JAVA","JavaScript","Kubernetes","Machine Learning ","Magento ","Mobile App Developers","MongoDB","MySQL ","NodeJS","Php","Python ","React Native ","React JS","Ruby ","Ruby on Rails ","Rust ","Scala ","Shopify ","Software Quality Assurance Testers","Solidity","TypeScript","Unity 3D ","Vue JS ","Web ","WordPress ","2D Animation","3D Designing","Amazon FBA ","Conversion Rate Optimisation","Copywriting","Data Entry Specialists","Data Scrapers","Database Programmers","Digital Marketers","Graphic Designing","Microsoft Access ","Network Engineers","Power BI Consultants","Product Managers","Product Marketers","Project Managers","Salesforce App Developers","SEO ","Tableau ","Translators","UI Designing","UX Designing","Web Designing","Chatbot Services","Cybersecurity & Data Protection Services","Data Analysis & Report Services","Database Services","Desktop Application Services","Development for Streamer Services","eCommerce Development Services","File Conversion Services","Game Development Services","Mobile App Development Services","Online Coding Lessons","QA Services","Support & IT Services","User Testing Services","Web Programming Services","Website & CMS Software Services","WordPress Development Services","PHP","database structuring","Jquery "],
    tokenSeparators: [','], 
    placeholder: "Add your Skills here",
    /* the next 2 lines make sure the user can click away after typing and not lose the new tag */
    selectOnClose: false, 
    closeOnSelect: false,
    
}); 
    
  // Initialize select2
  $("#selUser").select2();

  // Read selected option
  $('#but_read').click(function(){
    var username = $('#selUser option:selected').text();
    var userid = $('#selUser').val();

    $('#result').html("id : " + userid + ", name : " + username);

  });
});
selectBudget(1,2);
   function selectBudget(i,j){
       var payType="paytype-"+i;
       var notPayType="paytype-"+j;
      var targetId="budget"+i;
      var unselectId="budget"+j;
      var presentOff="present-"+j;
      var presentOn ="present-"+i;
      document.getElementById(targetId).style.border="1px solid #120bff";
      document.getElementById(unselectId).style.border="1px solid #eee";
      
      document.getElementById(presentOff).style.display='none';
      document.getElementById(presentOn).style.display='block';
   }
   function clickedWhat(i){
       var targetTab="tab-"+i;
       alert(targetTab);
       var tabToShow= document.getElementById(targetTab);
       tabToShow.style.visibility="visible";
       
       if(i=="4"){
       document.getElementById("tab-3").style.visibility="hidden";   
       document.getElementById("tab-2").style.visibility="hidden";
       document.getElementById("tab-1").style.visibility="hidden";
       }
       else if(i=="3"){
       document.getElementById("tab-4").style.visibility="hidden";   
       document.getElementById("tab-2").style.visibility="hidden";
       document.getElementById("tab-1").style.visibility="hidden";
       }
       else if(i=="2"){
       document.getElementById("tab-3").style.visibility="hidden";   
       document.getElementById("tab-4").style.visibility="hidden";
       document.getElementById("tab-1").style.visibility="hidden";
       }
       else if(i=="1"){
       document.getElementById("tab-3").style.visibility="hidden";   
       document.getElementById("tab-2").style.visibility="hidden";
       document.getElementById("tab-4").style.visibility="hidden";
       }
       
      
       
     // tabToShow.style.backgroundColor="blue";
      
   }
   $('#period').change(function() {
    //Use $option (with the "$") to see that the variable is a jQuery object
    var option = $(this).find('option:selected');
    //Added with the EDIT
    var value = option.val();//to get content of "value"
    if(value=="1"){
        var interval='/Hourly';
    }else if(value=="2"){
        var interval='/Daily';
    }else if(value=="3"){
        var interval='/Weekly';
    }else if(value=="4"){
        var interval='/monthly';
    }
    $("#interval").text(interval);
});

     $('#period9').change(function() {
    //Use $option (with the "$") to see that the variable is a jQuery object
    var option = $(this).find('option:selected');
    //Added with the EDIT
    var value = option.val();//to get content of "value"
    if(value=="1"){
        var interval='/Hourly';
    }else if(value=="2"){
        var interval='/Daily';
    }else if(value=="3"){
        var interval='/Weekly';
    }else if(value=="4"){
        var interval='/monthly';
    }
    $("#interval9").text(interval);
});
   
       
   </script>

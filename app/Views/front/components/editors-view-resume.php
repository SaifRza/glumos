<?php 
//print_r($myData);
//print_r($exp);
if(empty($myData[0]->profile_img)){
 $dp='default_logo_1.png';  
}else{
    $dp=$myData[0]->profile_img;
}

?>
<style>
    /* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  right: 0;
  background-color: #fff; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 30px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #f1f1f1;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s;
  padding: 20px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
<div class="row d-flex justify-content-end pt-2 px-3" style="max-width:800px;margin:auto" id=""> 
<div class="btn btn-primary col-auto"><a href="<?php echo base_url('/digital-resume');?>" class="text-white">Editors View</a></div>
</div>
<div class="row d-flex justify-content-around pt-2" style="max-width:800px;margin:auto" id="on-board"> 
<div class="col-12 mx-auto text-center mt-0">
    
  <div class="bg-white p-3 mt-3 shadow-lg" style="border-radius:20px">
       <h6 class="d-flex justify-content-between">Personal Information<span class="material-icons-outlined v-med ml-3" data-bs-toggle="modal" data-bs-target="#exampleModal1">
more_horiz
</span></h6>
<div class="row d-flex justify-content-start">
<div class="col-auto  justify-content-start">
 <h4 class="text-capitalize text-italic fw-bolder m-0"><?=$myData[0]->name;?></h4>
 <p class="text-capitalize m-0" style="font-size:12px">Nationality : <?=$myData[0]->nationality;?></p>
</div>

<p class="text-italic d-flex justify-content-start"><?php echo $myData[0]->email;?></p>
</div>
       <hr class="m-0">

<!---Objectives--->
  <h6 class="d-flex mt-3 justify-content-between">Objectives<span class="material-icons-outlined v-med ml-3" data-bs-toggle="modal" data-bs-target="#exampleModal1">
more_horiz
</span></h6>
<p class="text-italic mt-2 d-flex justify-content-start text-right"><?php echo $myData[0]->objectives;?></p>


<!--Objectives Ends-->
  <hr class="m-0">
<!---Experience--->
  <h6 class="d-flex mt-3 justify-content-between">Experience<span class="material-icons-outlined v-med ml-3" data-bs-toggle="modal" data-bs-target="#exampleModal1">
more_horiz
</span></h6>
<?php foreach($exp as $experience){?>
<?php if($experience->type<1){?>
<div class="d-flex justify-content-start">
    <h6>Worked as <?=$experience->title;?></h6>
</div>

    <p class="d-flex justify-content-start"> <?=$experience->institution_name;?></p>
<?php }?>
<?php }?>


<!--Experience Ends Ends-->
    
   </div> 
   
   
   
   
</div>
</div>
<!---Modal 96-->
<div class="modal fade" id="exampleModal96" tabindex="-1" aria-labelledby="exampleModalLabel95" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Education Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
   <form method="POST" action="<?php echo base_url('/update-user-info/9');?>"     >
       <div class="form-group text-center mb-3">
             <label for="inputJName" class="form-label">Programme name</label>
           <input type="text" class="form-control" name="job_title" id="inputJName" value="" placeholder="Programme name ">
       </div>       
       <div class="form-group row d-flex justify-content-between text-center mb-3">
           <div class="col-9">
             <label for="inputCName" class="form-label">College or Institution  Name</label>
           <input type="text" class="form-control" name="company_name" id="inputCName" value="" placeholder="College or Institution  Name">   
           </div>
           <div class="col-3">
              <label for="inputYName" class="form-label">Years</label>
           <input type="hidden" class="form-control" name="years" id="inputYName" value="1" >  
            <input type="hidden" class="form-control" name="type" value="1" > 
           </div>
          
       </div>
       <div class="text-center">
           <button type="submit" id='upload-btn' class="btn btn-success" >Submit</button>
       </div>
       
       </form>
      </div>
      
    </div>
  </div>
</div>
<!--Modal 96 Ends-->


<!---Modal 1-->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
   <form method="POST" action="<?php echo base_url('/update-user-info/1');?>"      enctype="multipart/form-data">
              
       <div class="form-group text-center mb-3">
         
<img id="output1" style="height:200px;width:200px;border-radius:50%"/>
<script>
  var loadFile = function(event) {
   
    var output = document.getElementById('output1');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
<input type="file" name="userfile" accept="image/*" onchange="loadFile(event)">
           
       </div>
       <div class="text-center">
           <button type="submit" id='upload-btn' class="btn btn-success" >Submit</button>
       </div>
       
       </form>
      </div>
      
    </div>
  </div>
</div>
<!--Modal 1 Ends-->
<!---Modal 3-->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Contact Number</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
   <form method="POST" action="<?php echo base_url('/update-user-info/5');?>"      enctype="multipart/form-data">

       <div class="mb-3">
  <label for="exampleFormControlInput11" class="form-label">Enter Your Name</label>
  <input type="text" class="form-control" name="name" id="exampleFormControlInput11" value="<?php echo $myData[0]->name;?>" placeholder="Seeker Name">
</div>

       <div class="mb-3">
  <label for="exampleFormControlInput11" class="form-label">Nationality</label>
<select name="nationality" required>
  <option value="">-- select one --</option>
  <option value="afghan">Afghan</option>
  <option value="albanian">Albanian</option>
  <option value="algerian">Algerian</option>
  <option value="american">American</option>
  <option value="andorran">Andorran</option>
  <option value="angolan">Angolan</option>
  <option value="antiguans">Antiguans</option>
  <option value="argentinean">Argentinean</option>
  <option value="armenian">Armenian</option>
  <option value="australian">Australian</option>
  <option value="austrian">Austrian</option>
  <option value="azerbaijani">Azerbaijani</option>
  <option value="bahamian">Bahamian</option>
  <option value="bahraini">Bahraini</option>
  <option value="bangladeshi">Bangladeshi</option>
  <option value="barbadian">Barbadian</option>
  <option value="barbudans">Barbudans</option>
  <option value="batswana">Batswana</option>
  <option value="belarusian">Belarusian</option>
  <option value="belgian">Belgian</option>
  <option value="belizean">Belizean</option>
  <option value="beninese">Beninese</option>
  <option value="bhutanese">Bhutanese</option>
  <option value="bolivian">Bolivian</option>
  <option value="bosnian">Bosnian</option>
  <option value="brazilian">Brazilian</option>
  <option value="british">British</option>
  <option value="bruneian">Bruneian</option>
  <option value="bulgarian">Bulgarian</option>
  <option value="burkinabe">Burkinabe</option>
  <option value="burmese">Burmese</option>
  <option value="burundian">Burundian</option>
  <option value="cambodian">Cambodian</option>
  <option value="cameroonian">Cameroonian</option>
  <option value="canadian">Canadian</option>
  <option value="cape verdean">Cape Verdean</option>
  <option value="central african">Central African</option>
  <option value="chadian">Chadian</option>
  <option value="chilean">Chilean</option>
  <option value="chinese">Chinese</option>
  <option value="colombian">Colombian</option>
  <option value="comoran">Comoran</option>
  <option value="congolese">Congolese</option>
  <option value="costa rican">Costa Rican</option>
  <option value="croatian">Croatian</option>
  <option value="cuban">Cuban</option>
  <option value="cypriot">Cypriot</option>
  <option value="czech">Czech</option>
  <option value="danish">Danish</option>
  <option value="djibouti">Djibouti</option>
  <option value="dominican">Dominican</option>
  <option value="dutch">Dutch</option>
  <option value="east timorese">East Timorese</option>
  <option value="ecuadorean">Ecuadorean</option>
  <option value="egyptian">Egyptian</option>
  <option value="emirian">Emirian</option>
  <option value="equatorial guinean">Equatorial Guinean</option>
  <option value="eritrean">Eritrean</option>
  <option value="estonian">Estonian</option>
  <option value="ethiopian">Ethiopian</option>
  <option value="fijian">Fijian</option>
  <option value="filipino">Filipino</option>
  <option value="finnish">Finnish</option>
  <option value="french">French</option>
  <option value="gabonese">Gabonese</option>
  <option value="gambian">Gambian</option>
  <option value="georgian">Georgian</option>
  <option value="german">German</option>
  <option value="ghanaian">Ghanaian</option>
  <option value="greek">Greek</option>
  <option value="grenadian">Grenadian</option>
  <option value="guatemalan">Guatemalan</option>
  <option value="guinea-bissauan">Guinea-Bissauan</option>
  <option value="guinean">Guinean</option>
  <option value="guyanese">Guyanese</option>
  <option value="haitian">Haitian</option>
  <option value="herzegovinian">Herzegovinian</option>
  <option value="honduran">Honduran</option>
  <option value="hungarian">Hungarian</option>
  <option value="icelander">Icelander</option>
  <option value="indian">Indian</option>
  <option value="indonesian">Indonesian</option>
  <option value="iranian">Iranian</option>
  <option value="iraqi">Iraqi</option>
  <option value="irish">Irish</option>
  <option value="israeli">Israeli</option>
  <option value="italian">Italian</option>
  <option value="ivorian">Ivorian</option>
  <option value="jamaican">Jamaican</option>
  <option value="japanese">Japanese</option>
  <option value="jordanian">Jordanian</option>
  <option value="kazakhstani">Kazakhstani</option>
  <option value="kenyan">Kenyan</option>
  <option value="kittian and nevisian">Kittian and Nevisian</option>
  <option value="kuwaiti">Kuwaiti</option>
  <option value="kyrgyz">Kyrgyz</option>
  <option value="laotian">Laotian</option>
  <option value="latvian">Latvian</option>
  <option value="lebanese">Lebanese</option>
  <option value="liberian">Liberian</option>
  <option value="libyan">Libyan</option>
  <option value="liechtensteiner">Liechtensteiner</option>
  <option value="lithuanian">Lithuanian</option>
  <option value="luxembourger">Luxembourger</option>
  <option value="macedonian">Macedonian</option>
  <option value="malagasy">Malagasy</option>
  <option value="malawian">Malawian</option>
  <option value="malaysian">Malaysian</option>
  <option value="maldivan">Maldivan</option>
  <option value="malian">Malian</option>
  <option value="maltese">Maltese</option>
  <option value="marshallese">Marshallese</option>
  <option value="mauritanian">Mauritanian</option>
  <option value="mauritian">Mauritian</option>
  <option value="mexican">Mexican</option>
  <option value="micronesian">Micronesian</option>
  <option value="moldovan">Moldovan</option>
  <option value="monacan">Monacan</option>
  <option value="mongolian">Mongolian</option>
  <option value="moroccan">Moroccan</option>
  <option value="mosotho">Mosotho</option>
  <option value="motswana">Motswana</option>
  <option value="mozambican">Mozambican</option>
  <option value="namibian">Namibian</option>
  <option value="nauruan">Nauruan</option>
  <option value="nepalese">Nepalese</option>
  <option value="new zealander">New Zealander</option>
  <option value="ni-vanuatu">Ni-Vanuatu</option>
  <option value="nicaraguan">Nicaraguan</option>
  <option value="nigerien">Nigerien</option>
  <option value="north korean">North Korean</option>
  <option value="northern irish">Northern Irish</option>
  <option value="norwegian">Norwegian</option>
  <option value="omani">Omani</option>
  <option value="pakistani">Pakistani</option>
  <option value="palauan">Palauan</option>
  <option value="panamanian">Panamanian</option>
  <option value="papua new guinean">Papua New Guinean</option>
  <option value="paraguayan">Paraguayan</option>
  <option value="peruvian">Peruvian</option>
  <option value="polish">Polish</option>
  <option value="portuguese">Portuguese</option>
  <option value="qatari">Qatari</option>
  <option value="romanian">Romanian</option>
  <option value="russian">Russian</option>
  <option value="rwandan">Rwandan</option>
  <option value="saint lucian">Saint Lucian</option>
  <option value="salvadoran">Salvadoran</option>
  <option value="samoan">Samoan</option>
  <option value="san marinese">San Marinese</option>
  <option value="sao tomean">Sao Tomean</option>
  <option value="saudi">Saudi</option>
  <option value="scottish">Scottish</option>
  <option value="senegalese">Senegalese</option>
  <option value="serbian">Serbian</option>
  <option value="seychellois">Seychellois</option>
  <option value="sierra leonean">Sierra Leonean</option>
  <option value="singaporean">Singaporean</option>
  <option value="slovakian">Slovakian</option>
  <option value="slovenian">Slovenian</option>
  <option value="solomon islander">Solomon Islander</option>
  <option value="somali">Somali</option>
  <option value="south african">South African</option>
  <option value="south korean">South Korean</option>
  <option value="spanish">Spanish</option>
  <option value="sri lankan">Sri Lankan</option>
  <option value="sudanese">Sudanese</option>
  <option value="surinamer">Surinamer</option>
  <option value="swazi">Swazi</option>
  <option value="swedish">Swedish</option>
  <option value="swiss">Swiss</option>
  <option value="syrian">Syrian</option>
  <option value="taiwanese">Taiwanese</option>
  <option value="tajik">Tajik</option>
  <option value="tanzanian">Tanzanian</option>
  <option value="thai">Thai</option>
  <option value="togolese">Togolese</option>
  <option value="tongan">Tongan</option>
  <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
  <option value="tunisian">Tunisian</option>
  <option value="turkish">Turkish</option>
  <option value="tuvaluan">Tuvaluan</option>
  <option value="ugandan">Ugandan</option>
  <option value="ukrainian">Ukrainian</option>
  <option value="uruguayan">Uruguayan</option>
  <option value="uzbekistani">Uzbekistani</option>
  <option value="venezuelan">Venezuelan</option>
  <option value="vietnamese">Vietnamese</option>
  <option value="welsh">Welsh</option>
  <option value="yemenite">Yemenite</option>
  <option value="zambian">Zambian</option>
  <option value="zimbabwean">Zimbabwean</option>
</select>
</div>


              
       <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Enter Phone Number<span style="font-size:13px">(This should be your whatsapp Number)</span> </label>
  <input type="phone" class="form-control" name="contact_number" id="exampleFormControlInput1" placeholder="+91-89XXXXXXX" required>
</div>



       <div class="text-center mt-3">
           <button type="submit" id='upload-btn' class="btn btn-primary" >Submit</button>
       </div>
       
       </form>
      </div>
      
    </div>
  </div>
</div>
<!--Modal 3 Ends-->
<!---Modal 5-->
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Salary Expectations</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
   <form method="POST" action="<?php echo base_url('/update-user-info/7');?>"      enctype="multipart/form-data">
              
       <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Enter Required Details</label>
  <div class="row d-flex justify-contents-around">
      <div class="col-6">
         <input type="text" class="form-control" placeholder="120" name="salary"> 
      </div>
      <div class="col-3">
        <div class="input-group">
         <select class="form-select form-select-md material-input mb-3" aria-label=".form-select-lg example" name="wage_type">
          <option selected value="/hour">/hour</option>
          <option value="/day">/day</option>
          <option value="/week">/week</option>
          <option value="/month">/month</option>
        </select>
         
         </div>
      </div>
      <div class="col-3">
         <input type="text" class="form-control" placeholder="USD" value="USD" name="currency"> 
      </div>
  </div>
</div>
       <div class="text-center mt-3">
           <button type="submit" id='upload-btn' class="btn btn-primary" >Submit</button>
       </div>
       
       </form>
      </div>
      
    </div>
  </div>
</div>
<!--Modal 4 Ends-->
<!--sidenav-starts---->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)"  onclick="closeNav()">
      <span class="material-icons-outlined">chevron_left</span>
      </a>
<form method="POST" class="p-5 shadow-sm" action="<?php echo base_url('/update-user-info/2');?>" style="border:radius:20px;" >
              
       <div class="form-group" >
           <label for="tags">Add Your SKills</label>
       <select id="tags" name="tags[]" multiple="multiple" style="width:100%;height:300px;">
        </select>
       </div>
       <div class="text-center mt-3">
           <button type="submit" id='upload-btn w-75' class="btn btn-primary" >Submit</button>
       </div>
       
       </form> 
</div>

<!--Sidenav ends--->

<script>
function submitForm(){
    document.getElementById('auto-suggests').submit();
}
    /* Set the width of the side navigation to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "450px";
document.getElementById("on-board").style.opacity = "0.3";

}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("on-board").style.opacity = "1";
}
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
   $(document).ready(function(){
   $('#tags').select2({
        dropdownParent: $('#exampleModal2')
    });        
  
 $('#tags').select2({
	tags: true,
    data:["AngularJS","AWS","C#","C++","CSS","Data-Analytics","Data-Visualization-Consultants","DevOps","Docker","Firebase","Google Cloud Platform (GCP)","Golang ","HTML5 ","JAVA","JavaScript","Kubernetes","Machine Learning ","Magento ","Mobile App Developers","MongoDB","MySQL ","NodeJS","Php","Python","React-Native","React-JS","Ruby","Ruby-on-Rails","Rust","Scala","Shopify","Software-Quality-Assurance-Testers","Solidity","TypeScript","Unity-3D ","Vue-JS","Web","WordPress ","2D-Animation","3D-Designing","Amazon-FBA","Conversion-Rate-Optimisation","Copywriting","Data-Entry-Specialists","Data-Scrapers","Database-Programmers","Digital-Marketers","Graphic-Designing","Microsoft-Access ","Network-Engineers","Power-BI-Consultants","Product-Managers","Product-Marketers","Project-Managers","Salesforce-App-Developers","SEO","Tableau","Translators","UI-Designing","UX-Designing","Web-Designing","Chatbot-Services","Cybersecurity-&-Data-Protection-Services","Data-Analysis-&-Report-Services","Database-Services","Desktop-Application Services","Development-for-Streamer-Services","eCommerce-Development-Services","File-Conversion-Services","Game-Development-Services","Mobile App-Development-Services","Online-Coding-Lessons","QA-Services","Support -&-IT-Services","User-Testing-Services","Web-Programming-Services","Website-&-CMS-Software-Services","WordPress-Development=-Services","PHP","Database-structuring","Jquery"],
    tokenSeparators: [','], 
    placeholder: "Add your tags here",
    /* the next 2 lines make sure the user can click away after typing and not lose the new tag */
    selectOnClose: false, 
    closeOnSelect: true,
  
    
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
</script>
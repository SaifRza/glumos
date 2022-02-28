<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobSeekers;
use App\Models\JobModel;
use App\Models\Template;
use App\Models\Employers;

class PostJob extends BaseController
{
   
    public function index($browsefor=null)
    {
        
        $data['browsefor']=$browsefor;
        return view('front/signin',$data);
    }
    
    public function getAnswers(){
        $templ=new Template();
        
        $data=$this->request->getPost();
        $id=$this->request->getPost('application_id');
        $jobid=$this->request->getPost('jobid');
        $appInfo=$templ->appInfo($id,$jobid);
        
        print_r($appInfo);
    }
    
    
    public function addJob(){
        $session = \Config\Services::session($config);
        $job_type=$this->request->getPost('job_type');
         $job_title=$this->request->getPost('job_title');
          $payroll_type=$this->request->getPost('payroll_period');
          $rate=$this->request->getPost('working_rate');
          $job_desc=$this->request->getPost('desc');
            $budget=$this->request->getPost('project_budget');
        $budget=$this->request->getPost('project_budget');
        $experience=$this->request->getPost('experience_type');
        $employer=new Employers();
             $employerDetails=$employer->getDetails($session->get('userdata')['email']);
             $company_id=$session->get('userdata')['id'];
        $str_rand=rand(100000,9999999);
        $result_rand = md5($str_rand);
        
       
      $jobData=[
             'find_by'=>$result_rand,
            'company_id'=>$company_id,
            'job_heading'=>$job_title,
            'requirement_type'=>$job_type,
             'required_skill'=>null,
             'experience_type'=>$experience,
            'job_description'=>$job_desc,
             'has_attachments'=>0,
              'tokens_required'=>4,
              'wage_type'=>$payroll_type,
            'hourly_rate'=>$rate,
            'complete_rate'=>$budget,
            'is_company_payment_verified'=>0,
             'proposal_limits'=>10,
            'is_premium_post'=>0,
            'interviewed'=>0,
            'status'=>0,
            'admin_approved'=>0,
            'post_time'=>date('Y-m-d H:i:s')
            ];
            
        $jbtable=new JobModel();
        $addnew=$jbtable->addNewJob($jobData);
        if($addnew){
            echo json_encode(array('response'=>true,'message'=>'Added Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }
    }
    
    
    public function careerJet(){
        require_once "Careerjet_API.php" ;

$api = new Careerjet_API('en_GB') ;
$page = 1 ; # Or from parameters.

$result = $api->search(array(
  'keywords' => 'php developer',
  'location' => 'London',
  'page' => $page ,
  'affid' => 'bd3036c11dfed1deffa254c6da8138b0',
));

if ( $result->type == 'JOBS' ){
  echo "Found ".$result->hits." jobs" ;
  echo " on ".$result->pages." pages\n" ;
  $jobs = $result->jobs ;
  
  foreach( $jobs as $job ){
    echo " URL:     ".$job->url."\n" ;
    echo " TITLE:   ".$job->title."\n" ;
    echo " LOC:     ".$job->locations."\n";
    echo " COMPANY: ".$job->company."\n" ;
    echo " SALARY:  ".$job->salary."\n" ;
    echo " DATE:    ".$job->date."\n" ;
    echo " DESC:    ".$job->description."\n" ;
    echo "\n" ;
  }

  # Basic paging code
  if( $page > 1 ){
    echo "Use \$page - 1 to link to previous page\n";
  }
  echo "You are on page $page\n" ;
  if ( $page < $result->pages ){
    echo "Use \$page + 1 to link to next page\n" ;
  }
}

# When location is ambiguous
if ( $result->type == 'LOCATIONS' ){
  $locations = $result->solveLocations ;
  foreach ( $locations as $loc ){
    echo $loc->name."\n" ; # For end user display
    ## Use $loc->location_id when making next search call
    ## as 'location_id' parameter
  }
}


    }
    
    
    public function removeJob($jobId){
        $data=[
            'status'=>2
            ];
        $job=new JobModel();
        $removeJob=$job->removeMyJob($data,$jobId);
        return redirect()->to(base_url('/dashboard'));
    }
     public function deleteJob($jobId){
        $data=[
            'status'=>4
            ];
        $job=new JobModel();
        $removeJob=$job->removeMyJob($data,$jobId);
        return redirect()->to(base_url('/dashboard'));
    }
    
    public function testSubmission(){
        $session = \Config\Services::session($config);
        $userid=$session->get('userdata')['id'];
     $Temo=new Template();        
     $array=$this->request->getPost();
     $template_id=$this->request->getPost('template_id');
     $post_id=$this->request->getPost('post_id');
     $ref_id=$this->request->getPost('ref_id');
     
     //get Template details
     
     $getTemplate=$Temo->loadTemplateByTempId($template_id);
     
     $total_ques=count($getTemplate);
     foreach($getTemplate as $template){
         
         echo '<br>';
         $answer_of='answer-'.$template->question_id;
         
         $marked=$this->request->getPost($answer_of);
         if($marked==""){
             $status=0;
         }else{
             $status=1;
         }
           $insert_array=[
             'question_id'=>$template->question_id,
             'post_id'=>$post_id,
             'status'=>$status,
             'userid'=>$userid,
             'correct'=>$template->correct,
              'answer'=>$marked,

             ];   $quess=1;
             if($status=="0"){
                $marks=1;
             
             }else{
               if($marked==$template->correct){
               $marks=1;}  
             }
            $total_marks+=$marks;
          $insertNow=$Temo->addAttempted($insert_array);
         
        //echo '<h3>'.$answer_of.'--'.$marked.'--'.$template->correct.'</h3>';
     }
// print_r($total_marks);
  $Percentage=$total_marks/$total_ques;
  echo '<br>';
 
     echo '<br>';
    
     //Evaluate Result;
     
     
     
     //Insert into question_attempt
        //get and Foreach query for insert
    $finalResult=[
     'marks_obtained'=>$Percentage,
     'status'=>1
     ];
     
    $pourResult=$Temo->updateApplication($finalResult,$ref_id);
    if($pourResult){
        return redirect()->to(base_url('/apply-for-job/'.$post_id));
    }
  
      
      
        
     
     //Application Result
        //Marks Evaluate and Insert
     
    }
    
    public function addQuestion(){
        date_default_timezone_set('Asia/Kolkata');
        $session = \Config\Services::session($config);
       $data=$this->request->getPost();
       $question_type=$this->request->getPost('type_of');
       $parent_id=$this->request->getPost('parent_id');
       $q=$this->request->getPost('question');
       $a=$this->request->getPost('option-1');
       $b=$this->request->getPost('option-2');
       $c=$this->request->getPost('option-3');
       $d=$this->request->getPost('option-4');
       $img=$this->request->getFile('userfile');
       $correct=$this->request->getPost('radioBox');
       if(1>2){
           echo json_encode(array('response'=>false,'message'=>'Please Enter All Fields'));
       }
       else{
        //Image Availablity-check
        if(empty($img)){
           $img_name=null; 
           $attached=2;
        }else{
            $attached=1;
                 $input = $this->validate([
                        'userfile' => [
                            'uploaded[userfile]',
                            'mime_in[userfile,image/jpg,image/jpeg,image/png]',
                            'max_size[userfile,28024]',
                        ]
                    ]);
                
                    if (!$input) {
                        print_r('Choose a valid file');
                    } else {
                        $img = $this->request->getFile('userfile');
                       
                        $img->move(ROOTPATH.'httpdocs/employer-questions/');
                        $img_name=$img->getName();
                    }
        }
           
       $tempData=[
        'question_id'=>mt_rand(10000000,99999999),
        'company_id'=>$session->get('userdata')['id'],
        'skill_type'=>$question_type,
        'question_no'=>0,
        'parent_id'=>$parent_id,
        'image_name'=>$img_name,
        'question_text'=>$q,
        'option_a'=>$a,
        'option_b'=>$b,
        'option_c'=>$c,
        'option_d'=>$d,
        'correct'=>$correct,
        'created_at'=>date('Y-m-d H:i:s')  
           ];
       $template=new Template();
       $addTemplate=$template->addQuestion($tempData);
       $tempInfo=$template->getTempInfo($parent_id);
       $pre_hard=$tempInfo[0]->hard;
       $pre_soft=$tempInfo[0]->soft;
       
       if($question_type=="1"){
           //Hardskill Question
           $set=$pre_hard+1;
           $type="hard";
       }else{
           //Softskill Question
           $set=$pre_soft+1;
           $type="soft";
       }
       if($addTemplate){
           //updating Data for Parent Template
           $updateTemplate=$template->updateTemp($set,$type,$parent_id);
           echo json_encode(array('response'=>true,'message'=>'Added Question Successfully'));
           
           return redirect()->to(base_url('/add-template'));
       }
       //print_r($data);
      }
    }
    
    public function addTemp(){
        date_default_timezone_set('Asia/Kolkata');
        $session = \Config\Services::session($config);
       $name=$this->request->getPost('template_name');
       if(empty($name)){
           echo json_encode(array('response'=>false,'message'=>'Please Enter All Fields'));
       }
       else{
       $tempData=[
        'template_id'=>mt_rand(10000000,99999999),
        'template_name'=>$name,
        'company_id'=>$session->get('userdata')['id'],
        'created_at'=>date('Y-m-d H:i:s')  
           ];
       $template=new Template();
       $addTemplate=$template->addTemplate($tempData);
       if($addTemplate){
           echo json_encode(array('response'=>true,'message'=>'Added Template'));
       }else{
         echo json_encode(array('response'=>false,'message'=>'Template Not added'));  
       }
       //print_r($data);
      }
      
    }
    
    public function getQuestions(){
       $session = \Config\Services::session($config);
        $id=$this->request->getPost('parent_id');
        $temptable=new Template();
        $info=$temptable->parentIdQuestions($id);
        foreach($info as $data){
            if($data->skill_type=="1"){
                $img_url=base_url().'/httpdocs/employer-questions/'.$data->image_name;
                $hard.='<div class="p-2 mt-2 bg-light">
              
                <h6>Ques.   '.$data->question_text.'</h6>
                <div class="row d-flex justify-content-around">
                <div class="col-auto">
                 <p style="font-size:14px">A)'.$data->option_a.'</p>
                <p style="font-size:14px">B)'.$data->option_b.'</p>
                <p style="font-size:14px">C)'.$data->option_c.'</p>
                <p style="font-size:14px">D)'.$data->option_d.'</p>
                <p style="font-size:14px">Correct : '.$data->correct.'</p>
                </div>
                <div class="col-auto">
                '.($data->image_name==""?'':'<img src="'.$img_url.'" style="height:200px;width:200px">').'
                </div>
               
                </div>
                
                  </div>';
            }else{
                $soft.='<div class="p-2 mt-2 bg-light">
                <h6>Ques. '.$data->question_text.'</h6>
                <p style="font-size:14px">A)'.$data->option_a.'</p>
                <p style="font-size:14px">B)'.$data->option_b.'</p>
                <p style="font-size:14px">C)'.$data->option_c.'</p>
                <p style="font-size:14px">D)'.$data->option_d.'</p>
                <p style="font-size:14px">Correct : '.$data->correct.'</p>
                  </div>';
            }
           
        } echo json_encode(array('hard'=>$hard,'soft'=>$soft));
    }
    
    public function getQuestionsForm(){
       $session = \Config\Services::session($config);
        $id=$this->request->getPost('parent_id');
        $temptable=new Template();
        $info=$temptable->parentIdQuestions($id);
        foreach($info as $data){
            if($data->skill_type=="1"){
                
                $hard.='<div class="px-2 py-3 mt-2 bg-white rounded-4">
                <h6>Ques.   '.$data->question_text.'<span class="text-danger">*</span></h6>
                
                '.($data->image_name==""?'':'<img src="'.base_url().'/httpdocs/employer-questions/'.$data->image_name.'" style="height:200px;width:200px">').'
                <select name="answer-'.$data->question_id.'" class="form-select" aria-label="Default select example" style="background:#eee">
                  <option selected>Choose Option</option>
                  <option value="1">'.$data->option_a.'</option>
                  <option value="2">'.$data->option_b.'</option>
                  <option value="3">'.$data->option_c.'</option>
                  <option value="4">'.$data->option_d.'</option>
                </select>
                  </div>';
            }else{
                $soft.='<div class="px-2 py-3 mt-2 bg-white rounded-4">
                <h6>Ques. '.$data->question_text.'<span class="text-danger">*</span></h6>
                '.($data->image_name==""?'':'<img src="'.base_url().'/httpdocs/employer-questions/'.$data->image_name.'" style="height:200px;width:200px">').'
                 <select name="answer-'.$data->question_id.'" class="form-select" aria-label="Default select example" style="background:#eee">
                  <option selected>Choose Option</option>
                  <option value="1">'.$data->option_a.'</option>
                  <option value="2">'.$data->option_b.'</option>
                  <option value="3">'.$data->option_c.'</option>
                  <option value="4">'.$data->option_d.'</option>
                </select>
                  </div>';
            }
           
        } echo json_encode(array('hard'=>$hard,'soft'=>$soft));
    }
    public function updateJob(){
    $session = \Config\Services::session($config);
        $job_type=$this->request->getPost('job_type');
         $job_title=$this->request->getPost('job_title');
          $payroll_type=$this->request->getPost('payroll_period');
          $rate=$this->request->getPost('working_rate');
          $job_desc=$this->request->getPost('desc');
        $budget=$this->request->getPost('project_budget');
        $experience=$this->request->getPost('experience_type');
        $skills=$this->request->getPost('skills');
        $temp_id=$this->request->getPost('template_id');
        $w_type=$this->request->getPost('w_type');
        $rate_amu=$this->request->getPost('rate_amu');
        
        if(!empty($this->request->getPost('w3review'))){
            //Job Type exists
            $JobData=[
              'job_description'=>$this->request->getPost('w3review'),
              'job_heading'=>$this->request->getPost('title'),
              'status'=>1,
              'wage_type'=>$w_type,
              'hourly_rate'=>$rate_amu
                ];
       
        $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            $session->remove('job_find_by');
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }
            
    }
        
        if(!empty($rate)){
            //Job Type exists
            $JobData=[
              'hourly_rate'=>$rate,
              'wage_type'=>$payroll_type
                ];
       
        $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }
            
    }
    
        if(!empty($budget)){
          //Job Type exists
            $JobData=[
              'complete_rate'=>$budget
                ];
       
        $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }   
        }
    
        if(!empty($job_type)){
            //Job Type exists
            $JobData=[
              'requirement_type'=>$job_type
                ];
       
        $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }
            
    }
    
        if(!empty($job_title)){
            //Job Type exists
            $JobData=[
              'job_heading'=>$job_title,
                ];
       
        $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }
            
    }
        
        if(!empty($skills)){
            $skl="";
         foreach($skills as $skill){
             $skl.="+".$skill;
         }
         $JobData=[
              'skill_tags'=>$skl,  
              'experience_type'=>$experience
                ];
         $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }          
       }
       if(intval($temp_id)>1000){
           $JobData=[
               'template_id'=>$temp_id
               ];
         $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }         
       }
       
       
       
        
    
    }
    public function userAuth(){
       $session = \Config\Services::session($config); 
        if(($session->get('userdata')['name'])==""){
         return redirect()->to('signin');
         }else{
             $employer=new Employers();
             $employerDetails=$employer->getDetails($session->get('userdata')['email']);
             $company_id=$employerDetails['0']->id;
             $myjobs=$employer->getPostedJobs($company_id);
             $data['myjobs']=$myjobs;
             $data['mydata']=$employerDetails;
            return view('front/user/index',$data);   
         }
    }
    public function logout(){
        $session = \Config\Services::session($config);
        $session->destroy();
          return view('front/signin'); 
    }
    public function browseAllJobs(){
       $session = \Config\Services::session($config);
       return view('front/user/browsejobs'); 
    }
    public function postJob(){
       $session = \Config\Services::session($config);
       return view('front/user/postjob'); 
    }
     public function verifyCompany(){
       $session = \Config\Services::session($config);
       return view('front/user/upload-documents'); 
    }
    public function addTemplate(){
       $session = \Config\Services::session($config);
       return view('front/user/add-templates'); 
    }
    public function viewTemplate(){
       $session = \Config\Services::session($config);
       return view('front/user/view-templates'); 
    }
    public function login(){
        return view('front/signin');  
    }
    public function message(){
       return view('front/user/message'); 
    }
    public function verifyAcc($email=null){
        $data=[];
        if(!empty($email)){
         $check = new UserModel();
         $verify=$check->existForActivation($email);
         if($verify){
           $data['success']='Account Activated Successfully';  
         }else{
             $data['error']='Sorry Unable To Find Your Account';
         }
            
           // $data['hashmail']=$email;
       // return view ('front/login',$login_cookie); 
        }else{
           $data['error']='Sorry Unable to Process Your Requests';
        }
        return view ('front/activate',$data); 
       
    
        
    }
    public function sendMail(){
        
     // $_POST = json_decode(file_get_contents("php://input"), true);
       $name = $this->request->getPost('name');
      $emailto = $this->request->getPost('email');
       $encrypt_mail=md5($emailto);
      $password = $this->request->getPost('password');
       //$emailto='codewithsaif@gmail.com';
       //$password='676767';
       //$name='Saif Sir';
       //$encrypt_mail=md5($emailto);
       	$subject='Webblio Account Activation Mail ';
       	$message='
       	<div style="width:100%;text-align:center;margin-top:20px;">
       	<p style="text-align:center;font-size:30px;color:red">Webblio.com</p>
       	</div>
       	<div style="width:90%;text-align:center;margin-top:20px;margin-left:auto;margin:right:auto;background:#dedede;padding:20px;height:auto">
          <h1 style="text-align:center;">Just One step more..</h1>
          <p  style="text-align:center;margin-top:10px;color:green;">Hi , <span style="font-size:1rem">'.$name.'</span></p>
         <div style="width:100%;text-align:center;margin-top:20px;">
          <a href="http://hotel-manage.webblio.com/Home/verifyAcc/'.$encrypt_mail.'"   style="background:green;color:white;font-size:1.3rem;border-radius:10px;padding:5px 10px;margin:auto;margin-top:100px;text-align:center">Activate Account</a>
          </a>
          <p  style="text-align:center;margin-top:10px;font-size:18px;">Click the Big Button  to activate your Webblio account.</p>
          
       	</div>
       	';
        /*$message='Hi '.$name.' <br><h3>Click the Link below for Account Activation<h3><br><br>
        <a style="color:purple;font-size:1rem" href="https://hotel-manage.webblio.com">https://hotel-manage.webblio.com</a><br>
        <p style="text-align:center">Or</p><br><br>
        <a style="background:green;color:white;font-size:1.3rem;border-radius:10px;padding:5px 10px">Activate Account</a>
        ';*/
        $email= \Config\Services::email();
        $email->setTo($emailto);
        $email->setFrom('care@webblio.com','Webblio');
        $email->seTSubject($subject);
        $email->seTMessage($message);
        //$filepath= 'httpdocs/images/sign.png';
        //$email->$attach($filepath);
        if($email->send()){
          
         $userData=[
             'email'=>$emailto,
             'name'=>$name,
             'password'=>md5($password),
             'verification'=>'0',
             'hashmail'=>md5($emailto)
             ];   
             $custom=new UserModel();
         $reg=$custom->registerUser($userData);
           if($reg){
           echo json_encode(array("statuse"=> true,"message"=> 'Message Send SuccessFully'));
            }else{
            echo json_encode(array("statuse"=> true,"message"=> 'Message Send SuccessFully User not Regsitered')); 
         }
        }else{
            $data=$email->printDebugger(['headers']);
            echo json_encode(array("statuse"=> false,"message"=> $data));
         //$data=$email->printDebugger(['headers']);
         //print_r($data);
        }
    }
    public function registerUser(){
      	$_POST = json_decode(file_get_contents("php://input"), true);
        $name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		
		$this->load->model('UserModel');
		

		if($this->queries->userExists($email)){
			echo json_encode(array("isSuccess"=> false,"statusCode"=> USER_CONFLICT)); //conflict
		}else{
			if($this->queries->isRefCodeInvalid($refferedBy)){
				echo json_encode(array("isSuccess"=> false,"statusCode"=> INVALID_REF_CODE)); //invalid ref code
			}else{
				if($this->queries->registerUser($mobile,$password,$refferedBy)){
					echo json_encode(array("isSuccess"=> true,"statusCode"=> REG_SUCCESS)); //all okay
				}else{
					echo json_encode(array("isSuccess"=> false,"statusCode"=> INTERNAL_SERVER_ERROR)); //internl server error
				}
			}
		}  
    }
    
    public function distribute(){
        
$url = "https://reqbin.com/echo/post/xml";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/xml",
   "Accept: application/xml",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = <<<DATA
<?xml version=1.0 encoding=utf-8?>
<source>
    <publisher>ATS Name</publisher>
    <publisherurl>http://www.atssite.com</publisherurl>
    <lastBuildDate>Fri, 10 Dec 2008 22:49:39 GMT</lastBuildDate>
    <job>
        <title><![CDATA[Sales Executive]]></title>
        <date><![CDATA[Tue, 29 Jun 2021 22:49:39 GMT]]></date>
        <referencenumber><![CDATA[unique123131]]></referencenumber>
        <url>
            <![CDATA[http://www.examplesite.com/viewjob.cfm?jobid=unique123131&amp;source=Indeed]]>
        </url>
        <company><![CDATA[ABC Hospital]]></company>
        <sourcename><![CDATA[ABC Medical Group]]></sourcename>
        <city><![CDATA[Phoenix]]></city>
        <state><![CDATA[AZ]]></state>
        <country><![CDATA[US]]></country>
        <postalcode><![CDATA[85003]]></postalcode>
        <streetaddress><![CDATA[123 fake street Phoenix AZ, 85003]]></streetaddress>
        <email><![CDATA[example@abccorp.com]]></email>
        <description>
            <![CDATA[Do you have 1-3 years of sales experience? Are you
            relentless at closing the deal? Are you ready for an exciting and
            high-speed career in sales? If so, we want to hear from you! [...]
            We provide competitive compensation, including stock options and a full
            benefit plan. As a fast-growing business, we offer excellent opportunities
            for exciting and challenging work. As our company continues to grow, you
            can expect unlimited career advancement! ]]>
        </description>
        <salary><![CDATA[90K per year]]></salary>
        <education><![CDATA[Bachelors]]></education>
        <jobtype><![CDATA[fulltime, parttime]]></jobtype>
        <category><![CDATA[Category1, Category2, CategoryN]]></category>
        <experience><![CDATA[5+ years]]></experience>
        <expirationdate><![CDATA[Mon, 08 Nov 2021]]></expirationdate>
        <remotetype><![CDATA[COVID-19]]></remotetype>
        <indeed-apply-data>COVERED IN A LATER SECTION</indeed-apply-data>
    </job>
</source>
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
    }
    
}

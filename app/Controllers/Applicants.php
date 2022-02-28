<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobModel;
use App\Models\JobSeekers;
use App\Models\Employers;
use App\Models\Template;
use App\Models\Uploads;
use App\Models\Applications;

class Applicants extends BaseController
{
   
    public function index($browsefor=null)
    {
        $data['browsefor']=$browsefor;
        return view('front/signin',$data);
    }
    public function resolve(){
        $apple=new Applications();
        $getAllSeeker=$apple->getAllSeekers();
        foreach($getAllSeeker as $seeker){
            //update hasmail
            $email=$seeker->email;
            $data=[
                'hashmail'=>md5($email)
                ];
            $updateEmail=$apple->updateHash($data,$email);
        }
    }
    public function connect(){
        $session = \Config\Services::session($config);
        $hasmail=$this->request->getPost('hashmail');
        $apple=new Applications();
        $seeker=new JobSeekers();
        $myData=$seeker->getDetailsCoded($hashmail);
        $email=$myData[0]->email;
     $expData=$seeker->getExpCoded($email);
     $data["myData"]=$myData;
     $data['exp']=$expData;
          $data['view_type']=0;
        
        $checkType=$apple->checkConnection($myData[0]->id,$session->get('userdata')['id']);
        if($checkType){
            
        }else{
          //Insert Data
        $data=[
            'email'=>$myData[0]->email,
            'applicant_id'=>$myData[0]->id,
            'company_id'=>$session->get('userdata')['id'],
            'created_at'=>date('Y-m-d H:i:s'),
            'status'=>1
            ];
        $addConnection=$apple->addTalents($data);    
        }
          
       
        echo json_encode(array('url'=>''));
        
         // return view('front/user/view_user',$data);
        
        //Select If Connection Exists
        
        //If Not exists
        
        
        
    }
    public function allApplicants(){
        $data['info']="Hello Userid";
       return view('front/user/applicants/',$data); 
    }
    
    public function myApplied(){
        $session = \Config\Services::session($config);
        $jobId=$this->request->getPost('job_id');
        $required=$this->request->getPost('required');
        $userid=$session->get('userdata')['email'];
        //1. Find I have glus to proceed or not 
        //2. Find I have alreday Applied or Not
        $seeker=new JobSeekers();
        $job= new JobModel();
        $apply=new Applications();
        
        
        $jobInfo=$job->getJobDetails($jobId);
        $mydata=$seeker->getDetails($userid);
        $myGlus=$mydata[0]->wallet;
        $data=['wallet'=>$myGlus-$required
            ];
        $seekerId=$session->get('userdata')['id'];
       
        //find My Application
        $applied=$apply->getApplied($jobId,$seekerId);
        if($applied){
            echo json_encode(array('response'=>false,'message'=>'You have Already Applied for this Job'));
        }else{    
        if($myGlus>=$required){
            //Reduce My Glus
           $company_id=$jobInfo->company_id;
                //Go For Adding My Data in job Applicants List of this Particular Job
                $application=[
                  'company_id'=>$company_id,	
                  'post_id'=>$jobId,
                  'applicant_id'=>$seekerId,
                  'applied_at'=>date('Y-m-d'),	
                  'room_id'=>0,
                  'status'=>0,
                  'response'=>0,	
                  'marks_obtained'=>0,
                  'created_at'=>time(),
                  'ended_at'=>time()+600,
                    ];
                $add=$apply->addApplication($application);
                if($add){
                    //$updateWallet=$seeker->updateWallet($data,$userid);
                    if(2>1){
                      echo json_encode(array('response'=>true,'message'=>'Applied to Job Successfully'));  
                    }else{
                       echo json_encode(array('response'=>false,'message'=>'Balance Factor'));  
                    }
                    
                }else{
                    echo json_encode(array('response'=>false,'message'=>'Unabled to add '));
                }
            
            
        }else{
            echo json_encode(array('response'=>true,'message'=>'Not Enough Glus To Proceed '.$myGlus));
        }
        }
      
    }
    
    public function profile(){
        $session = \Config\Services::session($config); 
     $employer=new Employers();
     $uploads=new Uploads();
     $assets = $uploads->getData();
             $employerDetails=$employer->getDetails($session->get('userdata')['email']);
             $company_id=$employerDetails['0']->id;
             $myjobs=$employer->getPostedJobs($company_id);
             $data['myjobs']=$myjobs;
             $data['mydata']=$employerDetails;
             $data['assets']=$assets;
          return view('front/user/profile',$data);     
    }
    
    public function settings(){
        $session = \Config\Services::session($config); 
     $employer=new Employers();
     $uploads=new Uploads();
     $assets = $uploads->getData();
             $employerDetails=$employer->getDetails($session->get('userdata')['email']);
             $company_id=$employerDetails['0']->id;
             $myjobs=$employer->getPostedJobs($company_id);
             $data['myjobs']=$myjobs;
             $data['mydata']=$employerDetails;
             $data['assets']=$assets;
          return view('front/user/settings',$data);     
    }
    
    public function userAuth(){
       $session = \Config\Services::session($config); 
        if(($session->get('userdata')['name'])==""){
         return redirect()->to('signin');
         }else{
             $template=new Template();
             $data=[];
               $id=$session->get('userdata')['id'];
               $myTemplates=$template->loadTemplate($id);
               $data["myTemplates"]=$myTemplates;
             $employer=new Employers();
             $mydatas=$employer->getDetails($session->get('userdata')['email']);
             $company_id=$mydatas['0']->id;
             $myjobs=$employer->getPostedJobs($company_id);
             $data["myjobs"]=$myjobs;
             $seeker=new JobSeekers();
             $mydata=$seeker->getDetails($session->get('userdata')['email']);
             if($session->get('userdata')['usertype']=="jobseeker"){
               $data["myData"]=$mydata;   
             }else{
               $data["myData"]=$mydatas;  
             }
            $data["info"]="Hey welcome";
           
           return view('front/user/index',$data);   
         }
    }
    
    public function resume(){
     $session = \Config\Services::session($config);
     $seeker=new JobSeekers();
     $myData=$seeker->getDetails($session->get('userdata')['email']);
     $data["myData"]=$myData;
          return view('front/resume',$data);    
    }
    
    public function logout(){
        $session = \Config\Services::session($config);
        $session->destroy();
          return view('front/signin'); 
    }
    public function browseAllJobs(){
       $session = \Config\Services::session($config);
       $job=new JobModel();
       $template=new Template();
             $data=[];
               $id=$session->get('userdata')['id'];
               $myTemplates=$template->loadTemplate($id);
               $data["myTemplates"]=$myTemplates;
             $employer=new Employers();
             $mydatas=$employer->getDetails($session->get('userdata')['email']);
             $company_id=$mydatas['0']->id;
             $myjobs=$employer->getPostedJobs($company_id);
             $data["myjobs"]=$myjobs;
             $seeker=new JobSeekers();
             $mydata=$seeker->getDetails($session->get('userdata')['email']);
             if($session->get('userdata')['usertype']=="jobseeker"){
               $data["myData"]=$mydata;   
             }else{
               $data["myData"]=$mydatas;  
             }
       $getDetails=$job->getAllJobs();
       $data['allJobs']=$getDetails;
       
       return view('front/user/browsejobs',$data); 
    }
    public function jobExplanation($id){
       $session = \Config\Services::session($config);
       $job=new JobModel();
       $jobInfo=$job->getJobDetails($id);
       if($jobInfo<1){
             $data['error']='Bad Gateway';
          $data['message']='You entered a manipulated the link';
           return view('front/register',$data);
       }else{
          $data['jobInfo']=$jobInfo;
           return view('front/user/jobInfo',$data);
       }
       
    }
    public function postJob($jobId=null){
       $session = \Config\Services::session($config);
       
              $template=new Template();
               $id=$session->get('userdata')['id'];
               $myTemplates=$template->loadTemplate($id);
               $data['myTemplates']=$myTemplates;
    if($jobId==null){ 
        $editable=2;
    }else{
        //verify This Job 
        $job=new JobModel();
        $isJobEditable=$job->jobStat($jobId,$id);
        if($isJobEditable>0){
        $editable=1;
        }else{
        $editable=0;        
        }
    }
    
    
    
    
    
         if(empty($session->get('job_find_by'))){
    
    if($editable=="2"){
       $session->set('job_find_by', md5(mt_rand()));  
       $session->set('created_at', date('Y-m-d H:i:s')); 
       $ses_jobid=$session->get('job_find_by') ;
      }elseif($editable=="1"){
       $ses_jobid=$jobId;   
      }else{
          $error=true;
          $data['error']=$error;
      }         
             
        
     
    $jobData=[
             'find_by'=>$ses_jobid,
            'company_id'=>$session->get('userdata')['id'],
            'job_heading'=>null,
            'requirement_type'=>'',
             'required_skill'=>null,
             'experience_type'=>0,
            'job_description'=>null,
             'has_attachments'=>0,
              'tokens_required'=>4,
              'wage_type'=> '',
            'hourly_rate'=>0,
            'complete_rate'=>0,
            'is_company_payment_verified'=>0,
             'proposal_limits'=>10,
            'is_premium_post'=>0,
            'interviewed'=>0,
            'status'=>0,
            'admin_approved'=>0,
            'post_time'=>$session->get('created_at')
            ];
            
        $jbtable=new JobModel();
        $addnew=$jbtable->addNewJob($jobData);
        if($addnew){
          
    $job= new JobModel();
    $jobInfo=$job->getJobDetails($ses_jobid);
    $data['jobInfo']=$jobInfo;
    
   return view('front/user/postjob',$data);  
        }else{
            print_r("problem occured while adding");
        }
  }
  else{
      if($editable=="2"){
       $ses_jobid=$session->get('job_find_by') ;   
      }elseif($editable=="1"){
       $ses_jobid=$jobId;   
      }else{
          $error=true;
          $data['error']=$error;
      }
     
    $job= new JobModel();
    $jobInfo=$job->getJobDetails($ses_jobid);
    $data['jobInfo']=$jobInfo;
   //print_r($data);
   echo '<br>';
    //print_r($session->get('userdata')); echo '<br>';
    //print_r($session->get('job_find_by'));
  return view('front/user/postjob',$data);
  }
        
    
    
   
    } 
   
    public function previewJobs($id){
            $session = \Config\Services::session($config);
       $job=new JobModel();
       $company_id=$session->get('userdata')['id'];
       $jobInfo=$job->previewJobDetails($id,$company_id);
       
       if($jobInfo>0){
           $template=new Template();
           $tempid=$jobInfo[0]->template_id;
           $myTemplates=$template->loadTemplateByTempId($tempid);
          $datas['myTemplates']=$myTemplates;
            $datas["jobInfo"]=$jobInfo;
           return view('front/user/jobpreview',$datas);
       }else{
         
           $datas['error']='Bad Gateway';
          $datas['message']='You entered a manipulated the link';
          //print_r($company_id);
          return view('front/register',$datas);
       }
         
    } 
    
    
    
     public function applyJob($id){
            $session = \Config\Services::session($config);
       $job=new JobModel();
       $jobInfo=$job->getJobDetails($id);
       
       if($jobInfo>0){
           $template=new Template();
           $tempid=$jobInfo->template_id;
           $myTemplates=$template->loadTemplateByTempId($tempid);
          $datas['myTemplates']=$myTemplates;
            $datas["jobInfo"]=$jobInfo;
            $datas['template_id']=$tempid;
           //print_r($myTemplates); 
        return view('front/user/applyJobs',$datas);
       }else{
         
           $datas['error']='Bad Gateway';
          $datas['message']='You entered a manipulated the link';
          //print_r($company_id);
          return view('front/register',$datas);
       }
         
    } 
    
     public function verifyCompany(){
       $session = \Config\Services::session($config);
       return view('front/user/upload-documents'); 
    }
    public function addTemplate(){
       $session = \Config\Services::session($config);
       $template=new Template();
       $id=$session->get('userdata')['id'];
       $myTemplates=$template->loadTemplate($id);
       $data['myTemplates']=$myTemplates;
       return view('front/user/add-templates',$data); 
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
    
}

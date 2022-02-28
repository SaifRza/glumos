<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobModel;
use App\Models\JobSeekers;
use App\Models\Employers;
use App\Models\Template;
use App\Models\Chats;

class ChatSection extends BaseController
{
   
    public function index($browsefor=null)
    {
        $chat = new Chats();
        $messages=$chat->getMessages();
        $data['messages']=$messages;
        $data['browsefor']=$browsefor;
        return view('front/chat/chat-view',$data);
    }
    
    public function userAuth(){
       $session = \Config\Services::session($config); 
        if(($session->get('userdata')['name'])==""){
         return redirect()->to('signin');
         }else{
             $template=new Template();
               $id=$session->get('userdata')['id'];
               $myTemplates=$template->loadTemplate($id);
               $data['myTemplates']=$myTemplates;
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
       $job=new JobModel();
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
    public function postJob(){
       $session = \Config\Services::session($config);
              $template=new Template();
               $id=$session->get('userdata')['id'];
               $myTemplates=$template->loadTemplate($id);
               $data['myTemplates']=$myTemplates;
         if(empty($session->get('job_find_by'))){
       $session->set('job_find_by', md5(mt_rand()));  
       $session->set('created_at', date('Y-m-d H:i:s')); 
     
    $jobData=[
             'find_by'=>$session->get('job_find_by'),
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
         $ses_jobid=$session->get('job_find_by') ; 
    $job= new JobModel();
    $jobInfo=$job->getJobDetails($ses_jobid);
    $data['jobInfo']=$jobInfo;
    
   return view('front/user/postjob',$data);  
        }else{
            print_r("problem occured while adding");
        }
  }
  else{
    $ses_jobid=$session->get('job_find_by') ; 
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

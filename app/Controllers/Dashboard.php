<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobModel;
use App\Models\JobSeekers;
use App\Models\Employers;
use App\Models\Template;
use App\Models\Uploads;
use App\Models\Checkouts;
use App\Models\Applications;
use CodeIgniter\I18n\Time;

class Dashboard extends BaseController
{
  
    public function index($browsefor=null)
    {
        $data['browsefor']=$browsefor;
        return view('front/signin',$data);
    }
    
    public function profile(){
        $session = \Config\Services::session($config); 
     $employer=new Employers();
     $uploads=new Uploads();
     $assets = $uploads->getData($session->get('userdata')['id']);
             $employerDetails=$employer->getDetails($session->get('userdata')['email']);
             $company_id=$employerDetails[0]->id;
             $myjobs=$employer->getPostedJobs($session->get('userdata')['id']);
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
       $checkout = new Checkouts();
       $isSubs=$checkout->isCheckout($session->get('userdata')['email']);
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
             $company_id=$session->get('userdata')['id'];
             $myjobs=$employer->getPostedJobs($company_id);
             $data["myjobs"]=$myjobs;
             $seeker=new JobSeekers();
             $mydata=$seeker->getDetails($session->get('userdata')['email']);
             if($isSubs){
                 $data['subscribed']=1;
                 $sub=1;
             }
             else{
                 $data['subscribed']=0;
                 $sub=0;
             }
             if($session->get('userdata')['usertype']=="jobseeker"){
               $myApplied=$template->getMyApplication($id);
               $data["myData"]=$mydata;  
               $data["myapplied"]=$myApplied;
             }else{
               
               //Talents List
               $talents=$employer->getConnections($session->get('userdata')['email'],$sub);
               $data['talents']=$talents;
                 
               //Below is myposted jobs lists
                 //count and fire foreach
                 if($myjobs){
                     foreach($myjobs as $jobdata){
                         $job_post_id=$jobdata->find_by;
                         if($job_post_id){
                          
                    $getSubmissions=$employer->countSubmissions($job_post_id);
                         
                        $cart=[$job_post_id => $getSubmissions];
                        $cartNow=$cart;
                        $subs[$job_post_id]=$getSubmissions;
                     }
                     }
                    
                 }
               
               
               //Load Submission count
               
             }
             
             
             //$data['submissions']=$array;
            // print_r($data);
            //$data["info"]="Hey welcome";
            $data['subs']=$subs;
           
         return view('front/user/index',$data);   
         }
    }
    
    public function saveJob(){
    $session = \Config\Services::session($config);
    $seeker=new JobSeekers();
    $jobId=$this->request->getPost('job_id');
        //insert New connection
             $dataInsert=[
                 'applicant_id'=>$session->get('userdata')['id'],
                 'post_id'=>$jobId,
                 'created_at'=>date('Y-m-d H:i:s'),
                 ];
             $addConnection=$seeker->saveThisJob($dataInsert,$session->get('userdata')['id'],$jobId);
             if($addConnection){
              echo json_encode(array("statuse"=> true,"message"=> 'Job Saved Successfully'));   
             }else{
              echo json_encode(array("statuse"=> false,"message"=> 'Already Saved this Job'));   
             }         
    }
    
    
    
    public function resumeView($id){
     $session = \Config\Services::session($config);
     $employer=new Employers();
    
    
     $user_hashmail=$id;
     $seeker=new JobSeekers();
     $myData=$seeker->getDetailsCoded($user_hashmail);
     $email=$myData[0]->email;
     $name=$myData[0]->name;
     $expData=$seeker->getExpCoded($email); 
     
     if($session->get('userdata')['usertype']=='employer'){
         $Emp_email=$session->get('userdata')['email'];
         //Check connection exists or not
         $isConnected=$employer->isConnected($id,$Emp_email);
         if($isConnected){
             
         }else{
             //insert New connection
             $dataInsert=[
                 'employer'=>$Emp_email,
                 'seeker_email'=>$email,
                 'hashmail'=>$id,
                 'seeker_name'=>$name,
                 'status'=>0
                 ];
             $addConnection=$employer->addNewConnection($dataInsert);
         }
         
     }
    
     $data["myData"]=$myData;
     $data['exp']=$expData;
          $data['view_type']=0;
          return view('front/user/view_user',$data); 
    }
    
    public function resume(){
     $session = \Config\Services::session($config);
     $seeker=new JobSeekers();
       $checkout = new Checkouts();
       $isSubs=$checkout->isCheckout($session->get('userdata')['email']);
       $id=$session->get('userdata')['id'];
        if($isSubs){
                 $data['subscribed']=1;
                 $sub=1;
             }
             else{
                 $data['subscribed']=0;
                 $sub=0;
             }
     $myData=$seeker->getDetails($session->get('userdata')['email']);
     $expData=$seeker->getExp($session->get('userdata')['id']);
     $data["myData"]=$myData;
     $data['exp']=$expData;
          $data['view_type']=0;
          return view('front/resume',$data);    
    }
    public function resumeClear(){
     $session = \Config\Services::session($config);
     $seeker=new JobSeekers();
     $myData=$seeker->getDetails($session->get('userdata')['email']);
     $expData=$seeker->getExp($session->get('userdata')['id']);
     $data["myData"]=$myData;
     $data['view_type']=1;
     $data['exp']=$expData;
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
               /* foreach($myTemplates as $myT){
                   //Count all question with template id update template
                   $t_id=$myT->template_id;
                   $count=$template->countQuestions($t_id);
                   $updateTemp=$template->updateT(8,$t_id);
               } */
               $data["myTemplates"]=$myTemplates;
               
              
             $employer=new Employers();
             $saved_list=$job->getSavedJobs($session->get('userdata')['id']); 
             $data['savedJobs']=$saved_list;
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
       $seeker= new JobSeekers();
       
       
       $jobInfo=$job->getJobDetails($id);
       $company_id=$jobInfo->company_id;
       $company=$seeker->getCompanyDetails($company_id);
       $company_assets=$seeker->getCompanyAssets($company_id);
       if($jobInfo<1){
             $data['error']='Bad Gateway';
          $data['message']='You entered a manipulated the link';
           return view('front/register',$data);
       }else{
          $data['jobInfo']=$jobInfo;
          $data['company']=$company;
          $data['company_assets']=$company_assets;
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
       $template=new Template();        
       $job=new JobModel();
       $jobInfo=$job->getJobDetails($id);
       //Get From  application
       $tempid=$jobInfo->template_id;
       $user_id=$session->get('userdata')['id'];
       //Check if I have Applied
       $checkAlready=$template->checkApplication($tempid,$user_id);
     
       if($checkAlready){
           $datas['info']=$checkAlready;
           $datas['message_data']='You have Already Applied for this Job';
          return view('front/user/applyJobs',$datas);
          
       }
       else{
       
       if($jobInfo>0){
           $template=new Template();
           //print_r($jobInfo->find_by);
           $apple=new Applications();
           
           //print_r($jobApplication);
           $tempid=$jobInfo->template_id;
           $ref_id=$jobInfo->id;
           $myTemplates=$template->loadTemplateByTempId($tempid);
          $datas['myTemplates']=$myTemplates;
            $datas["jobInfo"]=$jobInfo;
            $datas['template_id']=$tempid;
           //print_r($myTemplates);
             $jobApplication=$template->getApplicationDetails($jobInfo->find_by,$session->get('userdata')['id']);
       $datas['application_info']=$jobApplication;
           $datas['ref_post_id']=$id;
        return view('front/user/applyJobs',$datas);
       }else{
         
           $datas['error']='Bad Gateway';
          $datas['message']='You entered a manipulated the link';
          //print_r($company_id);
          return view('front/register',$datas);
       }
       }    
    } 
    
    public function verifyCompany(){
       $session = \Config\Services::session($config);
       return view('front/user/upload-documents'); 
    }
    
    public function addTemplate(){
       $session = \Config\Services::session($config);
       $template=new Template();
        $checkout = new Checkouts();
       $isSubs=$checkout->isCheckout($session->get('userdata')['email']);
       $id=$session->get('userdata')['id'];
        if($isSubs){
                 $data['subscribed']=1;
                 $sub=1;
             }
             else{
                 $data['subscribed']=0;
                 $sub=0;
             }
       $myTemplates=$template->loadTemplate($id);
       $myTemplates=$template->loadTemplate($id);
                if(count($myTemplates)>0){
               foreach($myTemplates as $myT){
                   $count=$template->countQuestions($myT->template_id);
                   $updateTemp=$template->updateT($count,$myT->template_id);
               } 
               }else{
                      // echo "Error with count variable";
                   } 
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
    
    public function allApplicants($id){
      $session = \Config\Services::session($config);
      $data['jobid']=$id;
      $company_id=$session->get('userdata')['id'];
      $employer= new Employers();
       if($isSubs){
                 $data['subscribed']=1;
                 $sub=1;
             }
             else{
                 $data['subscribed']=0;
                 $sub=0;
             }
      //Verify Id
      $isMyJobPost=$employer->isMyPostedJob($company_id);
      if($isMyJobPost){
       $data['job']=$employer->jobDetailsByPostId($id);
       //List of Applicants
       $data['applicants']=$employer->getAllApplicants($id,$sub);
       
       //print_r($employer->getAllApplicants($id));
       
      }else{
       $data['error']='This is not a Valid Link';   
      }
      
      return view('front/user/view-applicants',$data);
      //Load Applicants Data;
      
      //then
       
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

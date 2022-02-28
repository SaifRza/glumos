<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobSeekers;
use App\Models\Employers;

class Auth extends BaseController
{
   
    public function index($browsefor=null)
    {
        $data['browsefor']=$browsefor;
        return view('front/signin',$data);
    }
    public function signup(){
       return view('front/register'); 
    }
    
    public function forgetPass(){
        return view('front/forget-password'); 
    }
    
    public function changePassword($token=null){
        
        if(empty($token)){
            $data['error']=true;
            $data['error_message']='Bad Url Entered';
        }else{
        $seeker=new JobSeekers();    
        $istoken=$seeker->checkTokens($token);    
        if($istoken){
         $data['error']=true;
         $data['error_message']='Bad Url Entered'; 
        }
        else{
             $data['error']=false;
             $data['error_message']='gopd Entered';
             $data['token']=$token;
        }   
            
        $data['new_password']=true;
        return view('front/forget-password',$data);
        }
        
        
    } 
    
    
    
    public function login(){
         $session = \Config\Services::session($config);
         if(empty($session->get('userdata')['name'])){
            return view('front/signin');
         }else{
           return redirect()->to('/dashboard');   
         }
         
    }
    
    public function resetLink(){
      $emailVal = $this->request->getPost('emailed');  
      //is email existing in our database or not
      $seeker= new JobSeekers();
     $employer= new Employers();
     $isSeeker=$seeker->searchSeeker($emailVal);
    if($isSeeker){
        $selected='jobseeker';
        
    }
    $isEmployer=$employer->searchEmployer($emailVal);
    if($isEmployer){
       $selected='employer';
       
       $details=$seeker->getDetails($emailVal);
    }
    if($selected=="employer"||$selected=="seeker"){
       $details=$employer->getDetails($emailVal);
       $data=array(
           'email'=>$emailVal,
           'type'=>$selected,
           'reset_token'=>md5($emailVal)
           );
       $insert=$seeker->addToResetPassword($data);
       if($insert){
           //fire email
           
                 //Email Bodyyyy---
         $activation_url=base_url('reset-the-password');    
         $encrypt_mail=md5($emailVal);
         $name=$selected;
         $emailto=$emailVal;
         $logo_img=base_url('httpdocs/images/main_logo.png');
       	$subject='Glumos Password Reset Mail ';
        	$message='
     <div style="width:500px;text-align:center;margin-top:20px;background-color:#eee;max-width:600px;min-width:400px;margin-left:auto;margin-right:auto">
    <div class="" style="text-align: center;;margin: auto;">
        <img src="https://glumos.webblio.com/httpdocs/images/main_logo.png" style="height: 90px;width: 90px;">
    </div>
    <div class="" style="background-color: white;text-align: center;padding: 20px;">
        <h1>Just One More Step</h1>
        <p style="margin-top: -20px;font-size: 22px;font-weight:700;">'.$name.'</p>
        <p>Click the button below to change your password.</p>
        <a class="" style="background-color:blue;margin-top: 30px;width: 400px;padding:10px;text-align: center;color: white;"   href="'.$activation_url."/".$encrypt_mail.'">
        Verify Account</a>
    
    </div>
    <div style="margin-top:30px"></div>
    <div class="" style="display: flex;flex-direction: row;margin:auto;width:70%">
    <div class="" style="width:80x;margin:auto">
        <img src="https://cdn-icons-png.flaticon.com/512/145/145802.png" style="width:30px;height:30px">
    </div>
    <div class="" style="width:80x;margin:auto">
        <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" style="width:30px;height:30px">
    </div>
    </div>
    <div class="" style="text-align:center;margin-top:10px">
    Copyright(C) 2022 Glumos All Rights Reserved<br>
    Our Mailing address is <br>
    Glumos <br>
    Block E , Level 2 , Faculty of Bussines & law,<br>
    No.1 Jalan Taylors Subhang Jaya, Selangor 47500<br>
    Malaysia
    
    </div>
    </div>
       	';
        
        $email= \Config\Services::email();
        $email->setTo($emailto);
        $email->setFrom('support@webleader.in','Glumos');
        $email->seTSubject($subject);
        $email->seTMessage($message);
        //$filepath= 'httpdocs/images/sign.png';
        //$email->$attach($filepath);
        if($email->send()){
             echo json_encode(array("response"=> true,"message"=> "If email id is resgiterd  then Mail send SuccessFully"));
        }else{
            $data=$email->printDebugger(['headers']);
            echo json_encode(array("response"=> false,"message"=> $data));
        
        }
              
              
              //email Body ends
           
           
       }
    }
     else{
         echo json_encode(array('response'=>true,'message'=>"If this email is registered mail has been sent successfully"));
     } 
    }
    
    
    public function resetProcess(){
     $session = \Config\Services::session($config);
     $password = $this->request->getPost('passworded');
     $token = $this->request->getPost('token');
     $seeker= new JobSeekers();
     $employer= new Employers();
     $getInfo=$seeker->getTokenInfo($token);
     $type=$getInfo[0]->type;
     $email=$getInfo[0]->email;
     if($type=="employer"){
         $data=array(
             'password'=>md5($password)
             );
       $updatePassword=$employer->updatePassword($data,$email) ; 
     }elseif($type=="seeker"){
         $data=array(
             'password'=>md5($password)
             );
       $updatePassword=$seeker->updatePassword($data,$email);  
     }
    if($updatePassword){
        $setStatus=$seeker->setStatustoToken($data,$token);
        echo json_encode(array('response'=>true,'message'=>'Updated Password Succeefully'));
    }else{
        echo json_encode(array('response'=>false,'message'=>'Unable to update Password')); 
    }
     
    
     
       
    } 
    
    
    public function loginHandle(){
     $session = \Config\Services::session($config);
    $email = $this->request->getPost('emailed');
    $password = $this->request->getPost('passworded');
     $seeker= new JobSeekers();
     $employer = new Employers();
    //is email in employersTb
    $isSeeker=$seeker->searchSeeker($email);
    if($isSeeker){
        $selected='jobseeker';
        
    }
    $isEmployer=$employer->searchEmployer($email);
    if($isEmployer){
       $selected='employer';  
    }
    
   
    
    
    if($selected=='jobseeker'){
       $seeker= new JobSeekers();
     $jobSeeker=$seeker->isJobSeekerValid($email,$password);
     if($jobSeeker){
         $details=$seeker->getDetails($email);
         //$jobSeekerVerified=$seeker->isJobSeekerVerified(md5($email));
         if($details[0]->status=='1'){
         $session->set("userdata", array(
                'name' => $details[0]->name,
                'email'=>$details[0]->email,
                 'id'=>$details[0]->id,
                'usertype'=>$selected
               )); 
         
         echo json_encode(array('response'=>true,'message'=>"Logging In Please Wait..."));    
         }
         else{
         echo json_encode(array('response'=>false,'message'=>"Verify Your Email Id to Proceed"));      
         }
       
     }else{
         echo json_encode(array('response'=>false,'message'=>$jobSeeker));  
     }
    }else if($selected=='employer'){
       $employer= new Employers();
     $employerExists=$employer->isEmployerValid($email,md5($password));
     if($employerExists){
         $details=$employer->getDetails($email);
         $employerVerified=$employer->isEmployerVerified(md5($email));
         if($details[0]->user_status=='1'){
         $session->set("userdata", array(
                'name' => $details[0]->name,
                'email'=>$details[0]->email,
                 'id'=>$details[0]->company_id,
                'usertype'=>$selected
               )); 
         
         echo json_encode(array('response'=>true,'message'=>"Logging In Please Wait..."));    
         }
         else{
         echo json_encode(array('response'=>false,'message'=>"Verify Your Email Id to Proceed"));      
         }
       
     }else{
         echo json_encode(array('response'=>false,'message'=>"Incorrect Userid or Password"));  
     } 
    }
   
        
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
      // $name = $this->request->getPost('name');
      //$emailto = $this->request->getPost('email');
      // $encrypt_mail=md5($emailto);
      //$password = $this->request->getPost('password');
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
        $email->setFrom('support@webleader.in','Webblio');
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

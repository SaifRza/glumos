<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobSeekers;
use App\Models\Employers;

class Signup extends BaseController
{
   
    public function index($type=null)
    {
      
        $data['type']=$type;
        if($type=="company"){
            $data['typeof']='employer'; 
           return view('front/register',$data);  
        }elseif($type=="jobSeeker" || $type==""){
            $data['typeof']='seeker';
           return view('front/register',$data);  
        }elseif($type=="foreign"){
          $data['error']='Bad Gateway';
          $data['message']='You entered a manipulated the link';
           return view('front/register',$data);
        }
        
    }
    public function signup(){
       
    }
    public function login(){
         $session = \Config\Services::session($config);
         if(empty($session->get('userdata')['name'])){
            return view('front/signin');
         }else{
           return redirect()->to('/dashboard');   
         }
         
    }
    public function registerHandle(){
    $password =str_replace(' ','',$this->request->getPost('passwords'));
    $company=$this->request->getPost('company_names');
    $email=str_replace(' ','',$this->request->getPost('emails'));
    $username=str_replace(' ','',$this->request->getPost('usernames'));
    $usertype=$this->request->getPost('type');
    $firstname=str_replace(' ','',$this->request->getPost('fullname'));
    $lastname=str_replace(' ','',$this->request->getPost('lastname'));
    if($usertype!="seeker"){
       if(empty($password)||empty($company)||empty($email)||empty($username)){
           echo json_encode(array('response'=>false,'message'=>'Please Entered All Required Fields'));
       }else{
           $employer = new Employers();
           $newEmployerData=[
               "email"=>$email,
               "name"=>$company,
               "password"=>md5($password),
               "user_status"=>0,
               "username"=>$email,
               "registration_date"=>date('Y-m-d H:i:s'),
               "hashmail"=>md5($email)
               
               ];
            $emailExists=$employer->checkAvail($email);   
           if($emailExists){
              echo json_encode(array('response'=>false,'message'=>'Email already exists'));  
           }else{
               $addEmployer=$employer->addEmployer($newEmployerData);
               if($addEmployer){
                 //echo json_encode(array('response'=>true,'message'=>'Registered Successfully')); 
              //Email Bodyyyy---
         $activation_url=base_url('verify-account');    
         $encrypt_mail=md5($email);
         $name=$company;
         $emailto=$email;
         $logo_img=base_url('httpdocs/images/main_logo.png');
       	$subject='Glumos Account Activation Mail ';
        	$message='
     <div style="width:500px;text-align:center;margin-top:20px;background-color:#eee;max-width:600px;min-width:400px;margin-left:auto;margin-right:auto">
    <div class="" style="text-align: center;;margin: auto;">
        <img src="https://glumos.webblio.com/httpdocs/images/main_logo.png" style="height: 90px;width: 90px;">
    </div>
    <div class="" style="background-color: white;text-align: center;padding: 20px;">
        <h1>Just One More Step</h1>
        <p style="margin-top: -20px;font-size: 22px;font-weight:700;">'.$name.'</p>
        <p>Click the button below to verify your email id.</p>
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
        $email->setFrom('care@webblio.com','Glumos');
        $email->seTSubject($subject);
        $email->seTMessage($message);
        //$filepath= 'httpdocs/images/sign.png';
        //$email->$attach($filepath);
        if($email->send()){
             echo json_encode(array("response"=> true,"message"=> "Mail send SuccessFully"));
        }else{
            $data=$email->printDebugger(['headers']);
            echo json_encode(array("statuse"=> false,"message"=> $data));
        
        }
              
              
              //email Body ends
                 
               }else{
                     echo json_encode(array('response'=>false,'message'=>'Data Not Added to the table')); 
               }
           }       
               
           
           
       }  
    }else{
        
        //And if Equal to job seeker
        
       if(empty($password)||empty($firstname)||empty($lastname)||empty($email)||empty($username)){
           echo json_encode(array('response'=>false,'message'=>'Please Entered All Required Fields'));
       }
       else{
      
           $seeker = new JobSeekers();
           $newSeekerData=[
               "email"=>$email,
               "name"=>$firstname." ".$lastname,
               "password"=>md5($password),
               "status"=>0,
               "username"=>$email,
               "registration_date"=>date('Y-m-d H:i:s'),
               "hashmail"=>md5($email)
               
               ];
            $emailExists=$seeker->checkAvail($email);   
                
               
           echo json_encode(array('response'=>false,'message'=>$emailExists)); 
           
          
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
       //$name = $this->request->getPost('name');
     // $emailto = $this->request->getPost('email');
     //  $encrypt_mail=md5($emailto);
    //  $password = $this->request->getPost('password');
       $emailto='codewithsaif@gmail.com';
       //$password='676767';
       $name='Saif Sir';
      $encrypt_mail=md5($email);
       	$subject='Glumos Account Activation Mail ';
       	$message='
    <div style="width:500px;text-align:center;margin-top:20px;background-color:white;max-width:600px;min-width:400px;margin-left:auto;margin-right:auto">
	<div style="margin:auto;background: linear-gradient(to right, rgb(102, 125, 182), rgb(0, 130, 200), rgb(0, 130, 200), rgb(102, 125, 182));">
	<img src="https://cdn-icons-png.flaticon.com/512/2165/2165056.png" style="height:80px;width:auto;margin-left:auto;margin-right:auto;margin-top:30px;padding-bottom:30px;">
	</div>
	<div class="" style="color:gray;background:white;margin-top:-20px;width:95%;">
	 <h3 style="padding-top:10px">Email Confirmation</h3>
	 <p>Hey Saif , you are almost ready to start your professional journey with GLUMOS. Simply click the big yellow button below to verify your email address .
	 <div style="margin-left:auto;margin-right:auto;padding-top:30px;margin-bottom:30px;">
	 <a style="background: linear-gradient(to right, rgb(253, 200, 48), rgb(243, 115, 53));width:200px;height:60px;padding-top:15px;padding-bottom:15px;padding-right:10px;padding-left:10px;color:white;border-radius:20px" >Verify Email Address</a>
	 </div>
	</div>
</div>';
        
        $email= \Config\Services::email();
        $email->setTo($emailto);
        $email->setFrom('care@webblio.com','Glumos');
        $email->seTSubject($subject);
        $email->seTMessage($message);
        //$filepath= 'httpdocs/images/sign.png';
        //$email->$attach($filepath);
        if($email->send()){
             echo json_encode(array("response"=> true,"message"=> "Mail send SuccessFully"));
        }else{
            $data=$email->printDebugger(['headers']);
            echo json_encode(array("statuse"=> false,"message"=> $data));
         
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

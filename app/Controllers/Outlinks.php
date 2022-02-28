<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobSeekers;
use App\Models\Employers;

class Outlinks extends BaseController
{
   
    public function index($browsefor=null)
    {
        $data['browsefor']=$browsefor;
        return view('front/signin',$data);
    }
    public function privacyPolicy(){
       return view('front/privacyPol'); 
    }
    public function login(){
         $session = \Config\Services::session($config);
         if(empty($session->get('userdata')['name'])){
            return view('front/signin');
         }else{
           return redirect()->to('/dashboard');   
         }
         
    }
    public function loginHandle(){
     $session = \Config\Services::session($config);
    $email = $this->request->getPost('emailed');
    $password = $this->request->getPost('passworded');
    $selected = $this->request->getPost('type');
    if($selected=='jobseeker'){
     $seeker= new JobSeekers();
     $jobseekerExists=$seeker->isJobseekerValid($email,md5($password));
     if($jobseekerExists){
         $details=$seeker->getDetails($email);
         $session->set("userdata", array(
                'name' => $details[0]->name,
                'email'=>$details[0]->email,
                'id'=>$details[0]->id,
                'usertype'=>$selected
               ));
         
         echo json_encode(array('response'=>true,'message'=>"Logging In Please Wait..."));
     }else{
         echo json_encode(array('response'=>false,'message'=>"Open Email Verify Your Email Id to Login"));  
     }
    }else if($selected=='employer'){
       $employer= new Employers();
     $employerExists=$employer->isEmployerValid($email,md5($password));
     if($employerExists){
         $details=$employer->getDetails($email);
         $employerVerified=$employer->isEmployerVerified(md5($email));
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

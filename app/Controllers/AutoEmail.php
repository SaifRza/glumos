<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobModel;
use App\Models\JobSeekers;
use App\Models\Employers;

class AutoEmail extends BaseController
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
               "status"=>0,
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
        
        //get 5  jobs for email 
        $jobs=new JobModel();
        $allJobs=$jobs->getJobsForEmail();
        foreach($allJobs as $job){
            $list.='
                    <div class="" style="display:flex;flex-direction:row;padding:8px;margin-top:10px;margin-left:auto;maergin-right:auto">
                    <div class="" style="width:60%;margin:auto">
                    <h4 style="font-size:16px;margin:0px;">'.$job->job_heading.'</h4>
                    <p style="color:gray;font-size:13px;margin:0px">Freelance</p>
                    </div>
                    <div class="" style="width:40%;margin:auto">
                    <a href="'.base_url('/jobview').'/'.$job->find_by.'"  class="btn btn-primary py-2 px-3" style="background:#012bff;width:auto;color:white;padding:10px 20px;">View</a> 
                    </div>
                   </div>
                    ';
        }
        
     // $_POST = json_decode(file_get_contents("php://input"), true);
       //$name = $this->request->getPost('name');
     // $emailto = $this->request->getPost('email');
     //  $encrypt_mail=md5($emailto);
    //  $password = $this->request->getPost('password');
       $emailto='thilak014@gmail.com';
       //$password='676767';
       $name='Saif Sir';
      $encrypt_mail=md5($email);
       	$subject=' Hey, here`s New Jobs for You ';
       	$message='
       	<head>
       	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>
       	<style>
       	body {
  padding-top:150px;
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
	background-color: #ECECEC;
	}
	
	table {
	  border-collapse: collapse;
	}
	
	td #logo {
	  margin: 0 auto;
	  padding: 14px 0;
	}
	
	img {
	  border: none;
	  display: block;
	}
	
	.blue-btn {
	  display: inline-block;
	  margin-bottom: 34px;
	  border: 3px solid #000AFF;
	  padding: 11px 38px;
	  font-size: 12px;
	  font-family: arial;
	  font-weight: bold;
	  color: #000AFF;
	  text-decoration: none;
	  text-align: center;
	}
	
	a.blue-btn:hover {
	  background-color: #000AFF;
	  color: #fff;
	}
	
	a.white-btn {
	  display: inline-block;
	  margin-bottom: 30px;
	  border: 3px solid #fff;
	  background: transparent;
	  padding: 11px 38px;
	  font-size: 12px;
	  font-family: arial;
	  font-weight: bold;
	  color: #fff;
	  text-decoration: none;
	  text-align: center;
	}
	
	a.white-btn:hover {
	  background-color: #fff;
	  color: #000AFF;
	}
	
	.border-complete {
	  border-top: 1px solid #dadada;
	  border-left: 1px solid #dadada;
	  border-right: 1px solid #dadada;
	}
	
	.border-lr {
	  border-left: 1px solid #dadada;
	  border-right: 1px solid #dadada;
	}
	
	#banner-txt {
	  color: #fff;
	  padding: 15px 32px 0px 32px;
	  font-family: arial;
	  font-size: 13px;
	  text-align: center;
	}
	
	h2 #our-products {
	  font-family: "Pacifico";
	  
	  font-size: 27px;
	  color: #000AFF;
	}
	
	h3.our-products {
	  font-family: arial;
	  font-size: 15px;
	  color: #7c7b7b;
	}
	
	p.our-products {
	  text-align: center;
	  font-family: arial;
	  color: #7c7b7b;
	  font-size: 12px;
	  padding: 10px 10px 24px 10px;
	}
	
	h2.special {
	  margin: 0;
	  color: #fff;
	  color: #fff;
	  font-family: "Pacifico";
	  padding: 15px 32px 0px 32px;
	}
	
	p.special {
	  color: #fff;
	  font-size: 12px;
	  color: #fff;
	  text-align: center;
	  font-family: arial;
	  padding: 0px 32px 10px 32px;
	}
	
	h2#coupons {
	  color: #3baaff;
	  text-align: center;
	  font-family: "Pacifico";
	  margin-top: 30px;
	}
	
	p#coupons {
	  color: #7c7b7b;
	  text-align: center;
	  font-size: 12px;
	  text-align: center;
	  font-family: arial;
	  padding: 0 32px;
	}
	
	#socials {
 
 	}
	
	p#footer-txt {
	  text-align: center;
	  color: #303032;
	  font-family: arial;
	  font-size: 12px;
	  padding: 0 32px;
	}
	
	#social-icons {
   margin-top:50px;
    
	}
	
	@media only screen and (max-width: 640px) {
	  body[yahoo] .deviceWidth {
	    width: 440px!important;
	    padding: 0;
	  }
	  body[yahoo] .center {
	    text-align: center!important;
	  }
	  #social-icons {
	    width: 40%;
	  }
	}
	
	@media only screen and (max-width: 479px) {
	  body[yahoo] .deviceWidth {
	    width: 280px!important;
	    padding: 0;
	  }
	  body[yahoo] .center {
	    text-align: center!important;
	  }
	  #social-icons {
	    width: 60%;
	  }
	}
       	</style>
       	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: "Poppins", sans-serif;">
  <table width="80%" border="0" cellpadding="0" cellspacing="0" align="center">
    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center"  deviceWidth" >
      <tr>
        <td width="100%">
          <table border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
            <tr>
              <td id="logo" align="left">
                <a href="#"><img src="https://cdn-images-1.medium.com/max/900/1*E16hd4iTNl5gtEXkRHfELA.png" alt="" border="0" width=50/></a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="border-lr deviceWidth" bgcolor="#fff">
      <tr>
        <td align="left">
                        <h2 style="margin-left:50px;margin-top:50px;" id="our-products">New jobs alert!</h2> </td>
      </tr>
                                                                     <tr>
        <td align="left" style="">
                        <h4 style="margin-left:50px; width:85%;" id="our-products">For today, these are the jobs that we thought you might be interested in based on your digital resume on Glumos:

</h4> </td>
      </tr>

        <td class="center">

         
           

        </td>
      </tr>
    </table>
    
    '.$list.'
    
    
    

    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center"  deviceWidth"  >
      <tr>
        <td  align="center" valign="top" id="socials">
          <table id="social-icons" >
            <tr>
  <td style="padding:15px;">
                <a href=""><img src="https://cdn-icons-png.flaticon.com/512/145/145802.png" width="32" height="32" style="display:block;" /></a>
              </td>
              <td style="padding:15px;">
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/1384/1384015.png" width="32" height="32" style="display:block;" /></a>
              </td>
                                                                                                                                            
             
 

            </tr>
          </table>
        </td>
      </tr>

      <tr>
        <td style="text-align: center;">
          <p id="footer-txt"> <b>Copyright© 2022 Glumos. All rights reserved. </b>
            <br/><br/>Our mailing address is:<br/>Glumos</br>Block E, Level 2, Faculty of Business and Law,</br>No 1 Jalan Taylor’s</br>Subang Jaya, Selangor 47500</br>
Malaysia

          </p>
        </td>
      </tr>
    </table>
  </table>
</body>';
        
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

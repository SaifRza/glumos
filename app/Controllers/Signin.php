<?php

namespace App\Controllers;
use App\Models\UserModel;


class Signin extends BaseController
{
    

    public function index()
    {
        return view('front/signin');
    }
    public function verifySignin(){
        $session = \Config\Services::session($config);
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
     //$email='codewithsaif@gmail.com';
     //$password='676767';
        $data=[];
        if(!empty($email)){
         $check = new UserModel();
         $verify=$check->isUserExists($email,md5($password));
         if($verify){
             /*$sessionData = [
				'email' => $email,
				'id' => $verify->id,
				'name' =>  $verify->name
			];*/
			$session->set("userdata", array(
                'email' => $verify->email,
				'id' => $verify->id,
				'name' =>  $verify->name
 ));
           echo json_encode(array('statuse'=>true,'message'=>'SuccessFull Login'));  
         }else{
           echo json_encode(array('statuse'=>false,'message'=>'Incorrect Userid and Password here')); 
         }
            
           // $data['hashmail']=$email;
       // return view ('front/login',$login_cookie); 
        }else{
            echo json_encode(array('statuse'=>false,'message'=>'Email Empty'));
        } 
    }

    

}
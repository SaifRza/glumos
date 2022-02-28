<?php

namespace App\Controllers;
use \CodeIgniter\Controller;
use  App\Models\UserModel;
use  App\Models\AdminModel;

class Admin extends BaseController
{
     public function index()
    {
    
    return view('admin/login');
    }
    public function login(){
    $session = \Config\Services::session($config);
    $email = $this->request->getPost('emailed');
    $password = $this->request->getPost('passworded');
    $admin= new AdminModel();
    $adminExists=$admin->isAdminValid($email,$password);
    if($adminExists){
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $key=substr(str_shuffle($str_result), 0, 36);
        $addSessionKey=$admin->addNewKey($key);
        if($addSessionKey){
            $session->set("userdata", array(
                'key' => $key,
               ));
          echo json_encode(array('response'=>true,'message'=>'Logged in Successfully'));   
        }else{
           echo json_encode(array('response'=>true,'message'=>'Session Key Not added'));  
        }
       
    }else{
        echo json_encode(array('response'=>false,'message'=>'Emailid or Password Incorrect'));  
    }
    }
    function dashboard(){
    $session = \Config\Services::session($config); 
     $admin= new AdminModel();
    $adminData=$admin->getAdminInfo();
    $data['adminData']=$adminData;
    $sesKey=$session->get('userdata')['key'];
    $dbKey=$adminData[0]->sessionKey;
    if($sesKey==$dbKey){
      $custom=new UserModel();
      $data['subjects']=$custom->all();
     return view('admin/index',$data);   
    }else{
      $session->setFlashdata('message', 'Somebody Tries To Login Again');    
      return view('admin/login');   
    }
       
   
    }
    public function company(){
      
        $custom=new UserModel();
      $data['subjects']=$custom->all();
      $admin= new AdminModel();
      $employers=$admin->getAllEmployers();
      $data['employers']=$employers;  
     return view('admin/all-employers',$data);    
    }
    
    //Customisation fuhctions
    
    public function custom(){
      
        $custom=new UserModel();
        $data['hero']=$custom->hero();
      $data['subjects']=$custom->all();
      $admin= new AdminModel();
      $jobSeeker=$admin->getAllPayments();
      $data['payments']=$jobSeeker;  
     return view('admin/site-custom.php',$data);    
    }
    
    
    
    
    public function jobSeeker(){
      
        $custom=new UserModel();
      $data['subjects']=$custom->all();
      $admin= new AdminModel();
      $jobSeeker=$admin->getAllJobSeekers();
      $data['jobseekers']=$jobSeeker;  
     return view('admin/job-seeker',$data);    
    }
    public function subscriptions(){
      
        $custom=new UserModel();
      $data['subjects']=$custom->all();
      $admin= new AdminModel();
      $jobSeeker=$admin->getAllPayments();
      $data['payments']=$jobSeeker;  
     return view('admin/subscriptions.php',$data);    
    }
    
     public function jobs(){
      
        $custom=new UserModel();
      $data['subjects']=$custom->all();
      $admin= new AdminModel();
      $employers=$admin->getAllEmployers();
      $data['employers']=$employers;  
     return view('admin/all-jobs',$data);    
    }
    
     public function competitions(){
      
        $custom=new UserModel();
      $data['subjects']=$custom->all();
      $admin= new AdminModel();
      $employers=$admin->getAllEmployers();
      $data['employers']=$employers;  
     return view('admin/competitions',$data);    
    }
    
     public function errorReport(){
      
        $custom=new UserModel();
      $data['subjects']=$custom->all();
      $admin= new AdminModel();
      $employers=$admin->getAllEmployers();
      $data['employers']=$employers;  
     return view('admin/error-reports',$data);    
    }
    
    function updateCompanyStatus(){
     $id= $this->request->getPost('id'); 
     $status= $this->request->getPost('status'); 
     $array=[
         'verification'=>$status
         ];
     $admin=new AdminModel();
        $updated=$admin->updateCompany($array,$id);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Data Successfully'));
        }else{
             echo json_encode(array('response'=>false,'message'=>'Data Not Updated'));
        }
    }
    
    function verifyEmployer(){
      $id= $this->request->getPost('id'); 
        echo json_encode(array('response'=>true,'message'=>"Verifying $id"));
    }
    function allEmployers(){
       
        $custom=new UserModel();
      $data['subjects']=$custom->all();
      $admin= new AdminModel();
      $employers=$admin->getAllEmployers();
      $data['employers']=$employers;  
     return view('admin/all-employers',$data);
    }
    function analytics(){
       
        $custom=new UserModel();
      $data['subjects']=$custom->all();
        
     return view('admin/index',$data);
    }
    
    function ecommerce(){
         helper('form');
        $custom=new UserModel();
      $data['subjects']=$custom->all();
        
     return view('admin/ecommerce',$data);
    }
}

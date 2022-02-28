<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobModel;
use App\Models\NewsModel;


class News extends BaseController
{
    

    public function index()
    {
         $news=new NewsModel();
      $data['allnews']=$news->allNews();
       return view('front/all_news', $data);
    }
     public function newsCategory($category)
    {
         $news=new NewsModel();
         $data['category']=$category;
      $data['allnews']=$news->newsCategory($category);
       return view('front/all_news', $data);
    }
    
    
    public function viewNews($id){
        $news =new NewsModel();
        $data['newsData']=$news->getNewsDetails($id);
        if(empty($data['newsData'])){
            $data['error']='Sorry This Content is Unavailable';
        }
        return view('front/view_news',$data);
    }
    public function job_list(){
        
        return view('front/search_job_list');
    }
    public function jobDetailsByTitle($title){
        $job=new JobModel();
        $getId=$job->getJobDetailsByTitle($title);
        $id=$getId->id;
      if(!empty($id)){
        $data['jobData']=$job->getJobDetails($id);
        return view('front/job_apply',$data);
      }else{
        $data['job_name']=$title;
        $data['error']='Sorry This Particular Job Does Not Exists';
        return view('front/job_apply',$data);  
      }
    }
    
    
    public function jobDetailsByIndustry($industry){
        $job=new JobModel();
        $getId=$job->getJobDetailsByIndustry($industry);
       
      if($getId>0){
        $data['jobs']=$job->allByIndustry($industry);
        return view('front/browse_jobs',$data);
      }else{
        $data['job_name']=$industry;
        $data['error']='Sorry This Particular Job Industry Does Not Exists';
        return view('front/job_apply',$data);  
      }
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
           echo json_encode(array('statuse'=>false,'message'=>'Incorrect Userid and Password')); 
         }
            
           // $data['hashmail']=$email;
       // return view ('front/login',$login_cookie); 
        }else{
            echo json_encode(array('statuse'=>false,'message'=>'Email Empty'));
        } 
    }

    

}
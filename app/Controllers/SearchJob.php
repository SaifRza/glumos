<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobModel;


class SearchJob extends BaseController
{
    
     public function filter(){
          $jobModel =new JobModel();
        $data=$this->request->getPost();
        //print_r($data);
        $category=$this->request->getPost('category');
        if($category<2){
           //Api query 
        }else{
            //database query
            if($this->request->getPost('experience')){
              $experience=$this->request->getPost('experience');  
            }else{
                $location=0;
            }
            //By default all
            
            
              $sortby=$this->request->getPost('sorter');  
            
            //By default date
              $maxSalary=$this->request->getPost('max_salary_range');  
              $minSalary=$this->request->getPost('min_salary_range');
            //By default all  
            if($this->request->getPost('location')){
              $location=$this->request->getPost('location');  
            }else{
                $location=0;
            }  
            
            //By default all
           
            //OutPut
            $getData=$jobModel->filterJobs($maxSalary,$minSalary,$experience,$sortby,$location);
            
             if(count($getData)>0){
       foreach($getData as $jobs){
       if($jobs->logo_img==""){$logo_url='/httpdocs/logo-images/default_company.png';}else{$logo_url='/httpdocs/logo-images/'.$jobs->logo_img;}  
           if($jobs->complete_rate==""){
          $rate=0;
      }else{
          if($jobs->wage_type=="1"){
              $rate="/hour";
          }elseif($jobs->wage_type=="2"){
              $rate="/day";
          }elseif($jobs->wage_type=="3"){
              $rate="/week";
          }
      }
           $datas.='<div class="p-2 rounded bg-white my-2">
    <div class="row d-flex pt-2 justify-content-around">
        <div class="col-auto">
            
            <img src="'.base_url($logo_url).'" style="width:80px;height:80px;">
        </div> 
        <div class="col-6 text-left">
            <p class="m-0 text-muted">'.$jobs->name.'</p><h4 class="m-0 fav-col fw-bolder">'.$jobs->job_heading.'</h4><p class="m-0 text-muted">Location : N/A</p>
        </div> 
        <div class="col-3 text-right d-flex justify-content-end">
         <p class="m-0 text-muted text-right" style="font-size:14px;"> days ago</p>
        </div>
        
    </div>   
    <div class="row d-flex mt-2 mx-3"> 
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >schedule</span><span class="icon-text">'.($jobs->requirement_type=="1"?'Freelance':'Fulltime').'</span></p>
    </div>
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >attach_money</span><span class="icon-text"  >$ '.($jobs->complete_rate<1?$jobs->hourly_rate.$rate:$jobs->complete_rate  ).'</span></p>
    </div>
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >work</span><span class="icon-text"  >Experience : '.($jobs->experience_type=='1'?'Expert':'Intermediate').'</span></p></div>
    </div>  
    
    <div class="py-3">
        <ul class="mx-3">
         '.$jobs->job_description.'
        </ul>
    </div>  
    
    <div class="row d-flex justify-content-around mx-0">
        <div class="col-7 my-auto">
            <p class="text-muted my-auto">0 applicants</p>
        </div>
        <div class="col-2 my-auto btn btn-primary bg-white fav-border fav-text  px-2 py-1" style="">
            <a class="fav-text" href="" target="_blank">Save Job</a>
        </div>
        <div class="col-2 my-auto btn btn-info fav-bg text-white px-2 py-1"  style="">
            <a class="text-white" href="'.base_url('jobview').'/'.$jobs->find_by.'" target="_blank">Apply Now
            </a>
        </div>
    </div>  
    
</div> ';
       }
       
      
       echo json_encode(array('response'=>false,'data'=>$datas,'results'=>count($getData),'title'=>'filter'));
       }else{
           echo json_encode(array('response'=>false,'data'=>'Found Zero results','results'=>0,'title'=>'filter'));
       }
            
            
            
        }
    }
    
    

    public function index()
    {
       $array=$this->request->getPost();
       $title=$this->request->getPost('job_name');
       if(empty($title)){
           $like=0;
       }else{
           $like=1;
       }
       $type=$this->request->getPost('type');
        $job =new JobModel();
        $getData=$job->getJobsByTitle($title,$type,$like);
       //print_r($array);
       if(count($getData)>0){
       foreach($getData as $jobs){
       if($jobs->logo_img==""){$logo_url='/httpdocs/logo-images/default_company.png';}else{$logo_url='/httpdocs/logo-images/'.$jobs->logo_img;}  
           if($jobs->complete_rate==""){
          $rate=0;
      }else{
          if($jobs->wage_type=="1"){
              $rate="/hour";
          }elseif($jobs->wage_type=="2"){
              $rate="/day";
          }elseif($jobs->wage_type=="3"){
              $rate="/week";
          }
      }
           $datas.='<div class="p-2 rounded bg-white my-2">
    <div class="row d-flex pt-2 justify-content-around">
        <div class="col-auto">
            
            <img src="'.base_url($logo_url).'" style="width:80px;height:80px;">
        </div> 
        <div class="col-6 text-left">
            <p class="m-0 text-muted">'.$jobs->name.'</p><h4 class="m-0 fav-col fw-bolder">'.$jobs->job_heading.'</h4><p class="m-0 text-muted">Location : N/A</p>
        </div> 
        <div class="col-3 text-right d-flex justify-content-end">
         <p class="m-0 text-muted text-right" style="font-size:14px;"> days ago</p>
        </div>
        
    </div>   
    <div class="row d-flex mt-2 mx-3"> 
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >schedule</span><span class="icon-text">'.($jobs->requirement_type=="1"?'Freelance':'Fulltime').'</span></p>
    </div>
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >attach_money</span><span class="icon-text"  >$ '.($jobs->complete_rate<1?$jobs->hourly_rate.$rate:$jobs->complete_rate  ).'</span></p>
    </div>
    <div class="col-auto">
        <p class="m-0 text-muted fw-bolder" ><span class="material-icons" >work</span><span class="icon-text"  >Experience : '.($jobs->experience_type=='1'?'Expert':'Intermediate').'</span></p></div>
    </div>  
    
    <div class="py-3">
        <ul class="mx-3">
         '.$jobs->job_description.'
        </ul>
    </div>  
    
    <div class="row d-flex justify-content-around mx-0">
        <div class="col-7 my-auto">
            <p class="text-muted my-auto">0 applicants</p>
        </div>
        <div class="col-2 my-auto btn btn-primary bg-white fav-border fav-text  px-2 py-1" style="">
            <a class="fav-text" href="" target="_blank">Save Job</a>
        </div>
        <div class="col-2 my-auto btn btn-info fav-bg text-white px-2 py-1"  style="">
            <a class="text-white" href="'.base_url('jobview').'/'.$jobs->find_by.'" target="_blank">Apply Now
            </a>
        </div>
    </div>  
    
</div> ';
       }
       if($like<1){
         if($type=="1"){
           $typeOf='Freelance';
        }else{
          $typeOf='Fulltime';
              } 
       }else{
           $typeOf=$title;
       }
      
       echo json_encode(array('response'=>false,'data'=>$datas,'results'=>count($getData),'title'=>$typeOf));
       }else{
           echo json_encode(array('response'=>false,'data'=>'Found Zero results','results'=>0,'title'=>$title));
       }
    
    }
    public function jobdetails($id){
        $job =new JobModel();
        $data['jobData']=$job->getJobDetails($id);
        return view('front/job_apply',$data);
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
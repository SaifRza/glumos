<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobModel;


class Browse extends BaseController
{
    

    public function index()
    {
         $job=new JobModel();
      $data['jobs']=$job->all();
        return view('front/browse_jobs',$data);
    }
    
    public function filter(){
        $data=$this->request->getPost();
        print_r($data);
    }
    
    public function getApi(){
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://upwork-unofficial.p.rapidapi.com/upwork_jobs?search_query=software%20engineer",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: upwork-unofficial.p.rapidapi.com",
		"x-rapidapi-key: c5e46c5865mshfd02cc7d7f3a3b3p186152jsn93c4c981bbd0"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
    }
    
    public function getResult(){
        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://we-work-remotely-staging.herokuapp.com/api/v1/remote-jobs/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response; 
    }
    
    public function graphQl($search=null){
  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://remoteok.com/api',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

/*
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://demo.jobsoid.com/api/v1/jobs',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
*/

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
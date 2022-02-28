<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobModel;
use App\Models\Checkouts;


class Checkout extends BaseController
{
    

    public function index()
    {
      $session = \Config\Services::session($config);
      $checkout = new Checkouts();
      $isSubs=$checkout->isCheckout($session->get('userdata')['email']);
      if($isSubs){
          $res=$checkout->checkoutDetails($session->get('userdata')['email']);
          $data['res']=$res;
           $data['subscribed']=1;
      }else{
           $data['subscribed']=0;
       }
       
      $data['price']=5;
      return view('subscription/checkout',$data);
        
    }
    public function process(){
        $session = \Config\Services::session($config);
        
        
    $checkout = new Checkouts();        
    $data=$this->request->getPost();
         
    $isSubs=$checkout->isCheckout($session->get('userdata')['email']);
     if($isSubs){
      $data['subscribed']=1;   
     }else{
         $data['subscribed']=0;
    $stripe = new \Stripe\StripeClient('sk_test_51KLSa5JWHIkbNS80F2bJOiRoljNkV1kgwdYhlwTTs9ZJ2DZpaXbTG0Ekp6bP3qXAvnfOyGn5HPVeFuDA2CiMdT4F00xw1y2Mvr');
   $customer = $stripe->customers->create([
    'description' => $this->request->getPost('name'),
    'email' => $this->request->getPost('email'),
    'source' => $this->request->getPost('stripeToken'),
    ]);
      
      //Getting generated Customer Id
    $customer_id=$customer->id; 
      
     // echo $customer_id;
     
     //A code For Finding is customer subscribing for the first time
     $next_due_date = date('Y-m-d', strtotime("+30 days"));
     $next_30_days=strtotime($next_due_date);
     $next_30days=strtotime('+30 days');
      
      //Creating subscription
    $subscription=$stripe->subscriptions->create([
          'customer'=>$customer_id,
          'items'=>[
              ['price'=>'price_1KSGo5JWHIkbNS80dieZyE2Y']
              ],
          'trial_end'=>$next_30_days,
              
          ]);
          
      $id=$subscription->id;   
      $anchor=$subscription->billing_cycle_anchor;
      $created_start=$subscription->current_period_start;
      $created_end=$subscription->current_period_end;
      $customer_id=$subscription->customer;
      $status=$subscription->status;
      $card_holder_name=$this->request->getPost('name');
      $stripeToken=$this->request->getPost('stripeToken');
      $email=$this->request->getPost('email');
      $type=$subscription->plan['Stripe\Plan Object'];
      
      
      $array=[
          'email'=>$email,
          'status'=>$status,
          'customer_id'=>$customer_id,
          'period_end'=>$created_start,
          'period_start'=>$created_end,
          'card_holder'=>$card_holder_name,
          'anchor'=>$anchor,
          'stripeToken'=>$stripeToken,
          'live_mode'=>null,
          'trial_ends_at'=>$next_30_days
          ];
      
      $insert=$checkout->addCheckout($array);
     //print_r($subscription);
    return redirect()->to(base_url('/payment-process'));
      
     }
      
  


  

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
    
    public function graphQl($search=null){
        if($search=="undefined"){
            $search=="web developer";
        }
    $curl = curl_init();
$url="https://awesome-indeed.p.rapidapi.com/indeed_jobs_detailed?search_query=".rawurlencode($search)."&page=1";
curl_setopt_array($curl, [
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: awesome-indeed.p.rapidapi.com",
		"x-rapidapi-key:53ec7dd0b8mshb50d08313199a8ep107b38jsnf2815d1c0b77"
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
<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobSeekers;
use App\Models\JobModel;
use App\Models\Template;
use App\Models\Employers;
use App\Models\Uploads;

class Uploader extends BaseController
{
   
   
   
    public function index($browsefor=null)
    {
        $data['browsefor']=$browsefor;
        return view('front/signin',$data);
    }
    
    public function uploadPP($type=null){
     $session = \Config\Services::session($config);
     $user_id=$session->get('userdata')['id'];
     helper(['form', 'url']);
           $upload= new Uploads();
      if($type=="1"){
          $column="profile_img";
                        $input = $this->validate([
                        'userfile' => [
                            'uploaded[userfile]',
                            'mime_in[userfile,image/jpg,image/jpeg,image/png]',
                            'max_size[userfile,1024]',
                        ]
                    ]);
                
                    if (!$input&&0>1) {
                        print_r('Choose a valid file');
                    } else {
                        $img = $this->request->getFile('userfile');
                       
                        $img->move(ROOTPATH.'httpdocs/logo-images/');
                    }
        
      }elseif($type=="2"){
          $column="skills_tags";
      }
      elseif($type=="3"){
          $column="nationality";
      }elseif($type=="4"){
          $column="auto_suggest";
      }
      elseif($type=="10"){
          $column="work_type";
      }
      elseif($type=="11"){
          $column="loc_pref";
      }
      elseif($type=="5"){
          $column="contact_number";
          $nationality="nationality";
          $name="name";
      }elseif($type=="7"){
          $data=[
              'wage_type'=>$this->request->getPost('wage_type'),
              'currency'=>$this->request->getPost('currency'),
              'salary'=>$this->request->getPost('salary'),
              ];
      }elseif($type=="9"){
          if($this->request->getPost('present')<1){
          $Insdata=[
              'user_id'=>$user_id,
             'institution_name'=>$this->request->getPost('company_name'),
             'title'=>$this->request->getPost('job_title'),
             'years'=>$this->request->getPost('years'),
             'status'=>0,
             'location'=>$this->request->getPost('location'),
             'from_time'=>$this->request->getPost('from_time'),
             'to_time'=>$this->request->getPost('to_time'),
             'type'=>$this->request->getPost('type')
            
              ];
          }else{
          $Insdata=[
              'user_id'=>$user_id,
             'institution_name'=>$this->request->getPost('company_name'),
             'title'=>$this->request->getPost('job_title'),
             'years'=>$this->request->getPost('years'),
             'status'=>0,
             'location'=>$this->request->getPost('location'),
             'from_time'=>$this->request->getPost('from_time'),
             'to_time'=>'00-00-00',
             'type'=>$this->request->getPost('type')
            
              ];    
          }      
              
          $insertExp=$upload->insExp($Insdata);      
      }
      else{
          $make="0";
      }
      if($make=="0"){
         return redirect()->to(base_url('/digital-resume'));  
      }else{
          if($type=="1"){
           $data = [
               $column =>  $img->getName(),
            ];    
          }
          
          elseif($type=="7"){
               $data=[
              'wage_type'=>$this->request->getPost('wage_type'),
              'currency'=>$this->request->getPost('currency'),
              'salary'=>$this->request->getPost('salary'),
              ];
          }
          elseif($type=="2"){
              $skills=$this->request->getPost('tags');
              foreach($skills as $skill){
             $skl.=",".$skill;
               }
              $data = [
               $column =>  $skl,
            ]; 
          }elseif($type=="5"){
             $data = [
               $column =>  $this->request->getPost($column),
               'nationality'=>$this->request->getPost($nationality),
               'name'=>$this->request->getPost($name)
            ];  
          
          }
          
          else{
            $data = [
               $column =>  $this->request->getPost($column),
            ];   
          }
          $userid=$session->get('userdata')['email'];
            $uploadFeatured=$upload->uploadUserDetails($data,$userid);
          if($type=="")  
           return redirect()->to(base_url('/digital-resume')); 
        }    
      return redirect()->to(base_url('/digital-resume'));   
        
    }
    
     public function companyDocs(){
      $session = \Config\Services::session($config);
      $id=$session->get('userdata')['id'];
      $employer= new Employers();
      helper(['form', 'url']);
      $upload= new Uploads();
          $input = $this->validate([
            'userfile' => [
                'uploaded[userfile]',
                'mime_in[userfile,application/pdf]',
                'max_size[userfile,10024]',
            ]
        ]);
    
        if (!$input) {
            print_r('Choose a valid file');
        } else {
            $img = $this->request->getFile('userfile');
            
             $img->move(ROOTPATH.'httpdocs/document-files/');  
            $data = [
               'verification_file' =>  $img->getName(),
            ];
            
            
            $uploadFeatured=$upload->uploadFeatured($data,$id);
            if($uploadFeatured){
                $updateSeeker=$employer->updateStatus($email,'2');
            }
           // $save = $db->insert($data);
           
           return redirect()->to(base_url('dashboard')); 
            
        }
       
        
    }
    public function featuredImage($type=null){
        $session = \Config\Services::session($config);
        //print_r($type);
      helper(['form', 'url']);
      $id=$session->get('userdata')['id'];
      $upload= new Uploads();
          $input = $this->validate([
            'userfile' => [
                'uploaded[userfile]',
                'mime_in[userfile,image/jpg,image/jpeg,image/png]',
                'max_size[userfile,1024]',
            ]
        ]);
    
        if (!$input) {
            print_r('Choose a valid file');
        } else {
            $img = $this->request->getFile('userfile');
            if($type=="2"){
             $img->move(ROOTPATH.'httpdocs/logo-images/');  
             $data = [
               'logo_img' =>  $img->getName(),
               'location_name'=>$this->request->getPost('loc_name')
            ];
            }elseif($type=="1"){
            $img->move(ROOTPATH.'httpdocs/featured-images/');
            $data = [
               'featured_img' =>  $img->getName(),
            ];
            }
            
            //print_r($data);
            $uploadFeatured=$upload->uploadFeatured($data,$id);
            
           // $save = $db->insert($data);
           
          return redirect()->to(base_url('dashboard/profile')); 
            
        }
       
        
    }
        
      
    public function companyInfo($type=null){
    $session = \Config\Services::session($config);    
        $id=$session->get('userdata')['id'];
      helper(['form', 'url']);
      $upload= new Uploads();
            if($type=="1"){
             $data = [
               'hr_details' =>  $this->request->getPost('text'),
            ];
            }else{
            $data = [
               'overview_info' =>  $this->request->getPost('text'),
            ];
            }
            
            $uploadFeatured=$upload->uploadFeatured($data,$id);
            
           // $save = $db->insert($data);
           if($session->get('userdata')['usertype']=="jobseeker"){
           return redirect()->to(base_url('digital-resume'));    
           }else{
           return redirect()->to(base_url('dashboard/profile')); 
           } 
        
       
        
    }
   
    
    
    
    
    
    
    
    
    
    public function addJob(){
        $session = \Config\Services::session($config);
        $job_type=$this->request->getPost('job_type');
         $job_title=$this->request->getPost('job_title');
          $payroll_type=$this->request->getPost('payroll_period');
          $rate=$this->request->getPost('working_rate');
          $job_desc=$this->request->getPost('desc');
            $budget=$this->request->getPost('project_budget');
        $budget=$this->request->getPost('project_budget');
        $experience=$this->request->getPost('experience_type');
        $employer=new Employers();
             $employerDetails=$employer->getDetails($session->get('userdata')['email']);
             $company_id=$employerDetails['0']->id;
        $str_rand=rand(100000,9999999);
        $result_rand = md5($str_rand);
        
       
      $jobData=[
             'find_by'=>$result_rand,
            'company_id'=>$company_id,
            'job_heading'=>$job_title,
            'requirement_type'=>$job_type,
             'required_skill'=>null,
             'experience_type'=>$experience,
            'job_description'=>$job_desc,
             'has_attachments'=>0,
              'tokens_required'=>4,
              'wage_type'=>$payroll_type,
            'hourly_rate'=>$rate,
            'complete_rate'=>$budget,
            'is_company_payment_verified'=>0,
             'proposal_limits'=>10,
            'is_premium_post'=>0,
            'interviewed'=>0,
            'status'=>0,
            'admin_approved'=>0,
            'post_time'=>date('Y-m-d H:i:s')
            ];
            
        $jbtable=new JobModel();
        $addnew=$jbtable->addNewJob($jobData);
        if($addnew){
            echo json_encode(array('response'=>true,'message'=>'Added Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }
    }
    
    
    public function addQuestion(){
        date_default_timezone_set('Asia/Kolkata');
        $session = \Config\Services::session($config);
       $data=$this->request->getPost();
       $question_type=$this->request->getPost('type_of');
       $parent_id=$this->request->getPost('parent_id');
       $q=$this->request->getPost('question');
       $a=$this->request->getPost('option-1');
       $b=$this->request->getPost('option-2');
       $c=$this->request->getPost('option-3');
       $d=$this->request->getPost('option-4');
       $correct=1;
       if(1>2){
           echo json_encode(array('response'=>false,'message'=>'Please Enter All Fields'));
       }
       else{
       $tempData=[
        'question_id'=>mt_rand(10000000,99999999),
        'company_id'=>$session->get('userdata')['id'],
        'skill_type'=>$question_type,
        'question_no'=>0,
        'parent_id'=>$parent_id,
        'image_name'=>null,
        'question_text'=>$q,
        'option_a'=>$a,
        'option_b'=>$b,
        'option_c'=>$c,
        'option_d'=>$d,
        'correct'=>$correct,
        'created_at'=>date('Y-m-d H:i:s')  
           ];
       $template=new Template();
       $addTemplate=$template->addQuestion($tempData);
       $tempInfo=$template->getTempInfo($parent_id);
       $pre_hard=$tempInfo[0]->hard;
       $pre_soft=$tempInfo[0]->soft;
       
       if($question_type=="1"){
           //Hardskill Question
           $set=$pre_hard+1;
           $type="hard";
       }else{
           //Softskill Question
           $set=$pre_soft+1;
           $type="soft";
       }
       if($addTemplate){
           //updating Data for Parent Template
           $updateTemplate=$template->updateTemp($set,$type,$parent_id);
           echo json_encode(array('response'=>true,'message'=>'Added Question Successfully'));
       }
       //print_r($data);
      }
    }
    
    public function addTemp(){
        date_default_timezone_set('Asia/Kolkata');
        $session = \Config\Services::session($config);
       $name=$this->request->getPost('template_name');
       if(empty($name)){
           echo json_encode(array('response'=>false,'message'=>'Please Enter All Fields'));
       }
       else{
       $tempData=[
        'template_id'=>mt_rand(10000000,99999999),
        'template_name'=>$name,
        'company_id'=>$session->get('userdata')['id'],
        'created_at'=>date('Y-m-d H:i:s')  
           ];
       $template=new Template();
       $addTemplate=$template->addTemplate($tempData);
       if($addTemplate){
           echo json_encode(array('response'=>true,'message'=>'Added Template'));
       }else{
         echo json_encode(array('response'=>false,'message'=>'Template Not added'));  
       }
       //print_r($data);
      }
      
    }
    
    public function getQuestions(){
       $session = \Config\Services::session($config);
        $id=$this->request->getPost('parent_id');
        $temptable=new Template();
        $info=$temptable->parentIdQuestions($id);
        foreach($info as $data){
            if($data->skill_type=="1"){
                $hard.='<div class="p-2 mt-2 bg-light">
                <h6>Ques.   '.$data->question_text.'</h6>
                <p>A)'.$data->option_a.'</p>
                <p>B)'.$data->option_b.'</p>
                <p>C)'.$data->option_c.'</p>
                <p>D)'.$data->option_d.'</p>
                <p>Correct : '.$data->correct.'</p>
                  </div>';
            }else{
                $soft.='<div class="p-2 mt-2 bg-light">
                <h6>Ques. '.$data->question_text.'</h6>
                <p>A)'.$data->option_a.'</p>
                <p>B)'.$data->option_b.'</p>
                <p>C)'.$data->option_c.'</p>
                <p>D)'.$data->option_d.'</p>
                <p>Correct : '.$data->correct.'</p>
                  </div>';
            }
           
        } echo json_encode(array('hard'=>$hard,'soft'=>$soft));
    }
    
    public function getQuestionsForm(){
       $session = \Config\Services::session($config);
        $id=$this->request->getPost('parent_id');
        $temptable=new Template();
        $info=$temptable->parentIdQuestions($id);
        foreach($info as $data){
            if($data->skill_type=="1"){
                
                $hard.='<div class="p-2 mt-2 bg-light">
                <h6>Ques.   '.$data->question_text.'</h6>
                <p>A)<input type="radio" value="A" name="'.$data->question_id.'">'.$data->option_a.'</p>
                <p>B)<input type="radio" value="B" name="'.$data->question_id.'">'.$data->option_b.'</p>
                <p>C)<input type="radio" value="C" name="'.$data->question_id.'">'.$data->option_c.'</p>
                <p>D)<input type="radio" value="D" name="'.$data->question_id.'">'.$data->option_d.'</p>
                <p>Correct : '.$data->correct.'</p>
                  </div>';
            }else{
                $soft.='<div class="p-2 mt-2 bg-light">
                <h6>Ques. '.$data->question_text.'</h6>
                <p>A)<input type="radio" value="A" name="'.$data->question_id.'">'.$data->option_a.'</p>
                <p>B)<input type="radio" value="B" name="'.$data->question_id.'">'.$data->option_b.'</p>
                <p>C)<input type="radio" value="C" name="'.$data->question_id.'">'.$data->option_c.'</p>
                <p>D)<input type="radio" value="D" name="'.$data->question_id.'">'.$data->option_d.'</p>
                <p>Correct : '.$data->correct.'</p>
                  </div>';
            }
           
        } echo json_encode(array('hard'=>$hard,'soft'=>$soft));
    }
    public function updateJob(){
    $session = \Config\Services::session($config);
        $job_type=$this->request->getPost('job_type');
         $job_title=$this->request->getPost('job_title');
          $payroll_type=$this->request->getPost('payroll_period');
          $rate=$this->request->getPost('working_rate');
          $job_desc=$this->request->getPost('desc');
        $budget=$this->request->getPost('project_budget');
        $experience=$this->request->getPost('experience_type');
        $skills=$this->request->getPost('skills');
        $temp_id=$this->request->getPost('template_id');
        
        if(!empty($this->request->getPost('w3review'))){
            //Job Type exists
            $JobData=[
              'job_description'=>$this->request->getPost('w3review'),
              'job_heading'=>$this->request->getPost('title'),
              'status'=>1
                ];
       
        $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            $session->remove('job_find_by');
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }
            
    }
        
        if(!empty($rate)){
            //Job Type exists
            $JobData=[
              'hourly_rate'=>$rate,
              'wage_type'=>$payroll_type
                ];
       
        $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }
            
    }
    
        if(!empty($budget)){
          //Job Type exists
            $JobData=[
              'complete_rate'=>$budget
                ];
       
        $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }   
        }
    
        if(!empty($job_type)){
            //Job Type exists
            $JobData=[
              'requirement_type'=>$job_type 
                ];
       
        $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }
            
    }
    
        if(!empty($job_title)){
            //Job Type exists
            $JobData=[
              'job_heading'=>$job_title,
                ];
       
        $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }
            
    }
        
        if(!empty($skills)){
            $skl="";
         foreach($skills as $skill){
             $skl.="+".$skill;
         }
         $JobData=[
              'skill_tags'=>$skl  
                ];
         $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }          
       }
       if(intval($temp_id)>1000){
           $JobData=[
               'template_id'=>$temp_id
               ];
         $find_by=$session->get('job_find_by');
        $jbtable=new JobModel();
        $updated=$jbtable->updateJob($JobData,$find_by);
        if($updated){
            echo json_encode(array('response'=>true,'message'=>'Updated Job Successfully'));
        }else{
            echo json_encode(array('response'=>false,'message'=>'Job Not Added To Database'));
        }         
       }
       
       
       
        
    
    }
    public function userAuth(){
       $session = \Config\Services::session($config); 
        if(($session->get('userdata')['name'])==""){
         return redirect()->to('signin');
         }else{
             $employer=new Employers();
             $employerDetails=$employer->getDetails($session->get('userdata')['email']);
             $company_id=$employerDetails['0']->id;
             $myjobs=$employer->getPostedJobs($company_id);
             $data['myjobs']=$myjobs;
             $data['mydata']=$employerDetails;
            return view('front/user/index',$data);   
         }
    }
    public function logout(){
        $session = \Config\Services::session($config);
        $session->destroy();
          return view('front/signin'); 
    }
    public function browseAllJobs(){
       $session = \Config\Services::session($config);
       return view('front/user/browsejobs'); 
    }
    public function postJob(){
       $session = \Config\Services::session($config);
       return view('front/user/postjob'); 
    }
     public function verifyCompany(){
       $session = \Config\Services::session($config);
       return view('front/user/upload-documents'); 
    }
    public function addTemplate(){
       $session = \Config\Services::session($config);
       return view('front/user/add-templates'); 
    }
    public function viewTemplate(){
       $session = \Config\Services::session($config);
       return view('front/user/view-templates'); 
    }
    public function login(){
        return view('front/signin');  
    }
    public function message(){
       return view('front/user/message'); 
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

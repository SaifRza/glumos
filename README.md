# CodeIgniter 4 Development

[![Build Status](https://github.com/codeigniter4/CodeIgniter4/workflows/PHPUnit/badge.svg)](https://github.com/codeigniter4/CodeIgniter4/actions?query=workflow%3A%22PHPUnit%22)
[![Coverage Status](https://coveralls.io/repos/github/codeigniter4/CodeIgniter4/badge.svg?branch=develop)](https://coveralls.io/github/codeigniter4/CodeIgniter4?branch=develop)
[![Downloads](https://poser.pugx.org/codeigniter4/framework/downloads)](https://packagist.org/packages/codeigniter4/framework)
[![GitHub release (latest by date)](https://img.shields.io/github/v/release/codeigniter4/CodeIgniter4)](https://packagist.org/packages/codeigniter4/framework)
[![GitHub stars](https://img.shields.io/github/stars/codeigniter4/CodeIgniter4)](https://packagist.org/packages/codeigniter4/framework)
[![GitHub license](https://img.shields.io/github/license/codeigniter4/CodeIgniter4)](https://github.com/codeigniter4/CodeIgniter4/blob/develop/LICENSE)
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/codeigniter4/CodeIgniter4/pulls)
<br>

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

This repository holds the source code for CodeIgniter 4 only.
Version 4 is a complete rewrite to bring the quality and the code into a more modern version,
while still keeping as many of the things intact that has made people love the framework over the years.

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

### Documentation

The [User Guide](https://codeigniter4.github.io/userguide/) is the primary documentation for CodeIgniter 4.

The current **in-progress** User Guide can be found [here](https://codeigniter4.github.io/CodeIgniter4/).
As with the rest of the framework, it is a work in progress, and will see changes over time to structure, explanations, etc.

You might also be interested in the [API documentation](https://codeigniter4.github.io/api/) for the framework components.

## Important Change with index.php

index.php is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

CodeIgniter is developed completely on a volunteer basis. As such, please give up to 7 days
for your issues to be reviewed. If you haven't heard from one of the team in that time period,
feel free to leave a comment on the issue so that it gets brought back to our attention.

We use GitHub issues to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

If you raise an issue here that pertains to support or a feature request, it will
be closed! If you are not sure if you have found a bug, raise a thread on the forum first -
someone else may have encountered the same thing.

Before raising a new GitHub issue, please check that your bug hasn't already
been reported or fixed.

We use pull requests (PRs) for CONTRIBUTIONS to the repository.
We are looking for contributions that address one of the reported bugs or
approved work packages.

Do not use a PR as a form of feature request.
Unsolicited contributions will only be considered if they fit nicely
into the framework roadmap.
Remember that some components that were part of CodeIgniter 3 are being moved
to optional packages, with their own repository.

## Contributing

We **are** accepting contributions from the community!

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/contributing/README.md).

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:


- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- xml (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)

## Running CodeIgniter Tests

Information on running the CodeIgniter test suite can be found in the [README.md](tests/README.md) file in the tests directory.



Hello  in the next few lines you will be getting information about how this code works
and Here is a glimpse of topics that these code will be doing

1. USER REGISTRATION 
2. USER AUTHENTICATION
3. USER PAYMENTS
4. TYPES OF USERS
5. USER VERIFICATION
6. EMPLOYER JOB POST
7. JOSEKER JOB VIEW or BROWSE
8. JOBSEEKER JOB APPLY
9. JOBSEEKER-EMPLOYER CONNECTIONS
10. ADDING TEST TEMPLATES
11. ADMIN PANEL

#### 1  USER REGISTERTAION

For User Registeration
THE ENTIRE BUILD-UP is based on MVC i.e Modal View Controller , So for modal View Controller you can visit this particular link  https://codeigniter.com/user_guide/concepts/mvc.html , This is quite better Explanation about the code that are based on MVC
  
  A)ROUTES
  Check the url this registration page its 
  //For Freelancer 
  https://glumos.webleader.in/freelancer-signup
  Ended as freelancer-signup
  
  //For Company
  https://glumos.webleader.in/company-signup
  Ended as comapany-signup
  
  GO For the Following addres in the code
  
  app>conig>Routes.php
  
  Where you will find following piece of code \
  
  $routes('/ADRESS IN URL/' , 'Controller':'Function')
  
  $routes->get('/company-signup',"Signup::index/company");
  $routes->get('/freelancer-signup',"Signup::index/jobSeeker");
  
  
  B)controllers
  
  HERE We have Following Controllers "Signup"
  find Signup in Folowing Adress
  app>controllers>CONTROLLERNAME.php
  That Controller has a function with index name
  That Index is returning a view like this
  
  
  A SAMPLE INDEX FUNCTION
  public function index($browsefor=null)
    {
      $session = \Config\Services::session($config); 
       $checkout = new Checkouts();
      $isSubs=$checkout->isCheckout($session->get('userdata')['email']);
      if($isSubs){
                 $data['subscribed']=1;
             }
             else{
                 $data['subscribed']=0;
             }
      $job=new JobModel();
     //List of Saved Jobs
     if(!empty($session->get('userdata'))){
      $saved_list=$job->getSavedJobs($session->get('userdata')['id']); 
      
      $data['savedJobs']=$saved_list;
     }else{
         $data['savedJobs']=0;   
     }
     
        
     
       $getDetails=$job->getAllJobs();
       $data['allJobs']=$getDetails;
        $data['browsefor']=$browsefor;
        return view('front/index',$data);
    }
  
   
  C)VIEW 
  
   return view('front/index',$data);
   Every Function when its a get route Will have the following return as a resulting key
    return view('front/index',$data);
    
    Now Go and Find the Following inside the View folder
  
  
  Inside the App directory there's a directory named VIEW inside which there are Five folders named Front, Layout, admin...
  
  check For This address app>Views>{YourDIR}>{FileName.php}
  You will have a basic html file which have Forms and html tags 
  
  
 
 
 #### 1  USER AUTHENTICATION

For User signin
THE ENTIRE BUILD-UP is based on MVC i.e Modal View Controller , So for modal View Controller you can visit this particular link  https://codeigniter.com/user_guide/concepts/mvc.html , This is quite better Explanation about the code that are based on MVC
  
  A)ROUTES
  Check the url this registration page its 
  //For Freelancer  as well as Employer 
  https://glumos.webleader.in/login-now
  Ended as login-now
  
 
  
  GO For the Following address in the code
  
  app>conig>Routes.php
  
  Where you will find following piece of code 
  
  $routes('/ADRESS IN URL/' , 'Controller':'Function')
  
  $routes->get('/login-now',"Signin::index");
  
  
  B)controllers
  
  HERE We have Following Controllers "Signin"
  find Signup in Folowing Adress
  app>controllers>CONTROLLERNAME.php
  That Controller has a function with index name
  That Index is returning a view like this
  
   INDEX FUNCTION
 public function index()
    {
        return view('front/signin');
    }
  
   
  C)VIEW 
  
   *** return view('front/signin');
   Every Function when its a get route Will have the following return as a resulting key
    return view('front/index',$data);
    
  ***  Now Go and Find the Following inside the View folder
  
  
  Inside the App directory there's a directory named VIEW inside which there are Five folders named Front, Layout, admin...
  
  check For This address app>Views>{YourDIR}>{FileName.php}
  You will have a basic html file which have Forms and html tags 
  
  
   #### 1  USER Payments
   
  ***Stripe Pamnets Gateway***
  
  For User Payments
  THE ENTIRE BUILD-UP is based on MVC i.e Modal View Controller , So for modal View Controller you can visit this particular link   ,          https://codeigniter.com/user_guide/concepts/mvc.html , This is quite better Explanation about the code that are based on MVC
  
  For Stripe Integration
  Go For Following tutorial;
  Source  1 Youtube
  https://www.youtube.com/watch?v=UjcSWxPNo18
  
  Source 2 Stripe Docs
  https://stripe.com/docs/billing/quickstart
   You will see heading as  
   ***Prebuilt subscription page with Stripe Checkout***
   *** Do Remember To Select Php Code in striep docs Page
 
  
  A)ROUTES
  Check the url this registration page its 
  //For Freelancer  as well as Employer 
   https://glumos.webleader.in/checkout
  Ended as checkout
  
 
  
  GO For the Following address in the code
  
  app>conig>Routes.php
  
  Where you will find following piece of code 
  
  $routes('/ADRESS IN URL/' , 'Controller':'Function')
  
  $$routes->get('/payment-process',"Checkout::index");
  
  
  B)controllers
  ***REPLACE TEST KEYS & ALL TEST Params WITH LIVE KEYS & Params***
  
  HERE We have Following Controllers "Checkout"
  find Signup in Folowing Adress
  app>controllers>CONTROLLERNAME.php
  That Controller has a function with index name
  That Index is returning a view like this
  
   INDEX FUNCTION
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
  
   
  C)VIEW 
  ***REPLACE TEST KEYS & ALL TEST Params WITH LIVE KEYS & Params***
  
   *** return view('subscription/checkout');
   Every Function when its a get route Will have the following return as a resulting key
    return view('subscription/checkout',$data);
    
  ***  Now Go and Find the Following inside the View folder
  
  
  Inside the App directory there's a directory named VIEW inside which there are Five folders named Front, Layout, admin...
  
  check For This address app>Views>{YourDIR}>{FileName.php}
  You will have a basic html file which have Forms and html tags 
  
  ***REPLACE TEST KEYS & ALL TEST Params WITH LIVE KEYS & Params***
  
  
  
 
 4  ###TYPES_OF_USERS####
 
 EMPLOYERS
 ***Functionalities***
 a)Dashboard
 b)Post Jobs
 c)View Applicants
 d) Edit there Profile

 JOBSEEKERS
 
 ***Functionalities***
 a)Dashboard
 b)Apply For Jobs
 c)View Applicants
 d) Edit there Profile
 
 
 5. VERIFICATIONS
 
 ***Verification is done for employers Only***
 When ever a New Employer is Signed Up
 He has To Submit His Details On the Form Available On the Dashboard 
 When Admin Approves His Profile He Would be Able To Post Jobs 
 
 
### EMPLOYER JOB POSTS

Theres a Multistep Job Post Page on the Dashboard
that Multistep Job Post
  
A) ROUTES

Following routes are post routes that updates the data inside database in ***Job_posts*** Table
Post Route
$routes->post('/updateJob',"PostJob::updateJob");
The Following Post Request Updates the Job Post Whenever you click the Blue Next Button
What ever is visible on the the Screen i.e on multistep Job Post Page from employers View

Youn will see that itself is form which submits in ajax way when blue next button is clicked

  
  B)controllers
  
  HERE We have Following Controllers "PostJob"
  find PostJob
  in Folowing Adress
  app>controllers>CONTROLLERNAME.php
  That Controller has a function with index name
  That Index is returning a view like this
  
   updateFunction

***public function updateJob(){
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
        $w_type=$this->request->getPost('w_type');
        $rate_amu=$this->request->getPost('rate_amu');
        
        if(!empty($this->request->getPost('w3review'))){
            //Job Type exists
            $JobData=[
              'job_description'=>$this->request->getPost('w3review'),
              'job_heading'=>$this->request->getPost('title'),
              'status'=>1,
              'wage_type'=>$w_type,
              'hourly_rate'=>$rate_amu
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

codes ends***
  

### 7. JOSEKER JOB VIEW or BROWSE JOBS

  For Job View
  THE ENTIRE BUILD-UP is based on MVC i.e Modal View Controller , So for modal View Controller you can visit this particular link   ,          https://codeigniter.com/user_guide/concepts/mvc.html , This is quite better Explanation about the code that are based on MVC


**API Functioning**
___We are making cURL Php Requests On this controller___

A)CONTROLLERS
BrowseJobs.php
location
app>controllers>BrowseJobs.php


Codes
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

}

CODES ENDS
         
B)VIEW
browse-jobs.php
location
app>views>front>browse-jobs.php

  Codes
  //Here resp is the json array which we get on curl request on the above view page 
var info=resp;
            

var datas = info.filter( jobs => String(jobs.position).match(str));



var data_filter=datas.slice(start,end);

Object.values(data_filter).forEach((val) => {
      if(val){
           if(val.company_logo){
              var logo=val.company_logo; 
           }else{
               var logo=img_url;
           }
           var tagid="taga-"+val.id;
       const box='-----HTML----HERE------';
            $("#list-jobs").append(box);
       }else{
           const box='<h3>No Results Matches</h3>'
           $("#list-jobs").append(box);
       }
      }); 
 CodeEnds     
           
  

             
              
### 7. JOSEKER  APPLY JOBS
  
   For Job seeker Apply Jobs
  THE ENTIRE BUILD-UP is based on MVC i.e Modal View Controller , So for modal View Controller you can visit this particular link   ,          https://codeigniter.com/user_guide/concepts/mvc.html , This is quite better Explanation about the code that are based on MVC
  
  
  Job seeker can easily apply for Jobs
  when he is in Logged in states
  So,
  Being On Home Page Or in Browse Jobs Page
  He can Easily Apply For Jobs
  
  ***For External Jobs**
  He Would click on Apply Buttons
  And Apply on third Party Where the anchor tags directs
  
  <a href="____URL__" target="_blank">Apply Now</a>
  
  
  ***For Glumos Jobs***
  When User will click on any apply now button
  He will e target to another Tab with following Url
  
  A Sample URL Job View+
  https://glumos.webleader.in/jobview/0b08f572e88ddb6b401f82507f92806f
  
  
  Here 0b08f572e88ddb6b401f82507f92806f is job post code
  and  /jobview/ is the get Route Which accepts a parameter i.e Job post code
  
  A)ROUTES
  Here is our  Line of get Routes
  $routes->get('/jobview/(:any)',"Dashboard::jobExplanation/$1");
  
  In the Above Route
  (:any) is the parameter basically a String Parameter
  Where the job post code (i.e sample) 0b08f572e88ddb6b401f82507f92806f
  is passed in the url
  Then in the Another Parameter of route
  "Dashboard::jobExplanation/$1"
  $1 is the parameter Used in Controller to Find that job
  $1 always holds the value of paramenter (:any) passed in the URL
  
  FOR Applying
  
  If the Job Seeker is In Authenticated state then On Click on Apply now Blue Button he will be 
  Moved to another Page With the Following Url
  
  Initially Apply now Buttons check if the user is in logged in state or not
  and If he has Applied for this Test
  If already applied he Will get message as 
  Already Applied For this Job
  
  If not He will moved to another Page Which Will have a Form 
  Question Form
  //Form ??
  
  Form is basically all the question that a Particluar template that is associated with that job Lies
  Each Job post has a Template Each Template has template Id
  That Template Id is associate with the question that lies in thio template
  
  On Complety Filling up Form
  Job Applied is now visible At Jobseeker Dashboard\
  
  B)CONTROLLERS
  
  For Job View
   We have Controllers in Our Route Funtion as 
  Dashboard::jobExplanation/$1 
  Dashboard.php
  
  $routes->get('/jobview/(:any)',"Dashboard::jobExplanation/$1");
  
  location
  app>Cntrollers>Dashboard.php
  In thath Check out the Function name
  Dashboard::jobExplanation/$1
  i.e jobExplantion
  >>Codes
  public function jobExplanation($id){
       $session = \Config\Services::session($config);
       $job=new JobModel();
       $seeker= new JobSeekers();
       
       
       $jobInfo=$job->getJobDetails($id);
       $company_id=$jobInfo->company_id;
       $company=$seeker->getCompanyDetails($company_id);
       $company_assets=$seeker->getCompanyAssets($company_id);
       if($jobInfo<1){
             $data['error']='Bad Gateway';
          $data['message']='You entered a manipulated the link';
           return view('front/register',$data);
       }else{
          $data['jobInfo']=$jobInfo;
          $data['company']=$company;
          $data['company_assets']=$company_assets;
           return view('front/user/jobInfo',$data);
       }
       
    }
                       
                       <<<End Of Code
  
  
  ///////
  
  ### 
  ###  JOBSEEKER-EMPLOYER CONNECTIONS
  ### 
  When A Particular Submits the Job Template
  Then If he had Passed the Test. 
  Following Details on Employer Dashboard Whos has posted that job will be visible
  If jobseeker has passed the test i.e scored above 0.50 i.e 50 %
  
  1.Name
  2. Image
  3. Email
  4. Whatsapp
  
  together with these things 
  Following buttons will be there
  Email ,Whatsapp,
  View Profile
  
  When Employer Will click View Profile
  
  Following Routes and Controllers Will be Called
  
  A) ROUTES
  Here is the Route Which is Called When View Profile Button is Clicked
  $routes->get('/view-profile/(:any)',"Dashboard::resumeView/$1");
  
  This Routes get the resumeView Function which is as Follows
  
  B)CONTROLLERS
  
  Dashboard.php
  location
   app>controller>Dashboard.php
  
  //function
  
   public function resumeView($id){
     $session = \Config\Services::session($config);
     $employer=new Employers();
    
    
     $user_hashmail=$id;
     $seeker=new JobSeekers();
     $myData=$seeker->getDetailsCoded($user_hashmail);
     $email=$myData[0]->email;
     $name=$myData[0]->name;
     $expData=$seeker->getExpCoded($email); 
     
     if($session->get('userdata')['usertype']=='employer'){
         $Emp_email=$session->get('userdata')['email'];
         //Check connection exists or not
         $isConnected=$employer->isConnected($id,$Emp_email);
         if($isConnected){
             
         }else{
             //insert New connection
             $dataInsert=[
                 'employer'=>$Emp_email,
                 'seeker_email'=>$email,
                 'hashmail'=>$id,
                 'seeker_name'=>$name,
                 'status'=>0
                 ];
             $addConnection=$employer->addNewConnection($dataInsert);
         }
         
     }
    
     $data["myData"]=$myData;
     $data['exp']=$expData;
          $data['view_type']=0;
          return view('front/user/view_user',$data); 
    }
  
  
  
  C)VIEWS
  Here is the return method of the Above Function
  return view('front/user/view_user',$data);
  
  As THis clearly Says
  Locate the Following View Files
  front/user/view_user]
  
  location
  app>Views>Front>view_user.php
  
  $data is the array variable which holds array of all of the Details of the JobsSeeker
  and Data is used in the view Page to get contents of the user and Display it
  where necessary
  
  
  
  ### ADD TEST TEMPLATES
  When an emplpyer is in Logged in state He woould be able to add Templates
  and Add Question inside that Template
  
  
  A)Routes
  Routes to add Template
  $routes->post('/add-template',"PostJob::addTemp");
  
  Routes to add Questions
  $routes->post('/add-question',"PostJob::addQuestion");
  
  
  //get Routes
  $routes->get('/view-template',"Dashboard::allTemplates");
  $routes->get('/add-template',"Dashboard::addTemplate");
  
  For Adding Template  /add-tempate is used and It uses the function
  Dashboard::addTemp
  Within the controller Dashboard
  
   For Adding Question  /add-question is used and It uses the function
  Dashboard::addQuestion
  Within the controller Dashboard
  
  B)Controller
  
  Function to add Template
  

    
    public function addTemplate(){
       $session = \Config\Services::session($config);
       $template=new Template();
        $checkout = new Checkouts();
       $isSubs=$checkout->isCheckout($session->get('userdata')['email']);
       $id=$session->get('userdata')['id'];
        if($isSubs){
                 $data['subscribed']=1;
                 $sub=1;
             }
             else{
                 $data['subscribed']=0;
                 $sub=0;
             }
       $myTemplates=$template->loadTemplate($id);
       $myTemplates=$template->loadTemplate($id);
                if(count($myTemplates)>0){
               foreach($myTemplates as $myT){
                   $count=$template->countQuestions($myT->template_id);
                   $updateTemp=$template->updateT($count,$myT->template_id);
               } 
               }else{
                      // echo "Error with count variable";
                   } 
       $data['myTemplates']=$myTemplates;
      return view('front/user/add-templates',$data); 
    }
  
  
  
  Check the PostJob.php Controller For Function to addQuestion
   Function to add Question
  

    
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
       $img=$this->request->getFile('userfile');
       $correct=$this->request->getPost('radioBox');
       if(1>2){
           echo json_encode(array('response'=>false,'message'=>'Please Enter All Fields'));
       }
       else{
        //Image Availablity-check
        if(empty($img)){
           $img_name=null; 
           $attached=2;
        }else{
            $attached=1;
                 $input = $this->validate([
                        'userfile' => [
                            'uploaded[userfile]',
                            'mime_in[userfile,image/jpg,image/jpeg,image/png]',
                            'max_size[userfile,28024]',
                        ]
                    ]);
                
                    if (!$input) {
                        print_r('Choose a valid file');
                    } else {
                        $img = $this->request->getFile('userfile');
                       
                        $img->move(ROOTPATH.'httpdocs/employer-questions/');
                        $img_name=$img->getName();
                    }
        }
           
       $tempData=[
        'question_id'=>mt_rand(10000000,99999999),
        'company_id'=>$session->get('userdata')['id'],
        'skill_type'=>$question_type,
        'question_no'=>0,
        'parent_id'=>$parent_id,
        'image_name'=>$img_name,
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
           
           return redirect()->to(base_url('/add-template'));
       }
       //print_r($data);
      }
    }
  
  
  
  
  
  ##### A D M I N    P A N E L
  
  
Admin Panel View directory
app>views>admin

Admin Panel controller Directory
app>Controllers>Admin.php

Admin Panel Routes

1. $routes->post('/adminlogin',"Admin::login");
2. $routes->get('/admin',"Admin::index");
3. $routes->get('/Admin/view-employer',"Admin::allEmployers");
4. $routes->post('/Admin/viewEmployer',"Admin::verifyEmployer");
5. $routes->get('/Thilak',"Admin::dashboard");
  
  
A)ROUTES
Login Routes
$routes->post('/adminlogin',"Admin::login");

Dashboard Routes
$routes->get('/admin',"Admin::index");

List Of All Emploers
$routes->get('/Admin/view-employer',"Admin::allEmployers");

Routes To Verify Employer
$routes->post('/Admin/viewEmployer',"Admin::verifyEmployer");


C)Controllers

Admin.php is the Only controller Used For Configuring Admin Panel
Location: app>Controllers>Admin.php

Admin.php

  
  
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
    

### THIS CODE IS LICENSED TO GLUMOS.COM UNDER THILAK  SUNDARAM &   W. SATHISH 
### THIS CODE IS NOT FOR SALE

***Author Syed Saif Raza
*** mail at syedsaifrza@gmail.com
*** Contact For Assistance +91-7488649102
*** Visit    Syedsaif.in
*** Visit    Syed-saif.com
*** Visit    Webblio.com
*** Documented at 02-03-2022
  
  
### THIS CODE IS LICENSED TO GLUMOS.COM UNDER THILAK  SUNDARAM &   W. SATHISH 
### THIS CODE IS NOT FOR SALE

Why You I Documented Your Code
As noted above, many developers don’t understand the purpose of code documentation. They’ll argue that good code should be self-documenting and that you shouldn’t need to explain it. These people are, in a word, wrong. The truth is that good documentation is an essential part of any code base. Why? Because people shouldn’t need to read all of your code in order to understand what it does. “People” in that previous sentence can refer to anyone, including your future self.

The truth is that often, the “people” who’ll need to understand code after it’s written is you. That little bit of logic that seemed so clever when you wrote it six months ago might be difficult to understand today. If your code is well-documented, you don’t need to spend time trying to understand what it does. You’ll be able to spend a few seconds looking at the description and then get back to what you’re working on right now.

### THIS CODE IS LICENSED TO GLUMOS.COM UNDER THILAK  SUNDARAM &   W. SATHISH 
### THIS CODE IS NOT FOR SALE



###      T  H  A  N   K      Y  O  U


         
         

         
         




  
  
  

  
  
  
  
 
  
  





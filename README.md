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
12. PROFILE OF USER 
13. DATABASE

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
  
  
  

  
  
  
  
 
  
  





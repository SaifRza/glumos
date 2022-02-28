<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/mail-ajax',"Home::sendMail");
$routes->get('/signin',"Signin::index");
$routes->post('/signin-ajax',"Signin::verifySignin");
$routes->post('/search-keyword',"Autocomplete::homepage_search");
$routes->post('/search-job-list',"Browse::job_list");
$routes->get('/jobs',"Home::index/jobs");
$routes->get('/company-signup',"Signup::index/company");
$routes->get('/freelancer-signup',"Signup::index/jobSeeker");
$routes->get('/login-now',"Signin::index");
$routes->get('/Signup/(:any)',"Signup::index/foreign");
$routes->get('/verify-account/(:any)',"Verify::index");
$routes->post('/adminlogin',"Admin::login");
$routes->post('/logincheck',"Auth::loginHandle");
$routes->post('/register',"Signup::registerHandle");
$routes->get('/send-email',"Signup::sendMail");
$routes->get('/hirings',"Home::index/hirings");
$routes->get('/dashboard',"Dashboard::userAuth");
$routes->get('/logout',"Dashboard::logout");
$routes->get('/browse-jobs',"Dashboard::browseAllJobs");
$routes->get('/jobview/(:any)',"Dashboard::jobExplanation/$1");
$routes->get('/job-post-preview/(:any)',"Dashboard::previewJobs/$1");
$routes->get('/continue-job-post/(:any)',"Dashboard::postJob/$1");
$routes->get('/admin',"Admin::index");
$routes->get('/Admin/view-employer',"Admin::allEmployers");
$routes->post('/Admin/viewEmployer',"Admin::verifyEmployer");
$routes->get('/Thilak',"Admin::dashboard");

$routes->post('/save-job',"Dashboard::saveJob");

$routes->post('/add-Job',"PostJob::addJob");
$routes->post('/unlive-job/(:any)',"PostJob::removeJob/$1");
$routes->post('/delete-job/(:any)',"PostJob::deleteJob/$1");
$routes->post('/add-question',"PostJob::addQuestion");



//Uploads Routess
$routes->post('/upload-featured-photo/(:any)',"Uploader::featuredImage/$1");
$routes->post('/upload-info/(:any)',"Uploader::companyInfo/$1");
$routes->post('/update-user-info/(:any)',"Uploader::uploadPP/$1");
$routes->post('/company-verification-file/',"Uploader::companyDocs");
$routes->post('/get-answers/',"PostJob::getAnswers");



//Aplicants
$routes->get('/view-applicants/(:any)',"Dashboard::allApplicants/$1");
$routes->get('/view-profile/(:any)',"Dashboard::resumeView/$1");
$routes->get('/view-applicants/(:any)',"Applicants::jobApplicants/$1");
$routes->post('/my-job-status',"Applicants::myApplied");
$routes->post('/submit-user-test',"PostJob::testSubmission");



$routes->post('/search-job',"SearchJob::index");
$routes->post('/filter-jobs',"SearchJob::filter");
$routes->get('/reset-the-password/(:any)',"Auth::changePassword/$1");
$routes->get('/reset-password',"Auth::forgetPass");

//Payments uris
$routes->post('/go-stripe',"Checkout::process");
$routes->get('/payment-process',"Checkout::index");


$routes->post('/reset-my-password',"Auth::resetProcess");
$routes->post('/send-reset-link',"Auth::resetLink");

$routes->get('/messages',"ChatSection::index");

$routes->post('/add-template',"PostJob::addTemp");
$routes->post('/updateJob',"PostJob::updateJob");


$routes->post('/graphJobs/(:any)',"Browse::graphQl/$1");


$routes->get('/post-job',"Dashboard::postJob");
$routes->get('/freelancing-jobs',"Home::index/freelancing");
$routes->get('/fulltime-jobs',"Home::index/fulltime");

$routes->get('/digital-resume',"Dashboard::resume");
$routes->get('/digital-resume-view',"Dashboard::resumeClear");

$routes->get('/apply-for-job/(:any)',"Dashboard::applyJob/$1");
$routes->get('/verification-for-company',"Dashboard::postJob");
$routes->get('/view-template',"Dashboard::allTemplates");
$routes->get('/add-template',"Dashboard::addTemplate");

$routes->get('/privacy-policy',"Outlinks::privacyPolicy");
//$routes->get('/(:any)',"Signup::index/foreign");

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

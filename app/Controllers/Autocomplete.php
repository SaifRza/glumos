<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\JobModel;


class Autocomplete extends BaseController
{
    public function index(){
        echo "hello";
    }
    
    public function currency_search(){
        $keyword = $this->request->getPost('val');
        $search =new Currency();
        $allJobs=$search->all();
        $searchjobs=$search->searchJob($keyword);
        
        
        
          $output= '<ul>';   
        if(empty($searchjobs)){  
            foreach($allJobs as $arr){
               $output .='<li>'.$arr->job_post.'</li>';  
            }
              
              } else{
                     
            
            $output .='<li>'.$searchjobs->job_post.'</li>'; 
           
                 
              } 
            $output .='</ul>'; 
        echo $output;
          

    }
    
    public function homepage_search(){
        $keyword = $this->request->getPost('val');
        $search =new JobModel();
        $allJobs=$search->all();
        $searchjobs=$search->searchJob($keyword);
        
        
        
          $output= '<ul>';   
        if(empty($searchjobs)){  
            foreach($allJobs as $arr){
               $output .='<li>'.$arr->job_post.'</li>';  
            }
              
              } else{
                     
            
            $output .='<li>'.$searchjobs->job_post.'</li>'; 
           
                 
              } 
            $output .='</ul>'; 
        echo $output;
          

    }
    

}
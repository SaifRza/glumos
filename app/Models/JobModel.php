<?php
namespace App\Models;
use CodeIgniter\Model;

class JobModel extends Model{

    function all(){
        return $this->db->table('available_jobs')->get()->getResult();
    }
    function allByIndustry($industry){
        return $this->db->table('available_jobs')->like('industry',$industry)->get()->getResult();
    }
    function getSavedJobs($id){
     /* return $this->db->table('job_posts')->like('job_heading',$title)->where(array('status'=>1))->get()->getResult(); */
        $builder=$this->db->table('saved_jobs');
        $builder->where(array('applicant_id'=>$id));
        $builder->join('job_posts', 'job_posts.find_by=saved_jobs.post_id');
        $builder->join('company_assets', 'company_assets.company_id=job_posts.company_id'); 
        $result=$builder->get();
        
        
        return $result->getResult();
        
      
    }
    
    
    function getJobsByTitle($title,$type,$like){
     /* return $this->db->table('job_posts')->like('job_heading',$title)->where(array('status'=>1))->get()->getResult(); */
        $builder=$this->db->table('job_posts');
      if($like>0){
        $builder->like('job_heading',$title);    
      }else{
        $builder->select('*');  
      }
       
        
        $builder->where(array('status'=>1,'requirement_type'=>$type));
        $builder->join('employers', 'employers.id=job_posts.company_id');
        $builder->join('company_assets', 'company_assets.company_id=job_posts.company_id');
        $result=$builder->get();
        
        
        return $result->getResult();
        
      
    }
    
    function filterJobs($salary_max,$salary_min,$experience,$sortby,$location){
        $builder=$this->db->table('job_posts');
        $builder->select('*');  
        if($experience>0){
           $builder->where(array('status'=>1,'experience_type'=>$experience)); 
        }else{
           $builder->where(array('status'=>1)); 
        }
        if(empty($location)){
         if($experience>0){
           $builder->where(array('status'=>1,'experience_type'=>$experience)); 
         }else{
           $builder->where(array('status'=>1)); 
        }   
        }else{
          if($experience>0){
           $builder->where(array('status'=>1,'experience_type'=>$experience,'requirement_type'=>$location)); 
         }else{
           $builder->where(array('status'=>1,'requirement_type'=>$location)); 
        }   
        }
        
        
        if($sortby<1){
         $builder->orderBy('post_id', 'DESC');   
        }
        
        $builder->join('employers', 'employers.id=job_posts.company_id');
        $builder->join('company_assets', 'company_assets.company_id=job_posts.company_id');
        $result=$builder->get();
        return $result->getResult();
    }
    
    
     function updateJob($data,$id){
        $builder=$this->db->table('job_posts');
        $builder->where(array('find_by'=>$id));
        $result=$builder->update($data);
         if($result){
             return true;
         }else{
            return false; 
         }
  
    }
    function getAllJobs(){
         $builder=$this->db->table('job_posts');
        $builder->select('*');
        $builder->where(array('status'=>1));
        $builder->join('employers', 'employers.id=job_posts.company_id');
        $builder->join('company_assets', 'company_assets.company_id=job_posts.company_id');
        $result=$builder->get();
        
        if($result->getNumRows()>0){
        return $result->getResult();
        }else{
        return false;
        }
        
    }
    
    function getJobsForEmail(){
         $builder=$this->db->table('job_posts');
        $builder->select('*');
        $builder->where(array('status'=>1));
        $builder->orderBy('post_id','desc');
        $builder->limit(5);
        $result=$builder->get();
    
        
        if($result->getNumRows()>0){
        return $result->getResult();
        }else{
        return false;
        }
        
    }  
      
      
    function getJobDetails($id){
         $builder=$this->db->table('job_posts');
        $builder->select('*');
        //$builder->join('employers', 'employers.id = job_posts.company_id');
        $builder->where(array('find_by'=>$id));
        $result=$builder->get();
        if($builder->countAll()>0){
        return $result->getRow();
        }else{
        return false;
        }
        
    }
    function jobStat($id,$cid){
     $builder=$this->db->table('job_posts');
        $builder->select('*');
        $builder->where(array('find_by'=>$id,'company_id'=>$id,'status'=>0));
        $result=$builder->get();
        if($result->getNumRows()>0){
        return true;
        }else{
        return false;
        }
        
    }
    function removeMyJob($data,$id){
       $builder=$this->db->table('job_posts');
        $builder->where(array('find_by'=>$id));
        $result=$builder->update($data);
         if($result){
             return true;
         }else{
            return false; 
         } 
    }
    
    function previewJobDetails($id,$company_id){
         $builder=$this->db->table('job_posts');
        $builder->select('*');
        $builder->where(array('find_by'=>$id,'company_id'=>$company_id));
        $result=$builder->get();
        if($builder->countAll()>0){
        return $result->getResult();
        }else{
        return false;
        }
        
    }
    
    function getQuestionsByParentId($id){
      $builder=$this->db->table('template_names');
        $builder->select('*');
        $builder->where(array('parent_id'=>$id));
        $result=$builder->get();
        if($builder->countAll()>0){
        return $result->getResult();
        }else{
        return false;
        }   
    }
    
    function getJobDetailsByTitle($title){
       $details=$this->db->table('available_jobs')->where('job_post',$title)->get()->getRow();
        return $details; 
    }
    function getJobDetailsByIndustry($industry){
       $builder=$this->db->table('available_jobs')->where('industry',$industry);
        return $builder->countAllResults(); 
    }
    function searchJob($keyword){
        $details=$this->db->table('available_jobs')->like('job_post',$keyword)->get()->getRow();
        return $details;
    }
    function isUserExists($email,$password){
      $builder=$this->db->table('accounts');
        $builder->select('email,password');
        $builder->where(array('email'=>$email,'password'=>$password));
        $result=$builder->get();
        if($builder->countAll()==1){
        return $result->getRow();
        }else{
        return false;
        }
        
        return $result;  
    }
    function addNewJob($data){
        $builder=$this->db->table('job_posts');
        $result=$builder->insert($data);
        return $result;
        
    }
    function userblocked(){
        
    }
    function registerUser($userData){
        $builder=$this->db->table('accounts');
        $result=$builder->insert($userData);
        return $result;
        
    }
    function existForActivation($email){
       $builder=$this->db->table('accounts');
        $builder->select('hashmail');
        $builder->where('hashmail',$email);
        $result=$builder->get();
        if($builder->countAll()==1){
        return $result->getRow();
        }else{
        return false;
        }
        
        return $result;
    }
    
}
<?php
namespace App\Models;
use CodeIgniter\Model;

class Chats extends Model{

    function all(){
        $company_id=$session->get('userdata')['id'];
    return $this->db->table('templates')->where(array('company-id',$company_id))->get()->getResult();
    }
    function getMessages(){
      // $company_id=$session->get('userdata')['id'];
    return $this->db->table('message_rooms')->get()->getResult();   
    }
    function allByIndustry($industry){
        return $this->db->table('available_jobs')->like('industry',$industry)->get()->getResult();
    }
    
     function updateJob($jobData,$id){
        
        $builder=$this->db->table('job_posts');
        $builder->update($jobData);
        $result=$builder->where(array('find_by',$id));
         if($result){
             return true;
         }else{
            return false; 
         }
  
    }
    function getAllJobs(){
         $builder=$this->db->table('job_posts');
        $builder->select('*');
        $builder->join('employers', 'employers.id = job_posts.company_id');
        $result=$builder->get();
        
        if($builder->countAll()>0){
        return $result->getResult();
        }else{
        return false;
        }
        
    }
    function getJobDetails($id){
         $builder=$this->db->table('job_posts');
        $builder->select('*');
        $builder->where(array('find_by'=>$id));
        $result=$builder->get();
        if($builder->countAll()>0){
        return $result->getResult();
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
     function loadTemplate($id){
       $details=$this->db->table('template_names')->where('company_id',$id)->get()->getResult();
        return $details; 
    }
     function loadTemplateByTempId($id){
       $details=$this->db->table('templates')->where('parent_id',$id)->get()->getResult();
        return $details; 
    }
     function parentIdQuestions($id){
       $details=$this->db->table('templates')->where('parent_id',$id)->get()->getResult();
        return $details; 
    }
    function getTempInfo($id){
      $details=$this->db->table('template_names')->where('template_id',$id)->get()->getResult();
        return $details;  
    }
    function addTemplate($template){
     $builder=$this->db->table('template_names');
        $result=$builder->insert($template);
        return $result;   
    }
    function addQuestion($data){
        $builder=$this->db->table('templates');
        $result=$builder->insert($data);
        return $result;
        
    }
    function updateTemp($set,$type,$id){
        $data=array(
            $type=>$set,
            );
       $builder=$this->db->table('template_names');
        $builder->update($data);
        $result=$builder->where(array('template_id',$id));
         if($result){
             return true;
         }else{
            return false; 
         }  
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
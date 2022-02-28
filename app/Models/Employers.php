<?php
namespace App\Models;
use CodeIgniter\Model;

class Employers extends Model{

    function getAdminInfo(){
        return $this->db->table('employers')->get()->getResult();
    }
    function countSubmissions($id){
       $builder=$this->db->table('job_application');
        $builder->select('*');
        $builder->where(array('post_id'=>$id));
        $result=$builder->get();
      return $result->getNumRows();
    }
    function searchEmployer($email){
        $builder=$this->db->table('employers');
        $builder->select('*');
        $builder->where(array('email'=>$email));
        if($builder->countAllResults()>0){
        $result=$builder->get();    
        return true;
        }else{
        return false;
        }
       
    }
    function jobDetails($id){
      $builder=$this->db->table('job_posts');
        $builder->select('*');
        $builder->where(array('company_id'=>$id));
         $result=$builder->get();
      return $result->getResult();  
    }
     function jobDetailsByPostId($id){
      $builder=$this->db->table('job_posts');
        $builder->select('*');
        $builder->where(array('find_by'=>$id));
         $result=$builder->get();
      return $result->getResult();  
    }
    
    function getAllApplicants($id,$subs){
      $builder=$this->db->table('job_application');
        $builder->select('*');
        $builder->where(array('post_id'=>$id));
        if($subs=="0"){
        $builder->limit('10');    
        }
        $builder->join('jobseekers', 
        'jobseekers.id=job_application.applicant_id');
        
        
         $result=$builder->get();
      return $result->getResult();    
    }
    
    
     function isMyPostedJob($id){
      $builder=$this->db->table('job_posts');
        $builder->select('*');
        $builder->where(array('company_id'=>$id));
        if($builder->countAllResults()>0){
        $result=$builder->get();    
        return true;
        }else{
        return false;
        }
    }
    
    function isEmployerValid($email,$password){
      $builder=$this->db->table('employers');
        $builder->select('email,password');
        $builder->where(array('email'=>$email,'password'=>$password));
        if($builder->countAllResults()>0){
        $result=$builder->get();    
        return true;
        }else{
        return false;
        }
        
        return $result;  
    }
    
    function isEmailValid($email){
      $builder=$this->db->table('employers');
        $builder->select('email,verification');
        $builder->where(array('email'=>$email,'verification'=>1));
        if($builder->countAllResults()>0){
        $result=$builder->get();    
        return true;
        }else{
        return false;
        }
         
    }
    
    
     function isEmployerVerified($hashmail){
      $builder=$this->db->table('employers');
        $builder->select('hashmail,user_status');
        $builder->where(array('hashmail'=>$hashmail,'user_status'=>1));
        if($builder->countAllResults()>0){
        $result=$builder->get();    
        return true;
        }else{
        return false;
        }
          
    }
    
    function checkAvail($email){
      $builder=$this->db->table('employers');
        $builder->select('email');
        $builder->where(array('email'=>$email));
        if($builder->countAllResults()>0){
        $result=$builder->get();    
        return true;
        }else{
        return false;
        }
       
    }function addEmployer($data){
        $builder=$this->db->table('employers');
        $result=$builder->insert($data);
        return $result;
    }
    function isConnected($hash,$email){
      $builder=$this->db->table('connection');
        $builder->select('*');
        $builder->where(array('hashmail'=>$hash,'employer'=>$email));
        $result=$builder->get();
        if($result->getNumRows()>0){
       // $result=$builder->get();    
        return true;
        }else{
        return false;
        }
       
    }
    function addNewConnection($data){
        $builder=$this->db->table('connection');
        $result=$builder->insert($data);
        return $result;
    }
     function getDetails($email){
        $builder=$this->db->table('employers');
        $builder->select('*');
        $builder->where(array('email'=>$email));
        $builder->join('company_assets', 
        'company_assets.company_id=employers.id');
         $result=$builder->get();
      return $result->getResult();
        
    }
    function getConnections($email,$sub){
        if($sub=="0"){
           $details=$this->db->table('connection')->where(array('employer'=>$email))->limit('5')->get()->getResult(); 
        }else{
            $details=$this->db->table('connection')->where(array('employer'=>$email))->get()->getResult();
        }
         
         return $details;
    }
    function getPostedJobs($id){
         $details=$this->db->table('job_posts')->where(array('company_id'=>$id,'status <'=>4))->get()->getResult();
         return $details;
    }
    function verifyEmployer($hashmail){
        $data = array(
        'user_status' => 1,
        'activation_date'=>date('Y-m-d H:i:s')
        );
        $builder=$this->db->table('employers');
        $builder->where(array('hashmail'=>$hashmail));
        $result=$builder->update($data);
         if($result){
             return true;
         }else{
            return false; 
         }
       
       
    }
    function updateStatus($email,$status){
        $data = array(
        'verification' => $status
        );
        $builder=$this->db->table('employers');
        $builder->where(array('email'=>$email));
        $result= $builder->update($data);
         if($result){
             return true;
         }else{
            return false; 
         }
       
       
    }
    function addNewKey($key){
        $data = array(
        'sessionKey' => $key,
        );
        $builder=$this->db->table('admins');
        $builder->where(array('id'=>'1'));
        $result=$builder->update($data);
         if($result){
             return true;
         }else{
            return false; 
         }
      
    }
    
    
    
     function updatePassword($data,$token){
        
        $builder=$this->db->table('employers');
        $builder->where(array('email'=>$token));
        $result=$builder->update($data);
         if($result){
             return true;
         }else{
            return false; 
         }
      
    }
    
    
}
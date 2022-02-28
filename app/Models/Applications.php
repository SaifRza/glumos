<?php
namespace App\Models;
use CodeIgniter\Model;

class Applications extends Model{

    function getAdminInfo(){
        return $this->db->table('employers')->get()->getResult();
    }
    
    
    function getApplication(){
        
    }
    function getAllSeekers(){
      return $this->db->table('jobseekers')->get()->getResult();   
    }
    
    function addTalents($data){
     $builder=$this->db->table('talents_tb');
        $result=$builder->insert($data);
        return $result;   
    }
    function checkConnection($appli,$company){
        $builder=$this->db->table('talents_tb');
        $builder->select('*');
        $builder->where(array('applicant_id'=>$appli,'company_id'=>$company));
        $result=$builder->get(); 
        if($result->getNumRows()>0){   
        return true;
        }else{
        return false;
        } 
    }
    
    
    
    function addApplication($data){
     $builder=$this->db->table('job_application');
        $result=$builder->insert($data);
        return $result;   
    }
    
    function  getApplied($jobId,$userid){
       $builder=$this->db->table('job_application');
        $builder->select('*');
        $builder->where(array('applicant_id'=>$userid,'post_id'=>$jobId));
        $result=$builder->get(); 
        if($result->getNumRows()>0){   
        return true;
        }else{
        return false;
        }  
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
        $builder->select('hashmail,status');
        $builder->where(array('hashmail'=>$hashmail,'status'=>1));
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
     function getDetails($email){
         $details=$this->db->table('employers')->join('company_assets','company_assets.company_id=employers.id')->where('email',$email)->get()->getResult();
         return $details;
    }
    function getPostedJobs($id){
         $details=$this->db->table('job_posts')->where('company_id',$id)->get()->getResult();
         return $details;
    }
    function verifyEmployer($hashmail){
        $data = array(
        'status' => 1,
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
     function  updateHash($data,$id){
        
        $builder=$this->db->table('jobseekers');
        $builder->where(array('email'=>$id));
        $result=$builder->update($data);
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
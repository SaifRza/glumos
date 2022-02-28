<?php
namespace App\Models;
use CodeIgniter\Model;

class Uploads extends Model{

    function getAdminInfo(){
        return $this->db->table('employers')->get()->getResult();
    }
    function getData($id){
        return $this->db->table('company_assets')->where(array('company_id'=>$id))->get()->getResult();
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
    
    
     function isEmployerVerified($hasmail){
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
       
    }
    function insExp($data){
        $builder=$this->db->table('exp_edu_tb');
        $result=$builder->insert($data);
        return $result;
    }
    
    function addEmployer($data){
        $builder=$this->db->table('employers');
        $result=$builder->insert($data);
        return $result;
    }
     function getDetails($email){
         $details=$this->db->table('employers')->where('email',$email)->get()->getResult();
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
        $builder->update($data);
        $result=$builder->where('hashmail',$hashmail);
         if($result){
             return true;
         }else{
            return false; 
         }
       
       
    }
    function uploadUserDetails($data,$userid){
          
      $builder=$this->db->table('jobseekers');
        $builder->where('email',$userid);
        $result=$builder->update($data);
         if($result){
             return true;
         }else{
            return false; 
         }  
    }
    
    function uploadFeatured($data,$company_id){
        $builder=$this->db->table('company_assets');
        $builder->where('company_id',$company_id);
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
        $builder->update($data);
        $result=$builder->where('id','1');
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
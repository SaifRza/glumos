<?php
namespace App\Models;
use CodeIgniter\Model;

class JobSeekers extends Model{

    function getAdminInfo(){
        return $this->db->table('jobseekers')->get()->getResult();
    }
   
      function searchSeeker($email){
        $builder=$this->db->table('jobseekers');
        $builder->select('*');
        $builder->where(array('email'=>$email));
        if($builder->countAllResults()>0){
        $result=$builder->get();    
        return true;
        }else{
        return false;
        }
       
    }
   
     function isJobSeekerVerified($hashmail){
      $builder=$this->db->table('jobseekers');
        $builder->select('hashmail,status');
        $builder->where(array('hashmail'=>$hashmail,'status'=>1));
        if($builder->countAllResults()>0){
        $result=$builder->get();    
        return true;
        }else{
        return false;
        }
          
    }
   
   
    function isJobSeekerValid($email,$password){
        $builder=$this->db->table('jobseekers');
        $builder->select('*');
        $builder->where(array('email'=>$email,'password'=>md5($password)));
        $result=$builder->get(); 
        if($result->getNumRows()>0){
        return true;
        }else{
        return false;
        }
        
        //return $result;  
    }
    
     function isEmailValid($email){
      $builder=$this->db->table('jobseekers');
        $builder->select('email,verification');
        $builder->where(array('email'=>$email,'verification'=>1));
        if($builder->countAllResults()>0){
        $result=$builder->get();    
        return true;
        }else{
        return false;
        }
         
    }
    
     function  checkTokens($token){
      $builder=$this->db->table('reset_password');
        $builder->select('reset_token');
        $builder->where(array('reset_token'=>$token));
        if($builder->countAllResults>0){
        return true;
        }else{
        return false;
        }   
     }
    
    
    function checkAvail($email){
      $builder=$this->db->table('jobseekers');
        $builder->select('*');
        $builder->where(array('email'=>$email));
        $results=$builder->get();
        return $results->getNumRows();
       
    }
   
   function saveThisJob($data,$id,$post_id){
        $builder=$this->db->table('saved_jobs');
        $builder->select('*');
        $builder->where(array('applicant_id'=>$id,'post_id'=>$post_id));
        $results=$builder->get();
        if($results->getNumRows()>0){
           return false; 
        }else{
        $abuilder=$this->db->table('saved_jobs');
        $result=$abuilder->insert($data);  
        return $result; 
        }
      
    }
    
   function addJobseeker($data){
        $builder=$this->db->table('jobseekers');
        $result=$builder->insert($data);
        return $result;
    }
    function getDetailsCoded($id){
         $details=$this->db->table('jobseekers')->where('hashmail',$id)->get()->getResult();
         return $details;
    }
    function getCompanyDetails($id){
      $details=$this->db->table('employers')->where('id',$id)->get()->getResult();
         return $details;  
    }
    function getCompanyAssets($id){
      $details=$this->db->table('company_assets')->where('company_id',$id)->get()->getResult();
         return $details;  
    }
    function getExpCoded($email){
         $details=$this->db->table('exp_edu_tb')->where('user_id',$email)->get()->getResult();
         return $details;
    }
     function getDetails($email){
         $details=$this->db->table('jobseekers')->where('email',$email)->get()->getResult();
         return $details;
    }
    function getExp($email){
         $details=$this->db->table('exp_edu_tb')->where('user_id',$email)->get()->getResult();
         return $details;
    }
     function verifyJobSeeker($hashmail){
        $data = array(
        'status' => 1,
        'activation_date'=>date('Y-m-d H:i:s')
        );
        $builder=$this->db->table('jobseekers');
        $builder->update($data);
        $result=$builder->where('hashmail',$hashmail);
         if($result){
             return true;
         }else{
            return false; 
         }
      
    }
     function setStatustoToken($data,$token){
        
        $builder=$this->db->table('reset_password');
        $builder->where(array('reset_token'=>$token));
        $result=$builder->update($data);
         if($result){
             return true;
         }else{
            return false; 
         }
      
    }
     function updateWallet($data,$email){
        
        $builder=$this->db->table('jobseekers');
        $builder->where(array('email'=>$email));
        $result=$builder->update($data);
         if($result){
             return true;
         }else{
            return false; 
         }
      
    }
    
     function updatePassword($data,$token){
        
        $builder=$this->db->table('jobseekers');
        $builder->where(array('email'=>$email));
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
        $builder=$this->db->table('jobseekers');
        $builder->update($data);
        $result=$builder->where('id','1');
         if($result){
             return true;
         }else{
            return false; 
         }
    } 
    
    function addToResetPassword($data){
        $builder=$this->db->table('reset_password');
        $result=$builder->insert($data);
        return $result; 
    }
    
    function getTokenInfo($token){
        $builder=$this->db->table('reset_password');
        $builder->select('*');
        $builder->where(array('reset_token'=>$token,'status'=>0));
        if($builder->countAllResults()>0){
        $result=$builder->get()->getResult();    
        return $result;
        }else{
        return false;
        }   
    }
    
}
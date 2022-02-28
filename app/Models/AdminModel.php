<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model{

    function getAdminInfo(){
        return $this->db->table('admins')->get()->getResult();
    }
    
    function getAllEmployers(){
      return $this->db->table('employers')->join('company_assets','company_assets.company_id=employers.id')->get()->getResult();  
    }
    
     function getAllJobSeekers(){
      return $this->db->table('jobseekers')->get()->getResult();  
    }
      function getAllPayments(){
      return $this->db->table('stripe_tb')->get()->getResult();  
    }
    
    
    function verifyEmployer(){
      $id= $this->request->getPost('id'); 
        echo json_encode(array('response'=>true,'message'=>"Verifying $id"));
    }
   
    function isAdminValid($email,$password){
      $builder=$this->db->table('admins');
        $builder->select('admin_id,password');
        $builder->where(array('admin_id'=>$email,'password'=>$password));
        if($builder->countAllResults()>0){
        $result=$builder->get();    
        return true;
        }else{
        return false;
        }
        
        return $result;  
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
    function updateCompany($array,$id){
        $builder=$this->db->table('employers');
        $builder->where(array('email'=>$id));
        $result=$builder->update($array);
         if($result){
             return true;
         }else{
            return false; 
         }
    }
    
}
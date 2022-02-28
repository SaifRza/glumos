<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{

    function all(){
        return $this->db->table('sidebar_tb')->get()->getResult();
    }
    function hero(){
        return $this->db->table('site_assets')->get()->getResult();
    }
    function getSidebarDetails(){
        $builder =$this->db->table('sidebar_tb');
        $sidebar=$bulider->get()->getResult();
        return $sidebar;
    }
    function isUserExists($email,$password){
      $builder=$this->db->table('accounts');
        $builder->select('*');
        $builder->where(array('email'=>$email,'password'=>$password));
        $result=$builder->get();
        if($builder->countAll()==1){
        return $result->getRow();
        }else{
        return false;
        }
        
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
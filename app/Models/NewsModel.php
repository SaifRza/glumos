<?php
namespace App\Models;
use CodeIgniter\Model;

class NewsModel extends Model{

    function allNews(){
        return $this->db->table('news_headings')->get()->getResult();
    }
    function newsCategory($category){
        return $this->db->table('news_headings')->where('category',$category)->get()->getResult();
    }
    function getNewsDetails($id){
        $details=$this->db->table('news_headings')->where('id',$id)->get()->getRow();
        return $details;
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
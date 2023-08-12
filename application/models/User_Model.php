<?php 

class User_Model extends CI_Model 
{
    function registerUser($data)
    {
        $this->db->insert('user',$data);
    }

    function listUsers()
    {
        return $this->db->select('FIRST_NAME,LAST_NAME,EMAIL,GENDER,TELEPHONE,AGE')
            ->from('user')
            ->get()
            ->result();
    }

}
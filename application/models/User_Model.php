<?php 

class User_Model extends CI_Model 
{

    function checkExists($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('user');
        return $query->num_rows() == 1;
    }
    
    function listUsers()
    {
        return $this->db->select('ID,FIRST_NAME,LAST_NAME,EMAIL,GENDER,TELEPHONE,AGE')
            ->from('user')
            ->get()
            ->result();
    }

    function getUser($id)
    {
        $this->db->select('ID,FIRST_NAME,LAST_NAME,EMAIL,GENDER,TELEPHONE,AGE');
        $this->db->where('ID', $id);
        $query = $this->db->get('user');
        return $query->row();
    }

    function registerUser($data)
    {
        $this->db->insert('user',$data);
    }

    function updateUser($data){
        $this->db->set('FIRST_NAME', $data->FIRST_NAME);
        $this->db->set('LAST_NAME', $data->LAST_NAME);
        $this->db->set('EMAIL', $data->EMAIL);
        $this->db->set('GENDER', $data->GENDER);
        $this->db->set('TELEPHONE', $data->TELEPHONE);
        $this->db->set('AGE', $data->AGE);
        $this->db->where('ID', $data->ID);
        $this->db->update('user');
    }

    function deleteUser($id)
    {
        $this->db->delete('user', array('ID' => $id));
    }

}